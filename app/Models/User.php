<?php
// app\Models\User.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    public $incrementing = false; // karena 'id' sudah string
    public $timestamps = false; // tidak menggunakan kolom timestamps

    protected $fillable = [
        'id', 'tutor_id', '	playlist_id', 'name', 'email', 'password', 'image'
    ];
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_user');
    }
}
