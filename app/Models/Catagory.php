<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Spatie\Translatable\HasTranslations;

class Catagory extends Model
{
    use HasFactory;
    // use HasTranslations;
  
    // public $translatable = ['name'];
    protected $fillable = [
        'user_id',
        'name',
        'type',
    ];
}
