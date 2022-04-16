<!DOCTYPE html>
@if (Auth::user()->role == 'admin')
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Admin ~ Dashboard</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles_admin.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <style>
        input[type=text],
        select {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type=submit] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type=submit]:hover {
            background-color: #45a049;
        }

        div {
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
        }

    </style>
    <header>
        <a href="" class="btn btn-primary">
            <i class="fas fa-arrow-circle-left"></i>
            Go Back
        </a>
    </header>

    <body>

        <h3>Using CSS to style an HTML Form</h3>

        <div>
            <form action="/action_page.php">
                <label for="fname" name="brand">brand</label>
                <input type="text" id="fname" name="firstname" placeholder="">

                <label for="lname">Model</label>
                <input type="text" name="model" id="lname" name="lastname" placeholder="">

                <label for="lname">seats</label>
                <input type="text" name="model" id="lname" name="lastname" placeholder="">

                <label for="lname">daily price</label>
                <input type="text" name="model" id="lname" name="lastname" placeholder="">



                <label for="">GPS(yes/no)</label>
                <select id="" name="">
                    <option value="yes">yes</option>
                    <option value="no">no</option>


                </select>
                <label for="">category</label>
                <select id="" name="">
                    <option value=""></option>

                </select>


                <input type="submit" value="Submit">
            </form>
        </div>

    </body>
@else
    <div>
        <h1>You are not authorized to access this page {{ Auth::user()->name }} :)</h1>
    </div>
@endif
