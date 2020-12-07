@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div style="height: 150px"></div> <!-- padding from header -->
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Admin') }}</div>

                <div class="card-body">
                    <h5 class="card-title">Admin</h5>
                    <p class="card-text">Admin dashboard</p>
                    <a href="{{ route('admin.home') }}" class="btn btn-primary">Home</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
