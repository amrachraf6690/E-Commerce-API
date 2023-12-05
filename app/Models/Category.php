<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $dates =['created_at','updated_at'];


    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
