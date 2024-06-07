<?php

// app\Models\Playlist.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    protected $table = 'playlist';
    protected $primaryKey = 'id';
    public $incrementing = false; // karena 'id' sudah string
    public $timestamps = false; // tidak menggunakan kolom timestamps

    protected $fillable = [
        'id', 'tutor_id', 'title', 'description', 'thumb', 'date', 'status','harga','tingkatan','jenis',
    ];

    public function tutor()
    {
        return $this->belongsTo(Tutors::class, 'tutor_id', 'id');
    }
}
