@extends('system.layout.layout')
@section('title') {{ Helper::getPageTitle(__('Šifarnici')) }} @endsection
@section('c-icon')
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
        <path d="M256 160L256 224L384 224L384 160C384 124.7 355.3 96 320 96C284.7 96 256 124.7 256 160zM192 224L192 160C192 89.3 249.3 32 320 32C390.7 32 448 89.3 448 160L448 224C483.3 224 512 252.7 512 288L512 512C512 547.3 483.3 576 448 576L192 576C156.7 576 128 547.3 128 512L128 288C128 252.7 156.7 224 192 224z"/>
    </svg>
@endsection
@section('c-title') {{ __('Pregled svih šifarnika') }} @endsection
@section('c-breadcrumbs')
    <a href="#"> <p>{{ __('Dashboard') }}</p> </a> /
    <a href="{{ route('system.settings.keywords') }}">{{ __('Šifarnici') }}</a> /
    <a href="#">{{ __('Pregled instanci') }}</a>
@endsection
@section('c-buttons')
    <a href="{{ route('system.settings') }}">
        <button class="pm-btn btn btn-dark"> <img src="{{ asset('files/images/icons/star-white.svg') }}" alt="{{ __('Star') }}"> </button>
    </a>
    <a href="{{ route('system.settings.keywords.new-instance', ['key' => $key]) }}">
        <button class="pm-btn btn pm-btn-success">
            <img src="{{ asset('files/images/icons/plus-w.svg') }}" alt="{{ __('Star') }}">
            <span>{{ __('Unos') }}</span>
        </button>
    </a>
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

        @include('system.layout.snippets.filters.filter-header', ['var' => $instances])
        <table class="table table-bordered" id="filtering">
            <thead>
            <tr>
                <th scope="col" style="text-align:center;">#</th>
                @include('system.layout.snippets.filters.filters_header')
                <th width="120p" class="akcije text-center">{{__('Akcije')}}</th>
            </tr>
            </thead>
            <tbody>
            @php $i=1; @endphp
            @foreach($instances as $instance)
                <tr>
                    <td class="text-center">{{ $i++}}</td>
                    <td> {{ $instance->name ?? ''}} </td>
                    <td> {{ $instance->description ?? ''}} </td>
                    <td class="text-center" width="180px"> {{ $instance->value ?? ''}} </td>

                    <td class="text-center">
                        <a href="{{ route('system.settings.keywords.edit-instance', ['id' => $instance->id ]) }}" title="{{ __('Više informacija') }}">
                            <button class="btn btn-dark btn-xs">{{ __('Pregled') }}</button>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @include('system.layout.snippets.filters.pagination', ['var' => $instances])
    </div>
@endsection
