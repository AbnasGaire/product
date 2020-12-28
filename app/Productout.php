<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productout extends Model
{
    //
    protected $table="productout";

    protected $guarded=[];

    public function product(){
        return $this->belongsTo('App\Product');
    }

}
