<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Document</title>
</head>
<header>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
          <div class="navbar-header">
            <a class="navbar-brand" href="/">rentAcar</a>
          </div>
          <ul class="nav navbar-nav">
            <li><a href="/">Home</a></li>
            <li><a href="/cars">Car gallery</a></li>
            <li class="active"><a href="/reservations">Reservations list</a></li>
            <li><a href="newReservation">New reservation</a></li>
            <li><a href="#">Account</a></li>
          </ul>
        </div>
      </nav>
</header>
<style>
    @import url('https://fonts.googleapis.com/css?family=Assistant');

body {
    background: #eee;
    font-family: Assistant, sans-serif
}

.external-link {
    cursor: pointer;
    color: blue
}
</style>
<body>
    <br>
    <br>
    <div class="container mt-5 px-2">
        <div class="table-responsive">
            <table class="table table-striped table-dark text-white table-hover">
                <thead>
                    <tr>
                        <th>Owner</th>
                        <th>reservation date&time</th>
                        <th>gps</th>
                        <th>brand</th>
                        <th>Status</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservations as $reservation)
                    <tr>

                        <td>{{$reservation->user->name}}<br></td>
                        <td class="font-weight-bold">{{$reservation->reservation_date}} ({{$reservation->reservation_time}})</td>
                        <td>{{$reservation->car->gps}}</td>
                        <td>{{$reservation->car->brand}} | {{$reservation->car->model}}</td>
                        <td>
                            <button class="btn btn-warning disabled">Pending
                                <i class="fa-regular fa-hourglass"></i>                          
                              </button>
                            <button class= "btn btn-primary">Print Invoice
                                <i class="fa-solid fa-print"></i>       
                            </button>
                            
                        </td>
                      
                           
                    </tr>
                    @endforeach
               
                  
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>