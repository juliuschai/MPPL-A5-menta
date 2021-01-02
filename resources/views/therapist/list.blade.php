@extends('layouts.app')

@section('content')

<div style="height: 150px"></div> <!-- padding from header -->
<div class="container">
    <div class="col rounded-rectangle white">
        <div class="right_col booking" role="main">
            <div class="col-md-12 col-sm-12" role="main">
                <div class="col-md-12 col-sm-12">
                    <h2 class="table-title">Daftar Terapis tersedia</h2>
                    <therapist-list search-url="{{ route('therapist.list.data') }}">
                    </therapist-list>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
