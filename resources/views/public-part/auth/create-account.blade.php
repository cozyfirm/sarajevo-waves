@extends('public-part.auth.layout.layout')
@section('title') {{ Helper::getPageTitle(__('Kreirajte račun')) }} @endsection

@section('content')
    <div class="auth-wrapper">
        <div class="aw-form-wrapper">
            <div class="aw-form">
                <div class="aw-form-logo-wrapper">
                    <img class="dark-logo" src="{{ asset('files/images/menu-logo-dark.png') }}" alt="{{ __('Logo image') }}">
                </div>
                <div class="aw-form-header">
                    <h1>{{ __('Kreirajte račun!') }}</h1>
                    <p>{{ __('Kreirajte račun, istražite našu ponudu i pronađite proizvode po svom ukusu.') }}</p>
                </div>
                <div class="aw-form-form">
                    <div class="aw-ff-input-wrapper name-wrapper">
                        <label for="username">{{ __('Ime i prezime') }}</label>
                        <div class="input-wrapper">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
                                <path d="M240 192C240 147.8 275.8 112 320 112C364.2 112 400 147.8 400 192C400 236.2 364.2 272 320 272C275.8 272 240 236.2 240 192zM448 192C448 121.3 390.7 64 320 64C249.3 64 192 121.3 192 192C192 262.7 249.3 320 320 320C390.7 320 448 262.7 448 192zM144 544C144 473.3 201.3 416 272 416L368 416C438.7 416 496 473.3 496 544L496 552C496 565.3 506.7 576 520 576C533.3 576 544 565.3 544 552L544 544C544 446.8 465.2 368 368 368L272 368C174.8 368 96 446.8 96 544L96 552C96 565.3 106.7 576 120 576C133.3 576 144 565.3 144 552L144 544z"/>
                            </svg>
                            {{ html()->text('name', '')->class('input username-input register-name')->required()->placeholder('John Doe') }}
                        </div>
                    </div>

                    <div class="aw-ff-input-wrapper email-wrapper">
                        <label for="email">{{ __('Email') }}</label>
                        <div class="input-wrapper">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
                                <path
                                    d="M125.4 128C91.5 128 64 155.5 64 189.4C64 190.3 64 191.1 64.1 192L64 192L64 448C64 483.3 92.7 512 128 512L512 512C547.3 512 576 483.3 576 448L576 192L575.9 192C575.9 191.1 576 190.3 576 189.4C576 155.5 548.5 128 514.6 128L125.4 128zM528 256.3L528 448C528 456.8 520.8 464 512 464L128 464C119.2 464 112 456.8 112 448L112 256.3L266.8 373.7C298.2 397.6 341.7 397.6 373.2 373.7L528 256.3zM112 189.4C112 182 118 176 125.4 176L514.6 176C522 176 528 182 528 189.4C528 193.6 526 197.6 522.7 200.1L344.2 335.5C329.9 346.3 310.1 346.3 295.8 335.5L117.3 200.1C114 197.6 112 193.6 112 189.4z"/>
                            </svg>
                            {{ html()->text('email', $email ?? '')->class('input email-input register-email')->required()->placeholder('john@doe.ba') }}
                        </div>
                    </div>

                    <div class="aw-ff-input-wrapper">
                        <label for="password">{{ __('Šifra') }}</label>
                        <div class="input-wrapper">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
                                <path
                                    d="M320 96C284.7 96 256 124.7 256 160L256 224L448 224C483.3 224 512 252.7 512 288L512 512C512 547.3 483.3 576 448 576L192 576C156.7 576 128 547.3 128 512L128 288C128 252.7 156.7 224 192 224L192 160C192 89.3 249.3 32 320 32C383.5 32 436.1 78.1 446.2 138.7C449.1 156.1 437.4 172.6 419.9 175.6C402.4 178.6 386 166.8 383 149.3C378 119.1 351.7 96 320 96zM360 424C373.3 424 384 413.3 384 400C384 386.7 373.3 376 360 376L280 376C266.7 376 256 386.7 256 400C256 413.3 266.7 424 280 424L360 424z"/>
                            </svg>
                            {{ html()->password('password')->class('input register-password')->required()->placeholder('Vaša šifru') }}
                        </div>
                    </div>

                    <div class="aw-ff-input-wrapper">
                        <button class="create-account-btn">{{ __('Kreirajte račun') }}</button>
                    </div>

                    <div class="separation-line">
                        <p>ILI</p>
                    </div>

                    <div class="social-networks-wrapper">
                        <a href="#">
                            <div class="social-network">
                                <img src="{{ asset('files/images/icons/google.png') }}" alt="">
                                <p>{{ __('Google') }}</p>
                            </div>
                        </a>
{{--                        <a href="#">--}}
{{--                            <div class="social-network">--}}
{{--                                <img src="{{ asset('files/images/icons/apple.png') }}" alt="">--}}
{{--                                <p>{{ __('Apple') }}</p>--}}
{{--                            </div>--}}
{{--                        </a>--}}
                    </div>

                    <div class="sign-up-wrapper">
                        <p>{{ __('Imate korisnički račun?') }}</p>
                        <a href="{{ route('auth') }}">{{ __('Prijavite se') }}</a>
                    </div>
                </div>
            </div>
        </div>
        @include('public-part.auth.includes.right-side')
    </div>
@endsection
