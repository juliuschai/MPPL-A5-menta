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
                    name: 'therapists.id',
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
                    title: 'Verified',
                    data: 'verified_at',
                    name: 'verified_at',
                    searchable: true,
                    visible: true,
                    render: function (data, type, full, meta) {
                        if (data) {
                            return 'Ya';
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
