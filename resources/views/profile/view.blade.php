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
                            <form method="POST" action="{{ route('profile.edit') }}">
                                @csrf

                                <div class="form-group row">
                                    @if ($user->profile_pic_file)
                                    <img src="{{ asset($user->profile_pic_file) }}" width="100px"
                                        height="100px">
                                    @endif
                                </div>

                                <div class="form-group row">
                                    <label>Name: {{ $user->name }}</label>
                                </div>

                                <div class="form-group row">
                                    <label>E-mail: {{ $user->email }}</label>
                                </div>
                            </form>
                        </div>
                        <div class="col">
                            <div class="row">
                                <img src="{{ asset('img/menta-consull-3.png') }}" alt="">
                            </div>
                            <div class="row">
                                <a class="btn btn-link" href="/login">
                                    {{ __('Sudah punya akun?') }}
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
