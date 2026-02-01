@extends('system.layout.layout')
@section('title') {{ Helper::getPageTitle(__('Two-Factor Authentication')) }} @endsection
@section('c-icon')
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
        <path d="M96 192C96 130.1 146.1 80 208 80C269.9 80 320 130.1 320 192C320 253.9 269.9 304 208 304C146.1 304 96 253.9 96 192zM32 528C32 430.8 110.8 352 208 352C305.2 352 384 430.8 384 528L384 534C384 557.2 365.2 576 342 576L74 576C50.8 576 32 557.2 32 534L32 528zM464 128C517 128 560 171 560 224C560 277 517 320 464 320C411 320 368 277 368 224C368 171 411 128 464 128zM464 368C543.5 368 608 432.5 608 512L608 534.4C608 557.4 589.4 576 566.4 576L421.6 576C428.2 563.5 432 549.2 432 534L432 528C432 476.5 414.6 429.1 385.5 391.3C408.1 376.6 435.1 368 464 368z"/>
    </svg>
@endsection
@section('c-title') {{ __('Two-Factor Authentication') }} @endsection
@section('c-breadcrumbs')
    <a href="{{ route('system.dashboard') }}"> <p>{{ __('Dashboard') }}</p> </a> /
    <a href="{{ route('system.users') }}">{{ __('Pregled svih korisnika') }}</a> /
{{--    <a href="{{ route('system.users.preview', ['username' => $user->username ]) }}">{{ $user->name }}</a>--}}
@endsection

@section('c-buttons')
    <a href="{{ route('system.dashboard') }}">
        <button class="pm-btn btn btn-dark"> <img src="{{ asset('files/images/icons/star-white.svg') }}" alt="{{ __('Star') }}"> </button>
    </a>
@endsection

@section('content')
    <div class="content-wrapper preview-content-wrapper">
        <div class="form__info">
            <div class="form__info__inner">
                <form action="#" method="POST" id="js-form">
                    <h3>{{ __('Dvofaktorska autentifikacija (2FA)') }}</h3>
                    <h6 class="mt-3"><b>{{ __('Kratko objašnjenje') }}</b></h6>

                    <p>{{ __('2FA dodaje dodatni sloj zaštite vašem nalogu.') }}</p>
                    <p>{{ __('Nakon što unesete lozinku, tražiće se i 6-cifreni kod iz aplikacije (npr. Microsoft Authenticator) koji se mijenja svakih ~30 sekundi.') }}</p>

                    <p class="mt-3">{{ __('Šta vam treba') }}</p>
                    <ul>
                        <li>{{ __('Telefon sa instaliranom aplikacijom Microsoft Authenticator (ili druga TOTP aplikacija)') }}</li>
                        <li>{{ __('1–2 minute vremena za podešavanje') }}</li>
                    </ul>

                    <h6 class="mt-3"><b>{{ __('Upozorenje / napomena') }}</b></h6>
                    <p>{{ __('Ako izgubite telefon ili obrišete aplikaciju, nećete moći ući bez dodatnog načina oporavka (ako ga imate).') }}</p>
                    <p>{{ __('Preporuka: dodajte račun u Authenticator i na backup (cloud backup u app-u), ako koristite.') }}</p>

                    <div class="ps-row mt-3">
                        <div class="ps-col">
                            <h5>{{ __('2FA Status') }}</h5>
                            <p>{{ __('Dodaj dodatni sloj sigurnosti svom računu. Nakon unosa lozinke tražit će se jednokratni 6-cifreni kod iz aplikacije poput Microsoft Authenticatora. Ovo značajno smanjuje mogućnost neovlaštenog pristupa.') }}</p>
                        </div>
                        <div class="ps-col">
                            <div class="ps-toggle @if(Auth()->user()->two_fa) active @endif" id="notification-switch" type="notifications"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="right__menu__info">
            @include('system.app.users.snippets.right-menu')
        </div>
    </div>
@endsection
