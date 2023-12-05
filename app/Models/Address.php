<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'street',
        'city',
        'government',
        'zip_code',
    ];


    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class);
    }
}
