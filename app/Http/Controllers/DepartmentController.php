<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    public function index()
    {
        $dept = Department::get();
        return view('department.index', [
            'dept' => $dept
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kantor.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'kode_dept' => 'required',
            'nama_dept' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->with(['error' => 'Data gagal di simpan']);
        }

        $data = Department::create([
            'kode_dept' => $request->input('kode_dept'),
            'nama_dept' => $request->input('nama_dept'),
        ]);

        if ($data) {
            return redirect('/department')->with('success', 'Data berhasil ditambahkan!');
        }
    }

    public function edit(Request $request)
    {
        $kode_dept = $request->kode_dept;
        $department = Department::find($kode_dept);

        return view('department.edit', [
            'department' => $department
        ]);
    }

    public function update(Request $request, $kode_dept)
    {
        $kode_dept = $request->kode_dept;
        $rules = [
            'kode_dept' => 'required',
            'nama_dept' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->with(['error' => 'Data gagal diupdate']);
        }

        $data = Department::where('kode_dept', $kode_dept)->update([
            'kode_dept' => $request->input('kode_dept'),
            'nama_dept' => $request->input('nama_dept'),
        ]);

        return redirect('/department')->with('success', 'Data berhasil diupdate!');
    }

    public function destroy($kode_dept, Request $request)
    {
        $kode_dept = $request->kode_dept;
        $data = Department::find($kode_dept);

        if ($data) {
            $data->delete();
            return Response::json(['success' => 'Data berhasil di hapus'], 200);
        } else {
            return Redirect::back()->with(['error' => 'Data gagal di update']);
        }
    }
}
