<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'produk';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['supplier_id', 'nama', 'harga_jual', 'status', 'gambar'];

    public function supplier()
    {
        return $this->belongsTo('App\Supplier');
    }
}
