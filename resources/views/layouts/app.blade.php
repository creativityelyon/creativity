<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}"/>
  <title>@yield('title') | {{ config('app.name') }}</title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <!-- Bootstrap 4.1.1 -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <!-- <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/> -->
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
  <!-- Ionicons -->
  <link href="//fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
  <link href="{{ asset('assets/css/@fortawesome/fontawesome-free/css/all.css') }}" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="{{ asset('assets/css/iziToast.min.css') }}">
  <link href="{{ asset('assets/css/sweetalert.css') }}" rel="stylesheet" type="text/css"/>
  <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>

  @yield('page_css')
  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('web/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('web/css/components.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="{{ asset('adm/plugins/datatables/responsive.dataTables.min.css')}}">

  @yield('page_css')

  <style>
  table.dataTable th,
  table.dataTable td {
    white-space: nowrap;
  }

  .datepicker {
    font-size: 0.875em;
  }

  </style>
  @yield('css')
</head>
<body>

  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        @include('layouts.header')

      </nav>
      <div class="main-sidebar main-sidebar-postion">
        @include('layouts.sidebar')
      </div>
      <!-- Main Content -->
      <div class="main-content">
        @yield('content')
      </div>
      <footer class="main-footer">
        @include('layouts.footer')
      </footer>
    </div>
  </div>

  @include('profile.change_password')
  @include('profile.edit_profile')

</body>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{asset('adm/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/sweetalert.min.js') }}" charset="UTF-8"></script>
<script src="{{ asset('assets/js/iziToast.min.js') }}"></script>
<script src="{{ asset('assets/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.nicescroll.js') }}"></script>

<!-- Template JS File -->
<script src="{{ asset('web/js/stisla.js') }}"></script>
<script src="{{ asset('web/js/scripts.js') }}"></script>
<script src="{{ mix('assets/js/profile.js') }}"></script>
<script src="{{ mix('assets/js/custom/custom.js') }}"></script>


<!-- DataTables -->
<script src="{{asset('adm/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('adm/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{asset('adm/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('adm/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('adm/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('adm/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('adm/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<script src="{{asset('adm/plugins/datatables-rowgroup/js/rowGroup.bootstrap4.min.js')}}"></script>

<script src="{{asset('adm/plugins/datatables/dataTables.responsive.min.js')}}"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="{{asset('adm/plugins/moment/moment.min.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="{{ url('/js/jquery.blockUI.js')}}" type="text/javascript"></script>

@yield('page_js')
@yield('scripts')
@include('layouts.helper_js')
<script>

let loggedInUser =@json(\Illuminate\Support\Facades\Auth::user());
let loginUrl = '{{ route('login') }}';
// Loading button plugin (removed from BS4)
(function ($) {
  $.fn.button = function (action) {
    if (action === 'loading' && this.data('loading-text')) {
      this.data('original-text', this.html()).html(this.data('loading-text')).prop('disabled', true);
    }
    if (action === 'reset' && this.data('original-text')) {
      this.html(this.data('original-text')).prop('disabled', false);
    }
  };
}(jQuery));


$(function() {
  $('[data-toggle="tooltip"]').tooltip()
  @section('page_load')
  var table = $('.dtt').DataTable({
    dom: 'Bfrtip',
    pageLength : 10,
    lengthMenu : [[10, 20, 25, 50, -1], [10, 20, 25, 50, 'All']],
    // lengthMenu: [
    //   [ 10, 25, 50, -1 ],
    //   [ '10 rows', '25 rows', '50 rows', 'Show all' ]
    // ],
    buttons: [
      'pageLength',/*'copy', 'csv', */'excel', 'pdf', 'print','colvis'
    ],

    "paging": true,
    "lengthChange": true,
    "searching": true,
    "ordering": true,
    "info": true,
    "responsive": false,
  });
  table.buttons().container()
  .appendTo( '#example_wrapper .col-md-6:eq(0)' );

  $('.select2').select2({
    theme: 'bootstrap4'
  });
  $('.alert').alert();

  @show

});

// $( ".date" ).datepicker({
//   changeMonth: true,
//   changeYear: true,
//   yearRange: "-100:+5",
//   dateFormat: "dd-mm-yy",
// });

$(".date").datepicker({
  weekStart: 1,
  daysOfWeekHighlighted: "6,0",
  autoclose: true,
  todayHighlight: true,
  format: 'dd-mm-yyyy'
});
// $(".date").datepicker("setDate", new Date());

$('form').submit(function() {
  $.blockUI({
    message: '<h5>Please Wait !</h5>',
    css: {
      border:     'none',
      backgroundColor:'transparent'
    }
  });
});

$(window).keydown(function(event){
  if(event.keyCode == 13) {
    event.preventDefault();
    return false;
  }
});

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
