@extends('layout')

@section('content')
    @include('authenticated.administrator.menu')

    <div class="content-wrapper">
        @include('components.page-name', [ 'page_name' => 'Rooms' ])
    
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
                                            <th class="small text-bold">Type</th>
                                            <th class="small text-bold">Name</th>
                                            <th class="small text-bold">Address</th>
                                            <th class="small text-bold">Daily Rate</th>
                                            <th class="small text-bold">Action</th>
                                        </tr>
                                    </thead>
            
                                    <tbody class="small">
                                        @foreach ($rooms as $room)
                                            <tr>
                                                <td class="pt-2">{{ $room->id }}</td>
                                                <td class="pt-2">{{ $room->type }}</td>
                                                <td class="pt-2">{{ $room->name }}</td>
                                                <td class="pt-2">{{ $room->address }}</td>
                                                <td class="pt-2">₱{{ $room->daily_rate }}</td>
                                                <td>
                                                    <a href="/welcome/administrator/room/list/info.{{ $room->id }}" class="btn btn-light border btn-sm">
                                                       Show Info
                                                        <span class="fas fa-eye pl-1 text-warning"></span>
                                                    </a>
                                                    
                                                    @if($room->reservations->isEmpty())
                                                    <button onclick="removeRoom({{ $room->id }})" class="btn btn-light border btn-sm">
                                                        Remove
                                                        <span class="fas fa-times pl-1 text-danger"></span>
                                                    </button>
                                                    @endif
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