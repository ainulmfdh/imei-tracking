<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard dengan statistik ringkas.
     */
    public function index()
    {
        // 1. Menghitung total seluruh perangkat di tabel devices
        $totalDevices = Device::count();

        // 2. Menghitung perangkat yang statusnya 'available' (Tersedia)
        $availableDevices = Device::where('status', 'tersedia')->count();

        // 3. Menghitung perangkat yang statusnya 'dipakai' (Sedang Digunakan)
        $usedDevices = Device::where('status', 'dipakai')->count();

        // 4. Menghitung total user/admin yang terdaftar di tabel users
        $totalUsers = User::count();

        // Mengirimkan semua variabel ke view 'dashboard'
        return view('dashboard', compact(
            'totalDevices',
            'availableDevices',
            'usedDevices',
            'totalUsers'
        ));
    }
}
