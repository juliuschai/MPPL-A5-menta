@extends('layouts.app')

@section('content')
<main class="py-4 yellow">
    <div style="height: 150px"></div> <!-- padding from header -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="col rounded-rectangle white">
                    <div class="row justify-content-center">
                        <chat-room :conversation="{{ $conversation }}" :current-user="{{ auth()->user() }}"
                            :in-debt={{ auth()->user()->isInDebt() ? 'true' : 'false' }}></chat-room>
                        {{-- <custom-channel> </custom-channel> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
