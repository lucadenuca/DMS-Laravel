<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokument extends Model
{
    use HasFactory;

    protected $fillable = [
        'naziv',
        'putanja',
        'opis',
        'kategorija',
        'korisnik_id'
    ];

    protected $table = 'dokuments';
}
