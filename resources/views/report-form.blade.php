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
                            <div class="title-text">{{ __('LAPOR') }}</div>

                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            <form id="reportForm" method="POST"
                                action="{{ route('user.report', ['user' => $user->id]) }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="name">Name</label>
                                    <div class="col-md">
                                        <input id="name" type="text" class="form-control" name="name"
                                            value="{{ $user->name }}" disabled>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email">E-mail</label>
                                    <div class="col-md">
                                        <input id="email" type="email" class="form-control" name="email"
                                            value="{{ $user->email }}" disabled>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="reason">Alasan</label>
                                    <textarea id="reason" type="text" class="form-control" name="reason" autofocus>
                                    </textarea>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md offset-md-4">
                                        <button type="button" class="btn btn-danger" onclick="reportBtnClicked()">
                                            {{ __('Laporkan') }}
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

@section('scripts')
<script>
    function reportBtnClicked() {
        if (confirm('Apakah Anda yakin ingin melaporakan user?')) {
            document.getElementById('reportForm').submit();
        }
    }
</script>
@endsection
