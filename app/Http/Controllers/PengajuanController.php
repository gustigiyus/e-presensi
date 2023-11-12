<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    /* MODUL SAKIT */
    public function s_index()
    {
        $pengajuan = Pengajuan::with('karyawan')->where('status', 's')->get();

        return view('pengajuan.sakit.index', [
            'pengajuan' => $pengajuan
        ]);
    }

    public function s_edit(Request $request)
    {
        $id = $request->id;

        $pengajuan = Pengajuan::with('karyawan')->where('id', $id)->first();
        return view('pengajuan.sakit.edit', [
            'pengajuan' => $pengajuan
        ]);
    }
}
