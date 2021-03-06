@extends('layouts.app')

@section('content')

<div style="height: 150px"></div> <!-- padding from header -->
<div class="container">
    <div class="col rounded-rectangle white">
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
                        <a href="{{route('user.view', ['user' => 0])}}">
                            <button id="viewBtn" style="padding: 3px 8px" type="button" class="btn btn-warning"
                                title="Edit">
                                Lihat
                            </button>
                        </a>
                    </div>


                    <table id="tableElm" class="table table-bordered table-striped table-bordered table-hover"
                        data-ajaxurl="{{route('admin.user.data')}}">
                        <thead class="thead-custom-blue">
                            <tr>
                                <th class="text-center" scope="col">Id</th>
                                <th class="text-center" scope="col">Nama</th>
                                <th class="text-center" scope="col">Email</th>
                                <th class="text-center" scope="col">No. Telp</th>
                                <th class="text-center" scope="col">Role</th>
                                <th class="text-center" scope="col">Blocked</th>
                                <th class="text-center" scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.css" defer />
<script id="datatablesScript" src="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.js" defer></script>
<script src="{{asset('js/util/datatablesPlugin.js')}}" defer></script>
<script defer>
    let script = document.querySelector('#datatablesScript');

    script.addEventListener('load', function() {
        runonload();
    });

    function runonload(){
        var tableElm = $('#tableElm');

        var viewBtn = $('#viewBtnTemplate');

        tableElm.DataTable({
            processing: true,
            serverSide: true,
            ajax: tableElm.data('ajaxurl'),
            columns: [
                {
                    title: 'Id',
                    data: 'id',
                    name: 'id',
                    searchable: false,
                    visible: false,
                },
                {
                    title: 'Name',
                    data: 'name',
                    name: 'name',
                    searchable: true,
                    visible: true,
                },
                {
                    title: 'Email',
                    data: 'email',
                    name: 'email',
                    searchable: true,
                    visible: true,
                },
                {
                    title: 'No. Telp',
                    data: 'phone_num',
                    name: 'phone_num',
                    searchable: true,
                    visible: true,
                },
                {
                    title: 'Role',
                    data: 'role',
                    name: 'role',
                    searchable: true,
                    visible: true,
                },
                {
                    title: 'Blocked',
                    data: 'blocked_at',
                    name: 'blocked_at',
                    searchable: true,
                    visible: true,
                    render: function (data, type, full, meta) {
                        if (data) {
                            return new Date(data + ' UTC').toDateString();
                        } else {
                            return 'Tidak';
                        }
                    }
                },
                {
                    title: 'Aksi',
                    data: null,
                    name: null,
                    searchable: false,
                    visible: true,
                    render: function (data, type, full, meta) {
                        return viewBtn.createButton(full.id).html();
                    }
                },
            ],
        });
    }
</script>
@endsection
