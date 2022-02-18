@extends('layouts.auth')

@section('auth-body')
<div class="form-container outer">
    <div class="form-form">
        <div class="form-form-wrap">
            <div class="form-container">
                <div class="form-content">

                    <p class="">{{ __('auth.thanks_for_signing_up') }}</p>

                    @if (session('status') == 'verification-link-sent')
                        <div style="color: green">
                            {{ __('auth.verification_link_has_been_sent') }}
                        </div>
                    @endif

                    <form class="text-left" method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <div class="form">
                            <div class="d-sm-flex justify-content-between">
                                <div class="field-wrapper">
                                    <button type="submit" class="btn btn-primary" value="">{{ __('auth.resend_verification_link') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <br>
                    <form class="text-left" method="POST" action="{{ route('logout') }}">
                        @csrf
                        <div class="form">
                            <div class="d-sm-flex justify-content-between">
                                <div class="field-wrapper">
                                    <button type="submit" class="btn btn-primary" value="">{{ __('auth.sign_out') }}</button>
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
