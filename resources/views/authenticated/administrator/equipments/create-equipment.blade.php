@extends('layout')

@section('content')
    @include('authenticated.administrator.menu')

    <div class="content-wrapper">
        @include('components.page-name', [ 'page_name' => 'Save New Equipment' ])
    
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
                                                       <span class="material-icons-outlined" style="font-size: 15px">devices</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-6">
                                            <label class="small">Quantity <span class="text-danger">*</span>:</label>

                                            <div class="input-group mb-2">
                                                <input type="number" value="{{ old('quantity') }}" class="form-control form-control-sm" placeholder="Quantity" required name="quantity">
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
                                                <input type="number" step="any" value="{{ old('daily_rate') }}" class="form-control form-control-sm" placeholder="Daily Rate" required name="daily_rate">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                       <span class="material-icons-outlined" style="font-size: 15px">money</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-6">
                                            <label class="small">Photo <span class="text-danger">*</span>:</label>

                                            <div class="input-group mb-2">
                                                <input type="file" accept="image/*" class="form-control form-control-sm" required name="photo">
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
                                                <textarea value="{{ old('description') }}" class="form-control form-control-sm" rows="5" placeholder="Description" required name="description">{{ old('description') }}</textarea>
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