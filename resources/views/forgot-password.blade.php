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

                <form method="POST" action="/forgot-password-func" onsubmit="showLoaderAnimation()">
                    @csrf

                    <div class="input-group mb-1">
                        <input type="email" class="form-control form-control-sm" name="email" placeholder="Enter Email" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-at"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 my-2">
                            <button type="submit" name="login_button" class="btn-sm btn btn-danger btn-block elevation-1">
                                SUBMIT
                                <span class="fas fa-sign-in-alt pl-1"></span>
                            </button>

                            <a href="/" class="btn btn-default btn-sm btn-block">
                                <span class="fas fa-arrow-left text-danger mr-1"></span> Return to homepage
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop