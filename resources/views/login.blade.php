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

                <form method="POST" onsubmit="showLoaderAnimation()">
                    @csrf

                    <div class="input-group mb-2">
                        <input type="email" class="form-control form-control-sm" name="email" placeholder="Email" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-at"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-2">
                        <input type="password" class="form-control form-control-sm" name="password" placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-key"></span>
                            </div>
                        </div>
                    </div>

                    <label for="" class="small">
                        <a href="/forgot-password">Forgot Password?</a>
                    </label>

                    <div class="row">
                        <div class="col-12 my-2">
                            <button type="submit" name="login_button" class="btn btn-danger btn-sm btn-block elevation-1">
                                LOGIN
                                <span class="fas fa-sign-in-alt pl-1"></span>
                            </button>

                            <a href="/register" class="btn btn-default btn-sm btn-block">
                                Don't have an account? <span class="text-danger">Register now!</span>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection