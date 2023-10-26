<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $hariini = date('Y-m-d');
        $bulanini = date('m') * 1;
        $tahunini = date('Y');
        $nik = Auth::guard('karyawan')->user()->nik;

        $presensihariini = Presensi::where('tgl_presensi', $hariini)
            ->where('nik', $nik)->first();

        $historybulanini = Presensi::where('nik', $nik)
            ->whereRaw('MONTH(tgl_presensi)="' . $bulanini . '"')
            ->whereRaw('YEAR(tgl_presensi)="' . $tahunini . '"')
            ->orderBy('tgl_presensi')->get();

        $rekappresensi = Presensi::selectRaw('COUNT(nik) as jmlhadir, SUM(IF(jam_in > "07:00", 1, 0)) as jmlterlambat')
            ->where('nik', $nik)
            ->whereRaw('MONTH(tgl_presensi)="' . $bulanini . '"')
            ->whereRaw('YEAR(tgl_presensi)="' . $tahunini . '"')
            ->first();

        $leaderboard = Presensi::with('karyawan:nik,nama_lengkap,jabatan')
            ->where("tgl_presensi", $hariini)
            ->orderBy('jam_in')
            ->get();

        $namabln = ["", "Januari", "Febuari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

        return view('dashboard.dashboard', [
            'presensihariini' => $presensihariini,
            'historybulanini' => $historybulanini,
            'namabln' => $namabln,
            'bulanini' => $bulanini,
            'tahunini' => $tahunini,
            'rekappresensi' => $rekappresensi,
            'leaderboard' => $leaderboard
        ]);
    }
}
