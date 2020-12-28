<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
class Productin extends Model
{
    //
    protected $table="productin";

    protected $guarded=[];
    // public function productsout(){
    //     return $this->belongsTo(Product::class);
    // }

    public function product(){
        return $this->belongsTo('App\Product');
    }
}

