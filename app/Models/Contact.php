<?php

// app\Models\Contact.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contact';
    public $timestamps = false; // tidak menggunakan kolom timestamps

    protected $fillable = [
        'name', 'email', 'number', 'message'
    ];
}

