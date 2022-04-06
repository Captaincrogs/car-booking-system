<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Models\Car;
use App\Models\Reservation;
use Illuminate\Support\Facades\Session;

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
        //get whole session     
        return view('reservations', compact('reservations'));
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
            // $reservation->save();
        }

        $count = count($request->car_id);  

        
        
        $client = new Party([
            'name'          => 'Roosevelt Lloyd',
            'phone'         => '(520) 318-9486',
            'custom_fields' => [
                'note'        => 'IDDQD',
                'company'   => "Rent a Car",
                'business id' => '365#GG',
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

        //foreach carid in session put in new invoiceItem
        
        foreach ($request->car_id as $items) {
        $items = [
            (new InvoiceItem())
                    ->title(car::find($items)->brand . ' ' . car::find($items)->model)
                    ->description(' licence plate:' . ' ' . car::find($items)->licence_plate)
                    ->pricePerUnit(car::find($items)->hourlyPrice)
                    ->quantity($count)
                    ->discount(0),
                ];
            }
            
            $notes = [
                'Your pick up invoice',
                'Please bring this invoice when attending the pick up', 
            ];
        $notes = implode("<br>", $notes);
        
        $invoice = Invoice::make('receipt')
            ->series('BIG')
            // ability to include translated invoice status
            // in case it was paid
            ->status(__('invoices::invoice.paid'))
            ->sequence(667)
            ->serialNumberFormat('{SEQUENCE}/{SERIES}')
            ->seller($client)
            ->buyer($customer)
            ->date(now()->subWeeks(3))
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
        
        // $link = $invoice->url();
        // Then send email to party with link

        // And return invoice itself to browser or have a different view
        return $invoice->stream();

        return redirect()->route('newReservation')->with('success', 'Reservation added successfully');
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
        //count the total price of the car
        $total_price = 0;
        foreach ($session_cars as $car) {
            $total_price += $car->hourlyPrice;
        }
        return view('newReservation', compact('reservation', 'cars', 'session_cars', 'total_price'));
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
