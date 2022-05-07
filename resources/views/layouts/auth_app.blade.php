<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>@yield('title') | {{ config('app.name') }}</title>

  <!-- General CSS Files -->
  <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
  <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('web/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('web/css/components.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/css/iziToast.min.css') }}">
  <link href="{{ asset('assets/css/sweetalert.css') }}" rel="stylesheet" type="text/css"/>
  <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
</head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-md-6 offset-md-3">
            <div class="login-brand">
              <img src="{{ asset('img/logo.png') }}" alt="logo" width="100"
              class="shadow-light">
            </div>
            @yield('content')
            <div class="simple-footer">
              {{--                        Copyright &copy; {{ getSettingValue('application_name') }}  {{ date('Y') }}--}}
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>


</body>

<!-- General JS Scripts -->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.nicescroll.js') }}"></script>

<!-- JS Libraies -->

<!-- Template JS File -->
<script src="{{ asset('web/js/stisla.js') }}"></script>
<script src="{{ asset('web/js/scripts.js') }}"></script>
<!-- Page Specific JS File -->

@yield('scripts')
@include('layouts.helper_js')
<script>
@if(sizeof($errors))
swal({
  position: 'top-end',
  icon: 'error',
  title: 'Invalid Or Incomplete input',
  text: 'Please recheck your input.',
  showConfirmButton: true,
  confirmButtonText: 'Close',
})
@endif



@if(session('info'))
swal({
  position: "top-end",
  icon: "info",
  title: "Info",
  text: '{{session('info')}}',
  showConfirmButton: true,
  timer: 5000
});
@endif

@if(session('error'))
swal({
  position: "top-end",
  icon: "warning",
  title: "Something Wrong",
  text: '{{session('error')}}',
  showConfirmButton: true,
  timer: 5000
});
@endif

@if(session('success'))
swal({
  position: 'top-end',
  icon: 'success',
  title: 'Success',
  text: '{{session('success')}}',
  showConfirmButton: true,
  timer: 5000
});
@endif

</script>
</html>
