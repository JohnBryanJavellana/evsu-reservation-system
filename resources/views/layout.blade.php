<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ URL::asset('fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin-lte/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin-lte/plugins/fullcalendar/main.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin-lte/css/custom.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin-lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin-lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <script src="{{ URL::asset('admin-lte/plugins/jquery/jquery.min.js') }}"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lobster&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <title>EVSU Reservation Management System</title>
</head>

<style>
    body { font-family: 'Roboto', sans-serif; }
    #notif_badge { display: none; }
</style>

<body class="hold-transition layout-fixed layout-navbar-fixed">
    <div class="loader">
        <img src="{{ URL::asset('system-images/am-spinner-1.gif') }}" height="100"/>
    </div>

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="{{ URL::asset('admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ URL::asset('admin-lte/js/adminlte.min.js') }}"></script>
    <script src="{{ URL::asset('admin-lte/js/custom.js') }}"></script>
   
    <script src="{{ URL::asset('admin-lte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('admin-lte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('admin-lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('admin-lte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('admin-lte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    
    <script src="{{ URL::asset('admin-lte/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('admin-lte/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('admin-lte/plugins/pdfmake/vfs_fonts.js') }}"></script>

    <script src="{{ URL::asset('admin-lte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('admin-lte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('admin-lte/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <script>
        $(function () {
            $(".data-table").DataTable({
                "responsive": true, 
                "lengthChange": true, 
                "autoWidth": false,
                "order": [],
            });
        });

        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Select an option",
                allowClear: true
            });
        });
    </script>
</body>
</html>