<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// The model refers to the DB Table
class Doc_Imgs extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'TITULO_IMG',
        'RUTA_IMG'
    ];

    public $timestamps = false;
}
