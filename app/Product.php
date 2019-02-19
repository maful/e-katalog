<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'produk';

    public function supplier()
    {
        return $this->belongsTo('App\Supplier');
    }
}
