<!DOCTYPE html>
<html lang="en">
<head>
    <title>My Favorite Bands</title>

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('sortable/css/sortable-theme-bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.6.3/angular.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/2.5.0/ui-bootstrap-tpls.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="/">My Favorite Bands</a>
            </div>
            <div class="nav navbar-nav">
                <li @if($page == 'bands') class="active" @endif><a href="/bands">Bands</a></li>
                <li @if($page == 'albums') class="active" @endif><a href="/albums">Albums</a></li>
            </div>
        </div>
    </nav>
    <div id="main" ng-app="myApp" class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @yield('content')
            </div>
        </div>
    </div>
    <script src="//code.jquery.com/jquery-3.2.0.min.js" integrity="sha256-JAW99MJVpJBGcbzEuXk4Az05s/XyDdBomFqNlM3ic+I=" crossorigin="anonymous"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="{{ asset('bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>

    <script src="{{ asset('angular/app.js') }}"></script>
    <script src="{{ asset('angular/controllers/BandsController.js') }}"></script>
    <script src="{{ asset('angular/controllers/AlbumsController.js') }}"></script>

    <script src="{{ asset('sortable/js/sortable.min.js') }}"></script>

    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>