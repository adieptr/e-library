<?php

// app\Models\Tutor.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tutors extends Model
{
    protected $table = 'tutors';
    protected $primaryKey = 'id';
    public $incrementing = false; // karena 'id' sudah string
    public $timestamps = false; // tidak menggunakan kolom timestamps

    protected $fillable = [
        'id', 'name', 'profession', 'email', 'password', 'image', 'role'
    ];
}
