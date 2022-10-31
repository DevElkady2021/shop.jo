<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'trade_name',
        'phone',
        'img',
        'address',
    ];


    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
