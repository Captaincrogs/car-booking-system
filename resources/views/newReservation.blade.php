<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <script type="text/javascript" src="{{ mix('js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
    <title>Document</title>
</head>
@if(session()->has('success'))
    <div class="alert alert-success">
        <li><strong>{{ session()->get('success') }}</strong></li>
    </div>
@endif

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
            <form action="newReservation/store" method="post">
                @csrf
                <div>
                    @if(Auth::check())
                    <h4 >Hello, <strong>{{Auth::user()->name}}</strong> please select your pick up date and drop off date</h4>
                    @endif
                        <p class="dis fw-bold mb-3">Select start Date</p> 
                            <input type="date" class="selectedDate" id="pickupDate" min="2022-04-04"  name="pickupDate">
                            <input type="time" class="pickupTime" name="pickupTime" id="pickUpTime"> <span><strong> Pick up time</strong></span>
                            <br>
                            <br>    
                        <p class="dis fw-bold mb-3">Select end Date</p> 
                            <input type="date" class="selectedDate" id="returnDate" min="2022-04-06"  max='2022-08-05' name="returnDate">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <p class="fw-bold">Total</p>
                                <p class="fw-bold totalPrice">
                                    <span class="fas fa-euro-sign"></span>
                                    <span class="price">{{$total_price}}</span>
                                </p>
                            </div>
                            <div class="btn btn-primary mt-2">
                                <button type="submit" class="btn btn-primary">Print your pick up invoice!</button>
                            </div>
                            @foreach($session_cars as $session)
                            <input type="text" name="car_id[]" id="car_id" hidden value={{$session->id}} >
                            <input type="text" name="total_price" id="total_price" hidden value={{$total_price}}>
                            @endforeach
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>
<script>


let selectedDate = document.querySelectorAll('.selectedDate');

selectedDate.forEach(function(elem) {
    elem.addEventListener("change", function() {

        let pickupDate = document.querySelector('#pickupDate')
        let returnDate = document.querySelector('#returnDate')

        let pickUpDateMoment = moment(pickupDate.value, 'YYYY-MM-DD');
        let returnDateMoment = moment(returnDate.value, 'YYYY-MM-DD');

        let diff = returnDateMoment.diff(pickUpDateMoment, 'days');

        let totalPrice = diff * {{$total_price}};
        console.log (totalPrice);

        document.querySelector('.totalPrice .price').innerText = totalPrice;
   
        

    });
});



</script>