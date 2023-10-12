<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thana extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function district()
    {
        return $this->belongsTo(District::class);
    }


    public function villages()
    {
        return $this->hasMany(Village::class);
    }
}
