<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>SCIT Reservation</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{asset('vendors/iconfonts/mdi/css/materialdesignicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('vendors/css/vendor.bundle.base.css')}}">
  <link rel="stylesheet" href="{{asset('vendors/css/vendor.bundle.addons.css')}}">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.2.2/dist/sweetalert2.all.min.js"></script>
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
  <script src="https://momentjs.com/downloads/moment.js"></script>
  <script src="https://momentjs.com/downloads/moment-with-locales.js"></script>
  
  <script src="{{asset('vendors/js/vendor.bundle.base.js')}}"></script>
  <script src="{{asset('vendors/js/vendor.bundle.addons.js')}}"></script>
  <link href='{{asset("/packages/core/main.css")}}' rel='stylesheet' />
  <link href='{{asset("/packages/daygrid/main.css")}}' rel='stylesheet' />
  <link href='{{asset("/packages/timegrid/main.css")}}' rel='stylesheet' />
  <link href='{{asset("/packages/list/main.min.css")}}' rel='stylesheet' />
  <script src='{{asset("/packages/core/main.js")}}'></script>
  <script src='{{asset("/packages/interaction/main.js")}}'></script>
  <script src='{{asset("/packages/daygrid/main.js")}}'></script>
  <script src='{{asset("/packages/timegrid/main.js")}}'></script>
  <script src='{{asset("/packages/list/main.min.js")}}'></script>
  <!-- <script src='{{asset("/packages/moment/main.js")}}'></script>
  <script src='{{asset("/packages/moment-timezone/main.js")}}'></script> -->

@yield('scripts')
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{asset('css/style.css')}}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{asset('images/utech/icon.png')}}" />
  <style>
    .content-wrapper {
        background: #e6e2fc;
    }
    .navbar.default-layout {
        background: linear-gradient(120deg, #8776d3, #0e034d);
    }
    .sidebar{
      background: #f3f3f3;
    }

    .action-icon{
      font-size:20px;
      margin-right:10px;
    }
  </style>
  <style>
    #calendar{
      background-color:#fff;
      padding:40px 10px;
    }
    @media(max-width: 767px){
        .content-wrapper, .card .card-body, .card-body{
          padding: 0.3em !important;
          margin:0 !important;
        }

        
        .table-mobile th, .table-mobile td {
            padding: 0.3rem !important;
        }

        .card .card-body, .card-body{
          padding: 0.8em !important;
          margin:0 !important;
        }

        .hide-mobile{
          display: none;
        }
    }
</style>
<style>
  .fc-event{
    background-color: #ffdada !important;
    border: 1px solid #ffc8c8;
  }
</style>
</head>

<body>
  <div class="container-scroller">
      @include('layouts.navbar')

    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_sidebar.html -->
      @include('layouts.sidebar')

     <!-- partial -->
     <div class="main-panel">
        <div class="content-wrapper">
          @if(session()->has('flash_message'))
            <div class="alert alert-success">{{session('flash_message')}}</div>
          @endif

          @yield('content')
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->

        @include('layouts.footer')

        </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="{{asset('js/off-canvas.js')}}"></script>
  <script src="{{asset('js/misc.js')}}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <!-- End custom js for this page-->
</body>

</html>
