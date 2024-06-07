<?php

// app\Models\Content.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $table = 'content';
    protected $primaryKey = 'id';
    public $incrementing = false; // karena 'id' sudah string
    public $timestamps = false; // tidak menggunakan kolom timestamps

    protected $fillable = [
        'id', 'tutor_id', 'playlist_id', 'title', 'description', 'video', 'thumb', 'date', 'status'
    ];
}
