@extends('public-part.auth.layout.layout')
@section('title') {{ Helper::getPageTitle(__('Oporavak korisničkog računa')) }} @endsection

@section('content')
    <div class="auth-wrapper">
        <div class="aw-form-wrapper">
            <div class="aw-form">
                <div class="aw-form-logo-wrapper">
                    <img class="dark-logo" src="{{ asset('files/images/menu-logo-dark.png') }}" alt="{{ __('Logo image') }}">
                </div>
                <div class="aw-form-header">
                    <h1>{{ __('Provjerite svoj email') }}</h1>
                    <p>{{ __('Ako je unesena email adresa povezana s korisničkim računom, poslali smo vam upute za oporavak lozinke. Molimo vas da provjerite svoj inbox, kao i Spam / Junk folder.') }}</p>
                    <p>{{ __('Link za oporavak vrijedi ograničeno vrijeme. Ako niste zaprimili email u roku od nekoliko minuta, pokušajte ponovo ili kontaktirajte podršku.') }}</p>
                </div>
            </div>
        </div>
        @include('public-part.auth.includes.right-side')
    </div>
@endsection
