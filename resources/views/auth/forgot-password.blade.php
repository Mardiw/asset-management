@extends('layouts.auth')

@section('auth-body')
<div class="form-container outer">
    <div class="form-form">
        <div class="form-form-wrap">
            <div class="form-container">
                <div class="form-content">

                    <p class="">{{ __('auth.hint_forgot_password') }}</p>

                    <form class="text-left" method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="form">
                            <x-auth-session-status class="mb-4" :status="session('status')" />
                            <!-- Validation Errors -->
                            <x-auth-validation-errors class="mb-4" :errors="$errors" />
                            <div id="email-field" class="field-wrapper input">
                                <label for="email">{{ __('auth.email') }}</label>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-at-sign register"><circle cx="12" cy="12" r="4"></circle><path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-3.92 7.94"></path></svg>
                                <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('auth.registered_email') }}">
                            </div>

                            <div class="d-sm-flex justify-content-between">
                                <div class="field-wrapper">
                                    <button type="submit" class="btn btn-primary" value="">{{ __('auth.send_email_reset_link') }}</button>
                                </div>
                            </div>

                            <p class="signup-link">{{ __('auth.not_registered') }} <a href="{{ route('register') }}">{{ __('auth.create_account_now') }}</a></p>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
