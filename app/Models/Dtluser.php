<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dtluser extends Model
{
    protected $table = 'dtl_user';
    protected $primaryKey = 'id'; // Adjusted primary key
    public $incrementing = true; // Set to true for auto-incrementing IDs
    public $timestamps = false; // Assuming no timestamp columns

    protected $fillable = [
        'id_user', 'tutor_id', 'playlist_id', 'status'
    ];

    public function playlist()
    {
        return $this->belongsTo(Playlist::class, 'playlist_id', 'id');
    }
}
