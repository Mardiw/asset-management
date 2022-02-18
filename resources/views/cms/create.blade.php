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
    <div class="row layout-top-spacing layout-spacing">
        <div class="col-xl-12 col-lg-12 col-sm-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <h3>Tambah Asset</h3>
                </div>
                <form action="{{route('asset.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="widget-content widget-content-area br-6">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="input_nama_asset">Nama Asset</label>
                                <input id="nama-asset" type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" >
                                @error('nama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPAudio">Kategori</label>
                                <select class="form-control @error('category') is-invalid @enderror" name="category" id="category">
                                    <option value="-">Pilih</option>
                                    <option value="Laptop">Laptop</option>
                                    <option value="Desktop">Desktop</option>
                                </select>
                                @error('category')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputName">Image</label>
                                <br>
                                <input id="image-asset" type="file" name="image" class="@error('image') is-invalid @enderror" >
                                @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputStock">Stock</label>
                                <input id="stock" type="text" name="stock" class="form-control @error('stock') is-invalid @enderror">
                                @error('stock')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="layout-top-spacing">
                            <a href="{{route('asset.index')}}" class="btn"><i class="flaticon-cancel-12"></i> Cancel</a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('additional_css')
    <link href="{{asset('cork1/plugins/flatpickr/flatpickr.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('cork1/assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    <link  href="{{asset('cork1/assets/css/forms/theme-checkbox-radio.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('cork1/plugins/flatpickr/custom-flatpickr.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('additional_js')
    <script src="{{asset('cork1/plugins/input-mask/jquery.inputmask.bundle.min.js')}}"></script>
    <script src="{{asset('cork1/plugins/flatpickr/flatpickr.js')}}"></script>
@endsection
