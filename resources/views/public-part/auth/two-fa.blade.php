@extends('public-part.auth.layout.layout')
@section('title') {{ Helper::getPageTitle(__('Prijavite se')) }} @endsection

@section('content')
    <div class="auth-wrapper">
        <div class="aw-form-wrapper">
            <div class="aw-form">
                <div class="aw-form-logo-wrapper">
                    <img class="dark-logo" src="{{ asset('files/images/menu-logo-dark.png') }}" alt="{{ __('Logo image') }}">
                </div>
                <div class="aw-form-header">
                    <h2>{{ __('Dvofaktorska autentifikacija (2FA)') }}</h2>
                    <p>{{ __('Unesite 6-cifreni kod iz vaše OTP Auth aplikacije kako biste se prijavili u sistem.') }}</p>
                </div>
                <div class="aw-form-form">
                    <div class="two-fa-wrapper">
                        {{ html()->text('digit-one')->class('input otp-input')->required()->maxlength(1)->attribute('autofocus') }}
                        {{ html()->text('digit-two')->class('input otp-input')->required()->maxlength(1) }}
                        {{ html()->text('digit-three')->class('input otp-input')->required()->maxlength(1) }}
                        {{ html()->text('digit-four')->class('input otp-input')->required()->maxlength(1) }}
                        {{ html()->text('digit-five')->class('input otp-input')->required()->maxlength(1) }}
                        {{ html()->text('digit-six')->class('input otp-input')->required()->maxlength(1) }}
                    </div>
                    <div class="aw-ff-input-wrapper">
                        <button class="two-fa-btn">{{ __('Verifikuj kod') }}</button>
                    </div>

                    <div class="separation-line">
                        <p>{{ __('DODATNO') }}</p>
                    </div>

                    <div class="sign-up-wrapper">
                        <p>{{ __('Imaš problem sa prijavom?') }}</p>
                        <a href="#">{{ __('Kontaktiraj nas') }}</a>
                    </div>
                </div>
            </div>
        </div>
        @include('public-part.auth.includes.right-side')
    </div>
@endsection
