
 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

     <!-- <link rel="shortcut icon" href="assets/ico/favicon.png"> -->
     <title>Dashboard</title>
     <!-- Icons -->
     <link href="{{ asset('dashboard/css/font-awesome.min.css') }}" rel="stylesheet">
     <link href="{{ asset('dashboard/css/simple-line-icons.css') }}" rel="stylesheet">
     <!-- Main styles for this application -->
     <link href="{{ asset('dashboard/css/style.css') }}" rel="stylesheet">
 </head>

 <body class="" style="background-image: url('/bg.jpg');">
     <div class="container" style="padding-top: 150px">
         @yield('content')
     </div>
     <!-- Bootstrap and necessary plugins -->
     <script src="{{ asset('dashboard/js/libs/jquery.min.js') }}"></script>
     <script src="{{ asset('dashboard/js/libs/tether.min.js') }}"></script>
     <script src="{{ asset('dashboard/js/libs/bootstrap.min.js') }}"></script>

 </body>

 </html>
