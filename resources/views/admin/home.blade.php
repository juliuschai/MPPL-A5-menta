@extends('layouts.app')

@section('content')
<div class="py-4 dark-blue">
    <div style="height: 150px"></div> <!-- padding from header -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Admin') }}</div>

                    <div class="card-body">
                        <h5 class="card-title">Admin</h5>
                        <p class="card-text">Admin dashboard</p>
                        <a href="{{ route('admin.verify.therapist') }}" class="btn btn-primary">Verifikasi Terapis</a>
                        <a href="{{ route('admin.patient') }}" class="btn btn-primary">Daftar Pasien</a>
                        <a href="{{ route('admin.therapist') }}" class="btn btn-primary">Daftar Terapis</a>
                        <a href="{{ route('admin.article') }}" class="btn btn-primary">Verifikasi Pasien</a>
                        <a href="{{ route('admin.transaction.list') }}" class="btn btn-primary">Daftar Transaksi</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
