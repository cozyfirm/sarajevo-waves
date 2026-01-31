<div class="s-top-menu">
    <div class="app-name">
        <a title="{{__('Naslovna strana')}}">
            <img src="{{ asset('files/images/logo.png') }}" alt="{{ __('Logo image') }}">
        </a>
        <i class="fas fa-bars t-3 system-m-i-t" title="{{__('Otvorite / zatvorite MENU')}}"></i>
    </div>

    <div class="top-menu-links">
        <!-- Left top icons -->
        <div class="left-icons">
            <div class="single-li" title="{{ __('Globe') }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
                    <path d="M415.9 344L225 344C227.9 408.5 242.2 467.9 262.5 511.4C273.9 535.9 286.2 553.2 297.6 563.8C308.8 574.3 316.5 576 320.5 576C324.5 576 332.2 574.3 343.4 563.8C354.8 553.2 367.1 535.8 378.5 511.4C398.8 467.9 413.1 408.5 416 344zM224.9 296L415.8 296C413 231.5 398.7 172.1 378.4 128.6C367 104.2 354.7 86.8 343.3 76.2C332.1 65.7 324.4 64 320.4 64C316.4 64 308.7 65.7 297.5 76.2C286.1 86.8 273.8 104.2 262.4 128.6C242.1 172.1 227.8 231.5 224.9 296zM176.9 296C180.4 210.4 202.5 130.9 234.8 78.7C142.7 111.3 74.9 195.2 65.5 296L176.9 296zM65.5 344C74.9 444.8 142.7 528.7 234.8 561.3C202.5 509.1 180.4 429.6 176.9 344L65.5 344zM463.9 344C460.4 429.6 438.3 509.1 406 561.3C498.1 528.6 565.9 444.8 575.3 344L463.9 344zM575.3 296C565.9 195.2 498.1 111.3 406 78.7C438.3 130.9 460.4 210.4 463.9 296L575.3 296z"/>
                </svg>
                <div class="number-of"><p>3</p></div>
            </div>

            <a href="#" target="_blank">
                <div class="single-li">
                    <p> {{__('Blog')}} </p>
                </div>
            </a>
            <a href="#">
                <div class="single-li">
                    <p> {{__('Naslovna strana')}} </p>
                </div>
            </a>
        </div>

        <!-- Right top icons -->
        <div class="right-icons">
            <div class="single-li main-search-w" title="">
                <i class="fas fa-search main-search-t" title="{{__('Pretražite')}}"></i>
{{--                @include('system.template.menu.menu-includes.search')--}}
            </div>
            <div class="single-li m-show-notifications" title="Pregled obavijesti">
                <i class="fas fa-bell"></i>
                <div class="number-of"><p id="no-unread-notifications">12</p></div>

{{--                @include('system.template.menu.menu-includes.notifications')--}}
            </div>
            <div class="single-li main-search-w" title="">
                <a href="{{ route('auth.logout') }}">
                    <i class="fas fa-power-off" title="{{__('Odjavite se')}}"></i>
                </a>
            </div>
            <a href="#">
                <div class="single-li user-name">
                    <p><b> {{ Auth()->user()->name ?? '' }} </b></p>
{{--                    {!! Form::hidden('user_id', json_encode($loggedUser), ['class' => 'form-control', 'id' => 'loggedUser']) !!}--}}
                </div>
            </a>
        </div>
    </div>
</div>

<!--------------------------------------------------------------------------------------------------------------------->

<div class="s-left-menu t-3">
    <!-- user Info -->
    <div class="user-info">
        <div class="user-image">
            <img src="{{ asset('files/images/default/sparrow.webp') }}" alt="">
{{--            <img class="mp-profile-image" title="{{__('Promijenite sliku profila')}}" src="{{ isset($loggedUser->profileImgRel) ? asset( $loggedUser->profileImgRel->getFile()) : asset('images/user.png')}}" alt="">--}}
        </div>
        <div class="user-desc">
            <h4> {{ Auth()->user()->name ?? '' }} </h4>
            <p> {{ __('Administrator') }} </p>
            <p>
                <i class="fas fa-circle"></i>
                Online
            </p>
        </div>
    </div>
    <hr>

    <!-- Menu subsection -->
    <div class="s-lm-subsection">
        <div class="subtitle">
            <h4>{{__('Grafičko sučelje')}}</h4>
            <div class="subtitle-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
                    <path d="M96 96C113.7 96 128 110.3 128 128L128 464C128 472.8 135.2 480 144 480L544 480C561.7 480 576 494.3 576 512C576 529.7 561.7 544 544 544L144 544C99.8 544 64 508.2 64 464L64 128C64 110.3 78.3 96 96 96zM304 160C310.7 160 317.1 162.8 321.7 167.8L392.8 245.3L439 199C448.4 189.6 463.6 189.6 472.9 199L536.9 263C541.4 267.5 543.9 273.6 543.9 280L543.9 392C543.9 405.3 533.2 416 519.9 416L215.9 416C202.6 416 191.9 405.3 191.9 392L191.9 280C191.9 274 194.2 268.2 198.2 263.8L286.2 167.8C290.7 162.8 297.2 160 303.9 160z"/>
                </svg>
            </div>
        </div>
        <a href="{{ route('system.dashboard') }}" class="menu-a-link">
            <div class="s-lm-wrapper">
                <div class="s-lm-s-elements">
                    <div class="s-lms-e-img">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
                            <path d="M341.8 72.6C329.5 61.2 310.5 61.2 298.3 72.6L74.3 280.6C64.7 289.6 61.5 303.5 66.3 315.7C71.1 327.9 82.8 336 96 336L112 336L112 512C112 547.3 140.7 576 176 576L464 576C499.3 576 528 547.3 528 512L528 336L544 336C557.2 336 569 327.9 573.8 315.7C578.6 303.5 575.4 289.5 565.8 280.6L341.8 72.6zM304 384L336 384C362.5 384 384 405.5 384 432L384 528L256 528L256 432C256 405.5 277.5 384 304 384z"/>
                        </svg>
                    </div>
                    <p>{{__('Dashboard')}}</p>
                    <div class="extra-elements">
                        <div class="ee-t ee-t-b"><p>{{__('Graph')}}</p></div>
                    </div>
                </div>
            </div>
        </a>

        <div class="subtitle">
            <h4>{{__('Korisničko sučelje')}}</h4>
            <div class="subtitle-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
                    <path d="M64 144C64 117.5 85.5 96 112 96L208 96C234.5 96 256 117.5 256 144L256 160L384 160L384 144C384 117.5 405.5 96 432 96L528 96C554.5 96 576 117.5 576 144L576 240C576 266.5 554.5 288 528 288L432 288C405.5 288 384 266.5 384 240L384 224L256 224L256 240C256 247.3 254.3 254.3 251.4 260.5L320 352L400 352C426.5 352 448 373.5 448 400L448 496C448 522.5 426.5 544 400 544L304 544C277.5 544 256 522.5 256 496L256 400C256 392.7 257.7 385.7 260.6 379.5L192 288L112 288C85.5 288 64 266.5 64 240L64 144z"/>
                </svg>
            </div>
        </div>

        <a href="#" class="menu-a-link">
            <div class="s-lm-wrapper">
                <div class="s-lm-s-elements">
                    <div class="s-lms-e-img">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
                            <path d="M256.1 312C322.4 312 376.1 258.3 376.1 192C376.1 125.7 322.4 72 256.1 72C189.8 72 136.1 125.7 136.1 192C136.1 258.3 189.8 312 256.1 312zM226.4 368C127.9 368 48.1 447.8 48.1 546.3C48.1 562.7 61.4 576 77.8 576L274.3 576L285.2 521.5C289.5 499.8 300.2 479.9 315.8 464.3L383.1 397C355.1 378.7 321.7 368.1 285.7 368.1L226.3 368.1zM332.3 530.9L320.4 590.5C320.2 591.4 320.1 592.4 320.1 593.4C320.1 601.4 326.6 608 334.7 608C335.7 608 336.6 607.9 337.6 607.7L397.2 595.8C409.6 593.3 421 587.2 429.9 578.3L548.8 459.4L468.8 379.4L349.9 498.3C341 507.2 334.9 518.6 332.4 531zM600.1 407.9C622.2 385.8 622.2 350 600.1 327.9C578 305.8 542.2 305.8 520.1 327.9L491.3 356.7L571.3 436.7L600.1 407.9z"/>
                        </svg>
                    </div>
                    <p>{{__('Moj profil')}}</p>
                    <div class="extra-elements">
                        <div class="ee-t ee-t-g"><p>{{__('Info')}}</p></div>
                    </div>
                </div>
            </div>
        </a>

        <a href="{{ route('system.users') }}" class="menu-a-link">
            <div class="s-lm-wrapper">
                <div class="s-lm-s-elements">
                    <div class="s-lms-e-img">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
                            <path d="M96 192C96 130.1 146.1 80 208 80C269.9 80 320 130.1 320 192C320 253.9 269.9 304 208 304C146.1 304 96 253.9 96 192zM32 528C32 430.8 110.8 352 208 352C305.2 352 384 430.8 384 528L384 534C384 557.2 365.2 576 342 576L74 576C50.8 576 32 557.2 32 534L32 528zM464 128C517 128 560 171 560 224C560 277 517 320 464 320C411 320 368 277 368 224C368 171 411 128 464 128zM464 368C543.5 368 608 432.5 608 512L608 534.4C608 557.4 589.4 576 566.4 576L421.6 576C428.2 563.5 432 549.2 432 534L432 528C432 476.5 414.6 429.1 385.5 391.3C408.1 376.6 435.1 368 464 368z"/>
                        </svg>
                    </div>
                    <p>{{__('Korisnici')}}</p>
                    <div class="extra-elements">
                        <div class="ee-t ee-t-b"><p>{{__('All')}}</p></div>
                    </div>
                </div>
            </div>
        </a>

        <a href="#" class="menu-a-link">
            <div class="s-lm-wrapper">
                <div class="s-lm-s-elements">
                    <div class="s-lms-e-img">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
                            <path d="M288 88C288 74.7 298.7 64 312 64C457.8 64 576 182.2 576 328C576 341.3 565.3 352 552 352C538.7 352 528 341.3 528 328C528 208.7 431.3 112 312 112C298.7 112 288 101.3 288 88zM144 160C170.5 160 192 181.5 192 208L192 432C192 458.5 213.5 480 240 480C266.5 480 288 458.5 288 432C288 405.5 266.5 384 240 384C231.2 384 224 376.8 224 368L224 304C224 295.2 231.2 288 240 288C319.5 288 384 352.5 384 432C384 511.5 319.5 576 240 576C160.5 576 96 511.5 96 432L96 208C96 181.5 117.5 160 144 160zM312 160C404.8 160 480 235.2 480 328C480 341.3 469.3 352 456 352C442.7 352 432 341.3 432 328C432 261.7 378.3 208 312 208C298.7 208 288 197.3 288 184C288 170.7 298.7 160 312 160z"/>
                        </svg>
                    </div>
                    <p>{{__('Blog')}}</p>
                    <div class="extra-elements">
                        <div class="ee-t ee-t-b"><p>{{__('Other')}}</p></div>
                    </div>
                </div>
            </div>
        </a>

        <div class="subtitle">
            <h4> {{__('Ostalo')}} </h4>
            <div class="subtitle-icon">
                <i class="fas fa-box"></i>
            </div>
        </div>

        <a href="#" class="menu-a-link">
            <div class="s-lm-wrapper">
                <div class="s-lm-s-elements">
                    <div class="s-lms-e-img">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
                            <path d="M415.9 274.5C428.1 271.2 440.9 277 446.4 288.3L465 325.9C475.3 327.3 485.4 330.1 494.9 334L529.9 310.7C540.4 303.7 554.3 305.1 563.2 314L582.4 333.2C591.3 342.1 592.7 356.1 585.7 366.5L562.4 401.4C564.3 406.1 566 411 567.4 416.1C568.8 421.2 569.7 426.2 570.4 431.3L608.1 449.9C619.4 455.5 625.2 468.3 621.9 480.4L614.9 506.6C611.6 518.7 600.3 526.9 587.7 526.1L545.7 523.4C539.4 531.5 532.1 539 523.8 545.4L526.5 587.3C527.3 599.9 519.1 611.3 507 614.5L480.8 621.5C468.6 624.8 455.9 619 450.3 607.7L431.7 570.1C421.4 568.7 411.3 565.9 401.8 562L366.8 585.3C356.3 592.3 342.4 590.9 333.5 582L314.3 562.8C305.4 553.9 304 540 311 529.5L334.3 494.5C332.4 489.8 330.7 484.9 329.3 479.8C327.9 474.7 327 469.6 326.3 464.6L288.6 446C277.3 440.4 271.6 427.6 274.8 415.5L281.8 389.3C285.1 377.2 296.4 369 309 369.8L350.9 372.5C357.2 364.4 364.5 356.9 372.8 350.5L370.1 308.7C369.3 296.1 377.5 284.7 389.6 281.5L415.8 274.5zM448.4 404C424.1 404 404.4 423.7 404.5 448.1C404.5 472.4 424.2 492 448.5 492C472.8 492 492.5 472.3 492.5 448C492.4 423.6 472.7 404 448.4 404zM224.9 18.5L251.1 25.5C263.2 28.8 271.4 40.2 270.6 52.7L267.9 94.5C276.2 100.9 283.5 108.3 289.8 116.5L331.8 113.8C344.3 113 355.7 121.2 359 133.3L366 159.5C369.2 171.6 363.5 184.4 352.2 190L314.5 208.6C313.8 213.7 312.8 218.8 311.5 223.8C310.2 228.8 308.4 233.8 306.5 238.5L329.8 273.5C336.8 284 335.4 297.9 326.5 306.8L307.3 326C298.4 334.9 284.5 336.3 274 329.3L239 306C229.5 309.9 219.4 312.7 209.1 314.1L190.5 351.7C184.9 363 172.1 368.7 160 365.5L133.8 358.5C121.6 355.2 113.5 343.8 114.3 331.3L117 289.4C108.7 283 101.4 275.6 95.1 267.4L53.1 270.1C40.6 270.9 29.2 262.7 25.9 250.6L18.9 224.4C15.7 212.3 21.4 199.5 32.7 193.9L70.4 175.3C71.1 170.2 72.1 165.2 73.4 160.1C74.8 155 76.4 150.1 78.4 145.4L55.1 110.5C48.1 100 49.5 86.1 58.4 77.2L77.6 58C86.5 49.1 100.4 47.7 110.9 54.7L145.9 78C155.4 74.1 165.5 71.3 175.8 69.9L194.4 32.3C200 21 212.7 15.3 224.9 18.5zM192.4 148C168.1 148 148.4 167.7 148.4 192C148.4 216.3 168.1 236 192.4 236C216.7 236 236.4 216.3 236.4 192C236.4 167.7 216.7 148 192.4 148z"/>
                        </svg>
                    </div>
                    <p>{{__('Postavke')}}</p>
                    <div class="extra-elements">
                        <div class="ee-t ee-t-b"><p>{{__('Other')}}</p></div>
                    </div>
                </div>
            </div>
        </a>
    </div>

{{--    @include('system.template.menu.menu-includes.bottom-icons')--}}
</div>


{{--<!-- Upload an image for user account -->--}}
{{--@include('system.template.menu.menu-includes.profile-image')--}}
