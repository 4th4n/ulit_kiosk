<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    // I-specify ang mga attributes na pwedeng i-mass assign
    protected $fillable = [
        'name',
        'price',
        'description',
        'image',
        'quantity', // Idagdag ang quantity dito
    ];
}

