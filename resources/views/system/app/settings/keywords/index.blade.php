@extends('system.layout.layout')
@section('title') {{ Helper::getPageTitle(__('Šifarnici')) }} @endsection
@section('c-icon')
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
        <path d="M256 160L256 224L384 224L384 160C384 124.7 355.3 96 320 96C284.7 96 256 124.7 256 160zM192 224L192 160C192 89.3 249.3 32 320 32C390.7 32 448 89.3 448 160L448 224C483.3 224 512 252.7 512 288L512 512C512 547.3 483.3 576 448 576L192 576C156.7 576 128 547.3 128 512L128 288C128 252.7 156.7 224 192 224z"/>
    </svg>
@endsection
@section('c-title') {{ __('Pregled svih šifarnika') }} @endsection
@section('c-breadcrumbs')
    <a href="#"> <p>{{ __('Dashboard') }}</p> </a> / <a href="{{ route('system.settings.keywords') }}">{{ __('Pregled svih šifarnika') }}</a>
@endsection
@section('c-buttons')
    <a href="{{ route('system.settings') }}">
        <button class="pm-btn btn btn-dark"> <img src="{{ asset('files/images/icons/star-white.svg') }}" alt="{{ __('Star') }}"> </button>
    </a>
@endsection

@section('content')
    <div class="content-wrapper content-wrapper-bs">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th width="80px" class="text-center">{{ __('#') }}</th>
                <th>{{ __('Vrsta šifarnika') }}</th>
                <th width="120px" class="akcije text-center">{{__('Akcije')}}</th>
            </tr>
            </thead>
            <tbody>
            @php $i=1; @endphp
            @foreach($keywords as $key => $val)
                <tr>
                    <td class="text-center">{{ $i++}}</td>
                    <td> {{ $val ?? ''}} </td>

                    <td class="text-center">
                        <a href="{{ route('system.settings.keywords.preview-instances', ['key' => $key]) }}" title="{{ __('Više informacija') }}">
                            <button class="btn btn-dark btn-xs">{{ __('Više info') }}</button>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
