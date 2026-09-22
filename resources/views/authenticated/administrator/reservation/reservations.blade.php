@extends('layout')

@section('content')
    @include('authenticated.administrator.menu')

    <div class="content-wrapper">
        @include('components.page-name', [ 'page_name' => 'Reservations' ])
    
        <section class="content">
            <div class="container-fluid">
                @include('components.message-notification')
                
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card card-outline card-danger rounded-0">
                            <div class="card-body">
                                <table class="table table-bordered table-sm data-table">
                                    <thead>
                                        <tr>
                                            <th class="small text-bold">ID#</th>
                                            <th class="small text-bold">Date</th>
                                            <th class="small text-bold">Name</th>
                                            <th class="small text-bold">Type</th>
                                            <th class="small text-bold">Status</th>
                                            <th class="small text-bold">Action</th>
                                        </tr>
                                    </thead>
            
                                    <tbody class="small">
                                        @foreach ($reservations as $reservation)
                                            <tr>
                                                <td class="pt-2">{{ $reservation->id }}</td>
                                                <td class="pt-2">{{ $reservation->from . ' to ' . $reservation->to }}</td>
                                                <td class="pt-2">{{ $reservation->room_used->name }}</td>
                                                <td class="pt-2">{{ $reservation->room_used->type }}</td>
                                                <td class="pt-2">{{ ucwords($reservation->status) }}</td>
                                                <td>
                                                    <a href="/welcome/administrator/reservations/info/{{ $reservation->id }}" class="btn btn-light border btn-sm">
                                                       Show Info
                                                        <span class="fas fa-eye pl-1 text-warning"></span>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        function removeRoom(room_id){
            let con = confirm("Are you sure you want to remove this room?");
       
            if (con == true){
                window.location.href = "/welcome/administrator/room/list/remove." + room_id;
            }
        }
    </script>
@endsection