<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Laravolt\Indonesia\Facade as Indonesia;
use App\Http\Requests\StoreSupplier;
use App\Http\Requests\UpdateSupplier;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('suppliers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = Indonesia::allCities();

        return view('suppliers.create', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSupplier $request)
    {
        Supplier::create($request->all());

        return redirect('suppliers')->with('success', 'Data Supplier berhasil disimpan.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        $cities = Indonesia::allCities();

        return view('suppliers.edit', compact('supplier', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSupplier $request, $id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->fill($request->all());
        $supplier->save();

        return redirect('suppliers')->with('success', 'Data Supplier berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();

        return redirect('suppliers')->with('success', 'Data Supplier berhasil dihapus.');
    }

    public function jsonSuppliers()
    {
        $suppliers = Supplier::orderBy('id', 'desc')->get();
        return DataTables::of($suppliers)
            ->addIndexColumn()
            ->addColumn('action', function($supplier) {
                return view('suppliers.datatables.action', compact('supplier'))->render();
            })
            ->addColumn('kota', function($supplier) {
                return Indonesia::findCity($supplier->city_id)->name;
            })
            ->addColumn('umur', function($supplier) {
                return $this->getAge($supplier->tahun_lahir) . ' tahun';
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    private function getAge($year)
    {
        $now = \Carbon\Carbon::now();
        $b_day = \Carbon\Carbon::createFromDate($year);
        $age = $b_day->diffInYears($now);

        return $age;
    }
}
