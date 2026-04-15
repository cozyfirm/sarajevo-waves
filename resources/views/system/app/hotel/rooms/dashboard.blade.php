@extends('system.layout.layout')
@section('c-icon')
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
        <path d="M144 336C144 288.7 109.8 249.4 64.8 241.5C72 177.6 126.2 128 192 128L448 128C513.8 128 568 177.6 575.2 241.5C530.2 249.5 496 288.7 496 336L496 368L144 368L144 336zM0 448L0 336C0 309.5 21.5 288 48 288C74.5 288 96 309.5 96 336L96 416L544 416L544 336C544 309.5 565.5 288 592 288C618.5 288 640 309.5 640 336L640 448C640 483.3 611.3 512 576 512L64 512C28.7 512 0 483.3 0 448z"/>
    </svg>
@endsection
@section('c-title') {{ __('Sobe') }} @endsection
@section('c-breadcrumbs')
    <a href="{{ route('system.dashboard') }}"> <p>{{ __('Pametno upravljanje hotelom') }}</p> </a>
@endsection
@section('c-buttons')
    <a href="{{ route('system.hotel.dashboard') }}">
        <button class="pm-btn btn btn-dark"><img src="{{ asset('files/images/icons/star-white.svg') }}" alt="{{ __('Star') }}"> </button>
    </a>
@endsection

@section('content')
    <div class="homepage">
        <div class="homepage-main">
            <div class="home-row borderless">
                <div class="home-row-header white">
                    <h4> {{__('PREGLED SOBA')}} </h4>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
                        <path d="M144 336C144 288.7 109.8 249.4 64.8 241.5C72 177.6 126.2 128 192 128L448 128C513.8 128 568 177.6 575.2 241.5C530.2 249.5 496 288.7 496 336L496 368L144 368L144 336zM0 448L0 336C0 309.5 21.5 288 48 288C74.5 288 96 309.5 96 336L96 416L544 416L544 336C544 309.5 565.5 288 592 288C618.5 288 640 309.5 640 336L640 448C640 483.3 611.3 512 576 512L64 512C28.7 512 0 483.3 0 448z"/>
                    </svg>
                </div>

                <div class="rooms-wrapper">
                    @foreach($rooms as $room)
                        <div class="single-room go-to" data-url="{{ route('system.hotel.rooms.preview', ['id' => $room->id ]) }}">
                            <!-- Room header -->
                            <div class="room-header">
                                <div class="rh-info">
                                    <button class="room-type">DELUXE</button>
                                    <p>{{ $room->number ?? '100' }}</p>
                                </div>
                                <div class="rh-icons">
                                    @if($room->rs_status == 1)
                                        <!-- Make up room -->
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" class="make-up-room">
                                            <path d="M598.6 118.6C611.1 106.1 611.1 85.8 598.6 73.3C586.1 60.8 565.8 60.8 553.3 73.3L361.3 265.3L326.6 230.6C322.4 226.4 316.6 224 310.6 224C298.1 224 288 234.1 288 246.6L288 275.7L396.3 384L425.4 384C437.9 384 448 373.9 448 361.4C448 355.4 445.6 349.6 441.4 345.4L406.7 310.7L598.7 118.7zM373.1 417.4L254.6 298.9C211.9 295.2 169.4 310.6 138.8 341.2L130.8 349.2C108.5 371.5 96 401.7 96 433.2C96 440 103.1 444.4 109.2 441.4L160.3 415.9C165.3 413.4 169.8 420 165.7 423.8L39.3 537.4C34.7 541.6 32 547.6 32 553.9C32 566.1 41.9 576 54.1 576L227.4 576C266.2 576 303.3 560.6 330.8 533.2C361.4 502.6 376.7 460.1 373.1 417.4z"/>
                                        </svg>
                                    @elseif($room->rs_status == 2)
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" class="do-not-disturb">
                                            <path d="M73 39.1C63.6 29.7 48.4 29.7 39.1 39.1C29.8 48.5 29.7 63.7 39 73.1L567 601.1C576.4 610.5 591.6 610.5 600.9 601.1C610.2 591.7 610.3 576.5 600.9 567.2L513.4 479.7C530.6 477.3 543.9 462.4 543.9 444.5C543.9 436.4 541.2 428.6 536.1 422.3L526.3 410.1C496.4 372.5 480 325.8 480 277.7L480 256C480 178.6 425 114 352 99.2L352 96C352 78.3 337.7 64 320 64C302.3 64 288 78.3 288 96L288 99.2C249.4 107 215.8 128.8 192.8 158.9L73 39.1zM160 277.6C160 325.7 143.6 372.4 113.6 410L103.8 422.2C98.8 428.5 96 436.3 96 444.4C96 464 111.9 479.9 131.5 479.9L366.8 479.9L159.9 273L159.9 277.5zM320 576C349.8 576 374.9 555.6 382 528L258 528C265.1 555.6 290.2 576 320 576z"/>
                                        </svg>
                                    @endif
                                </div>
                            </div>

                            <!-- Booking info -->
                            <div class="booking-info">
                                <div class="bi-user-info">
                                    <h5>John Doe</h5>
                                    <p>Tuzla</p>
                                </div>
                                <div class="bi-dates">
                                    <p>10. Apr 14:00</p>
                                    <p>do 12. Apr 10:00</p>
                                </div>
                            </div>

                            <!-- Room info -->
                            <div class="room-info">
                                <div class="ri-element total-users">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
                                        <path d="M320 312C386.3 312 440 258.3 440 192C440 125.7 386.3 72 320 72C253.7 72 200 125.7 200 192C200 258.3 253.7 312 320 312zM290.3 368C191.8 368 112 447.8 112 546.3C112 562.7 125.3 576 141.7 576L498.3 576C514.7 576 528 562.7 528 546.3C528 447.8 448.2 368 349.7 368L290.3 368z"/>
                                    </svg>
                                    <p>2</p>
                                </div>
                                <div class="ri-element total-nights">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
                                        <path d="M303.3 112.7C196.2 121.2 112 210.8 112 320C112 434.9 205.1 528 320 528C353.3 528 384.7 520.2 412.6 506.3C309.2 482.9 232 390.5 232 280C232 214.2 259.4 154.9 303.3 112.7zM64 320C64 178.6 178.6 64 320 64C339.4 64 358.4 66.2 376.7 70.3C386.6 72.5 394 80.8 395.2 90.8C396.4 100.8 391.2 110.6 382.1 115.2C321.5 145.4 280 207.9 280 280C280 381.6 362.4 464 464 464C469 464 473.9 463.8 478.8 463.4C488.9 462.6 498.4 468.2 502.6 477.5C506.8 486.8 504.6 497.6 497.3 504.6C451.3 548.8 388.8 576 320 576C178.6 576 64 461.4 64 320z"/>
                                    </svg>
                                    <p>5</p>
                                </div>
                                <div class="ri-element temperature">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
                                        <path d="M160 160C160 107 203 64 256 64C309 64 352 107 352 160L352 324.7C381.5 351.1 400 389.4 400 432C400 511.5 335.5 576 256 576C176.5 576 112 511.5 112 432C112 389.4 130.5 351 160 324.7L160 160zM256 496C291.3 496 320 467.3 320 432C320 405.1 303.5 382.1 280 372.7L280 160C280 146.7 269.3 136 256 136C242.7 136 232 146.7 232 160L232 372.7C208.5 382.2 192 405.2 192 432C192 467.3 220.7 496 256 496zM528 144C528 126.3 513.7 112 496 112C478.3 112 464 126.3 464 144C464 161.7 478.3 176 496 176C513.7 176 528 161.7 528 144zM416 144C416 99.8 451.8 64 496 64C540.2 64 576 99.8 576 144C576 188.2 540.2 224 496 224C451.8 224 416 188.2 416 144z"/>
                                    </svg>
                                    <p>24.5°C</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="homepage-side">
            <div class="reminders home-right-wrapper">
                <div class="home-right-header">
                    <p> {{__('Brzi linkovi')}} </p>
                </div>
                <div class="home-right-element">
                    <a href="{{ route('public.home') }}" target="_blank"> {{__('Kalendar')}} </a>
                </div>
                <div class="home-right-element" title="{{ __('Cozy Firm d.o.o') }}">
                    <a href="https://support.cozyfirm.com" target="_blank"> {{__('Rezerviši sobu')}} </a>
                </div>
            </div>


            <div class="reminders home-right-wrapper">
                <div class="home-right-header">
                    <p> {{__('Posljednje rezervacije')}} </p>
                </div>
                <div class="home-right-system-access">
                    <div class="sa__row_wrapper go-to" data-url="#" title="#">
                        <div class="icon__wrapper ps-12">
                            <p> 1 </p>
                        </div>
                        <div class="text__wrapper">
                            <div class="text__data">
                                <p>{{ __('John Doe - Room 103') }}</p>
                                <span> 01. Feb 2026 10:52h </span>
                            </div>
                            <div class="icons__data">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
                                    <path d="M384 128L448 128L448 544C448 561.7 462.3 576 480 576L512 576C529.7 576 544 561.7 544 544C544 526.3 529.7 512 512 512L512 128C512 92.7 483.3 64 448 64L352 64L352 64L192 64C156.7 64 128 92.7 128 128L128 512C110.3 512 96 526.3 96 544C96 561.7 110.3 576 128 576L352 576C369.7 576 384 561.7 384 544L384 128zM256 320C256 302.3 270.3 288 288 288C305.7 288 320 302.3 320 320C320 337.7 305.7 352 288 352C270.3 352 256 337.7 256 320z"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="sa__row_wrapper go-to" data-url="#" title="#">
                        <div class="icon__wrapper ps-12">
                            <p> 2 </p>
                        </div>
                        <div class="text__wrapper">
                            <div class="text__data">
                                <p>{{ __('Jolly Doe - Room 105') }}</p>
                                <span> 01. Feb 2026 10:52h </span>
                            </div>
                            <div class="icons__data">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
                                    <path d="M128 128C128 92.7 156.7 64 192 64L448 64C483.3 64 512 92.7 512 128L512 512C529.7 512 544 526.3 544 544C544 561.7 529.7 576 512 576L128 576C110.3 576 96 561.7 96 544C96 526.3 110.3 512 128 512L128 128zM416 352C433.7 352 448 337.7 448 320C448 302.3 433.7 288 416 288C398.3 288 384 302.3 384 320C384 337.7 398.3 352 416 352z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
