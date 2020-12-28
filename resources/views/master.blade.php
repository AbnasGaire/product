<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/ac375a449b.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>
    {{-- <div>
        <a href="{{ route('productin.list') }}" class="btn btn-success mx-auto">Productinlist View</a>
        <a href="{{ route('productout.list') }}" class="btn btn-primary mx-auto">Productoutlist View</a>
        <a href="{{ route('productin.view') }}" class="btn btn-secondary mx-auto">Productin</a>
        <a href="{{ route('productout.view') }}" class="btn btn-warning mx-auto">ProductOut</a>
        <a href="{{ route('product.available') }}" class="btn btn-danger mx-auto">Available list</a>
    </div> --}}


    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/">PRO<span style="color:blue;">DUCT</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('productin.view') ? 'active' : ' ' }}"
                        href="{{ route('productin.view') }}">Product In</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('productin.list') ? 'active' : ' ' }} "
                        href="{{ route('productin.list') }}">Productin List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('productout.view') ? 'active' : ' ' }}"
                        href="{{ route('productout.view') }}">Product Out</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('productout.list') ? 'active' : ' ' }}"
                        href="{{ route('productout.list') }}">Productout List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('product.available') ? 'active' : ' ' }}"
                        href="{{ route('product.available') }}">Available List</a>
                </li>


            </ul>

        </div>
    </nav>
    @yield("content")
</body>

</html>
