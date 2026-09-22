@extends('layout')

@section('content')
    @include('authenticated.patron.menu')

    <div class="content-wrapper">
        @include('components.page-name', [ 'page_name' => 'Create New Reservation' ])
    
        <section class="content">
            <div class="container-fluid">
                @include('components.message-notification')

                <div class="row">
                    <div class="col-xl-12">
                        <div class="card card-outline card-danger rounded-0">
                            <div class="card-header">
                                <form method="GET">
                                    @csrf

                                    <div class="row">
                                        <div class="col-xl-6">
                                            <label class="small">From <span class="text-danger">*</span>:</label>
                                    
                                            <div class="input-group mb-2">
                                                <input type="date" min="{{ date('Y-m-d') }}" value="{{ request()->from }}" class="form-control form-control-sm" required name="from" id="from_date">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="material-icons-outlined" style="font-size: 15px">date_range</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    
                                        <div class="col-xl-6">
                                            <label class="small">To <span class="text-danger">*</span>:</label>
                                    
                                            <div class="input-group mb-2"> 
                                                <input type="date" min="{{ date('Y-m-d') }}" value="{{ request()->to }}" class="form-control form-control-sm" required name="to" id="to_date">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="material-icons-outlined" style="font-size: 15px">date_range</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="btn btn-danger btn-sm elevation-1" type="submit">
                                        <span class="fas fa-save mr-1"></span> Generate
                                    </button>

                                    <a href="/welcome/patron/reservation/new" class="btn btn-default btn-sm">
                                        <span class="fas fa-redo mr-1"></span> Reset
                                    </a>
                                </form>
                            </div>
                            <div class="card-body">
                                <table class="data-table table table-bordered table-sm small">
                                    <thead>
                                        <tr>
                                            <th>ID#</th>
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>Daily Rate</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($rooms as $room)
                                            <tr>
                                                <td style="padding-top: 10px">{{ $room->id }}</td>
                                                <td style="padding-top: 10px">{{ $room->name }}</td>
                                                <td style="padding-top: 10px">{{ $room->type }}</td>
                                                <td style="padding-top: 10px">₱{{ $room->daily_rate }}</td>
                                                <td>
                                                    <button class="btn btn-default btn-sm" data-toggle="modal" data-target="#view_room_{{ $room->id }}"> 
                                                        <span class="fas fa-eye mr-1 text-danger"></span> View Room
                                                    </button>
                                                </td>

                                                @include('authenticated.patron.reservation.view-room')
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
@endsection