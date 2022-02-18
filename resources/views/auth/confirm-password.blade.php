@extends('layouts.auth')

@section('auth-body')
<div class="form-container outer">
    <div class="form-form">
        <div class="form-form-wrap">
            <div class="form-container">
                <div class="form-content">

                    <p class="">{{ __('auth.confirm_password_for_safe_area') }}</p>

                    <form class="text-left" method="POST" action="{{ route('password.confirm') }}">
                        @csrf
                        <div class="form">
                            <!-- Validation Errors -->
                            <x-auth-validation-errors class="mb-4" :errors="$errors" />
                            <div id="email-field" class="field-wrapper input">
                                <label for="password">{{ __('auth.password') }}</label>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                <input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="toggle-password" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                            </div>

                            <div class="d-sm-flex justify-content-between">
                                <div class="field-wrapper">
                                    <button type="submit" class="btn btn-primary" value="">{{ __('auth.confirm_button') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('additional_css')
<link rel="stylesheet" type="text/css" href="/cork1/assets/css/forms/theme-checkbox-radio.css">
<link rel="stylesheet" type="text/css" href="/css/fontawesome/css/all.css">
@endsection
