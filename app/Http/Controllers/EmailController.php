<?php

namespace App\Http\Controllers;

use App\Mail\CustomEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function sendEmail(Request $request)
    {
        $title = 'Judul Email';
        $content = 'Ini adalah konten email yang dikirim dengan desain HTML.';
        $recipientEmail = $request->input('email'); // Ambil alamat email dari input pengguna

        Mail::to($recipientEmail)->send(new CustomEmail($title, $content));

            return redirect()->route('forgot-password')->with('success', 'Link Update Password Telah Dikirim Ke Email '. $recipientEmail);
    }

    public function uppas()
    {
        return view('updatepass');
    }
}

