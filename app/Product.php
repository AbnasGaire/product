<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Productin;
use App\Productout;

class Product extends Model
{   
    protected $guarded=[];
    
    public function productsin(){
        return $this->hasMany('App\Productin');
    }

    public function productsout(){
        return $this->hasMany('App\Productout');
    }
}