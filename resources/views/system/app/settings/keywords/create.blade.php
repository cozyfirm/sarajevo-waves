@extends('system.layout.layout')
@section('title') {{ Helper::getPageTitle($keyword) }} @endsection
@section('c-icon')
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
        <path d="M256 160L256 224L384 224L384 160C384 124.7 355.3 96 320 96C284.7 96 256 124.7 256 160zM192 224L192 160C192 89.3 249.3 32 320 32C390.7 32 448 89.3 448 160L448 224C483.3 224 512 252.7 512 288L512 512C512 547.3 483.3 576 448 576L192 576C156.7 576 128 547.3 128 512L128 288C128 252.7 156.7 224 192 224z"/>
    </svg>
@endsection
@section('c-title') {{ $keyword }} @endsection
@section('c-breadcrumbs')
    <a href="#"> <p>{{ __('Dashboard') }}</p> </a> /
    <a href="#">..</a> /
    <a href="{{ route('system.settings.keywords.new-instance', ['key' => $key]) }}">{{ __('Šifarnici') }}</a> /
    <a href="#">{{ __('Unos - Pregled') }}</a>
@endsection
@section('c-buttons')
    @if(isset($edit))
        <a href="{{ route('system.settings.keywords.delete-instance', ['id' => $instance->id ]) }}">
            <button class="pm-btn btn pm-btn-trash">
                <img src="{{ asset('files/images/icons/trash-w.svg') }}" alt="{{ __('Left') }}">
            </button>
        </a>
    @endif
    <a href="{{ route('system.settings.keywords.preview-instances', ['key' => $key]) }}">
        <button class="pm-btn btn pm-btn-info">
            <img src="{{ asset('files/images/icons/chevron-left-w.svg') }}" alt="{{ __('Left') }}">
            <span>{{ __('Nazad') }}</span>
        </button>
    </a>
@endsection

@section('content')
    <div class="content-wrapper content-wrapper-p-15">
        <form action="@if(isset($edit)) {{ route('system.settings.keywords.update-instance') }} @else {{ route('system.settings.keywords.save-instance') }} @endif" method="POST">
            @csrf
            @if(isset($edit))
                {{ html()->hidden('id')->class('form-control')->value($instance->id) }}
            @endif
            {{ html()->hidden('type')->class('form-control')->value($key) }}
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        {{ html()->label(__('Vrijednost'))->for('name')->class('bold') }}
                        {{ html()->text('name')->class('form-control form-control-sm mt-2')->required()->maxlength(100)->value((isset($instance) ? $instance->name : '')) }}
                        <small id="nameHelp" class="form-text text-muted">{{ __('Prikazana vrijednost šifarnika') }}</small>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        {{ html()->label(__('Opis'))->for('description')->class('bold') }}
                        {{ html()->textarea('description')->class('form-control form-control-sm mt-2')->maxlength(100)->value((isset($instance) ? $instance->description : ''))->style('height:120px') }}
                        <small id="descriptionHelp" class="form-text text-muted">{{ __('Eventualni kratki opis šifarnika') }}</small>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-dark btn-sm"> {{ __('SAČUVAJTE') }} </button>
                </div>
            </div>
        </form>
    </div>
@endsection
