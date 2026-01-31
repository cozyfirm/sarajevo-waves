@extends('public-part.auth.layout.layout')
@section('title') {{ Helper::getPageTitle(__('Postavite novu šifru')) }} @endsection

@section('content')
    <div class="auth-wrapper">
        <div class="aw-form-wrapper">
            <div class="aw-form">
                <div class="aw-form-logo-wrapper">
                    <img class="dark-logo" src="{{ asset('files/images/menu-logo-dark.png') }}" alt="{{ __('Logo image') }}">
                </div>
                <div class="aw-form-header">
                    <h1>{{ __('Postavite novu šifru') }}</h1>
                    <p>{{ __('Unesite novu šifru za svoj nalog. Preporučujemo da šifra ima najmanje 8 karaktera i sadrži slova i brojeve.') }}</p>
                </div>
                <div class="aw-form-form">
                    {{ html()->hidden('token')->class('form-control')->value($token) }}

                    <div class="aw-ff-input-wrapper email-wrapper">
                        <label for="email">{{ __('Email') }}</label>
                        <div class="input-wrapper">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
                                <path d="M125.4 128C91.5 128 64 155.5 64 189.4C64 190.3 64 191.1 64.1 192L64 192L64 448C64 483.3 92.7 512 128 512L512 512C547.3 512 576 483.3 576 448L576 192L575.9 192C575.9 191.1 576 190.3 576 189.4C576 155.5 548.5 128 514.6 128L125.4 128zM528 256.3L528 448C528 456.8 520.8 464 512 464L128 464C119.2 464 112 456.8 112 448L112 256.3L266.8 373.7C298.2 397.6 341.7 397.6 373.2 373.7L528 256.3zM112 189.4C112 182 118 176 125.4 176L514.6 176C522 176 528 182 528 189.4C528 193.6 526 197.6 522.7 200.1L344.2 335.5C329.9 346.3 310.1 346.3 295.8 335.5L117.3 200.1C114 197.6 112 193.6 112 189.4z"/>
                            </svg>
                            {{ html()->text('email')->class('input email')->required()->placeholder('Unesite Vaš email') }}
                        </div>
                    </div>

                    <div class="aw-ff-input-wrapper password-wrapper">
                        <label for="password">{{ __('Šifra') }}</label>
                        <div class="input-wrapper">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
                                <path d="M125.4 128C91.5 128 64 155.5 64 189.4C64 190.3 64 191.1 64.1 192L64 192L64 448C64 483.3 92.7 512 128 512L512 512C547.3 512 576 483.3 576 448L576 192L575.9 192C575.9 191.1 576 190.3 576 189.4C576 155.5 548.5 128 514.6 128L125.4 128zM528 256.3L528 448C528 456.8 520.8 464 512 464L128 464C119.2 464 112 456.8 112 448L112 256.3L266.8 373.7C298.2 397.6 341.7 397.6 373.2 373.7L528 256.3zM112 189.4C112 182 118 176 125.4 176L514.6 176C522 176 528 182 528 189.4C528 193.6 526 197.6 522.7 200.1L344.2 335.5C329.9 346.3 310.1 346.3 295.8 335.5L117.3 200.1C114 197.6 112 193.6 112 189.4z"/>
                            </svg>
                            {{ html()->password('password')->class('input password')->required()->placeholder('Molimo da unesete Vašu šifru') }}
                        </div>
                    </div>

                    <div class="aw-ff-input-wrapper">
                        <button class="new-password-btn">{{ __('Sačuvaj novu šifru') }}</button>
                    </div>
                </div>
            </div>
        </div>
        @include('public-part.auth.includes.right-side')
    </div>
@endsection
