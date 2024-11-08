<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class JabatanController extends Controller
{
    public function index()
    {
        $jabatan = Jabatan::get();
        return view('jabatan.index', [
            'jabatan' => $jabatan
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'nama_jabatan' => 'required',
            'gaji_pokok' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->with(['error' => 'Data gagal di simpan']);
        }

        $data = Jabatan::create([
            'nama_jabatan' => $request->input('nama_jabatan'),
            'gaji_pokok' => $request->input('gaji_pokok'),
            'deskripsi' => $request->input('deskripsi'),
        ]);

        if ($data) {
            return redirect('/jabatan')->with('success', 'Data berhasil ditambahkan!');
        }
    }

    public function edit(Request $request)
    {
        $id = $request->id_jabatan;
        $jabatan = Jabatan::find($id);

        return view('jabatan.edit', [
            'jabatan' => $jabatan
        ]);
    }

    public function update(Request $request, $id)
    {
        $id_jabatan = $id;
        $rules = [
            'nama_jabatan' => 'required',
            'gaji_pokok' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->with(['error' => 'Data gagal diupdate']);
        }

        $data = Jabatan::where('id', $id_jabatan)->update([
            'nama_jabatan' => $request->input('nama_jabatan'),
            'gaji_pokok' => $request->input('gaji_pokok'),
            'deskripsi' => $request->input('deskripsi'),
        ]);

        return redirect('/jabatan')->with('success', 'Data berhasil diupdate!');
    }

    public function destroy(Request $request, $id)
    {
        $id_jabatan = $id;

        $data = Jabatan::find($id_jabatan);
        if ($data) {
            $data->delete();
            return Response::json(['success' => 'Data berhasil di hapus'], 200);
        } else {
            return Redirect::back()->with(['error' => 'Data gagal di update']);
        }
    }
}
