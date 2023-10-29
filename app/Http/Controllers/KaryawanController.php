<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function index()
    {
        $karyawan = Karyawan::with('department')->orderBy('nama_lengkap')->get();

        return view('karyawan.index', [
            'karyawan' => $karyawan
        ]);
    }
}
