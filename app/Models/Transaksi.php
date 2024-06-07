<?php

// app\Models\Comment.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    public $incrementing = false; // karena 'id' sudah string
    public $timestamps = false; // tidak menggunakan kolom timestamps

    protected $fillable = [
        'id_transaksi ', 'id_user', 'id_playlist','tanggal','bukti_pembayaran'
    ];

    public function user()
{
    return $this->belongsTo(User::class, 'id_user');
}
}

