<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// The model refers to the DB Table
class Images extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'IMAGE'
    ];

    public $timestamps = false;
}
