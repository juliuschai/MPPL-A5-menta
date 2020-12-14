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
                            <form method="POST">
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

                                <div class="form-group row">
                                    <label>Bidang: {{ $user->therapist->expertise }}</label>
                                </div>

                                @if (!$user->therapist->vacation)
                                <div class="form-group row">
                                    <label for="openingHours">Jam Buka: {{ isset($user->therapist->opening_hours) ? $user->therapist->opening_hours->format('H:i') : '-' }}</label>
                                </div>

                                <div class="form-group row">
                                    <label for="closingHours">Jam Tutup: {{ isset($user->therapist->closing_hours) ? $user->therapist->closing_hours->format('H:i') : '-' }}</label>
                                </div>
                                @else
                                {{-- Libur --}}
                                <div class="form-group row">
                                    <div>
                                        Praktik tutup
                                    </div>
                                </div>
                                @endif
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
