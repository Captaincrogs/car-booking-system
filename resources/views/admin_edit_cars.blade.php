<!DOCTYPE html>
@if (Auth::user()->role == 'admin')
    <html lang="en">

    <!DOCTYPE html>

    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Admin ~ Dashboard</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="{{ URL::asset('css/styles_admin.css') }}" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>

    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="../admin">Rent a Car</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                    class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
                        aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i
                            class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li><a class="dropdown-item" href="#!">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="admin">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Edit stock
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            </a>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Edit/Add
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo"
                                data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                        data-bs-target="#pagesCollapseAuth" aria-expanded="false"
                                        aria-controls="pagesCollapseAuth">
                                        Add
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne"
                                        data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" current href="add_new_cars">Add new cars</a>
                                        </nav>
                                    </div>


                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                        data-bs-target="#pagesCollapseError" aria-expanded="false"
                                        aria-controls="pagesCollapseError">
                                        Edit
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i>
                                        </div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne"
                                        data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="#">Edit new cars</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Addons</div>
                            <a class="nav-link" href="charts.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Charts
                            </a>
                            <a class="nav-link" href="tables.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Tables
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        @if (Auth::user())
                            <div class="small">Logged in as:</div>
                            <span class="small">{{ Auth::user()->name }}</span>
                        @endif
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Edit Stock</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>s
                        </ol>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fa-solid fa-car"></i> Cars in showroom
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>brand</th>
                                        <th>model</th>
                                        <th>category</th>
                                        <th>licene plate</th>
                                        <th>GPS</th>
                                        <th>Remove/edit</th>

                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>brand</th>
                                        <th>model</th>
                                        <th>category</th>
                                        <th>licene plate</th>
                                        <th>GPS</th>
                                        <th>Remove/edit</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($cars as $car)
                                        <tr>
                                            <td>{{ $car->brand }}</td>
                                            <td>{{ $car->model }}</td>
                                            <td>{{ $car->category }}</td>
                                            <td>{{ $car->licence_plate }}</td>
                                            <td>{{ $car->gps == 1 ? 'yes' : 'no' }}</td>
                                            <td hidden>{{ $car->id }}</td>
                                            <td>
                                                <form action={{ '/admin/newcars/delete', $car->id }} method="POST">
                                                    @csrf
                                                    <button type="submit" value="{{ $car->id }}"
                                                        class="btn btn-danger" name="id">Delete</button>
                                                    <button type="button" class="btn btn-primary edit" id="edit"
                                                        data-bs-toggle="modal" id="submit"
                                                        data-bs-target="#exampleModal" data-target="#exampleModal">Edit
                                                        car
                                                        info
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
            </div>
            </main>
            {{-- modal --}}
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/admin/newcars/update" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="brand" name="brand" class="col-form-label" for="brand">Brand:</label>
                                    <input type="text" class="form-control" id="brnd" name="brand" disabled>
                                </div>

                                <div class="mb-3">
                                    <label for="model" name="model" class="col-form-label" required>Model:</label>
                                    <input type="text" class="form-control" id="mdl" name="model">
                                </div>

                                <div class="mb-3">
                                    <label for="category" class="col-form-label" required>Select
                                        category:</label>
                                    <select class="form-control" name="category">
                                        @foreach ($car_categories as $category)
                                            <option>{{ $category }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="licence_plate" name="licence_plate" class="col-form-label"
                                        required>Licence
                                        Plate:</label>
                                    <input type="text" class="form-control" id="lcp" name="licence_plate">
                                </div>
                                <div class="mb-3">
                                    <label for="amount" name="amount" class="col-form-label" required>Amount:
                                    </label>
                                    <input min="1" max="10" type="number" class="form-control" id="amount"
                                        name="amount">
                                </div>
                                <div class="mb-3">
                                    <label for="price" class="col-form-label" required>daily rent price €:
                                    </label>
                                    <input min="1" type=" number" class="form-control" id="daily_price"
                                        name="daily_price">
                                </div>

                                <div class="mb-3">
                                    <label for="gps" name="gps" class="col-form-label">Car armed with gps ?</label>
                                    <select class="form-control" name="gps">
                                        @foreach ($has_gps as $gps)
                                            <option> {{ $gps == 1 ? 'has gps' : 'no gps' }}</td>
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="mb-3">

                                    <input type="text" hidden class="form-control" name='car_id' id="car_id">
                                </div>
                                <div class="text-center">
                                    <img src="https://wallpaper.dog/large/5507296.jpg " width="280" height="236"
                                        class="rounded" alt="...">
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" id="submiti" class="btn btn-primary">Save</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- end modal --}}

        <footer class="py-4 bg-light mt-auto">

        </footer>
        </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
        </script>
        <script type="text/javascript" src="{{ URL::asset('js/scripts.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/datatables-simple-demo.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    </body>
    <script>
        $(document).ready(function() {
            $(document).on("click", ".edit", function() {
                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#brnd').val(data[0]);
                $('#mdl').val(data[1]);
                $('#lcp').val(data[3]);
                $('#gps').val(data[4]);
                $('#car_id').val(data[5]);
            });
        });

        //ajax call to controller
        // function deleteCar(id) {
        //     $.ajax({
        //         type: 'get',
        //         url: '/admin/newcars/delete/' + id,
        //         success: function(data) {
        //             console.log(data);
        //             location.reload();
        //         }
        //     });
        // }
    </script>


    </html>
@else
    <div>
        <h1>You are not authorized to access this page {{ Auth::user()->name }} :)</h1>
    </div>
@endif

</html>
