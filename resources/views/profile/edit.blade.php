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
                            <form method="POST" accept="{{ route('profile.edit') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group row">
                                    <label for="profilePic">Profile Picture</label>
                                    @if ($user->profile_pic_file)
                                    <img src="{{ asset($user->profile_pic_file) }}" width="100px"
                                        height="100px">
                                    @endif
                                    <div class="col-md">
                                        <input style="border: none; margin-left: -12px;" id="profilePic" type="file"
                                            name="profilePic" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="name">Name</label>
                                    <div class="col-md">
                                        <input id="name" type="text" class="form-control" name="name"
                                            autocomplete="name" autofocus value="{{ $user->name }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email">E-mail</label>
                                    <div class="col-md">
                                        <input id="email" type="email" class="form-control" name="email"
                                            pattern="[^ @]*@[^ @]*" autocomplete="email"
                                            placeholder="{{ $user->email }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md">
                                        <a href="{{ route('phone.change') }}">Ubah nomor telepon</a> <br>
                                        <sub>Perhatian! Anda harus verifikasi ulang!</sub>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Simpan') }}
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
