@extends('system.layout.layout')
@section('c-icon')
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
        <path d="M341.8 72.6C329.5 61.2 310.5 61.2 298.3 72.6L74.3 280.6C64.7 289.6 61.5 303.5 66.3 315.7C71.1 327.9 82.8 336 96 336L112 336L112 512C112 547.3 140.7 576 176 576L464 576C499.3 576 528 547.3 528 512L528 336L544 336C557.2 336 569 327.9 573.8 315.7C578.6 303.5 575.4 289.5 565.8 280.6L341.8 72.6zM304 384L336 384C362.5 384 384 405.5 384 432L384 528L256 528L256 432C256 405.5 277.5 384 304 384z"/>
    </svg>
@endsection
@section('c-title') {{ __('Dashboard') }} @endsection
@section('c-breadcrumbs')
    <a href="{{ route('system.dashboard') }}"> <p>{{ __('Upravljačka tabla admin panela') }}</p> </a>
@endsection
@section('c-buttons')
    <a href="{{ route('system.dashboard') }}">
        <button class="pm-btn btn btn-dark"><img src="{{ asset('files/images/icons/star-white.svg') }}" alt="{{ __('Star') }}"> </button>
    </a>
@endsection

@section('content')
    <div class="homepage">
        <div class="homepage-main">
            <div class="home-row">
                <div class="home-row-header">
                    <h4> {{__('MODULI')}} </h4>
                </div>

                <div class="home-row-body">
                    <div class="home-row-items">
                        <div class="home-icon go-to" data-url="{{ route('system.settings.keywords') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
                                <path d="M256 160L256 224L384 224L384 160C384 124.7 355.3 96 320 96C284.7 96 256 124.7 256 160zM192 224L192 160C192 89.3 249.3 32 320 32C390.7 32 448 89.3 448 160L448 224C483.3 224 512 252.7 512 288L512 512C512 547.3 483.3 576 448 576L192 576C156.7 576 128 547.3 128 512L128 288C128 252.7 156.7 224 192 224z"/>
                            </svg>
                            <p> {{__('Ključne riječi')}} </p>
                        </div>
                        <div class="home-icon go-to" data-url="{{ route('system.settings.faq') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
                                <path d="M528 320C528 205.1 434.9 112 320 112C205.1 112 112 205.1 112 320C112 434.9 205.1 528 320 528C434.9 528 528 434.9 528 320zM64 320C64 178.6 178.6 64 320 64C461.4 64 576 178.6 576 320C576 461.4 461.4 576 320 576C178.6 576 64 461.4 64 320zM320 240C302.3 240 288 254.3 288 272C288 285.3 277.3 296 264 296C250.7 296 240 285.3 240 272C240 227.8 275.8 192 320 192C364.2 192 400 227.8 400 272C400 319.2 364 339.2 344 346.5L344 350.3C344 363.6 333.3 374.3 320 374.3C306.7 374.3 296 363.6 296 350.3L296 342.2C296 321.7 310.8 307 326.1 302C332.5 299.9 339.3 296.5 344.3 291.7C348.6 287.5 352 281.7 352 272.1C352 254.4 337.7 240.1 320 240.1zM288 432C288 414.3 302.3 400 320 400C337.7 400 352 414.3 352 432C352 449.7 337.7 464 320 464C302.3 464 288 449.7 288 432z"/>
                            </svg>
                            <p>{{ __('FAQs') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="homepage-side">
            <div class="reminders home-right-wrapper">
                <div class="home-right-header">
                    <p> {{__('Brzi linkovi')}} </p>
                </div>
                <div class="home-right-element">
                    <a href="{{ route('public.home') }}" target="_blank"> {{__('Naslovna strana')}} </a>
                </div>
                <div class="home-right-element" title="{{ __('Cozy Firm d.o.o') }}">
                    <a href="https://support.cozyfirm.com" target="_blank"> {{__('CozyFirm Podrška')}} </a>
                </div>
            </div>


            <div class="reminders home-right-wrapper">
                <div class="home-right-header">
                    <p> {{__('Historija pristupa')}} </p>
                </div>
                <div class="home-right-system-access">
                    @foreach($systemAccess as $access)
                        <div class="sa__row_wrapper go-to" data-url="{{ route('system.users.preview', ['username' => $access->userRel->username ?? 'unknown']) }}" title="{{ $access->userRel->name ?? 'Nepoznat korisnik' }}">
                            <div class="icon__wrapper ps-12">
                                <p> {{ $access->userRel->getInitials() }} </p>
                            </div>
                            <div class="text__wrapper">
                                <div class="text__data">
                                    <p>{{ $access->description ?? '' }}</p>
                                    <span>{{ $access->dateTime() }}</span>
                                </div>
                                <div class="icons__data">
                                    @if($access->action == 'sign-in')
                                        <i class="fa-solid fa-right-to-bracket"></i>
                                    @else
                                        <i class="fa-solid fa-power-off"></i>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
