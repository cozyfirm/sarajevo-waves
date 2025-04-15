<div class="three__elements">
    <div class="element">
        <h5>24</h5>
        <p>{{ __('Total years') }}</p>
    </div>
    <div class="element">
        <h5>4.66</h5>
        <p>{{ __('Score') }}</p>
    </div>
    <div class="element">
        <h5>4</h5>
        <p>{{ __('Certificates') }}</p>
    </div>
</div>

<div class="rm-card" title="{{ __('Informacije o edukaciji') }}">
    <div class="rm-card-header">
        <div class="text__part" title="{{ __('Fakultet i univerzitet') }}">
            <h5><a href="#" class="hover-yellow-text" title="{{ __('Uredite informacije') }}"> ETF Sarajevo </a></h5>
            <p>Univerzitet u Sarajevu</p>
        </div>
        <i class="fa-solid fa-building-columns"></i>
    </div>
    <hr>
    <div class="location__wrapper">
        <div class="lw__row" title="{{ __('Stečeno zvanje') }}">
            <i class="fa-solid fa-user-graduate"></i>
            <p> diplomirani inženjer elektrotehnike</p>
        </div>
        <div class="lw__row" title="{{ __('Datum diplomiranja') }}">
            <i class="fa-solid fa-calendar-day"></i>
            <p> 24.08.2018 </p>
        </div>
    </div>
</div>

<div class="rm-card">
    <div class="rm-card-header" title="{{ __('Moje posljednje obuke') }}">
        <h5>{{ __('Posljednje obuke') }}</h5>
        <img class="normal-icon" src="{{ asset('files/images/icons/training.svg') }}" alt="{{ __('Training image') }}">
    </div>
    <hr>
    <div class="list__wrapper">
        <ol>
            <li>
                <a href="#">
                    Neka tamo info
                </a>
            </li>
        </ol>
    </div>
</div>

<div class="rm-card-icons">
    <a href="#" title="{{ __('Stručna sprema') }}" class="open-add-author">
        <div class="rm-ci-w">
            <img class="normal-icon" src="{{ asset('files/images/icons/building-columns-solid.svg') }}" alt="{{ __('University image') }}">
        </div>
    </a>
    <a href="#" title="">
        <div class="rm-ci-w">
            <img src="{{ asset('files/images/icons/category.svg') }}" alt="{{ __('Category image') }}">
        </div>
    </a>
</div>

<!-- System access -->
{{--@if($user->systemAccessRel->count())--}}
{{--    <div class="rm-card" title="{{ __('Korisnički podaci') }}">--}}
{{--        <div class="rm-card-header">--}}
{{--            <div class="text__part">--}}
{{--                <h5>{{ __('Pristup sistemu') }}</h5>--}}
{{--            </div>--}}
{{--            <i class="fa-solid fa-laptop-file"></i>--}}
{{--        </div>--}}
{{--        <hr>--}}
{{--        <div class="system__access">--}}
{{--            @foreach($user->systemAccessRel as $access)--}}
{{--                <div class="sa__row">--}}
{{--                    <p> {{ $access->dateTime() }} {{ $access->description ?? '' }}</p>--}}
{{--                    @if($access->action == 'sign-in')--}}
{{--                        <i class="fa-solid fa-right-to-bracket"></i>--}}
{{--                    @else--}}
{{--                        <i class="fa-solid fa-power-off"></i>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--            @endforeach--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endif--}}
