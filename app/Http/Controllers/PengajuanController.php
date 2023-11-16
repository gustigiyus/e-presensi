<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class PengajuanController extends Controller
{
    /* MODUL SAKIT */
    public function s_index(Request $request)
    {
        $dari = $request->dari;
        $sampai = $request->sampai;
        $nik = $request->nik;
        $nama_karyawan = $request->nama_karyawan;
        $status_approved = $request->status_approved;

        $pengajuan = Pengajuan::with('karyawan')
            ->search($dari, $sampai, $nik, $nama_karyawan, $status_approved)
            ->where('status', 's')->orderBy('tgl_izin', 'desc')->paginate(2)->appends($request->all());

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

    public function s_update(Request $request, $id)
    {
        $id = $request->id;
        $rules = [
            'status_approved' => 'required',
            'tgl_approved' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->with(['error' => 'Data gagal diupdate']);
        }

        $data = Pengajuan::where('id', $id)->update([
            'status_approved' => $request->input('status_approved'),
            'tgl_approved' => $request->input('tgl_approved'),
        ]);

        return redirect('/pengajuan/sakit')->with('status', 'Data berhasil diupdate!');
    }

    public function s_decline(Request $request, $id)
    {
        $id = $request->id;

        $data = Pengajuan::where('id', $id)->update([
            'status_approved' => 0,
        ]);

        return redirect('/pengajuan/sakit')->with('status', 'Data berhasil diupdate!');
    }

    /* MODUL Izin */
    public function i_index(Request $request)
    {
        $dari = $request->dari;
        $sampai = $request->sampai;
        $nik = $request->nik;
        $nama_karyawan = $request->nama_karyawan;
        $status_approved = $request->status_approved;

        $pengajuan = Pengajuan::with('karyawan')
            ->search($dari, $sampai, $nik, $nama_karyawan, $status_approved)
            ->where('status', 'i')->orderBy('tgl_izin', 'desc')->paginate(2)->appends($request->all());

        return view('pengajuan.izin.index', [
            'pengajuan' => $pengajuan
        ]);
    }

    public function i_edit(Request $request)
    {
        $id = $request->id;

        $pengajuan = Pengajuan::with('karyawan')
            ->where('id', $id)->first();
        return view('pengajuan.izin.edit', [
            'pengajuan' => $pengajuan
        ]);
    }

    public function i_update(Request $request, $id)
    {
        $id = $request->id;
        $rules = [
            'status_approved' => 'required',
            'tgl_approved' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->with(['error' => 'Data gagal diupdate']);
        }

        $data = Pengajuan::where('id', $id)->update([
            'status_approved' => $request->input('status_approved'),
            'tgl_approved' => $request->input('tgl_approved'),
        ]);

        return redirect('/pengajuan/izin')->with('status', 'Data berhasil diupdate!');
    }

    public function i_decline(Request $request, $id)
    {
        $id = $request->id;

        $data = Pengajuan::where('id', $id)->update([
            'status_approved' => 0,
        ]);

        return redirect('/pengajuan/izin')->with('status', 'Data berhasil diupdate!');
    }
}
