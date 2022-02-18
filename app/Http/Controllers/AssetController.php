<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assetList = Asset::all();
        $data = [
            'page_name' => 'Asset',
            'category_name' => 'asset',
            'asset_list' => $assetList,
        ];
        return view('cms.list')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'page_name' => 'Asset',
            'category_name' => 'asset',
        ];
        return view('cms.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|unique:assets,nama_asset',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:5120',
            'category' => 'not_in:-',
            'stock' => 'required|numeric'
		]);

        $newAsset = new Asset();
        $newAsset->nama_asset = $request->nama;
        $newAsset->category = $request->category;
        $newAsset->stock = $request->stock;
        $newAsset->status = 'Ready';

        $image = $request->file('image');
        $directory ='image/asset/';
        $imageName = uniqid().'_'.$image->getClientOriginalName();
        Storage::disk('public')->put($directory.$imageName, file_get_contents($image));
        $newAsset->image = $directory.$imageName;

        $qrcode = QrCode::size(400)->generate('Nama Asset: '.$request->nama.' Category: '.$request->category);
        $qrcode = base64_encode($qrcode);
        $output_file = 'image/qrcode/img-' . time() . '.png';
        Storage::disk('public')->put($output_file, $qrcode);
        $newAsset->qr_code = $output_file;


        try {
            $newAsset->save();
            return redirect()->route('asset.index')->with('success', "Asset Berhasil Dibuat");

        } catch (\Throwable $th) {
            return redirect()->route('asset.create')->withErrors($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $asset = Asset::findOrFail($id);
        $data = [
            'page_name' => 'Asset',
            'category_name' => 'asset',
            'asset' => $asset
        ];
        return view('cms.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $asset = Asset::findOrFail($id);
        $this->validate($request, [
            'nama' => 'required|unique:assets,nama_asset,'.$asset->id,
            'category' => 'not_in:-',
            'stock' => 'required|numeric'
		]);

        $asset->nama_asset = $request->nama;
        $asset->category = $request->category;
        $asset->stock = $request->stock;

        $image = $request->file('image');
        if($image){
            Storage::disk('public')->delete($asset->image);
            $directory ='image/asset/';
            $imageName = uniqid().'_'.$image->getClientOriginalName();
            Storage::disk('public')->put($directory.$imageName, file_get_contents($image));
            $asset->image = $directory.$imageName;
        }

        try {
            $asset->save();
            return redirect()->route('asset.index')->with('success', "Asset Berhasil Diupdate");

        } catch (\Throwable $th) {
            return redirect()->route('asset.update')->withErrors($th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $asset = Asset::findOrFail($id);
        Storage::disk('public')->delete($asset->image);
        try {
        $asset->delete();
        return redirect()->route('asset.index')->with('success', "Produk berhasil dihapus");
        } catch (\Throwable $th) {
            return redirect()->route('asset.index')->withErrors($th->getMessage());
        }
    }

    public function pinjam($id){
        $asset = Asset::findOrFail($id);
        $asset->status = "Ready";
        try {
            $asset->save();
            return redirect()->route('asset.index')->with('success', "Asset Berhasil Diupdate");

        } catch (\Throwable $th) {
            return redirect()->route('asset.index')->withErrors($th->getMessage());
        }
    }

    public function generate ($id)
    {
        $data = Asset::findOrFail($id);
        $qrcode = QrCode::size(400)->generate('Nama Asset: '.$data->nama_asset.' Category: '.$data->category);
        return view('cms.qrcode',compact('qrcode'));
    }
}
