<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// The model refers to the DB Table
class TemporalSaves extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'TIPO_DOCTO',
        'TITULO_DOCTO',
        'CUERPO_DOCTO',
        'PUBLICAR',
        'CVE_NIVEL',
        'CVE_CALENDARIO',
        'CAMPUS',
    ];

    public $timestamps = false;
}
