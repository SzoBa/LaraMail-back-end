<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
    use HasFactory;

    //protected $table = 'tablename'; you can define another name for the table, if differs

    protected $fillable = [
        'id_user_from',
        'id_user_to',
        'subject',
        'message',
        'is_read',
        'sent',
    ];

//    protected $casts = [
//        'sent' => 'datetime',
//    ];
//if you want to change the type of the returned value

    protected $attributes = ['is_read' => false];

//    protected $hidden = [
//        'id',
//    ];
//If you need to hide an attribute

    public $timestamps = false;
    //if you need to override built-in times

    public function user() {
        return $this->belongsTo(User::class, 'id_user_from', 'id');
    }
}
