@extends('system.layout.layout')
@section('title') {{ Helper::getPageTitle(__('Korisnici')) }} @endsection
@section('c-icon')
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
        <path d="M96 192C96 130.1 146.1 80 208 80C269.9 80 320 130.1 320 192C320 253.9 269.9 304 208 304C146.1 304 96 253.9 96 192zM32 528C32 430.8 110.8 352 208 352C305.2 352 384 430.8 384 528L384 534C384 557.2 365.2 576 342 576L74 576C50.8 576 32 557.2 32 534L32 528zM464 128C517 128 560 171 560 224C560 277 517 320 464 320C411 320 368 277 368 224C368 171 411 128 464 128zM464 368C543.5 368 608 432.5 608 512L608 534.4C608 557.4 589.4 576 566.4 576L421.6 576C428.2 563.5 432 549.2 432 534L432 528C432 476.5 414.6 429.1 385.5 391.3C408.1 376.6 435.1 368 464 368z"/>
    </svg>
@endsection
@section('c-title') {{ __('Korisnici') }} @endsection
@section('c-breadcrumbs')
    <a href="{{ route('system.dashboard') }}"> <p>{{ __('Dashboard') }}</p> </a> / <a href="{{ route('system.users') }}">{{ __('Pregled svih korisnika') }}</a>
@endsection
@section('c-buttons')
    <a href="{{ route('system.dashboard') }}">
        <button class="pm-btn btn btn-dark"> <img src="{{ asset('files/images/icons/star-white.svg') }}" alt="{{ __('Star') }}"> </button>
    </a>
    <a href="{{ route('system.users.create') }}">
        <button class="pm-btn btn pm-btn-success">
            <img src="{{ asset('files/images/icons/plus-w.svg') }}" alt="{{ __('Star') }}">
            <span>{{ __('Unos novog') }}</span>
        </button>
    </a>
@endsection

@section('content')
    <div class="content-wrapper content-wrapper-p-15">
        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif

        @include('system.layout.snippets.filters.filter-header', ['var' => $users])
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
            @foreach($users as $user)
                <tr>
                    <td class="text-center">{{ $i++}}</td>
                    <td> {{ $user->name ?? ''}} </td>
                    <td> {{ $user->email ?? ''}} </td>
                    <td> {{ ucfirst($user->role ?? '')  }} </td>
                    <td> {{ $user->phone ?? ''}} </td>
                    <td> {{ $user->birthDate() ?? ''}} </td>
                    <td> {{ $user->address ?? ''}} </td>
                    <td> {{ $user->city ?? ''}} </td>
                    <td> {{ $user->countryRel->name_ba ?? ''}} </td>

                    <td class="text-center">
                        <a href="{{route('system.users.preview', ['username' => $user->username] )}}" title="Pregled korisnika">
                            <button class="btn btn-dark btn-xs">{{ __('Pregled') }}</button>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @include('system.layout.snippets.filters.pagination', ['var' => $users])
    </div>
@endsection
