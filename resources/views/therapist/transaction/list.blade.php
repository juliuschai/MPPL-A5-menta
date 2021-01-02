@extends('layouts.app')

@section('content')

<div style="height: 150px"></div> <!-- padding from header -->
<div class="container">
    <div class="col rounded-rectangle white">
        <div class="right_col booking" role="main">
            <div class="col-md-12 col-sm-12" role="main">
                <div class="col-md-12 col-sm-12">
                    <h2 class="table-title">Transaksi</h2>

                    @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                    @endif

                    <!-- Action button templates -->
                    <div id="callEndBtnTemplate" style="display: none;">
                        <form id="endCallForm" action="{{ route('therapist.call.finish', ['transaction' => 0]) }}" method="POST">
                            @csrf
                            <input type="hidden" id="timeInput">
                            <button id="callEndBtn" style="padding: 3px 8px" type="button" class="btn btn-danger"
                                onclick="endCallBtnClicked(this)" title="callEnd">
                                Akhiri
                            </button>
                        </form>
                    </div>
                    <div id="viewBtnTemplate" style="display: none;">
                        <a href="{{route('therapist.transaction.view', ['transaction' => 0])}}">
                            <button id="viewBtn" style="padding: 3px 8px" type="button" class="btn btn-warning"
                                title="View">
                                Lihat
                            </button>
                        </a>
                    </div>


                    <table id="tableElm" class="table table-bordered table-striped table-bordered table-hover"
                        data-ajaxurl="{{route('therapist.transaction.data')}}">
                        <thead class="thead-custom-blue">
                            <tr>
                                <th class="text-center" scope="col">Id</th>
                                <th class="text-center" scope="col">Pasien</th>
                                <th class="text-center" scope="col">Waktu Mulai</th>
                                <th class="text-center" scope="col">Waktu Akhir</th>
                                <th class="text-center" scope="col">Harga</th>
                                <th class="text-center" scope="col">Terbayar</th>
                                <th class="text-center" scope="col">Terverifikasi</th>
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

    function endCallBtnClicked(elm) {
        let $form = $(elm).parent()
        $form.find('#timeInput').val(new Date());
        $form.submit();
    }

    script.addEventListener('load', function() {
        runonload();
    });

    function runonload(){
        var tableElm = $('#tableElm');

        var viewBtn = $('#viewBtnTemplate');
        var callEndBtn = $('#callEndBtnTemplate');

        var datatableRes = tableElm.DataTable({
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
                    title: 'Pasien',
                    data: 'name',
                    name: 'u.name',
                    searchable: true,
                    visible: true,
                },
                {
                    title: 'Waktu Mulai',
                    data: 'start_at',
                    name: 'start_at',
                    searchable: true,
                    visible: true,
                },
                {
                    title: 'Waktu Akhir',
                    data: 'end_at',
                    name: 'end_at',
                    searchable: true,
                    visible: true,
                },
                {
                    title: 'Harga',
                    data: 'fee',
                    name: 'fee',
                    searchable: true,
                    visible: true,
                },
                {
                    title: 'Terbayar',
                    data: 'payment_file_path',
                    name: 'payment_file_path',
                    searchable: true,
                    visible: true,
                    render: function (data, type, full, meta) {
                        if (data) {
                            if (data == 'free') {
                                return 'Gratis'
                            } else {
                                return 'Sudah dibayar'
                            }
                        } else {
                            return 'Belum Dibayar'
                        }
                    }
                },
                {
                    title: 'Terverifikasi',
                    data: 'verified_at',
                    name: 'verified_at',
                    searchable: true,
                    visible: true,
                    render: function (data, type, full, meta) {
                        if (data) {
                            return 'Sudah';
                        } else {
                            return 'Belum';
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
                        if (!full.end_at)
                        {
                            // call hasn't been ended yet
                            return callEndBtn.createButton(full.id).html();
                        } else {
                            return viewBtn.createButton(full.id).html();
                        }
                    }
                },
            ],
        });
        datatableRes.columns('start_at:name').order('desc').draw();
    }
</script>
@endsection
