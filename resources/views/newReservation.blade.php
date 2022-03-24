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
                        @if(Session::has('car_id'))
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
        <ul>
            @foreach(Session::get('list') as $car_id)
            @foreach($cars as $car)
            <li> {{$car_id === $car->id ? $car->id : '' }} {{$car_id === $car->id ? $car->brand : '' }} {{$car_id === $car->id ? $car->model : '' }}</li>

             @endforeach
            @endforeach
        </ul>
    </div>
    @endif
        <div class="box-inner-1 pb-3 mb-3 ">
            <div class="d-flex justify-content-between mb-3 userdetails">
                <p class="fw-bold">Car</p>
                <p class="fw-lighter"><span class="fas fa-euro-sign"></span>
                    @if(Session::has('list'))
                    {{-- {{dd(Session::get('list'))}} --}}
                    @foreach(Session::get('list') as $car_id)
                    @foreach($cars as $car)
                    <!-- count price the total hourly price-->
                    @if($car_id === $car->id)
                        {{-- <li>{{$car_id === $car->id ? $car->hourlyPrice: '' }}</li> --}}
                        {{-- count the total hourlyPrice and display it --}}
                        {{-- @php
                            $price = $car->hourlyPrice;
                            $totalPrice = $price * count(Session::get('car_id'));
                        @endphp --}}
                        <li>{{$totalPrice}}</li>
                    @endif                    
                    @endforeach
                    @endforeach
                    @endif
                </p>
            </div>
            <div id="my" class="carousel slide carousel-fade img-details" data-bs-ride="carousel" data-bs-interval="2000">
                <div class="carousel-indicators"> <button type="button" data-bs-target="#my" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button> <button type="button" data-bs-target="#my" data-bs-slide-to="1" aria-label="Slide 2"></button> <button type="button" data-bs-target="#my" data-bs-slide-to="2" aria-label="Slide 3"></button> </div>
                <div class="carousel-inner">
                    <div class="carousel-item active"> <img src="" class="d-block w-100"> </div>
                </div> <button class="carousel-control-prev" type="button" data-bs-target="#my" data-bs-slide="prev">
                    <div class="icon"> <span class="fas fa-arrow-left"></span> </div> <span class="visually-hidden">Previous</span>
                </button> <button class="carousel-control-next" type="button" data-bs-target="#my" data-bs-slide="next">
                    <div class="icon"> <span class="fas fa-arrow-right"></span> </div> <span class="visually-hidden">Next</span>
                </button>
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
                <div class="mb-3">
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
                </div>
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
                                <p class="fw-bold"><span class="fas fa-dollar-sign"></span>35.80</p>
                            </div>
                            <div class="btn btn-primary mt-2">Print Invoice<span class="fas fa-euro-sign px-1"></span>35.80 </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>