@extends('layouts.app')

@section('content')
<main class="py-4 yellow">
    <div style="height: 150px"></div> <!-- padding from header -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="col rounded-rectangle white">
                    <div class="row justify-content-center">
                        <div class="col">
                            <div class="title-text">{{ __('Mari Dimulai!') }}</div>

                            <div style="text-align: center">
                                Masukkan 6 digit kode yang telah <br>
                                kami kirim melalui SMS ke <br>
                                08********** <br>
                            </div>
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <form method="POST" action="{{ route('phone.verify') }}">
                                @csrf

                                <div class="form-group row">
                                    <div class="col-md">
                                        <input id="code" type="text"
                                            class="form-control @error('code') is-invalid @enderror" name="code"
                                            value="{{ old('code') }}" required autocomplete="code" autofocus
                                            placeholder="Kode Verifikasi">

                                        @error('code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Verifikasi') }}
                                        </button>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md offset-md-4">
                                        <a href="{{ route('phone.verify.create') }}">
                                            <button type="button" class="btn btn-secondary">
                                                {{ __('Kirim Ulang Kode') }}
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col">
                            <div class="row">
                                <img src="{{ asset('img/menta-consull-3.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
