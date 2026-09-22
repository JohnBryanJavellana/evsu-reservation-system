@extends('layout')

@section('content')
    @include('authenticated.administrator.menu')

    <div class="content-wrapper">
        @include('components.page-name', [ 'page_name' => 'Update User' ])
    
        <section class="content">
            <div class="container-fluid">
                @include('components.message-notification')
                
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card card-outline card-danger rounded-0">
                            <div class="card-body">
                                <img class="mb-3" src="{{ URL::asset('user-images/' . $thisuser->profile_picture) }}" alt="" height="100" srcset="">

                                <form method="POST" enctype="multipart/form-data" onsubmit="showLoaderAnimation()">
                                    @csrf
                                    
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <label class="small">First name <span class="text-danger">*</span>:</label>

                                            <div class="input-group mb-2">
                                                <input type="text" value="{{ $thisuser->firstname }}" class="form-control form-control-sm" placeholder="First name" required name="firstname">
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
                                                <input type="text" value="{{ $thisuser->middlename }}" class="form-control form-control-sm" placeholder="Middle name" required name="middlename">
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
                                                <input type="text" value="{{ $thisuser->lastname }}" class="form-control form-control-sm" placeholder="Last name" required name="lastname">
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
                                                    <option value="" @if($thisuser->suffix == "") selected @endif>N/A</option>
                                                    @foreach([
                                                        'JR.', 'SR.', 'I', 'II', 'III', 'IV', 'MD', 'PHD', 'ESQ.', 'MBA', 'MA', 'MS', 
                                                        'MSC', 'BSC', 'BS', 'BA', 'AB', 'LLB', 'LLM', 'LLD', 'Jr.', 'Sr.', 'Rev.', 'Fr.'
                                                    ] as $suffix)
                                                        <option value="{{ $suffix }}" @if($thisuser->suffix == $suffix) selected @endif>{{ $suffix }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    
                                        <div class="col-xl-6">
                                            <label class="small">Email <span class="text-danger">*</span>:</label>

                                            <div class="input-group mb-2">
                                                <input type="email" value="{{ $thisuser->email }}" class="form-control form-control-sm" placeholder="Email" required name="email">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="material-icons-outlined" style="font-size: 15px">alternate_email</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
            
                                        <div class="col-xl-6">
                                            <label class="small">New Password</label>

                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control form-control-sm" placeholder="Password" name="password">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="material-icons-outlined" style="font-size: 15px">password</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
            
                                        <div class="col-xl-6">
                                            <label class="small">Change Profile Picture</label>
                                            <div class="input-group mb-2">
                                                <input type="file" accept="image/*" class="form-control form-control-sm" name="avatar">
                                                
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="material-icons-outlined" style="font-size: 15px">image</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
            
                                        <div class="col-xl-6">
                                            <div class="form-group mb-2">
                                                <label class="small">Account Role <span class="text-danger">*</span>:</label>
            
                                                <select class="form-control form-control-sm" required name="role">
                                                    <option value="Patron" @if ($thisuser->role == "Patron") selected @endif>Patron</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
            
                                    <button type="submit" name="save_user" class="btn btn-danger btn-sm elevation-1 mt-3">
                                        <i class="fas fa-save pr-2"></i>
                                        Save Changes
                                    </button>

                                    <a href="/welcome/administrator/patron/list" class="btn btn-default btn-sm mt-3">
                                        <i class="fas fa-arrow-left pr-2"></i>
                                        Return to list
                                    </a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection