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
    
    public function printInvoices()
    {
        $client = new Party([
            'name'          => 'Roosevelt Lloyd',
            'phone'         => '(520) 318-9486',
            'custom_fields' => [
                'note'        => 'IDDQD',
                'business id' => '365#GG',
            ],
        ]);
        
        $customer = new Party([
            'name'          => 'Ashley Medina',
            'address'       => 'The Green Street 12',
            'code'          => '#22663214',
            'custom_fields' => [
                'order number' => '> 654321 <',
            ],
        ]);
        
        $items = [
            (new InvoiceItem())
                ->title('Service 1')
                ->description('Your product or service description')
                ->pricePerUnit(47.79)
                ->quantity(2)
                ->discount(10),
            (new InvoiceItem())->title('Service 2')->pricePerUnit(71.96)->quantity(2),
            (new InvoiceItem())->title('Service 3')->pricePerUnit(4.56),
            (new InvoiceItem())->title('Service 4')->pricePerUnit(87.51)->quantity(7)->discount(4)->units('kg'),
            (new InvoiceItem())->title('Service 5')->pricePerUnit(71.09)->quantity(7)->discountByPercent(9),
            (new InvoiceItem())->title('Service 6')->pricePerUnit(76.32)->quantity(9),
            (new InvoiceItem())->title('Service 7')->pricePerUnit(58.18)->quantity(3)->discount(3),
            (new InvoiceItem())->title('Service 8')->pricePerUnit(42.99)->quantity(4)->discountByPercent(3),
            (new InvoiceItem())->title('Service 9')->pricePerUnit(33.24)->quantity(6)->units('m2'),
            (new InvoiceItem())->title('Service 11')->pricePerUnit(97.45)->quantity(2),
            (new InvoiceItem())->title('Service 12')->pricePerUnit(92.82),
            (new InvoiceItem())->title('Service 13')->pricePerUnit(12.98),
            (new InvoiceItem())->title('Service 14')->pricePerUnit(160)->units('hours'),
            (new InvoiceItem())->title('Service 15')->pricePerUnit(62.21)->discountByPercent(5),
            (new InvoiceItem())->title('Service 16')->pricePerUnit(2.80),
            (new InvoiceItem())->title('Service 17')->pricePerUnit(56.21),
            (new InvoiceItem())->title('Service 18')->pricePerUnit(66.81)->discountByPercent(8),
            (new InvoiceItem())->title('Service 19')->pricePerUnit(76.37),
            (new InvoiceItem())->title('Service 20')->pricePerUnit(55.80),
        ];

        $notes = [
            'your multiline',
            'additional notes',
            'in regards of delivery or something else',
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
            ->currencySymbol('$')
            ->currencyCode('USD')
            ->currencyFormat('{SYMBOL}{VALUE}')
            ->currencyThousandsSeparator('.')
            ->currencyDecimalPoint(',')
            ->filename($client->name . ' ' . $customer->name)
            ->addItems($items)
            ->notes($notes)
            ->logo(public_path('vendor/invoices/sample-logo.png'))
            // You can additionally save generated invoice to configured disk
            ->save('public');

        $link = $invoice->url();
        // Then send email to party with link

        // And return invoice itself to browser or have a different view
        return $invoice->stream();
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
        
        return view('newReservation', compact('reservation' , 'cars'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreReservationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReservationRequest $request)
    {
        //
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
