<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

        $rekapizin = DB::table('pengajuan_izin')
            ->selectRaw('SUM(IF(status="i",1,0)) as jml_izin, SUM(IF(status="s",1,0)) as jml_sakit')
            ->whereRaw('MONTH(tgl_izin)="' . $bulanini . '"')
            ->whereRaw('YEAR(tgl_izin)="' . $tahunini . '"')
            ->where('nik', $nik)
            ->where('status_approved', 1)
            ->first();

        $namabln = ["", "Januari", "Febuari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

        return view('dashboard.dashboard', [
            'presensihariini' => $presensihariini,
            'historybulanini' => $historybulanini,
            'namabln' => $namabln,
            'bulanini' => $bulanini,
            'tahunini' => $tahunini,
            'rekappresensi' => $rekappresensi,
            'leaderboard' => $leaderboard,
            'rekapizin' => $rekapizin
        ]);
    }


    public function dashboardadmin()
    {
        $hariini = date('Y-m-d');
        $rekappresensi = DB::table('presensi')
            ->selectRaw('COUNT(nik) as jmlhadir, SUM(IF(jam_in > "07:00", 1, 0)) as jmlterlambat')
            ->where('tgl_presensi', $hariini)
            ->first();

        $rekapizin = DB::table('pengajuan_izin')
            ->selectRaw('SUM(IF(status="i",1,0)) as jml_izin, SUM(IF(status="s",1,0)) as jml_sakit')
            ->where('tgl_izin', $hariini)
            ->where('status_approved', 1)
            ->first();

        return view('dashboard.dashboardadmin', [
            'rekappresensi' => $rekappresensi,
            'rekapizin' => $rekapizin
        ]);
    }
}
