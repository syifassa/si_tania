<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RiwayatInput;
use Illuminate\Support\Facades\Auth;

class BerandaWargaController extends Controller
{
    public function index()
    {
        $riwayatTerbaru = RiwayatInput::where('user_id', Auth::id())
            ->latest()
            ->take(5)
            ->get();

        $totalRiwayat = RiwayatInput::where('user_id', Auth::id())->count();

        return view('warga.beranda', compact('riwayatTerbaru', 'totalRiwayat'));
    }
}
