<div class="infobox-1">
    <div class="info-icon">
        <img width="150px" src="{{ url('storage/'.$produk->image) }}" alt="{{$produk->image}}" />
    </div>
    <h5 class="info-heading">{{$produkName}}</h5>
    <p class="info-text">Harga: Rp. {{ number_format($produkHarga, 0, '.', ',') }}</p>
    <p class="info-text">Stock: {{$produkStock}}</p>
    <button type="button" href="#{{$produk}}" class="btn btn-primary mb-2 mr-2" data-toggle="modal" data-target="#produk{{$produkId}}">
        Masukkan keranjang
      </button>
</div>

<div class="modal fade" id="produk{{$produkId}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h4 class="modal-heading mb-4 mt-2">{{$produkName}}</h4>
                <img width="150px" src="{{ url('storage/'.$produk->image) }}" alt="{{$produk->image}}" />
                <p class="modal-text">Harga: Rp. {{ number_format($produkHarga, 0, '.', ',') }}</p>
                <p class="modal-text">Stock: {{$produkStock}}</p>
                <form action="{{route('keranjang.store')}}" id="form-create{{$produkId}}" method="post">
                    @csrf
                    <input type="hidden" name="stock" value="{{$produkStock}}">
                    <input type="hidden" name="idProduk" value="{{$produkId}}">
                    <input id="qtyProduk" type="numeric" name="qty" placeholder="Quantity" class="form-control @error('qty') is-invalid @enderror" >
                    @error('qty')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                <button type="submit" onclick="confirmSubmit('{{$produkId}}')" id="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
