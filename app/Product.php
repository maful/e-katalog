<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    protected $table = 'produk';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['supplier_id', 'nama', 'harga_jual', 'status', 'gambar'];

    /**
     * Get the product's image url.
     *
     * @return string
     */
    public function getImageUrlAttribute()
    {
        if ($this->gambar) {
            return Storage::disk('public')->url('products/' . $this->gambar);
        } else {
            return asset('images/noimagefound.jpg');
        }
    }

    public function supplier()
    {
        return $this->belongsTo('App\Supplier');
    }
}
