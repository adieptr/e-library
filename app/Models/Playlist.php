<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    protected $table = 'playlist';
    protected $primaryKey = 'id';
    public $incrementing = false; // because 'id' is a string
    public $timestamps = false; // not using timestamp columns

    protected $fillable = [
        'id', 'tutor_id', 'title', 'description', 'thumb', 'date', 'status', 'harga', 'tingkatan', 'jenis',
    ];

    public function tutor()
    {
        return $this->belongsTo(Tutors::class, 'tutor_id', 'id');
    }
    public function dtlUser()
    {
        return $this->hasOne(Dtluser::class, 'playlist_id', 'id');
    }
}
