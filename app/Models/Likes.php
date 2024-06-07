<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    protected $table = 'likes';
    protected $primaryKey = null; // Tidak ada primary key tunggal
    public $incrementing = false; // Tidak ada kolom auto-increment
    public $timestamps = false; // Tidak menggunakan kolom timestamps

    protected $fillable = [
        'user_id', 'tutor_id', 'content_id'
    ];

    // Metode untuk menentukan kunci unik
    public function getKey()
    {
        return "{$this->user_id}_{$this->tutor_id}_{$this->content_id}";
    }
}
