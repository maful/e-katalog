@extends('layouts.app')

@section('content-app')
<div class="row row-cards row-deck">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Supplier</h3>
                <div class="card-options">
                    <a href="javascript:void(0)" id="reload-table" class="btn btn-sm btn-pill btn-secondary mr-2"><i class="fe fe-refresh-cw mr-2"></i>Refresh</a>
                    <a href="{{ route('suppliers.create') }}" class="btn btn-sm btn-pill btn-primary">Tambah Supplier</a>
                </div>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-icon alert-success alert-dismissible" role="alert">
                        <i class="fe fe-check mr-2" aria-hidden="true"></i>
                        <button type="button" class="close" data-dismiss="alert"></button>
                        {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap" id="datatable">
                        <thead>
                            <tr>
                                <th class="w-1">No.</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Kota</th>
                                <th>Umur</th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
require(['datatables', 'jquery'], function(datatable, $) {
    var oTable = $('#datatable').DataTable({
        lengthChange: false,
        serverSide: true,
        ajax: '{{ url('suppliers/get-json') }}',
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'nama', name: 'nama' },
            { data: 'email', name: 'email' },
            { data: 'kota', name: 'kota' },
            { data: 'umur', name: 'umur' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
        language: {
            "url": 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Indonesian.json'
        },
        columnDefs: [
            {
                targets: [0],
                className: "text-center"
            },
            {
                targets: [5],
                className: "text-right"
            }
        ]
    });

    $("#reload-table").click(function() {
        oTable.ajax.reload(null, false);
    });
});
</script>
@endsection