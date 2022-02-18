<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Produk extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $produk;
    public $produkId;
    public $produkName;
    public $produkImage;
    public $produkHarga;
    public $produkStock;
    public function __construct($produk)
    {
        $this->produk = $produk;
        $this->produkId = $produk->id;
        $this->produkName =$produk->nama_produk;
        $this->produkImage = $produk->image;
        $this->produkHarga = $produk->harga;
        $this->produkStock = $produk->stock;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.produk');
    }
}
