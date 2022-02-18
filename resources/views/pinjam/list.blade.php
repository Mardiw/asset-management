@extends('layouts.app')

@section('content')

<div class="layout-px-spacing">
    @if ($errors->any())
    <x-admin-alert-error />
    @elseif (session()->has('success'))
    <x-admin-alert-success message="{{ session()->get('success') }}" />
    @elseif (session()->has('info'))
    <x-admin-alert-info message="{{ session()->get('info') }}" />
    @elseif (session()->has('warning'))
    <x-admin-alert-info message="{{ session()->get('warning') }}" />
    @endif
    <div class="layout-top-spacing layout-spacing">
        <div class="text-center">
            <a href="{{route('asset.create')}}" class="btn btn-primary mb-2 mr-2 float-right">
                Tambah Asset
            </a>
        </div>
    </div>
    <div class="row layout-top-spacing">

        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-6">
                <h4>Data Peminjaman</h4>
                <div class="table-responsive mb-4 mt-4">
                    <table id="pinjam-table" class="table table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Peminjam</th>
                                <th>Nama Asset</th>
                                <th>Dari Tanggal</th>
                                <th>Sampai Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pinjam_list as $pinjam)
                            <tr>
                                <td>{{$pinjam->id}}</td>
                                <td>{{$pinjam->nama_peminjam}}</td>
                                <td>{{$pinjam->asset->nama_asset}}</td>
                                <td>{{date_format(new DateTime($pinjam->tanggal_pinjam_from), 'd M Y')}}</td>
                                <td>{{date_format(new DateTime($pinjam->tanggal_pinjam_to), 'd M Y')}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nama Peminjam</th>
                                <th>Nama Asset</th>
                                <th>Dari Tanggal</th>
                                <th>Sampai Tanggal</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('additional_css')
    {{-- Table Datatable Basic --}}
    <link rel="stylesheet" type="text/css" href="{{asset('cork1/plugins/table/datatable/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('cork1/plugins/table/datatable/dt-global_style.css')}}">
@endsection

@section('additional_js')
    <script src="{{asset('cork1/plugins/table/datatable/datatables.js')}}"></script>
    <script>
        $('#pinjam-table').DataTable({
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
                "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [10, 20, 50],
            "pageLength": 10
        });
    </script>
@endsection
