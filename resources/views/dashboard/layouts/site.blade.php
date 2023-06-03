<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Lukasz Holeczek">
    <meta name="keyword" content="">
    <!-- <link rel="shortcut icon" href="assets/ico/favicon.png"> -->
    <title>Dashboard</title>
    <!-- Icons -->
    <link href="{{ asset('dashboard/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard/css/simple-line-icons.css') }}" rel="stylesheet">
    <!-- Main styles for this application -->
    <link href="{{ asset('dashboard/css/style.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('noty/noty.css') }}">
    <script src="{{ asset('noty/noty.min.js') }}" defer></script>

    <link href="{{ asset('dashboard/css/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard/css/removeSortingDataTables.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard/css/datatablesStyles.css') }}" rel="stylesheet">
    <style>
        td{
        }
    </style>
    @yield('styles')

</head>

<body class="navbar-fixed sidebar-nav fixed-nav">
    <header class="navbar">
        <div class="container-fluid">
            <button class="navbar-toggler mobile-toggler hidden-lg-up" type="button">&#9776;</button>
            <a class="navbar-brand" href="{{ route('home') }}"></a>
            <ul class="nav navbar-nav hidden-md-down">
                <li class="nav-item">
                    <a class="nav-link navbar-toggler layout-toggler" href="#">&#9776;</a>
                </li>
            </ul>
            <ul class="nav navbar-nav pull-right hidden-md-down">

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="hidden-md-down">{{ Auth::user()->name }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-header text-xs-center">
                            <strong>Settings</strong>
                        </div>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                             onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                             <i class="fa fa-lock"></i> Logout
                         </a>

                         <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                             @csrf
                         </form>
                    </div>
                </li>
                <li class="nav-item">
                </li>
            </ul>
        </div>
    </header>
    <div class="sidebar">
        <nav class="sidebar-nav">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard.home') }}"><i class="icon-speedometer"></i>
                        Dashboard</a>
                </li>
                <li class="nav-title">
                    Management
                </li>

                @if (Auth::user()->hasRole('admin'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard.users.index') }}"><i class="icon-people"></i>
                        Users</a>
                </li>
                @endif
                @if (Auth::user()->hasRole(['admin', 'doctor']))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard.types.index') }}"><i class="icon-folder-alt "></i>
                        Types</a>
                </li>

                @endif
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard.dayOfWorks.index') }}"><i class="icon-calendar"></i>
                        Day Of Work</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard.appointments.index') }}"><i class="icon-calculator"></i> Appointments</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard.patients.index') }}"><i class="icon-user"></i> Patients</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard.paymentlog.index') }}"><i class="fa fa-money"></i> Payments</a>
                </li>
                @if (Auth::user()->hasRole('admin'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard.log') }}"><i class="fa fa-history"></i> Log</a>
                </li>
                @endif
                <li class="divider"></li>
                <li class="nav-title">
                    Extras
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link" href="{{ route('dashboard.profile') }}"><i class="icon-user"></i> Profile</a>
                </li>
                @if (Auth::user()->hasRole('doctor'))

                <li class="nav-item nav-dropdown">
                    <a class="nav-link" href="{{ route('dashboard.doctors.edit', Auth::id()) }}"><i class="icon-info"></i> Info</a>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"
                             onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                             <i class="fa fa-lock"></i> Logout
                         </a>

                         <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                             @csrf
                         </form>
                </li>
                @if (Auth::user()->hasRole('admin'))

                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-settings"></i> Settings</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard.about') }}"><i
                                    class="icon-info"></i>
                                About</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard.services') }}"><i
                                    class="fa fa-archive"></i>
                                Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard.question') }}"><i
                                    class="fa fa-question-circle "></i>
                                Questions</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard.social') }}"><i class="icon-share"></i>
                                Social</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard.images') }}"><i class="icon-picture"></i>
                                Images</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard.gallery') }}"><i class="fa fa-file-image-o "></i>
                                Gallery</a>
                        </li>
                    </ul>
                </li>
                @endif
            </ul>
        </nav>
    </div>
    <!-- Main content -->
    <main class="main">
        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item"><a
                    href="{{ route('dashboard.home') }}">{{ Auth::user()->roles->first()->name}}</a>
            </li>
            <li class="breadcrumb-item active">Dashboard</li>
            <!-- Breadcrumb Menu-->
            <li class="breadcrumb-menu">
                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                    <a class="btn btn-secondary" href="{{ route('dashboard.home') }}"><i class="icon-graph"></i>
                        &nbsp;Dashboard</a>
                </div>
            </li>
        </ol>
        <div class="container-fluid">
            <div class="animated fadeIn">
                @yield('content')
            </div>
        </div>
        <!-- /.conainer-fluid -->
    </main>

    <footer class="footer">
        <span class="text-left">
            <a href="">Doctor</a> &copy; 2023.
        </span>
        <span class="pull-right">
            Powered by <a href="">UOK</a>
        </span>
    </footer>
    <!-- Bootstrap and necessary plugins -->
    <script src="{{ asset('dashboard/js/libs/jquery.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/libs/tether.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/libs/bootstrap.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/libs/pace.min.js') }}"></script>
    <!-- Plugins and scripts required by all views -->
    <script src="{{ asset('dashboard/js/libs/Chart.min.js') }}"></script>
    <!-- CoreUI main scripts -->

    <script src="{{ asset('dashboard/js/app.js') }}"></script>

    @extends('dashboard.layouts._noty')
    <script src="{{ asset('dashboard/js/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                responsive: true,
                searching: false,
                paging: false,
                info: false,
                sorting: false,
            });
        });
    </script>
    @stack('scripts')
</body>

</html>
