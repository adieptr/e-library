<?php

// app\Models\Bookmark.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    protected $table = 'bookmark';
    protected $primaryKey = null; // karena tidak ada primary key tunggal
    public $incrementing = false; // karena tidak ada kolom auto-increment
    public $timestamps = false; // tidak menggunakan kolom timestamps

    protected $fillable = [
        'user_id', 'playlist_id'
    ];
}

