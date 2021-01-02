@extends('layouts.app')

@section('content')
<main class="py-4 dark-blue">
    <div style="height: 150px"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="col rounded-rectangle white">
                    <div class="row">
                        <div class="col">
                            <div class="title-text">{{ __('LIHAT') }}</div>
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <form method="POST"
                                action="{{ route('admin.transaction.accept', ['transaction' => $transaction->id]) }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="start_at">Waktu Mulai</label>
                                    <div class="col-md">
                                        <input id="start_at" type="text" class="form-control"
                                            value="{{ $transaction->start_at }}" disabled>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="end_at">Waktu Akhir</label>
                                    <div class="col-md">
                                        <input id="end_at" type="text" class="form-control"
                                            value="{{ $transaction->end_at }}" disabled>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="total">Total</label>
                                    <div class="col-md">
                                        <input id="total" type="text" class="form-control"
                                            value="{{ $transaction->total }}" disabled>
                                    </div>
                                </div>

                                @if ($transaction->isPaid())
                                <div class="form-group row">
                                    <label>Bukti transaksi:</label>
                                    <div class="col-md">
                                        <a href="{{ asset($transaction->payment_file_path) }}">
                                            <button type="button">Lihat</button>
                                        </a>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md">
                                        <button type="button" class="btn btn-danger"
                                            onclick="denyConfirm()">Hapus</button>
                                        <a id="denyLink"
                                            href="{{ route('admin.transaction.deny', ['transaction' => $transaction->id]) }}">
                                        </a>
                                    </div>
                                </div>
                                @else
                                <div class="form-group row">
                                    <label>Bukti transaksi:</label>
                                    <div class="col-md">
                                        <label>Belum diupload</label>
                                    </div>
                                </div>
                                @endif

                                <div class="form-group row">
                                    <label for="terverifikasi">Terverifikasi</label>
                                    <div class="col-md">
                                        <input id="terverifikasi" type="text" class="form-control"
                                            value="{{ $transaction->verified_at??'Belum terverifikasi' }}" disabled>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Verify') }}
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
    function denyConfirm() {
        if (confirm('Apakah anda yakin menghapus pembayaran?')) {
            window.location = document.getElementById('denyLink').getAttribute('href');
        }
    }
</script>
@endsection
