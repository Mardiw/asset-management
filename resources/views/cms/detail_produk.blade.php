@extends('layouts.app')

@section('content')
<div class="layout-px-spacing">
    <div class="row layout-top-spacing layout-spacing">
        <div class="col-xl-12 col-lg-12 col-sm-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <h3>Detail Produk</h3>
                </div>
                    <div class="widget-content widget-content-area br-6">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name">Nama Produk</label>
                                <p>{{$produk->nama_produk}}</p>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="hp">Image</label>
                                <br>
                                <img width="150px" src="{{ url('storage/'.$produk->image) }}" alt="{{$produk->image}}" />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="birthplace">Harga</label>
                                <p>{{$produk->harga}}</p>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="birthdate">Stock</label>
                                <p>{{$produk->stock}}</p>
                            </div>
                        </div>
                        <div class="layout-top-spacing">
                            <a href="{{route('produk.index')}}" class="btn"><i class="flaticon-cancel-12"></i> Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

