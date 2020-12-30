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
                            <div class="title-text">{{ __('MEETING SELESAI') }}</div>
                            <form method="POST" action="{{ route('therapist.call.end', ['transaction' => $transaction->id]) }}">
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
                                    <label for="harga">Harga</label>
                                    <div class="col-md">
                                        <input id="harga" type="text" class="form-control" onkeyup="hargaUpdate()"
                                            autofocus>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <small for="cut">Menta 10%</small>
                                    <div class="col-md">
                                        <input id="cut" type="text" class="form-control form-control-sm" disabled>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div for="fee">Total</div>
                                    <div class="col-md">
                                        <input id="fee" type="text" class="form-control disabled" name="fee" readonly>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md offset-md-4">
                                        <button type="submit" class="btn btn-primary disabled">
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
