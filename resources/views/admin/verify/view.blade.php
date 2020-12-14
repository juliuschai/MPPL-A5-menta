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
                            <div class="title-text">{{ __('DOKUMEN') }}</div>
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <div class="form-group row">
                                <div class="col-md">
                                    <label>Name:</label>
                                    {{ $therapist->user->name }}
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md">
                                    <label>Email:</label>
                                    {{ $therapist->user->email }}
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md">
                                    <label>No. Telp:</label>
                                    {{ $therapist->user->phone_num }}
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md">
                                    <label>Bidang:</label>
                                    {{ $therapist->expertise }}
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md">
                                    <label>Dokumen:</label>
                                    <a href="{{ asset($therapist->document_file) }}">
                                        <button type="button">Lihat</button>
                                    </a>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md offset-md-4">
                                    <form method="POST" action="{{ route('admin.verify.therapist.accept',
                                            ['therapist' => $therapist->id]) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Verifikasi') }}
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.verify.therapist.deny',
                                            ['therapist' => $therapist->id]) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">
                                            {{ __('Delete File') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
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
