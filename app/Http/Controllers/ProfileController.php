<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        // auth()->user() akan menarik seluruh data database si pemasang sesi saat ini
        $user = auth()->user();

        // Oper data $user tersebut ke file view
        return view('profile.index', compact('user'));
    }
}