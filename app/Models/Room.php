<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $table = 'rooms';

    protected $fillable = [
        'user_id',
        'rname',
        'rkey',
        'description',
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
