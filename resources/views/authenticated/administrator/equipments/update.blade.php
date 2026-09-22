@extends('layout')

@section('content')
    @include('authenticated.administrator.menu')

    <div class="content-wrapper">
        @include('components.page-name', [ 'page_name' => 'Equipment Information' ])
    
        <section class="content">
            <div class="container-fluid">
                @include('components.message-notification')
                
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card card-outline card-outline-tabs card-danger rounded-0">
                            <div class="card-header p-0 border-bottom-0">
                                <ul class="nav nav-tabs small" id="custom-tabs-header-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-tabs-details-tab" data-toggle="pill" href="#custom-tabs-details" role="tab" aria-controls="custom-tabs-details" aria-selected="true">
                                            <span class="fas fa-info-circle pr-1"></span>
                                            Details
                                        </a>
                                    </li>
            
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-records-tab" data-toggle="pill" href="#custom-tabs-records" role="tab" aria-controls="custom-tabs-records" aria-selected="false">
                                            <span class="fas fa-clipboard pr-1"></span>
                                            Records
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-four-tabContent">
                                    <div class="tab-pane fade show active" id="custom-tabs-details" role="tabpanel" aria-labelledby="custom-tabs-details-tab">
                                        <img class="mb-3" src="{{ URL::asset('equipment-images/' . $thisequipment->photo_url) }}" alt="" height="100" srcset="">

                                        <form method="POST" enctype="multipart/form-data" onsubmit="showLoaderAnimation()">
                                            @csrf
                                    
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <label class="small">Name <span class="text-danger">*</span>:</label>

                                                    <div class="input-group mb-2">
                                                        <input type="text" value="{{ $thisequipment->name }}" class="form-control form-control-sm" placeholder="Name" required name="name">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                            <span class="material-icons-outlined" style="font-size: 15px">devices</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-6">
                                                    <label class="small">Quantity <span class="text-danger">*</span>:</label>

                                                    <div class="input-group mb-2">
                                                        <input type="number" value="{{ $thisequipment->quantity }}" class="form-control form-control-sm" placeholder="Quantity" required name="quantity">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                            <span class="material-icons-outlined" style="font-size: 15px">tag</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                    
                                                <div class="col-xl-6">
                                                    <label class="small">Daily Rate <span class="text-danger">*</span>:</label>

                                                    <div class="input-group mb-2">
                                                        <input type="number" step="any" value="{{ $thisequipment->daily_rate }}" class="form-control form-control-sm" placeholder="Daily Rate" required name="daily_rate">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                            <span class="material-icons-outlined" style="font-size: 15px">money</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-6">
                                                    <label class="small">Change Photo:</label>

                                                    <div class="input-group mb-2">
                                                        <input type="file" accept="image/*" class="form-control form-control-sm" name="photo">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                            <span class="material-icons-outlined" style="font-size: 15px">image</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-12">
                                                    <label class="small">Description <span class="text-danger">*</span>:</label>

                                                    <div class="input-group mb-2">
                                                        <textarea value="{{ $thisequipment->description }}" class="form-control form-control-sm" rows="5" placeholder="Description" required name="description">{{ $thisequipment->description }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                    
                                            <button type="submit" class="btn btn-danger btn-sm elevation-1 mt-2">
                                                <i class="fas fa-save pr-2"></i>
                                                Submit Changes
                                            </button>

                                            <a href="/welcome/administrator/equipment/list" class="btn btn-default btn-sm mt-2">
                                                <i class="fas fa-arrow-left pr-2"></i>
                                                Return to list
                                            </a>
                                        </form>
                                    </div>
        
                                    <div class="tab-pane fade" id="custom-tabs-records" role="tabpanel" aria-labelledby="custom-tabs-records-tab">
                                        <table class="data-table table table-sm table-bordered small table-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>ID#</th>
                                                    <th>Qty.</th>
                                                    <th>Rented By</th>
                                                    <th>Date Range</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach ($thisequipment->reservation_equipments as $r)
                                                    <tr>
                                                        <td>{{ $r->id }}</td>
                                                        <td>{{ $r->quantity }}</td>
                                                        <td>{{ $r->reservation->rented_by->firstname . ' ' . $r->reservation->rented_by->middlename . ' ' . $r->reservation->rented_by->lastname . ' ' . $r->reservation->rented_by->suffix }}</td>
                                                        <td>{{ $r->reservation->from . ' to ' . $r->reservation->to }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection