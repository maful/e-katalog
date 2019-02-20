<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'supplier';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['city_id', 'nama', 'email', 'tahun_lahir'];

    public function products()
    {
        return $this->hasMany('App\Produk');
    }
}
