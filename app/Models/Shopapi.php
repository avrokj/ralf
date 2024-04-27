<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shopapi extends Model
{
    use HasFactory;
    protected $guarded = []; // tühi jada, ehk siis saame kõike muuta
    protected $table = 'products';
    protected $fillable = ['title', 'description', 'price', 'quantity', 'image'];
}
