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
                            <div class="title-text">{{ __('GANTI NOMOR TELEPON') }}</div>

                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <form method="POST" action="{{ route('phone.change') }}">
                                @csrf

                                <div class="form-group row">
                                    <div class="col-md">
                                        <input id="phone" type="tel" class="form-control" name="phone"
                                            value="{{ old('phone') }}" required autocomplete="phone"
                                            pattern="\+?\d{0,13}" title="Harus berupa angka!"
                                            placeholder="Nomor Telepon">
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Ganti') }}
                                        </button>
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
