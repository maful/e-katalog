<?php

namespace App\Http\Controllers;

use App\Product;
use App\Supplier;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\StoreProduct;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = Supplier::orderBy('nama', 'asc')->get();

        return view('products.create', compact('suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProduct $request)
    {
        $input = $request->except(['gambar']);

        $file = $request->file('gambar');
        $filePath = 'products/' . $file->hashName();
        Storage::disk('public')->put($filePath, file_get_contents($file));
        $input['gambar'] = $file->hashName();

        Product::create($input);

        return redirect('products')->with('success', 'Data Produk berhasil disimpan.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $suppliers = Supplier::orderBy('nama', 'asc')->get();

        return view('products.edit', compact('product', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $input = $request->except(['gambar']);
        if ($request->hasFile('gambar')) {
            if ($product->gambar) {
                Storage::disk('public')->delete('products/' . $product->gambar);
            }

            $file = $request->file('gambar');
            $filePath = 'products/' . $file->hashName();
            Storage::disk('public')->put($filePath, file_get_contents($file));
            $input['gambar'] = $file->hashName();
        }

        $product->fill($input);
        $product->save();

        return redirect('products')->with('success', 'Data Produk berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->gambar != "") {
            Storage::disk('public')->delete('products/' . $product->gambar);
        }
        $product->delete();

        return redirect('products')->with('success', 'Data Produk berhasil dihapus.');
    }

    public function jsonProducts()
    {
        $products = Product::orderBy('id', 'desc')->get();
        return DataTables::of($products)
            ->addIndexColumn()
            ->addColumn('action', function($product) {
                return view('products.datatables.action', compact('product'))->render();
            })
            ->addColumn('supplier', function($product) {
                return $product->supplier->nama;
            })
            ->editColumn('harga_jual', function($product) {
                return format_rupiah($product->harga_jual);
            })
            ->editColumn('status', function($product) {
                return badge_boolean($product->status);
            })
            ->rawColumns(['action', 'status'])
            ->toJson();
    }
}
