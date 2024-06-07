<?php
// app\Models\User.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dtluser extends Model
{
    protected $table = 'dtl_user';
    protected $primaryKey = 'playlist_id';
    // protected $primaryKey = 'id';
    // public $incrementing = false; // karena 'id' sudah string
    // public $timestamps = false; // tidak menggunakan kolom timestamps

    protected $fillable = [
        'id_user', 'tutor_id', 'playlist_id','status'
    ];
}
