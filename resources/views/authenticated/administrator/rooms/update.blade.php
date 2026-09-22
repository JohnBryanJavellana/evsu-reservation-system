@extends('layout')

@section('content')
    @include('authenticated.administrator.menu')

    <div class="content-wrapper">
        @include('components.page-name', [ 'page_name' => 'Room Information' ])
    
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
                                        <form method="POST" enctype="multipart/form-data" onsubmit="showLoaderAnimation()">
                                            @csrf
                                            
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <label class="small">Name <span class="text-danger">*</span>:</label>
        
                                                    <div class="input-group mb-2">
                                                        <input type="text" value="{{ $thisroom->name }}" class="form-control form-control-sm" placeholder="Name" required name="name">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                               <span class="material-icons-outlined" style="font-size: 15px">house</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
        
                                                <div class="col-xl-6">
                                                    <div class="form-group mb-2">
                                                        <label class="small">Type <span class="text-danger">*</span>:</label>
                    
                                                        <select name="type" class="form-control form-control-sm mb-2">
                                                            <option @if($thisroom->type == 'Standard')selected @endif value="Standard">Standard</option>
                                                            <option @if($thisroom->type == 'Premium')selected @endif value="Premium">Premium</option>
                                                            <option @if($thisroom->type == 'Deluxe')selected @endif value="Deluxe">Deluxe</option>
                                                        </select>
                                                    </div>
                                                </div>
                    
                                                <div class="col-xl-6">
                                                    <label class="small">Maximum Occupancy <span class="text-danger">*</span>:</label>
        
                                                    <div class="input-group mb-2">
                                                        <input type="number" value="{{ $thisroom->max_occupancy }}" class="form-control form-control-sm" placeholder="Maximum Occupancy" required name="max_occupancy">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                               <span class="material-icons-outlined" style="font-size: 15px">group</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
        
                                                <div class="col-xl-6">
                                                    <label class="small">Daily Rate <span class="text-danger">*</span>:</label>
        
                                                    <div class="input-group mb-2">
                                                        <input type="number" value="{{ $thisroom->daily_rate }}" step="any" class="form-control form-control-sm" placeholder="Daily Rate" required name="daily_rate">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                               <span class="material-icons-outlined" style="font-size: 15px">money</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
        
                                                <div class="col-xl-6">
                                                    <label class="small">Address <span class="text-danger">*</span>:</label>
        
                                                    <div class="input-group mb-2">
                                                        <textarea value="{{ $thisroom->address }}" class="form-control form-control-sm" rows="5" placeholder="Address" required name="address">{{ $thisroom->address }}</textarea>
                                                    </div>
                                                </div>
        
                                                <div class="col-xl-6">
                                                    <label class="small">Description <span class="text-danger">*</span>:</label>
        
                                                    <div class="input-group mb-2">
                                                        <textarea value="{{ $thisroom->description }}" class="form-control form-control-sm" rows="5" placeholder="Description" required name="description">{{ $thisroom->description }}</textarea>
                                                    </div>
                                                </div>
        
                                                <div class="col-xl-6">
                                                    <label class="small">Add Photos</label>
        
                                                    <div class="input-group mb-2">
                                                        <input type="file" accept="image/*" multiple class="form-control form-control-sm" name="photos[]">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                               <span class="material-icons-outlined" style="font-size: 15px">image</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-12">
                                                    <table class="table table-bordered table-sm small">
                                                        <thead>
                                                            <tr>
                                                                <th>Image</th>
                                                                <th>Remove</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            @foreach ($thisroom->room_photos as $photo)
                                                                <tr>
                                                                    <td>
                                                                        <img src="{{ URL::asset('room-images/' . $photo->photo_url) }}" height="80" alt="">
                                                                    </td>

                                                                    <td>
                                                                        <a href="/welcome/administrator/room/list/info.{{ $thisroom->id }}/removePhoto.{{ $photo->id }}">
                                                                            <span class="fas fa-trash text-danger"></span>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                    
                                            <button type="submit" class="btn btn-danger btn-sm elevation-1 mt-2">
                                                <i class="fas fa-save pr-2"></i>
                                                Submit Changes
                                            </button>

                                            <a href="/welcome/administrator/room/list" class="btn btn-default btn-sm mt-2">
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
                                                    <th>Status</th>
                                                    <th>Rented By</th>
                                                    <th>Date Range</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach ($thisroom->reservations_backward as $r)
                                                    <tr>
                                                        <td>{{ $r->id }}</td>
                                                        <td>{{ strtoupper($r->status) }}</td>
                                                        <td>{{ $r->rented_by->firstname . ' ' . $r->rented_by->middlename . ' ' . $r->rented_by->lastname . ' ' . $r->rented_by->suffix }}</td>
                                                        <td>{{ $r->from . ' to ' . $r->to }}</td>
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