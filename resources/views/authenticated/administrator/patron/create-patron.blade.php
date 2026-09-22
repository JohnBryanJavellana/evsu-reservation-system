@extends('layout')

@section('content')
    @include('authenticated.administrator.menu')

    <div class="content-wrapper">
        @include('components.page-name', [ 'page_name' => 'Create New Patron' ])
    
        <section class="content">
            <div class="container-fluid">
                @include('components.message-notification')

                <div class="row">
                    <div class="col-xl-12">
                        <div class="card card-outline card-danger rounded-0">
                            <div class="card-header p-0">
                                <div class="alert rounded-0 border-0 alert-light text-muted mb-0" style="font-size: 11.5px">
                                    <span class="fas fa-lock text-bold mr-1"></span> To secure patron account, we'll generate a temporary password and send it to the email address you provided. This helps us confirm email existence.
                                </div>        
                            </div>
                            <div class="card-body">
                                <form method="POST" enctype="multipart/form-data" onsubmit="showLoaderAnimation()">
                                    @csrf
                                    
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <label class="small">First name <span class="text-danger">*</span>:</label>

                                            <div class="input-group mb-2">
                                                <input type="text" value="{{ old('firstname') }}" class="form-control form-control-sm" placeholder="First name" required name="firstname">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                       <span class="material-icons-outlined" style="font-size: 15px">person</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-6">
                                            <label class="small">Middle name <span class="text-danger">*</span>:</label>

                                            <div class="input-group mb-2">
                                                <input type="text" value="{{ old('middlename') }}" class="form-control form-control-sm" placeholder="Middle name" required name="middlename">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                       <span class="material-icons-outlined" style="font-size: 15px">person</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
            
                                        <div class="col-xl-6">
                                            <label class="small">Last name <span class="text-danger">*</span>:</label>

                                            <div class="input-group mb-2">
                                                <input type="text" value="{{ old('lastname') }}" class="form-control form-control-sm" placeholder="Last name" required name="lastname">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                       <span class="material-icons-outlined" style="font-size: 15px">person</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-6">
                                            <div class="form-group mb-2">
                                                <label class="small">Suffix</label>
            
                                                <select name="suffix" class="form-control form-control-sm mb-2">
                                                    <option value="" @if(old('suffix') == '') selected @endif>Select Suffix</option>
                                                    @foreach([
                                                        'JR.', 'SR.', 'I', 'II', 'III', 'IV', 'MD', 'PHD', 'ESQ.', 'MBA', 'MA', 'MS', 
                                                        'MSC', 'BSC', 'BS', 'BA', 'AB', 'LLB', 'LLM', 'LLD', 'Jr.', 'Sr.', 'Rev.', 'Fr.'
                                                    ] as $suffix)
                                                        <option value="{{ $suffix }}" @if(old('suffix') == $suffix) selected @endif>{{ $suffix }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-xl-6">
                                            <label class="small">Email <span class="text-danger">*</span>:</label>

                                            <div class="input-group mb-2">
                                                <input type="email" value="{{ old('name') }}" class="form-control form-control-sm" placeholder="Email" required name="email">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                       <span class="material-icons-outlined" style="font-size: 15px">alternate_email</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-6">
                                            <div class="form-group mb-2">
                                                <label class="small">Account Role <span class="text-danger">*</span>:</label>
            
                                                <select class="form-control form-control-sm" required name="role">
                                                    <option value="Patron">Patron</option>
                                                </select>
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