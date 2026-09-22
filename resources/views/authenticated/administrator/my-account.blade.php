@extends('layout')

@section('content')
    @include('authenticated.administrator.menu')

    <div class="content-wrapper">
        @include('components.page-name', [ 'page_name' => 'My Account' ])
    
        <section class="content">
            <div class="container-fluid">
                @include('components.message-notification')
                
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card card-outline card-danger rounded-0">
                            <div class="card-body">
                                <img class="mb-3" src="{{ URL::asset('user-images/' . $myaccount->profile_picture) }}" alt="" height="100" srcset="">

                                <form method="POST" enctype="multipart/form-data" onsubmit="showLoaderAnimation()">
                                    @csrf
                                    
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <label class="small">First name *</label>

                                            <div class="input-group mb-2">
                                                <input type="text" value="{{ $myaccount->firstname }}" class="form-control form-control-sm" placeholder="First name" required name="firstname">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                       <span class="material-icons-outlined" style="font-size: 15px">person</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-6">
                                            <label class="small">Middle name *</label>

                                            <div class="input-group mb-2">
                                                <input type="text" value="{{ $myaccount->middlename }}" class="form-control form-control-sm" placeholder="Middle name" required name="middlename">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                       <span class="material-icons-outlined" style="font-size: 15px">person</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
            
                                        <div class="col-xl-6">
                                            <label class="small">Last name *</label>

                                            <div class="input-group mb-2">
                                                <input type="text" value="{{ $myaccount->lastname }}" class="form-control form-control-sm" placeholder="Last name" required name="lastname">
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
                                                    <option value="" @if($myaccount->suffix == "") selected @endif>N/A</option>
                                                    <option value="JR" @if($myaccount->suffix == "JR") selected @endif>JR</option>
                                                    <option value="SR" @if($myaccount->suffix == "SR") selected @endif>SR</option>
                                                    <option value="I" @if($myaccount->suffix == "I") selected @endif>I</option>
                                                    <option value="II" @if($myaccount->suffix == "II") selected @endif>II</option>
                                                    <option value="III" @if($myaccount->suffix == "III") selected @endif>III</option>
                                                    <option value="IV" @if($myaccount->suffix == "IV") selected @endif>IV</option>
                                                    <option value="MD" @if($myaccount->suffix == "MD") selected @endif>MD</option>
                                                    <option value="PHD" @if($myaccount->suffix == "PHD") selected @endif>PHD</option>
                                                    <option value="ESQ" @if($myaccount->suffix == "ESQ") selected @endif>ESQ</option>
                                                    <option value="MBA" @if($myaccount->suffix == "MBA") selected @endif>MBA</option>
                                                    <option value="MA" @if($myaccount->suffix == "MA") selected @endif>MA</option>
                                                    <option value="MS" @if($myaccount->suffix == "MS") selected @endif>MS</option>
                                                    <option value="MSC" @if($myaccount->suffix == "MSC") selected @endif>MSC</option>
                                                    <option value="BSC" @if($myaccount->suffix == "BSC") selected @endif>BSC</option>
                                                    <option value="BS" @if($myaccount->suffix == "BS") selected @endif>BS</option>
                                                    <option value="BA" @if($myaccount->suffix == "BA") selected @endif>BA</option>
                                                    <option value="AB" @if($myaccount->suffix == "AB") selected @endif>AB</option>
                                                    <option value="LLB" @if($myaccount->suffix == "LLB") selected @endif>LLB</option>
                                                    <option value="LLM" @if($myaccount->suffix == "LLM") selected @endif>LLM</option>
                                                    <option value="LLD" @if($myaccount->suffix == "LLD") selected @endif>LLD</option>
                                                    <option value="Jr" @if($myaccount->suffix == "Jr") selected @endif>Jr</option>
                                                    <option value="Sr" @if($myaccount->suffix == "Sr") selected @endif>Sr</option>
                                                    <option value="Rev" @if($myaccount->suffix == "Rev") selected @endif>Rev</option>
                                                    <option value="Fr" @if($myaccount->suffix == "Fr") selected @endif>Fr</option>
                                                </select>
                                            </div>
                                        </div>
                                    
                                        <div class="col-xl-6">
                                            <label class="small">Email *</label>

                                            <div class="input-group mb-2">
                                                <input type="email" value="{{ $myaccount->email }}" class="form-control form-control-sm" placeholder="Email" required name="email">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="material-icons-outlined" style="font-size: 15px">alternate_email</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
            
                                        <div class="col-xl-6">
                                            <label class="small">Change Password</label>

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
                                    </div>
            
                                    <button type="submit" name="save_user" class="btn btn-danger btn-sm elevation-1 mt-3">
                                        <i class="fas fa-save pr-2"></i>
                                        Save Changes
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