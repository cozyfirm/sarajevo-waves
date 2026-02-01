@extends('system.layout.layout')
@section('title') {{ Helper::getPageTitle(__('Korisnici')) }} @endsection
@section('c-icon')
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
        <path d="M96 192C96 130.1 146.1 80 208 80C269.9 80 320 130.1 320 192C320 253.9 269.9 304 208 304C146.1 304 96 253.9 96 192zM32 528C32 430.8 110.8 352 208 352C305.2 352 384 430.8 384 528L384 534C384 557.2 365.2 576 342 576L74 576C50.8 576 32 557.2 32 534L32 528zM464 128C517 128 560 171 560 224C560 277 517 320 464 320C411 320 368 277 368 224C368 171 411 128 464 128zM464 368C543.5 368 608 432.5 608 512L608 534.4C608 557.4 589.4 576 566.4 576L421.6 576C428.2 563.5 432 549.2 432 534L432 528C432 476.5 414.6 429.1 385.5 391.3C408.1 376.6 435.1 368 464 368z"/>
    </svg>
@endsection
@section('c-title') {{ __('Korisnici') }} @endsection
@section('c-breadcrumbs')
    <a href="{{ route('system.dashboard') }}"> <p>{{ __('Dashboard') }}</p> </a> /
    <a href="{{ route('system.users') }}">{{ __('Pregled svih korisnika') }}</a> /
    @if(!isset($user))
        <a href="#">{{ __('Unos korisnika') }}</a>
    @else
        <a href="{{ route('system.users.preview', ['username' => $user->username ]) }}">{{ $user->name }}</a>
    @endif
@endsection

@section('c-buttons')
    <a href="{{ route('system.users') }}">
        <button class="pm-btn btn pm-btn-info">
            <img src="{{ asset('files/images/icons/chevron-left-w.svg') }}" alt="{{ __('Left') }}">
            <span>{{ __('Nazad') }}</span>
        </button>
    </a>

    @if(isset($edit))
        <a href="{{ route('system.users.edit', ['username' => $user->username ]) }}">
            <button class="pm-btn btn pm-btn-trash">
                <img src="{{ asset('files/images/icons/trash-w.svg') }}" alt="{{ __('Left') }}">
            </button>
        </a>
    @endif
@endsection

@section('content')
    <div class="content-wrapper content-wrapper-p-15">
        @if(session()->has('success'))
            <div class="alert alert-success mt-3">
                {{ session()->get('success') }}
            </div>
        @elseif(session()->has('error'))
            <div class="alert alert-danger mt-3">
                {{ session()->get('error') }}
            </div>
        @endif

        <div class="row">
            <div class="@if(isset($preview)) col-md-9 @else col-md-12 @endif">
                <form action="@if(isset($edit)) {{ route('system.users.update') }} @else {{ route('system.users.save') }} @endif" method="POST" id="js-form">
                    @if(isset($edit))
                        {{ html()->hidden('id')->class('form-control')->value($user->id) }}
                    @endif

                    {{--                    <div class="row">--}}
                    {{--                        <div class="col-md-12">--}}
                    {{--                            <div class="form-group">--}}
                    {{--                                {{ html()->label(__('Ime i prezime'))->for('supplier_id')->class('bold') }}--}}
                    {{--                                {{ html()->select('supplier_id', [], isset($invoice) ? $user->supplier_id : '')->class('form-control form-control-sm')->required()->disabled(isset($preview)) }}--}}
                    {{--                                <small id="supplier_idHelp" class="form-text text-muted">{{ __('Odaberite dobavljača robe') }}</small>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ html()->label(__('Ime i prezime'))->for('name')->class('bold') }}
                                {{ html()->text('name', $user->name ?? '' )->class('form-control form-control-sm')->required()->value((isset($user) ? $user->name : ''))->isReadonly(isset($preview)) }}
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ html()->label(__('Email'))->for('email')->class('bold') }}
                                {{ html()->text('email')->class('form-control form-control-sm')->required()->maxlength(150)->value((isset($user) ? $user->email : ''))->isReadonly(isset($preview)) }}
                                <small id="emailHelp" class="form-text text-muted">{{ __('Unesite email') }}</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ html()->label(__('Uloga'))->for('role')->class('bold') }}
                                {{ html()->select('role', ['user' => 'Korisnik', 'moderator' => 'Moderator', 'admin' => 'Admin' ], isset($user) ? $user->role : '')->class('form-control single-select2 form-control-sm')->required()->disabled(isset($preview)) }}
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ html()->label(__('Telefon'))->for('phone')->class('bold') }}
                                {{ html()->text('phone')->class('form-control form-control-sm mt-1')->required()->maxlength(13)->value((isset($user) ? $user->phone : ''))->isReadonly(isset($preview))->placeholder('+387') }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ html()->label(__('Datum rođenja'))->for('birth_date')->class('bold') }}
                                {{ html()->text('birth_date')->class('form-control form-control-sm date-input mt-1')->required()->maxlength(10)->value((isset($user) ? $user->birthDate() : ''))->isReadonly(isset($preview)) }}
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ html()->label(__('Adresa'))->for('address')->class('bold') }}
                                {{ html()->text('address')->class('form-control form-control-sm mt-1')->required()->maxlength(100)->value((isset($user) ? $user->address : ''))->isReadonly(isset($preview)) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ html()->label(__('Grad'))->for('city')->class('bold') }}
                                {{ html()->text('city')->class('form-control form-control-sm mt-1')->required()->maxlength(50)->value((isset($user) ? $user->city : ''))->isReadonly(isset($preview)) }}
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ html()->label(__('Država'))->for('country')->class('bold') }}
                                {{ html()->select('country', $countries, isset($user) ? $user->country : '21')->class('form-control single-select2 form-control-sm mt-1')->required()->disabled(isset($preview)) }}
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ html()->label(__('Kratki opis'))->for('about')->class('bold') }}
                                {{ html()->textarea('about')->class('form-control form-control-sm mt-1')->required()->value((isset($user) ? $user->about : ''))->isReadonly(isset($preview))->style('height:120px;') }}
                            </div>
                        </div>
                    </div>

                    @if(!isset($preview))
                        <div class="row mt-4">
                            <div class="col-md-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-dark btn-sm"> {{ __('SAČUVAJTE') }} </button>
                            </div>
                        </div>
                    @endif
                </form>
            </div>


            @if(isset($preview))
                <div class="col-md-3 border-left">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card p-0 m-0" title="#">
                                <div class="card-body d-flex justify-content-between">
                                    <h5 class="p-0 m-0"> {{ __('Ostale informacije') }} </h5>
                                    <i class="fas fa-info mt-1 mr-1"></i>
                                </div>
                            </div>


                            <form action="{{ route('system.admin.users.update-profile-image') }}" method="POST" id="update-profile-image" enctype="multipart/form-data">
                                @csrf
                                {{ html()->hidden('id')->class('form-control')->value($user->id) }}
                                <div class="card p-0 m-0 mt-3" title="{{ __('Nova fotografija za program') }}">
                                    <div class="card-body d-flex justify-content-between">
                                        <label for="photo_uri" >
                                            <p class="m-0">{{ __('Ažurirajte fotografiju') }}</p>
                                        </label>
                                        <i class="fas fa-image mt-1"></i>
                                    </div>
                                    <input name="photo_uri" class="form-control form-control-lg d-none" id="photo_uri" type="file">
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

            @endif
        </div>
    </div>
@endsection
