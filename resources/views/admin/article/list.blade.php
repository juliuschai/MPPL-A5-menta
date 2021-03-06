@extends('layouts.app')

@section('content')

<div style="height: 150px"></div> <!-- padding from header -->
<div class="container">
    <div class="col rounded-rectangle white">
        <div class="right_col booking" role="main">
            <div class="col-md-12 col-sm-12" role="main">
                <div class="col-md-12 col-sm-12">
                    <h2 class="table-title">Daftar Laporan</h2>

                    @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                    @endif

                    <!-- Action button templates -->
                    <div id="viewBtnTemplate" style="display: none;">
                        <a href="{{route('admin.article.form', ['article' => 0])}}">
                            <button id="viewBtn" style="padding: 3px 8px" type="button" class="btn btn-warning"
                                title="Edit">
                                Edit
                            </button>
                        </a>
                    </div>

                    <a href="{{ route('admin.article.create') }}">
                        <button class="btn btn-success">Buat Artikel</button>
                    </a>

                    <table id="tableElm" class="table table-bordered table-striped table-bordered table-hover"
                        data-ajaxurl="{{route('admin.article.data')}}">
                        <thead class="thead-custom-blue">
                            <tr>
                                <th class="text-center" scope="col">Id</th>
                                <th class="text-center" scope="col">Judul</th>
                                <th class="text-center" scope="col">Deskripsi</th>
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
                    title: 'Judul',
                    data: 'title',
                    name: 'title',
                    searchable: true,
                    visible: true,
                },
                {
                    title: 'Deskripsi',
                    data: 'short_description',
                    name: 'short_description',
                    searchable: true,
                    visible: true,
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
