<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use Illuminate\Http\Request;

use App\Models\Car;
use App\Models\User;
use App\Models\Reservation;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\InvoiceItem;


class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservations = Reservation::all();
        $cars = Car::all();
        //get whole session     
        return view('admin', compact('reservations', 'cars'));
    }

    public function printInvoices(StoreReservationRequest $request)
    {

        for ($i = 0; $i < count($request->car_id); $i++) {
            $reservation = new Reservation;
            $reservation->car_id = $request->car_id[$i];
            $reservation->user_id = auth()->user()->id;
            $reservation->reservation_start_date = $request->pickupDate;
            $reservation->reservation_end_date = $request->returnDate;
            $reservation->reservation_time = $request->pickupTime;
            $reservation->status = 'pending';
            $request->total_price;
            $reservation->save();
        }

        //first get difrence then calculte total price
        $start = new \DateTime($request->pickupDate);
        $end = new \DateTime($request->returnDate);
        $days = $start->diff($end)->days;

        //multiply days by price
        $totalPrice = $days * $request->total_price;


        $client = new Party([
            'name'          => 'RentaCar'  . Auth::user()->name . rand(1, 100),
            'phone'         => '(520) 318-9486',
            'custom_fields' => [
                'note'        => 'IDDQD',
                'company'   => "Rent a Car",
                'address'   => "123 Main St",
            ],
        ]);

        $customer = new Party([
            'code'          => '#22663214',
            'name'          =>  auth()->user()->name,
            'address'       =>  auth()->user()->adress,
            'custom_fields' => [
                'city'          =>  auth()->user()->city,
                'cellphone'     =>  auth()->user()->cellphone,
                'order number' => '> 654321 <',
            ],
        ]);

        // totalAmount is the hourly price of the car multiplied by the number of hours
        foreach ($request->car_id as $car_id) {
            $car = Car::find($car_id);
            $totalAmount = $car->hourlyPrice * $request->total_price;
        }

        //foreach carid in session put in new invoiceItem
        foreach ($request->car_id as $item) {
            $items[] = (new InvoiceItem())
                ->title(car::find($item)->brand . ' ' . car::find($item)->model)
                ->description(' licence plate:' . ' ' . car::find($item)->licence_plate)
                ->pricePerUnit(car::find($item)->hourlyPrice)
                ->discount(0)
                ->subTotalPrice(0)
                ->tax(0);
        }

        $notes = [
            'Please bring this invoice when attending the pick up',
            " ",
            //pickup date and time 
            'Pickup Date: ' . $request->pickupDate . ' ' . $request->pickupTime,
            //return date
            'Return Date: ' . $request->returnDate,
            'Thank you for choosing Rent a Car',
        ];
        $notes = implode("<br>", $notes);

        $invoice = Invoice::make('receipt')
            ->series('BIG')
            // ability to include translated invoice status
            // in case it was paid
            ->status(__('invoices::invoice.paid'))
            ->totalAmount($totalPrice)
            ->sequence(667)
            ->serialNumberFormat('{SEQUENCE}/{SERIES}')
            ->seller($client)
            ->buyer($customer)
            ->date(now()->subWeeks(0))
            ->dateFormat('m/d/Y')
            ->payUntilDays(14)
            ->currencySymbol('€')
            ->currencyCode('EUR')
            ->currencyFormat('{SYMBOL}{VALUE}')
            ->currencyThousandsSeparator('.')
            ->currencyDecimalPoint(',')
            ->filename($client->name . ' ' . $customer->name)
            ->addItems($items)
            ->notes($notes)
            // ->logo(public_path('vendor/invoices/sample-logo.png'))
            // You can additionally save generated invoice to configured disk
            ->save('public');

        Session::forget('list');
        $user = User::find(Auth::user()->id);
        if ($user->user_orders == null) {
            $user->user_orders = $user->user_orders . $invoice->url();
        } else {
            $user->user_orders = $user->user_orders . '->' . $invoice->url();
        }
        $user->save();
        return $invoice->stream();
        return redirect()->route('cars')->with('success', 'Reservation added successfully');
    }

    public function sessionRemove(Request $request)
    {

        //list heeft nog geen waarde maar is alle id's hierdoor werkt het niet op specifieke auto te verwijderen
        Session::forget('list', [$request->car_id]);
        Session::save();
        return redirect()->route('cars');
    }

    public function adminDeleteReservation(Request $request)
    {
        $reservation = Reservation::find($request->reservation_id);
        $reservation->delete();
        return redirect()->route('admin')->with('success', 'Reservation deleted successfully');
    }

    public function get_invoice(Request $request)
    {
        $invoice = user::find($request->id)->user_orders;
        $invoice = explode('->', $invoice);
        $invoice = array_filter($invoice);
        $test = explode('/', $invoice[0]);
        return response()->download(public_path() . '/storage/' . $test[count($test) - 1]);
    }

    public function edit_cars(Request $request)
    {
        $car_categories = [
            'supersport',
            'sport',
            'standard',
            'economy',
            'luxury',
        ];

        $has_gps = [
            '1',
            '0',
        ];
        $reservations = Reservation::all();
        $cars = Car::all();
        return view('admin_edit_cars', compact('reservations', 'cars', 'car_categories', 'has_gps'));
    }

    public function add_cars(Request $request)
    {
        //get all cars
        $cars = Car::all();
        // $car = new Car();
        // $car->brand = $request->brand;
        // $car->model = $request->model;
        // $car->licence_plate = $request->licence_plate;
        // $car->year = $request->year;
        // $car->hourlyPrice = $request->hourlyPrice;
        // $car->car_category = $request->car_category;
        // $car->has_gps = $request->has_gps;
        // $car->save();
        // return redirect()->route('admin')->with('success', 'Car added successfully');
        return view('admin_add_cars', compact('cars'));
    }

    public function update_cars(Request $request)
    {
        $car = new Car;
        $car = Car::find($request->car_id);
        //timestamp of today 
        $car->updated_at = now();
        $car->created_at = $car->created_at;
        $car->seats = $car->seats;
        $car->brand = $car->brand;
        $car->model = $request->model;
        $car->licence_plate = $request->licence_plate;
        //transform yes to 1 and no to 0
        if ($request->gps == 'yes') {
            $car->gps = 1;
        } else {
            $car->gps = 0;
        }
        $car->amount = $request->amount;
        // seats does not change standard value of 5

        $car->daily_price = $request->daily_price;
        $car->category = $request->category;

        $car->save();

        return redirect()->route('cars')->with('success', 'Car updated successfully');


    }

    public function delete_cars(Request $request)
    {
        $car = Car::find($request->id);
        $car->delete();
        return redirect()->route('cars')->with('success', 'Car deleted successfully');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $reservation = reservation::all();
        $cars = Car::all();

        $session_cars = Car::find(Session::get('list'));
        $total_price = 0;

        if (empty($session_cars)) {
            return redirect()->route('cars')->with('error', 'Please select a car first');
        } else {
            foreach ($session_cars as $car) {
                $total_price += $car->hourlyPrice;
            }
            return view('newReservation', compact('reservation', 'cars', 'session_cars', 'total_price'));
        }
    }




    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreReservationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReservationRequest $request)
    {
        //store the reservation
        // $reservation = new Reservation;
        // $reservation->name = $request->name;
        // $reservation->email = $request->email;
        // $reservation->phone = $request->phone;
        // $reservation->pickupDate = $request->pickupDate;
        // $reservation->returnDate = $request->returnDate;
        // $reservation->save();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReservationRequest  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReservationRequest $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}
