@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div style="height: 150px"></div> <!-- padding from header -->
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Therapist') }}</div>

                <div class="card-body">
                    <h5 class="card-title">Therapist</h5>
                    <p class="card-text">Therapist dashboard</p>
                    <a href="{{ route('therapist.home') }}" class="btn btn-primary">Home</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
