<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link rel="stylesheet" href="css/cars.css">
    <title>Document</title>
</head>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark"> <a class="navbar-brand" href="#" data-abc="true">rentAcar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02"
        aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation"> <span
            class="navbar-toggler-icon"></span> </button>
    <div class="collapse navbar-collapse" id="navbarColor02">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active"> <a class="nav-link" href="/" data-abc="true">Home <span
                        class="sr-only">(current)</span></a> </li>
            <li class="nav-item"> <a class="nav-link" href="/cars" data-abc="true">Car Gallery</a> </li>
            <li class="nav-item"><a class="nav-link" href="/admin">Admin</a></li>
            <li class="nav-item"> <a class="nav-link" href="/newReservation" data-abc="true">Cart</a></li>
            <li class="nav-item"> <a class="nav-link" href="<?php echo e(url('/logout')); ?>">Logout</a></li>

        </ul>
    </div>
</nav>
</header>
<?php if(session()->has('success')): ?>
    <div class="alert alert-success">
        <li><?php echo e(session()->get('success')); ?></li>
    </div>
<?php endif; ?>
<?php if(session()->has('error')): ?>
    <div class="alert alert-danger">
        <li><?php echo e(session()->get('error')); ?></li>
    </div>
<?php endif; ?>
<div class="container mt-5 mb-5">
    <div class="row g-1">
        <?php $__currentLoopData = $cars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $car): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-4">
                <div class="p-card">
                    <div class="p-carousel">
                        <div class="carousel slide" data-ride="carousel" id="carousel-1">
                            <div class="carousel-inner" role="listbox">
                                <div class="carousel-item active"><img class="d-block w-100"
                                        src="img/cars/<?php echo e($car->image); ?>" alt="Slide Image"></div>
                                
                            </div>
                            <div><a class="carousel-control-prev" href="#carousel-1" role="button"
                                    data-slide="prev"><span class="carousel-control-prev-icon"></span><span
                                        class="sr-only">Previous</span></a><a class="carousel-control-next"
                                    href="#carousel-1" role="button" data-slide="next"><span
                                        class="carousel-control-next-icon"></span><span
                                        class="sr-only">Next</span></a></div>
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-1" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-1" data-slide-to="1"></li>
                                <li data-target="#carousel-1" data-slide-to="2"></li>
                            </ol>
                        </div>
                    </div>
                    <div class="p-details">
                        <form action="cars/checkout" method="post">
                            <?php echo csrf_field(); ?>
                            <div class="d-flex justify-content-between align-items-center mx-2">
                                <h5 input="name"><?php echo e($car->brand); ?>~ <?php echo e($car->model); ?></h5>
                                <span>€<?php echo e($car->daily_price); ?> p/day</span>
                            </div>
                            <div class="mx-2">
                                <hr class="line">
                            </div>
                            <div class="d-flex justify-content-between mt-2 spec mx-2">
                                <div class="d-flex flex-column align-items-center">
                                    <h6 class="mb-0">Horsepower</h6><span><?php echo e($car->horsepower); ?></span>
                                </div>
                                <div class="d-flex flex-column align-items-center">
                                    <h6 class="mb-0">Top-speed</h6><span><?php echo e($car->top_speed); ?>km</span>
                                </div>
                                <div class="d-flex flex-column align-items-center">
                                    <h6 class="mb-0">Seats</h6><span><?php echo e($car->seats); ?></span>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="<?php echo e($car->id); ?>">
                            <div class="buy mt-3">
                                <button type="submit" class="btn w-100 rounded my-2 btn btn-primary btn-block ">Add car
                                    to booking list</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>
<?php /**PATH /home/aimane/Documents/oefenexamen (Bit Academy)/Rent-a-Car---Realisatie-014d3643-3aa27aff/rentacar/resources/views/cars.blade.php ENDPATH**/ ?>