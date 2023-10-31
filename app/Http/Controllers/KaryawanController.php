<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class KaryawanController extends Controller
{
    public function index(Request $request)
    {
        $nama_lengkap = $request->nama_karyawan;
        $kode_dept = $request->kode_dept;

        $karyawan = Karyawan::with('department')
            ->search($nama_lengkap, $kode_dept)
            ->orderBy('nama_lengkap')
            ->paginate(10);

        $department = Department::get();

        return view('karyawan.index', [
            'karyawan' => $karyawan,
            'department' => $department,
        ]);
    }

    public function store(Request $request)
    {
        $nik = $request->nik;
        $nama_lengkap = $request->nama_lengkap;
        $jabatan = $request->jabatan;
        $no_hp = $request->no_hp;
        $kode_dept = $request->kode_dept;
        $foto = $request->foto;

        $data = [
            'nik' => $nik,
            'nama_lengkap' => $nama_lengkap,
            'jabatan' => $jabatan,
            'no_hp' => $no_hp,
            'kode_dept' => $kode_dept,
            'password' => Hash::make('12345'),
            'foto' => $foto != '' ? $nik . ".png" : '',
        ];

        $simpan = Karyawan::create($data);
        if ($simpan) {
            if ($foto != '') {
                $folderPath = 'public/upload/karyawan/';
                $fileName = $nik . ".png";
                $request->file('foto')->storeAs($folderPath, $fileName);
            }
            return Redirect::back()->with(['success' => 'Data berhasil di simpan']);
        } else {
            return Redirect::back()->with(['error' => 'Data gagal di simpan']);
        }
    }
}
