<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

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

    /* MODUL Izin */
    public function i_index()
    {
        $pengajuan = Pengajuan::with('karyawan')->where('status', 'i')->get();

        return view('pengajuan.izin.index', [
            'pengajuan' => $pengajuan
        ]);
    }

    public function i_edit(Request $request)
    {
        $id = $request->id;

        $pengajuan = Pengajuan::with('karyawan')->where('id', $id)->first();
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
}
