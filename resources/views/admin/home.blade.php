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
                        <a href="{{ route('admin.user.list') }}" class="btn btn-primary">Daftar User</a>
                        <a href="{{ route('admin.report.list') }}" class="btn btn-primary">Daftar Report</a>
                        <a href="{{ route('admin.article.list') }}" class="btn btn-primary">Daftar Artikel</a>
                        <a href="{{ route('admin.transaction.list') }}" class="btn btn-primary">Daftar Transaksi</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
