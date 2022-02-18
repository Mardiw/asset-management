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
                <h4>Data Asset</h4>
                <div class="table-responsive mb-4 mt-4">
                    <table id="asset-table" class="table table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Asset</th>
                                <th>Image</th>
                                <th>Kategori</th>
                                <th>Stock</th>
                                <th>QR Code</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($asset_list as $asset)
                            <form id="form-delete-{{$asset->id}}" action="{{ route('asset.destroy', ['asset' => $asset->id]) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                            <tr>
                                <td>{{$asset->id}}</td>
                                <td>{{$asset->nama_asset}}</td>
                                <td>
                                    <img width="150px" src="{{ asset('storage/'.$asset->image) }}" alt="{{$asset->image}}" />
                                </td>
                                <td>{{$asset->category}}</td>
                                <td>{{$asset->stock}}</td>
                                <td>
                                    {!! QrCode::size(75)->generate('Nama Asset: '.$asset->nama_asset.' Category: '.$asset->category); !!}
                                </td>
                                <td>
                                    @if ($asset->status == 'Ready')
                                    <span class="badge badge-primary"> {{$asset->status}} </span>
                                    @elseif($asset->status == 'Dipinjam')
                                    <span class="badge badge-secondary"> {{$asset->status}} </span>
                                    <p>Nama Peminjam: {{$asset->pinjam->nama_peminjam}}</p>
                                    <p>From: {{date_format(new DateTime($asset->pinjam->tanggal_pinjam_from), 'd M Y')}}</p>
                                    <p>To: {{date_format(new DateTime($asset->pinjam->tanggal_pinjam_to), 'd M Y')}}</p>
                                    @endif
                                </td>
                                <td>
                                    @if ($asset->status == 'Ready')
                                    <a href="{{route('asset.edit', ['asset' => $asset->id])}}"><i class="fa fa-pencil-square-o" aria-hidden="true" title="Edit" style="color: #0b1c52; font-size: 20px"></i></a>
                                    <a href=""><i class="fa fa-trash-o" id="{{$asset->id}}" aria-hidden="true" title="Delete" style="color: red; font-size: 20px"></i></a>
                                    <br>
                                    <button type="button" class="badge badge-primary" id="modal-toggle" data-item="{{$asset->id}}" data-toggle="modal" data-target="#pinjamModal">
                                        Pinjam
                                    </button>
                                    @elseif($asset->status == 'Dipinjam')
                                    <form action="{{ route('pinjam.update', ['pinjam' => $asset->id]) }}" id="form-create" method="post">
                                        @csrf
                                        @method('patch')
                                    <button type="submit" class="badge badge-primary">
                                        Selesai
                                    </button>
                                    <form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nama Asset</th>
                                <th>Image</th>
                                <th>Kategori</th>
                                <th>Stock</th>
                                <th>QR Code</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="modal fade" id="pinjamModal" tabindex="-1" role="dialog" aria-labelledby="pinjamModal" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="pinjamModal">Data pinjam</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                </button>
                            </div>
                            <form id="form-pinjam" method="post">
                                @csrf
                                <div class="modal-body">
                                    <input type="hidden" id="idAsset" name="idAsset" >
                                    <h5>Tanggal Peminjaman</h5>
                                        <div class="form-group col-md-10">
                                            <label for="inputDate">From</label>
                                            <input id="from-date" class="form-control flatpickr flatpickr-input active" type="text" name="from_date" required>
                                        </div>
                                        <div class="form-group col-md-10">
                                            <label for="inputDate">To</label>
                                            <input id="to-date" class="form-control flatpickr flatpickr-input active" type="text" name="to_date" required>
                                        </div>
                                        <h5>Nama Peminjam</h5>
                                        <div class="form-group col-md-10">
                                            <input id="event-name" type="text" name="nama_peminjam" class="form-control " required>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
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
    <link href="{{asset('cork1/plugins/flatpickr/flatpickr.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('cork1/plugins/flatpickr/custom-flatpickr.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('additional_js')
    <script src="{{asset('cork1/plugins/flatpickr/flatpickr.js')}}"></script>
    <script src="{{asset('cork1/plugins/table/datatable/datatables.js')}}"></script>
    <script>
        function confirmDelete(id)
        {
            var x = confirm("Apakah produk ini mau dihapus?");
            if (x)
                $('#form-delete-'+id).submit();
            else
                return false;
        }
    </script>
    <script>
        var f2 = flatpickr(document.getElementById('from-date'), {
            enableTime: false,
            dateFormat: "Y-m-d",
            minDate: "today",
        });

        var f1 = flatpickr(document.getElementById('to-date'), {
            enableTime: false,
            dateFormat: "Y-m-d",
            minDate: "today",
        });

        $(document).on("click", "#modal-toggle", function () {
            var itemid= $(this).attr('data-item');
            var url = '{{ route("store.pinjam", ":id") }}';
            url = url.replace(':id', itemid);
            $("#idAsset").val(itemid);
            $("#form-pinjam").attr("action",url);
        });
    </script>
    <script>
        $('#asset-table').DataTable({
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

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $( document ).ready(function() {
            $(document).on('click', '.fa-trash-o', function(){
                var id = $(this).attr("id");
                var url = '{{ route("asset.destroy", ":id") }}';
                url = url.replace(':id', id);
                console.log(url);
                if(confirm("Apakah produk ini mau dihapus?"))
                {
                    $.ajax({
                        url:url,
                        method:"DELETE",
                        success:function(res)
                        {
                            console.log("Deleted");
                        }
                    });
                }else{
                    return false;
                }
            });
        });
    </script>
@endsection
