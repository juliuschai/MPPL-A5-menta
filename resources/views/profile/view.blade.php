@extends('layouts.app')

@section('content')
<main class="py-4 dark-blue">
    <div style="height: 150px"></div> <!-- padding from header -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="col rounded-rectangle white">
                    <div class="row">
                        <div class="col">
                            <div class="title-text">{{ __('PROFILE') }}</div>

                            {{-- Show message after user successfully reports someone --}}
                            @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                            @endif

                            <form method="POST" action="{{ route('profile.edit') }}">
                                @csrf

                                <div class="form-group row">
                                    @if ($user->profile_pic_file)
                                    <img src="{{ asset($user->profile_pic_file) }}" width="100px" height="100px">
                                    @endif
                                </div>

                                <div class="form-group row">
                                    <label>Name: {{ $user->name }}</label>
                                </div>

                                <div class="form-group row">
                                    <label>E-mail: {{ $user->email }}</label>
                                </div>

                                @if (auth()->user()->isAdmin())
                                <div class="form-group row">
                                    <label>No. Telp: {{ $user->phone_num }}</label>
                                </div>
                                @endif
                            </form>
                        </div>
                        <div class="col">
                            <div class="row">
                                <img src="{{ asset('img/menta-consull-3.png') }}" alt="">
                            </div>
                            <div class="row">
                                <a class="btn btn-link" href="{{ route('user.report', [$user->id]) }}">
                                    {{ __('Laporkan User') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
