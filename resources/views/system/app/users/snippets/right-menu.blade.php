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
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
            <path d="M335.9 84.2C326.1 78.6 314 78.6 304.1 84.2L80.1 212.2C67.5 219.4 61.3 234.2 65 248.2C68.7 262.2 81.5 272 96 272L128 272L128 480L128 480L76.8 518.4C68.7 524.4 64 533.9 64 544C64 561.7 78.3 576 96 576L544 576C561.7 576 576 561.7 576 544C576 533.9 571.3 524.4 563.2 518.4L512 480L512 272L544 272C558.5 272 571.2 262.2 574.9 248.2C578.6 234.2 572.4 219.4 559.8 212.2L335.8 84.2zM464 272L464 480L400 480L400 272L464 272zM352 272L352 480L288 480L288 272L352 272zM240 272L240 480L176 480L176 272L240 272zM320 160C337.7 160 352 174.3 352 192C352 209.7 337.7 224 320 224C302.3 224 288 209.7 288 192C288 174.3 302.3 160 320 160z"/>
        </svg>
    </div>
    <hr>
    <div class="location__wrapper">
        <div class="lw__row" title="{{ __('Stečeno zvanje') }}">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
                <path d="M337.3 51C325.9 48.7 314.2 48.7 302.8 51L115.3 88.5C104.1 90.7 96 100.6 96 112C96 122.3 102.5 131.3 112 134.6L112 208L96.3 286.6C96.1 287.5 96 288.5 96 289.5C96 297.5 102.5 304.1 110.6 304.1L145.5 304.1C153.5 304.1 160.1 297.6 160.1 289.5C160.1 288.5 160 287.6 159.8 286.6L144 208L144 141.3L192 150.9L192 208C192 278.7 249.3 336 320 336C390.7 336 448 278.7 448 208L448 150.9L524.7 135.6C535.9 133.3 544 123.4 544 112C544 100.6 535.9 90.7 524.7 88.5L337.3 51zM320 288C275.8 288 240 252.2 240 208L400 208C400 252.2 364.2 288 320 288zM216.1 384.1C154.7 412.3 112 474.3 112 546.3C112 562.7 125.3 576 141.7 576L296 576L296 430L238.6 387C232.1 382.1 223.4 380.8 216 384.2zM344 576L498.3 576C514.7 576 528 562.7 528 546.3C528 474.3 485.3 412.3 423.9 384.2C416.5 380.8 407.8 382.1 401.3 387L343.9 430L343.9 576z"/>
            </svg>
            <p> diplomirani inženjer elektrotehnike</p>
        </div>
        <div class="lw__row" title="{{ __('Datum diplomiranja') }}">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
                <path d="M216 64C229.3 64 240 74.7 240 88L240 128L400 128L400 88C400 74.7 410.7 64 424 64C437.3 64 448 74.7 448 88L448 128L480 128C515.3 128 544 156.7 544 192L544 480C544 515.3 515.3 544 480 544L160 544C124.7 544 96 515.3 96 480L96 192C96 156.7 124.7 128 160 128L192 128L192 88C192 74.7 202.7 64 216 64zM216 176L160 176C151.2 176 144 183.2 144 192L144 240L496 240L496 192C496 183.2 488.8 176 480 176L216 176zM144 288L144 480C144 488.8 151.2 496 160 496L480 496C488.8 496 496 488.8 496 480L496 288L144 288z"/>
            </svg>
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
