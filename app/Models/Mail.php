<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user_from',
        'id_user_to',
        'subject',
        'message',
    ];

//    protected $casts = [
//        'sent' => 'datetime',
//    ];
//if you want to change the type of the returned value

    protected $attributes = ['is_read' => false];
    protected $hidden = [
        'id',
    ];

    public $timestamps = false;
}
