<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Input;

class WelcomeController extends Controller
{
    public function index()
    {
        $query = Product::query();
        $query->when(Input::get('supplier') != '', function ($q) {
            return $q->where('supplier_id', Input::get('supplier'));
        });
        $query->when(Input::get('search') != '', function ($q) {
            return $q->where('nama', 'like', '%'.Input::get('search').'%')
                        ->orWhere('harga_jual', 'like', '%'.Input::get('search').'%');
        });
        $products = $query->where('status', true)->paginate(8);

        $filter = array();
        if (Input::get('search') != '') {
            $filter['search'] = Input::get('search');
        }

        return view('welcome', compact('products', 'filter'));
    }
}
