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
                        <input type="text" class="form-control form-control-sm" name="first_name" placeholder="First name" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-2">
                        <input type="text" class="form-control form-control-sm" name="middle_name" placeholder="Middle name">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-2">
                        <input type="text" class="form-control form-control-sm" name="last_name" placeholder="Last name" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>

                    <select name="suffix" class="form-control form-control-sm mb-2">
                        <option>Select Suffix</option>
                        <option value="JR.">JR.</option>
                        <option value="SR.">SR.</option>
                        <option value="I">I</option>
                        <option value="II">II</option>
                        <option value="III">III</option>
                        <option value="IV">IV</option>
                        <option value="MD">MD</option>
                        <option value="PHD">PHD</option>
                        <option value="ESQ.">ESQ.</option>
                        <option value="MBA">MBA</option>
                        <option value="MA">MA</option>
                        <option value="MS">MS</option>
                        <option value="MSC">MSC</option>
                        <option value="BSC">BSC</option>
                        <option value="BS">BS</option>
                        <option value="BA">BA</option>
                        <option value="AB">AB</option>
                        <option value="LLB">LLB</option>
                        <option value="LLM">LLM</option>
                        <option value="LLD">LLD</option>
                        <option value="Jr.">Jr.</option>
                        <option value="Sr.">Sr.</option>
                        <option value="Rev.">Rev.</option>
                        <option value="Fr.">Fr.</option>
                    </select>
                    
                    <div class="input-group mb-2">
                        <input type="email" class="form-control form-control-sm" name="email" placeholder="Email" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-at"></span>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-light text-muted mb-1" style="font-size: 11.5px">
                        To secure your account, we'll generate a temporary password and send it to the email address you provided. This helps us confirm your email existence.
                    </div>

                    <div class="row">
                        <div class="col-12 my-2">
                            <button type="submit" name="login_button" class="btn btn-danger btn-sm btn-block elevation-1">
                                REGISTER
                                <span class="fas fa-save pl-1"></span>
                            </button>

                            <a href="/" class="btn btn-default btn-sm btn-block">
                                Already have an account? <span class="text-danger">Login now!</span>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection