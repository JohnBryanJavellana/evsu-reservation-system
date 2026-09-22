@extends('layout')

@section('content') 
<style>
    .login-page {
        background: url("{{ URL::asset('system-images/bg.png') }}") no-repeat;
        background-attachment: fixed;
        background-size: cover;
    }
</style>

<div class="login-page">
    <div class="login-box">
        @include('components.message-notification')

        <div class="card card-outline rounded-0 card-danger text-dark elevation-3">
            <div class="card-body px-4">
                <div class="text-center mb-3">
                    <small class="text-bold">Eastern Visayas State University Reservation Management System</small>
                </div>

                <form method="POST" action="/reset-password" onsubmit="showLoaderAnimation()">
                    @csrf
                    
                    <input type="hidden" value="{{ $token }}" name="token">

                    <label for="" class="small">My Email</label>
                    <div class="input-group mb-2">
                        <input type="email" class="form-control form-control-sm" readonly name="email" value="{{ request()->email }}" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-at"></span>
                            </div>
                        </div>
                    </div>

                    <label for="" class="small">New Password <span class="text-danger">*</span></label>
                    <div class="input-group mb-2">
                        <input type="password" class="form-control form-control-sm" name="password" placeholder="Enter Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-key"></span>
                            </div>
                        </div>
                    </div>

                    <label for="" class="small">Repeat Password <span class="text-danger">*</span></label>
                    <div class="input-group mb-2">
                        <input type="password" class="form-control form-control-sm" name="password_confirmation" placeholder="Repeat Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-key"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 mb-3 mt-2">
                            <button type="submit" name="login_button" class="btn-sm btn btn-danger btn-block elevation-1">
                                SUBMIT
                                <span class="fas fa-sign-in-alt pl-1"></span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop