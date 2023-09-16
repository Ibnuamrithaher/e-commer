<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index(Request $request){
        $produks = Produk::all();
        return view('produk.index',compact('produks'));
    }

    public function store(Request $request){

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric'],
            'patch_image' => ['required','image','mimes:jpg,jpeg,png'],
        ]);
        $image = $request->file('patch_image');
        $patch_image = Storage::disk('public')->put('upload', $image);
        $produk = Produk::create([
            'name' => $request->name,
            'price' => $request->price,
            'patch_image' => $patch_image,
            'status' => 'active',
        ]);

        return redirect()->back()->withSuccess('Berhasil membuat produk !');
    }

    public function update(Request $request,$id){
        $produk = Produk::findOrFail($id);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric'],
            'patch_image' => ['image','mimes:jpg,jpeg,png'],
            'status' => ['required'],
        ]);

        if ($request->file('patch_image')) {
            $image = $request->file('patch_image');
            $patch_image = Storage::disk('local')->put('upload', $image);
        }else{
            $patch_image = $produk->patch_image;
        }

        $produk->update([
            'name' => $request->name,
            'price' => $request->price,
            'patch_image' => $patch_image,
            'status' => $request->status,
        ]);

        return redirect()->back()->withSuccess('Berhasil membuat produk !');
    }

    public function destroy($id){
        $produk = Produk::findOrFail($id);
        $produk->delete();
        return redirect()->back()->withSuccess('Berhasil menghapus produk !');
    }
}
