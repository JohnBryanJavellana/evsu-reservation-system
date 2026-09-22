@extends('layout')

@section('content')
    @include('authenticated.administrator.menu')

    <div class="content-wrapper">
        @include('components.page-name', [ 'page_name' => 'Create New Room' ])
    
        <section class="content">
            <div class="container-fluid">
                @include('components.message-notification')

                <div class="row">
                    <div class="col-xl-12">
                        <div class="card card-outline card-danger rounded-0">
                            <div class="card-body">
                                <form method="POST" enctype="multipart/form-data" onsubmit="showLoaderAnimation()">
                                    @csrf
                                    
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <label class="small">Name <span class="text-danger">*</span>:</label>

                                            <div class="input-group mb-2">
                                                <input type="text" value="{{ old('name') }}" class="form-control form-control-sm" placeholder="Name" required name="name">
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
                                                    <option @if(old('type') == 'Standard')selected @endif value="Standard">Standard</option>
                                                    <option @if(old('type') == 'Premium')selected @endif value="Premium">Premium</option>
                                                    <option @if(old('type') == 'Deluxe')selected @endif value="Deluxe">Deluxe</option>
                                                </select>
                                            </div>
                                        </div>
            
                                        <div class="col-xl-6">
                                            <label class="small">Maximum Occupancy <span class="text-danger">*</span>:</label>

                                            <div class="input-group mb-2">
                                                <input type="number" value="{{ old('max_occupancy') }}" class="form-control form-control-sm" placeholder="Maximum Occupancy" required name="max_occupancy">
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
                                                <input type="number" value="{{ old('daily_rate') }}" step="any" class="form-control form-control-sm" placeholder="Daily Rate" required name="daily_rate">
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
                                                <textarea value="{{ old('address') }}" class="form-control form-control-sm" rows="5" placeholder="Address" required name="address">{{ old('address') }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-xl-6">
                                            <label class="small">Description <span class="text-danger">*</span>:</label>

                                            <div class="input-group mb-2">
                                                <textarea value="{{ old('description') }}" class="form-control form-control-sm" rows="5" placeholder="Description" required name="description">{{ old('description') }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-xl-6">
                                            <label class="small">Photos <span class="text-danger">*</span>:</label>

                                            <div class="input-group mb-2">
                                                <input type="file" accept="image/*" multiple class="form-control form-control-sm" required name="photos[]">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                       <span class="material-icons-outlined" style="font-size: 15px">image</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
            
                                    <button type="submit" class="btn btn-danger btn-sm elevation-1 mt-3">
                                        <i class="fas fa-save pr-2"></i>
                                        Submit Details
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection