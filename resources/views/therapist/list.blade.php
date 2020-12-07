@extends('layouts.app')

@section('content')

<div class="right_col booking" role="main">
    <div class="col-md-12 col-sm-12" role="main">
        <div class="col-md-12 col-sm-12">
            <h2 class="table-title">Daftar User</h2>

            @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
            @endif

            <!-- Action button templates -->
            <div id="viewBtnTemplate" style="display: none;">
                <a href="{{route('admin.user.view', ['user' => 0])}}">
                    <button id="viewBtn" style="padding: 3px 8px" type="button" class="btn btn-warning" title="Edit">
                        Lihat
                    </button>
                </a>
            </div>


            <table id="tableElm" class="table table-bordered table-striped table-bordered table-hover"
                data-ajaxurl="{{route('admin.users.data')}}">
                <thead class="thead-custom-blue">
                    <tr>
                        <th class="text-center" scope="col">Id</th>
                        <th class="text-center" scope="col">Nama</th>
                        <th class="text-center" scope="col">Email</th>
                        <th class="text-center" scope="col">No. Telp</th>
                        <th class="text-center" scope="col">Verified</th>
                        <th class="text-center" scope="col">Role</th>
                        <th class="text-center" scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
@endsection


@section('scripts')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.css" defer />
<script src="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.js" defer></script>
<script src="{{asset('js/util/datatablesPlugin.js')}}" defer></script>
<script src="{{asset('js/user/list.js')}}?2" defer></script>
@endsection
