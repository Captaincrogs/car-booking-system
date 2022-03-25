<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/cart.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <title>Document</title>
</head>

<header>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="header-content">
                    <div class="header-content-inner">
                        <h1>Your Cart</h1>
                        <hr>
                        @if(Session::has('list'))
                        @else
                        <p>Your cart is empty</p>
                        @endif
                        <a href="/cars" class="btn btn-primary btn-xl page-scroll">Continue Shopping</a>
                    </div>
                </div>
            </div>
        </div>
</header>
<div class="container d-lg-flex">
    <div class="box-1 bg-light user">
{{-- foreach car_id in session display  --}}
    @if(Session::has('car_id'))
    <div class="alert alert-primary">
    </div>
    @endif
        <div class="box-inner-1 pb-3 mb-3 ">
            <div class="  mb-3 ">
                    
                    <ul class="list-group">
                        <h3>Chosen Cars</h3>
                        @foreach($session_cars as $session)
                        <li class="list-group-item list-group-item-primary">€{{$session->hourlyPrice}} {{$session->brand}} ~ {{$session->model}} </li>
                        @endforeach
                      </ul>

                     {{-- <li>{{$car_id === $car->id ? $car->hourlyPrice: '' }}</li> --}}
                     {{-- count the total hourlyPrice and display it --}}
                     {{-- @php
                        $price = $car->hourlyPrice;
                        $totalPrice = $price * count(Session::get('car_id'));
                        @endphp --}}
                        {{-- <li>{{$totalPrice}}</li> --}}
                        
            </div>
        
            <p class="dis info my-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate quos ipsa sed officiis odio </p>
           
        </div>
    </div>
    <div class="box-2">
        <div class="box-inner-2">
            <div>
                <p class="fw-bold">Payment Details</p>
                <p class="dis mb-3">Complete your purchase by providing your payment details</p>
            </div>
            <form action="">
                {{-- <div class="mb-3">
                    <p class="dis fw-bold mb-2">Full Name</p> <input class="form-control" type="email">
                </div>
                <div class="mb-3">
                    <p class="dis fw-bold mb-2">Email address</p> <input class="form-control" type="email">
                </div>
                <div class="mb-3">
                    <p class="dis fw-bold mb-2">Postal Code</p> <input class="form-control" type="text" >
                </div>
                <div class="mb-3">
                    <p class="dis fw-bold mb-2">City</p> <input class="form-control" type="text" >
                </div>
                <div class="mb-3">
                    <p class="dis fw-bold mb-2">Addres</p> <input class="form-control" type="text" >
                </div> --}}
                <div>
                    <p class="dis fw-bold mb-2">Phone number</p>
                    <input class="form-control" type="text">
                    <div class="address">
                        <p class="dis fw-bold mb-3">Select start Date</p> 
                            <input type="date" id="start" name="trip-start">
                            <br>
                        <p class="dis fw-bold mb-3">Select end Date</p> 
                            <input type="date" id="start" name="trip-end">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <p class="fw-bold">Total</p>
                                <p class="fw-bold"><span class="fas fa-euro-sign"></span>{{$total_price}}</p>
                            </div>
                            <div class="btn btn-primary mt-2">Print Invoice<span class="fas fa-euro-sign px-1"></span>{{$total_price}} </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>