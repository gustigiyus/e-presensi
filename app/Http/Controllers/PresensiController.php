<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Pengajuan;
use App\Models\Presensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class PresensiController extends Controller
{
    public function create()
    {
        $hariini = date('Y-m-d');
        $nik = Auth::guard('karyawan')->user()->nik;

        $cek = Presensi::where('tgl_presensi', $hariini)
            ->where('nik', $nik)->count();

        return view('presensi.create', [
            'cek' => $cek
        ]);
    }

    public function store(Request $request)
    {
        $nik = Auth::guard('karyawan')->user()->nik;
        $tgl_presensi = date("Y-m-d");
        $jam = date("H:i:s");

        // LOKASI KANTOR (TITIK RADIUS)
        $latitudeKantor = -6.916810104499334;
        $longitudeKantor = 107.79425030729652;

        // $latitudeKantor = -6.914289335466438;
        // $longitudeKantor = 107.61169550914718;

        // $latitudeKantor = -6.9172307420433965;
        // $longitudeKantor = 107.61005901027413;

        // LOKASI USER
        $lokasi = $request->lokasi;

        // dd($lokasi);

        $lokasiUser = explode(',', $lokasi);
        $latitudeUser = $lokasiUser[0];
        $longitudeUser = $lokasiUser[1];
        $jarak = $this->distance($latitudeKantor, $longitudeKantor, $latitudeUser, $longitudeUser);
        $radius = round($jarak["meters"]);

        $cek = Presensi::where('tgl_presensi', $tgl_presensi)
            ->where('nik', $nik)->count();

        if ($cek > 0) {
            $ket = 'out';
        } else {
            $ket = 'in';
        }
        // CONVERT IMAGE FROM BASE64 TO READABLE IMAGE
        $image = $request->image;
        $image_parts = explode(";base64", $image);
        $image_base64 = base64_decode($image_parts[1]);
        // SETTING PATH AND FILE
        $folderPath = 'public/upload/absensi/';
        $formatName = $nik . "-" . $tgl_presensi . "-" . $ket;
        $fileName = $formatName . ".png";
        $file = $folderPath . $fileName;



        if ($radius > 15) {
            echo "error|Maaf anda berada diluar radius, jarak anda " . $radius . " meter dari kantor|radius";
        } else {
            if ($cek > 0) {
                // Pulang
                $data_pulang = [
                    'jam_out' => $jam,
                    'foto_out' => $fileName,
                    'lokasi_out' => $lokasi,
                ];
                $simpanData = Presensi::where('tgl_presensi', $tgl_presensi)
                    ->where('nik', $nik)
                    ->update($data_pulang);
                $clausa = 'out';
            } else {
                // Masuk
                $data = [
                    'nik' => $nik,
                    'tgl_presensi' => $tgl_presensi,
                    'jam_in' => $jam,
                    'foto_in' => $fileName,
                    'lokasi_in' => $lokasi,
                ];
                $simpanData = Presensi::create($data);
                $clausa = 'in';
            }

            if ($simpanData) {
                if ($clausa == 'out') {
                    echo "success|Terimakasih, hati-hati dijalan|out";
                } elseif ($clausa == 'in') {
                    echo "success|Terimakasih, selamat bekerja|in";
                }
                Storage::put($file, $image_base64);
            } else {
                if ($clausa == 'out') {
                    echo "error|Maaf Gagal Absen, Hubungai Tim IT|out";
                } elseif ($clausa == 'in') {
                    echo "error|Maaf Gagal Absen, Hubungai Tim IT|in";
                }
            }
        }
    }

    //Menghitung Jarak
    function distance($lat1, $lon1, $lat2, $lon2)
    {
        $theta = $lon1 - $lon2;
        $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $feet = $miles * 5280;
        $yards = $feet / 3;
        $kilometers = $miles * 1.609344;
        $meters = $kilometers * 1000;
        return compact('meters');
    }

    public function editprofile()
    {
        $nik = Auth::guard('karyawan')->user()->nik;
        $karyawan = Karyawan::where('nik', $nik)->first();

        return view('presensi.editprofile', [
            'karyawan' => $karyawan
        ]);
    }

    public function updateprofile(Request $request)
    {
        $nik = Auth::guard('karyawan')->user()->nik;
        $nama_lengkap = $request->nama_lengkap;
        $no_hp = $request->no_hp;
        $password = Hash::make($request->password);

        $dt_karyawan = Karyawan::where('nik', $nik)->first();

        // Check if the photo exists in the database and delete it if necessary
        if ($request->hasFile('foto')) {
            // Define the path where photos are stored
            $folderPath = 'public/upload/karyawan/';

            // If the previous photo exists, delete it
            if ($dt_karyawan->foto && file_exists(storage_path('app/' . $folderPath . $dt_karyawan->foto))) {
                unlink(storage_path('app/' . $folderPath . $dt_karyawan->foto)); // Delete the old photo
            }

            // Set the new photo name based on NIK and extension
            $foto = $nik . "." . $request->file('foto')->getClientOriginalExtension();
        } else {
            // Use the existing photo if no new one is uploaded
            $foto = $dt_karyawan->foto;
        }

        // Prepare the data to be updated
        if (empty($request->password)) {
            $data = [
                'nama_lengkap' => $nama_lengkap,
                'no_hp' => $no_hp,
                'foto' => $foto,
            ];
        } else {
            $data = [
                'nama_lengkap' => $nama_lengkap,
                'no_hp' => $no_hp,
                'password' => $password,
                'foto' => $foto,
            ];
        }

        // Update the data in the database
        $update = Karyawan::where('nik', $nik)->update($data);
        if ($update) {
            // If a new photo was uploaded, store it
            if ($request->hasFile('foto')) {
                $request->file('foto')->storeAs($folderPath, $foto);
            }

            return Redirect::back()->with(['success' => 'Data berhasil di update']);
        } else {
            return Redirect::back()->with(['error' => 'Data gagal di update']);
        }
    }

    public function histori()
    {
        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

        return view('presensi.histori', [
            'namabulan' => $namabulan
        ]);
    }

    public function gethistori(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $nik = Auth::guard('karyawan')->user()->nik;

        // echo $bulan . "" . $tahun;

        $histori = Presensi::whereRaw('MONTH(tgl_presensi)="' . $bulan . '"')
            ->whereRaw('YEAR(tgl_presensi)="' . $tahun . '"')
            ->where('nik', $nik)
            ->orderBy('tgl_presensi')
            ->get();

        return view('presensi.gethistori', [
            'histori' => $histori
        ]);
    }

    public function izin()
    {
        $nik = Auth::guard('karyawan')->user()->nik;
        $dataizin = DB::table('pengajuan_izin')->where('nik', $nik)->get();
        return view('presensi.izin', [
            'dataizin' => $dataizin
        ]);
    }

    public function izinadd()
    {
        return view('presensi.izinadd');
    }

    public function storeizin(Request $request)
    {
        $nik = Auth::guard('karyawan')->user()->nik;
        $status = $request->status;
        $tgl_izin = $request->tgl_izin;
        $keterangan = $request->keterangan;

        $data = [
            'nik' => $nik,
            'status' => $status,
            'tgl_izin' => $tgl_izin,
            'keterangan' => $keterangan,
        ];

        $simpan = DB::table('pengajuan_izin')->insert($data);

        if ($simpan) {
            return redirect('/presensi/izin')->with(['success' => 'Data Berhasil Disimpan']);
        } else {
            return redirect('/presensi/izin')->with(['error' => 'Data Gagal Disimpan']);
        }
    }

    public function monitoring()
    {
        return view('presensi.monitoring');
    }

    public function getpresensi(Request $request)
    {
        $tanggal = $request->tanggal;
        $presensi = Presensi::with('karyawan.department')->where('tgl_presensi', $tanggal)->get();

        return view('presensi.getpresensi', [
            'presensi' => $presensi
        ]);
    }

    public function showmaps(Request $request)
    {
        $id = $request->id;
        $presensi = Presensi::with('karyawan')->where('id', $id)->first();

        return view('presensi.showmaps', [
            'presensi' => $presensi
        ]);
    }

    public function cekpengajuanizin(Request $request)
    {
        $tgl_izin = $request->tgl_izin;
        $nik = Auth::guard('karyawan')->user()->nik;

        $cek = Pengajuan::where('nik', $nik)->where('tgl_izin', $tgl_izin)->count();

        return $cek;
    }
}
