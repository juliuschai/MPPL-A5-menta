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
                            <form method="POST" enctype="multipart/form-data"
                                action="{{ route('transaction.view', ['transaction' => $transaction->id]) }}">
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
                                    <label>Bukti transaksi terupload:</label>
                                    <div class="col-md">
                                        <a href="{{ asset($transaction->payment_file_path) }}">
                                            <button type="button">Lihat</button>
                                        </a>
                                    </div>
                                </div>
                                @endif

                                <div class="form-group row">
                                    <label for="document">Bukti pembayaran</label>
                                    <div class="col-md">
                                        <input style="border: none; margin-left: -12px;" id="document" type="file"
                                            name="document" class="form-control">
                                    </div>
                                </div>

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

@section('scripts')
<script>
    function hargaUpdate() {
        let harga = parseInt(document.getElementById('harga').value);
        document.getElementById('cut').value = harga*0.1;
        document.getElementById('fee').value = harga*1.1;
    }
</script>
@endsection
