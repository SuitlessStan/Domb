<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css"/>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/calendar.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Domb</title>
</head>
<body>
    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="{{route('home')}}">Domb</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#"><i id="home-icon" class="fas fa-home fa-2x"></i> <span class="sr-only">(current)</span></a>
            </li>
          </ul>
          <div class="top-right">
            <div class="dropdown">
                <button class="dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="far fa-bell"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                <div class="notification">
                    <h5 class="lead font-weight-bold">Notifications</h5>
                    <hr>
                </div>
                  <div class="container text-center">
                    <small>You have 0 notifications</small>
                  </div>
                </div>
            </div>

            <div class="dropdown">
                <button class="dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-circle-notch"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                <div class="notification">
                    <h5 class="lead font-weight-bold">Progress</h5>
                    <hr>
                </div>
                  <div class="container text-center">
                    <small>You've completed 1/5 tasks</small>
                  </div>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="far fa-user-circle"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                <div class="notification">
                    <h5 class="lead font-weight-bold">Profile</h5>
                    <hr>
                </div>
                  <div class="container text-center">
                    <small>Hello Esam</small>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </nav>
    {{-- Content --}}

    <section id="content-wrapper">
        <div class="row" style="margin: 0">
            <div class="col-md-3" style="padding-left: 0">
                <div class="left-section">
                    <div class="container" id="cans">
                        <ul id="features" class="container-fluid card bg-light">
                            <a href="/tasks" class="item-nav">
                                <li  class="d-flex">
                                    <div class="container d-flex">
                                        <i class="fas fa-tasks mr-2"></i>
                                        <small class="features-title">Tasks</small>
                                    </div>
                                    <small class="mr-2">{{$tasksCount}}</small>
                                </li>
                            </a>
                            <a href="/appointments" class="item-nav">
                                <li  class="d-flex">
                                    <div class="container d-flex">
                                        <i class="fas fa-calendar-check mr-2"></i>
                                        <small class="features-title">Appointments</small>
                                    </div>
                                    <small class="mr-2">{{$appointmentsCount}}</small>
                                </li>
                            </a>
                            <a href="/activities" class="item-nav">
                                <li  class="d-flex">
                                    <div class="container d-flex">
                                        <i class="fas fa-snowboarding mr-2"></i>
                                        <small class="features-title">Activities</small>
                                    </div>
                                    <small class="mr-2">{{$pollsCount}}</small>
                                </li>
                            </a>
                            <a href="/media" class="item-nav">
                                <li  class="d-flex">
                                    <div class="container d-flex">
                                        <i class="fab fa-hubspot mr-2"></i>
                                        <small class="features-title">Hub</small>
                                    </div>
                                </li>
                            </a>
                            <a href="/calendar" class="item-nav">
                                <li  class="d-flex">
                                    <div class="container d-flex">
                                        <i class="fas fa-calendar-times mr-2"></i>
                                        <small class="features-title">Calendar</small>
                                    </div>
                                </li>
                            </a>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="main-section m-1">
                    <div class="container bg-light" id="todaysDate">
                        <h4 class="lead font-weight-bold">Today <small id="date"></small></h4>
                    </div>
                    @yield('content')

                </div>
            </div>
        </div>


    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/app2.js')}}"></script>
    <script src="{{asset('js/calendar.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    @yield('javascript')
</body>
</html>
