<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Pinjam;
use Illuminate\Http\Request;

class PinjamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pinjamList = Pinjam::all();
        $data = [
            'page_name' => 'Pinjam',
            'category_name' => 'pinjam',
            'pinjam_list' => $pinjamList,
        ];
        return view('pinjam.list')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $asset = Asset::findOrFail($id);
            $this->validate($request, [
                'from_date' => 'required',
                'to_date' => 'required',
                'nama_peminjam' => 'required',
            ]);
            $newPinjam = new Pinjam();
            $newPinjam->asset_id = $request->idAsset;
            $newPinjam->tanggal_pinjam_from = $request->from_date;
            $newPinjam->tanggal_pinjam_to = $request->to_date;
            $newPinjam->nama_peminjam = $request->nama_peminjam;
            $asset->status = "Dipinjam";
            try {
                $asset->save();
                $newPinjam->save();
                return redirect()->route('asset.index')->with('success', "Peminjaman Berhasil Diupdate");

            } catch (\Throwable $th) {
                return redirect()->route('asset.index')->withErrors($th->getMessage());
            }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $asset->status = "Ready";
        try {
            $asset->save();
            return redirect()->route('asset.index')->with('success', "Peminjaman Berhasil Diupdate");

        } catch (\Throwable $th) {
            return redirect()->route('asset.index')->withErrors($th->getMessage());
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
        //
    }
}
