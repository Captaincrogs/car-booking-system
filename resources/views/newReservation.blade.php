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
                        <p>Your cart is empty</p>
                        <a href="/cars" class="btn btn-primary btn-xl page-scroll">Continue Shopping</a>
                    </div>
                </div>
            </div>
        </div>
</header>
<div class="container d-lg-flex">
    <div class="box-1 bg-light user">
     
        <div class="box-inner-1 pb-3 mb-3 ">
            <div class="d-flex justify-content-between mb-3 userdetails">
                <p class="fw-bold">Lightroom Presets</p>
                <p class="fw-lighter"><span class="fas fa-dollar-sign"></span>33.00+</p>
            </div>
            <div id="my" class="carousel slide carousel-fade img-details" data-bs-ride="carousel" data-bs-interval="2000">
                <div class="carousel-indicators"> <button type="button" data-bs-target="#my" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button> <button type="button" data-bs-target="#my" data-bs-slide-to="1" aria-label="Slide 2"></button> <button type="button" data-bs-target="#my" data-bs-slide-to="2" aria-label="Slide 3"></button> </div>
                <div class="carousel-inner">
                    <div class="carousel-item active"> <img src="https://thumbs.dreamstime.com/z/fiat-multipla-venice-italy-july-motor-car-city-street-57677951.jpg" class="d-block w-100"> </div>
                </div> <button class="carousel-control-prev" type="button" data-bs-target="#my" data-bs-slide="prev">
                    <div class="icon"> <span class="fas fa-arrow-left"></span> </div> <span class="visually-hidden">Previous</span>
                </button> <button class="carousel-control-next" type="button" data-bs-target="#my" data-bs-slide="next">
                    <div class="icon"> <span class="fas fa-arrow-right"></span> </div> <span class="visually-hidden">Next</span>
                </button>
            </div>
            <p class="dis info my-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate quos ipsa sed officiis odio </p>
            <div class="radiobtn"> <input type="radio" name="box" id="one"> <input type="radio" name="box" id="two"> <input type="radio" name="box" id="three"> <label for="one" class="box py-2 first">
                    <div class="d-flex align-items-start"> <span class="circle"></span>
                        <div class="course">
                            <div class="d-flex align-items-center justify-content-between mb-2"> <span class="fw-bold"> Collection 01 </span> <span class="fas fa-dollar-sign">29</span> </div> <span>10 x Presets. Released in 2018</span>
                        </div>
                    </div>
                </label> <label for="two" class="box py-2 second">
                    <div class="d-flex"> <span class="circle"></span>
                        <div class="course">
                            <div class="d-flex align-items-center justify-content-between mb-2"> <span class="fw-bold"> Collection 01 </span> <span class="fas fa-dollar-sign">29</span> </div> <span>10 x Presets. Released in 2018</span>
                        </div>
                    </div>
                </label> <label for="three" class="box py-2 third">
                    <div class="d-flex"> <span class="circle"></span>
                        <div class="course">
                            <div class="d-flex align-items-center justify-content-between mb-2"> <span class="fw-bold"> Collection 01 </span> <span class="fas fa-dollar-sign">29</span> </div> <span>10 x Presets. Released in 2018</span>
                        </div>
                    </div>
                </label> </div>
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
                    <p class="dis fw-bold mb-2">Email address</p> <input class="form-control" type="email" value="luke@skywalker.com">
                </div>
                <div>
                    <p class="dis fw-bold mb-2">Card details</p>
                    <div class="d-flex align-items-center justify-content-between card-atm border rounded">
                        <div class="fab fa-cc-visa ps-3"></div> <input type="text" class="form-control" placeholder="Card Details">
                        <div class="d-flex w-50"> <input type="text" class="form-control px-0" placeholder="MM/YY"> <input type="password" maxlength=3 class="form-control px-0" placeholder="CVV"> </div>
                    </div>
                    <div class="my-3 cardname">
                        <p class="dis fw-bold mb-2">Cardholder name</p> <input class="form-control" type="text">
                    </div>
                    <div class="address">
                        <p class="dis fw-bold mb-3">Billing address</p> <select class="form-select" aria-label="Default select example">
                            <option selected hidden>United States</option>
                            <option value="1">India</option>
                            <option value="2">Australia</option>
                            <option value="3">Canada</option>
                        </select>
                        <div class="d-flex"> <input class="form-control zip" type="text" placeholder="ZIP"> <input class="form-control state" type="text" placeholder="State"> </div>
                        <div class=" my-3">
                            <p class="dis fw-bold mb-2">VAT Number</p>
                            <div class="inputWithcheck"> <input class="form-control" type="text" value="GB012345B9"> <span class="fas fa-check"></span> </div>
                        </div>
                        <div class="d-flex flex-column dis">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <p>Subtotal</p>
                                <p><span class="fas fa-dollar-sign"></span>33.00</p>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <p>VAT<span>(20%)</span></p>
                                <p><span class="fas fa-dollar-sign"></span>2.80</p>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <p class="fw-bold">Total</p>
                                <p class="fw-bold"><span class="fas fa-dollar-sign"></span>35.80</p>
                            </div>
                            <div class="btn btn-primary mt-2">Pay<span class="fas fa-dollar-sign px-1"></span>35.80 </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>