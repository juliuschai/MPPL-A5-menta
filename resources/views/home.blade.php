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
                        <h5 class="card-title">Dashboard</h5>
                        <p class="card-text">Dashboard</p>
                        <a href="{{ route('therapist.list') }}" class="btn btn-primary">Terapis tersedia</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
