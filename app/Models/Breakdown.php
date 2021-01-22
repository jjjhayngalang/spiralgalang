<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Breakdown extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'name', 'random_id'
    ];

    public function random(){
        return $this->belongsTo('App\Models\Random');
    }
}