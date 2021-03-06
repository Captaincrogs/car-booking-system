<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <script type="text/javascript" src="<?php echo e(mix('js/app.js')); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
    <title>Document</title>
</head>
<?php if(session()->has('success')): ?>
    <div class="alert alert-success">
        <li><strong><?php echo e(session()->get('success')); ?></strong></li>
    </div>
<?php endif; ?>
<?php if(session()->has('error')): ?>
    <div class="alert alert-success">
        <li><strong><?php echo e(session()->get('success')); ?></strong></li>
    </div>
<?php endif; ?>

<header>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="header-content">
                    <div class="header-content-inner">
                        <h1>Your Cart</h1>
                        <hr>
                        <?php if(Session::has('list')): ?>
                        <?php else: ?>
                            <p>Your cart is empty</p>
                        <?php endif; ?>
                        <a href="/cars" class="btn btn-primary btn-xl page-scroll">Go back to gallery</a>
                    </div>
                </div>
            </div>
        </div>
</header>
<div class="container d-lg-flex">
    <div class="box-1 bg-light user">
        
        <?php if(Session::has('car_id')): ?>
            <div class="alert alert-primary">
            </div>
        <?php endif; ?>
        <div class="box-inner-1 pb-3 mb-3 ">
            <div class="  mb-3 ">
                <ul class="list-group">
                    <h4>Chosen Car - <strong>one car per transaction</strong></h4>
                    <?php $__currentLoopData = $session_cars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        
                        <form action="/reservation/sessionRemove" method="POST">
                            <?php echo csrf_field(); ?>
                            <li class="list-group-item list-group-item-primary">???<?php echo e($session->daily_price); ?>

                                <?php echo e($session->brand); ?> ~ <?php echo e($session->model); ?>

                                <input type="hidden" name="id" value="<?php echo e($session->car_id); ?>">
                                <button type="submit" class="btn btn-danger">Remove</button>
                            </li>
                        </form>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
            <p class="dis info my-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate quos ipsa sed
                officiis odio </p>
        </div>
    </div>
    <div class="box-2">
        <div class="box-inner-2">
            <div>
                <p class="fw-bold">Payment Details</p>
                <p class="dis mb-3">Complete your purchase by providing the pick up and return date.</p>
            </div>
            <form action="newReservation/store" method="post">
                <?php echo csrf_field(); ?>
                <div>
                    <?php if(Auth::check()): ?>
                        <h4>Hello, <strong><?php echo e(Auth::user()->name); ?></strong> please select your pick up date and drop
                            off date</h4>
                        <br>
                    <?php endif; ?>
                    <p class="dis fw-bold mb-3">Select start Date</p>
                    <input type="date" class="selectedDate" id="pickupDate" value="" required name="pickupDate">
                    <input type=time class="pickupTime" name="pickupTime" required id="pickUpTime"> <span><strong>
                            Pick up time</strong></span>
                    <br>
                    <br>
                    <p class="dis fw-bold mb-3">Select end Date</p>
                    <input type="date" class="selectedDate" id="returnDate" min="2022-04-06" required max='2022-08-05'
                        name="returnDate">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <p class="fw-bold">Total</p>
                        <p class="fw-bold totalPrice">
                            <span class="fas fa-euro-sign"></span>
                            <span class="price"><?php echo e($total_price); ?></span>
                        </p>
                    </div>
                    <div class="btn btn-primary mt-2">
                        <button type="submit" class="btn btn-primary">Print your pick up invoice!</button>
                    </div>
                    <?php $__currentLoopData = $session_cars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <input type="text" name="car_id[]" id="car_id" hidden value=<?php echo e($session->id); ?>>
                        <input type="text" name="total_price" id="total_price" hidden value=<?php echo e($total_price); ?>>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
        </div>
        </form>
    </div>
</div>
</div>
<script>
    //niet mogelijk om een ouder datum te kiezen dan de huidige datum
    function date() {
        console.log(moment().format('MM-DD-YYYY'));
        document.getElementById('pickupDate').value = moment().format('YYYY-MM-DD');
        document.getElementById('pickupDate').min = moment().format('YYYY-MM-DD');

        document.getElementById('returnDate').value = moment().add(1, 'days').format('YYYY-MM-DD');
        document.getElementById('returnDate').max = moment().add(30, 'days').format('YYYY-MM-DD');
        document.getElementById('returnDate').min = moment().format('YYYY-MM-DD');

    }
    //bereken het verschil tussen de datums 
    function calculatePrice() {
        let selectedDate = document.querySelectorAll('.selectedDate');

        selectedDate.forEach(function(elem) {
            elem.addEventListener("change", function() {

                let pickupDate = document.querySelector('#pickupDate');
                let returnDate = document.querySelector('#returnDate');

                let pickUpDateMoment = moment(pickupDate.value, 'YYYY-MM-DD');
                let returnDateMoment = moment(returnDate.value, 'YYYY-MM-DD');

                let diff = returnDateMoment.diff(pickUpDateMoment, 'days');

                let totalPrice = diff * <?php echo e($total_price); ?>;
                console.log(totalPrice);

                document.querySelector('.totalPrice .price').innerText = totalPrice;
                document.getElementById('pickUpDate').value = new Date().toDateInputValue();


            });
        });
    }
    calculatePrice()
    date();
</script>
<?php /**PATH /home/aimane/Documents/oefenexamen (Bit Academy)/Rent-a-Car---Realisatie-014d3643-3aa27aff/rentacar/resources/views/newReservation.blade.php ENDPATH**/ ?>