<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

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

        // totalAmount is the hourly price of the car multiplied by the number of days
        foreach ($request->car_id as $car_id) {
            $car = Car::find($car_id);
            $totalAmount = $car->daily_price * $request->total_price;
        }

        //foreach carid in session put in new invoiceItem
        foreach ($request->car_id as $item) {
            $items[] = (new InvoiceItem())
                ->title(car::find($item)->brand . ' ' . car::find($item)->model)
                ->description(' licence plate:' . ' ' . car::find($item)->licence_plate)
                ->pricePerUnit(car::find($item)->daily_price)
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
        
        if ($reservation->invoice_link == null) {
            $reservation->invoice_link = $reservation->invoice_link . $invoice->url();
        } else {
            $reservation->invoice_link = $reservation->invoice_link . '->' . $invoice->url();
        }

        if ($reservation->reservation_end_date < $reservation->reservation_start_date) {
            $reservation->status = 'canceled';
        }

        //if session
        $reservation->save();
        return $invoice->stream();
        return redirect()->route('cars')->with('success', 'Reservation added successfully');
    }

    public function sessionRemove(Request $request)
    {

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
        $reservation = Reservation::find($request->reservation_id);
        //if it is the same download else trow error
        //remove http://rentacar.test/storage from invoice link
        $invoice_link = str_replace('http://rentacar.test/storage/', '', $reservation->invoice_link);
        return response()->download(public_path() . '/public/'. $invoice_link);

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

        //insert new
        $car = new Car();
        $car->brand = $request->brand;
        $car->model = $request->model;
        $car->licence_plate = $request->licence_plate;
        $car->daily_price = $request->dailyprice;
        $car->category = $request->category;
        if ($request->gps == 'yes') {
            $car->gps = 1;
        } else {
            $car->gps = 0;
        }
        $car->seats = $request->seats;
        $car->horsepower = $request->horsepower;
        $car->top_speed = $request->topspeed;
        
        $image = $request->file('image');
        $image_name = time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('/img/cars');
        $image->move($destinationPath, $image_name);
        $car->image = $image_name;
        $car->save();

        return redirect()->route('admin')->with('success', 'Car added successfully');
    }


    public function update_cars(Request $request)
    {
        $car = new Car;
        $car = Car::find($request->car_id);
        $car->updated_at = now();
        $car->created_at = $car->created_at;
        $car->seats = $car->seats;
        $car->brand = $car->brand;
        $car->model = $request->model;
        $car->licence_plate = $request->licence_plate;
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
                $total_price += $car->daily_price;
            }
               
            //if cart has more then one car remove the last car
            if (count($session_cars) > 1) {
                Session::pull('list', [$session_cars[count($session_cars) - 1]->id]);
                return back()->with('error', 'Please select only one car');
               

            }
            return view('newReservation', compact('reservation', 'cars', 'session_cars', 'total_price'));
        }
    }
}




  