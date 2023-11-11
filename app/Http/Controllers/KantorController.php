<?php

namespace App\Http\Controllers;

use App\Models\Kantor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class KantorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kantor = Kantor::get();
        return view('kantor.index', [
            'kantor' => $kantor
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kantor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'nm_kantor' => 'required',
            'location' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'radius' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $data = Kantor::create([
            'nm_kantor' => $request->input('nm_kantor'),
            'location' => $request->input('location'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'radius' => $request->input('radius'),
        ]);

        if ($data) {
            return redirect('/kantor')->with('status', 'Kantor berhasil ditambahkan!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Kantor $kantor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kantor $kantor, $id)
    {
        $kantor = Kantor::find($id);

        return view('kantor.edit', [
            'kantor' => $kantor
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'nm_kantor' => 'required',
            'location' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'radius' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $data = Kantor::where('id', $id)->update([
            'nm_kantor' => $request->input('nm_kantor'),
            'location' => $request->input('location'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'radius' => $request->input('radius'),
        ]);

        if ($data) {
            return redirect('/kantor')->with('status', 'Data kantor berhasil diupdate!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Kantor::find($id);
        if (!$data) {
            return redirect('/kantor')->with('error', 'Data kantor tidak ditemukan');
        }

        $data->delete();
        return redirect('/kantor')->with('status', 'Data kantor berhasil dihapus!');
    }
}
