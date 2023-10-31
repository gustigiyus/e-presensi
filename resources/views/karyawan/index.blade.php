@extends('layouts.admin.tabler')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Master Data
                    </div>
                    <h2 class="page-title">
                        Data Karyawan
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-12">

                    @php
                        $success = Session::get('success');
                        $error = Session::get('error');
                    @endphp

                    @if ($success)
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <div class="d-flex">
                                <div>
                                    <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24"
                                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M5 12l5 5l10 -10"></path>
                                    </svg>
                                </div>
                                <div>
                                    {{ $success }}
                                </div>
                            </div>
                            <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                        </div>
                    @elseif ($error)
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <div class="d-flex">
                                <div>
                                    <!-- Download SVG icon from http://tabler-icons.io/i/alert-circle -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24"
                                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                        <path d="M12 8v4"></path>
                                        <path d="M12 16h.01"></path>
                                    </svg>
                                </div>
                                <div>
                                    {{ $error }}
                                </div>
                            </div>
                            <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col">
                            <a href="#" class="btn btn-primary" id="btnAddKar">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M12 5l0 14"></path>
                                    <path d="M5 12l14 0"></path>
                                </svg>
                                Tambah Karyawan
                            </a>
                        </div>
                    </div>

                    <div class="card mt-2">
                        <div class="card-body d-flex flex-column gap-3">
                            <div>
                                <form action="/karyawan" method="GET">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Nama Karyawan"
                                                    name="nama_karyawan" id="nama_karyawan"
                                                    value="{{ Request('nama_karyawan') }}">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <select name="kode_dept" class="form-select">
                                                    <option value="">Pilih Department</option>
                                                    @foreach ($department as $d)
                                                        <option value="{{ $d->kode_dept }}"
                                                            {{ Request('kode_dept') == $d->kode_dept ? 'selected' : '' }}>
                                                            {{ $d->nama_dept }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <button type="submit" class="btn btn-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-search" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                                                    <path d="M21 21l-6 -6"></path>
                                                </svg>
                                                Cari
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <td>No</td>
                                            <td>NIK</td>
                                            <td>Nama</td>
                                            <td>Jabtan</td>
                                            <td>No. HP</td>
                                            <td>Foto</td>
                                            <td>Department</td>
                                            <td>Aksi</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($karyawan as $d)
                                            @php
                                                $path = Storage::url('upload/karyawan/' . $d->foto);
                                            @endphp
                                            <tr>
                                                <td>{{ $loop->iteration + $karyawan->firstitem() - 1 }}</td>
                                                <td>{{ $d->nik }}</td>
                                                <td>{{ $d->nama_lengkap }}</td>
                                                <td>{{ $d->jabatan }}</td>
                                                <td>{{ $d->no_hp }}</td>
                                                <td>
                                                    @if (empty($d->foto))
                                                        <img src="{{ url('assets/img/no_image.png') }}" class="avatar"
                                                            alt="foto">
                                                    @else
                                                        <img src="{{ url($path) }}" class="avatar" alt="foto">
                                                    @endif
                                                </td>
                                                <td>{{ $d->department->nama_dept }}</td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>

                                {{ $karyawan->links('vendor.pagination.bootstrap-5') }}
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-blur fade" id="modal-inputkaryawan" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/karyawan/store" method="POST" id="frmKaryawan" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-barcode"
                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M4 7v-1a2 2 0 0 1 2 -2h2"></path>
                                        <path d="M4 17v1a2 2 0 0 0 2 2h2"></path>
                                        <path d="M16 4h2a2 2 0 0 1 2 2v1"></path>
                                        <path d="M16 20h2a2 2 0 0 0 2 -2v-1"></path>
                                        <path d="M5 11h1v2h-1z"></path>
                                        <path d="M10 11l0 2"></path>
                                        <path d="M14 11h1v2h-1z"></path>
                                        <path d="M19 11l0 2"></path>
                                    </svg>
                                </span>
                                <input type="text" name="nik" id="nik" class="form-control"
                                    placeholder="NIK">
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user"
                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                    </svg>
                                </span>
                                <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control"
                                    placeholder="Nama Lengkap">
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-device-analytics" width="24"
                                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path
                                            d="M3 4m0 1a1 1 0 0 1 1 -1h16a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-16a1 1 0 0 1 -1 -1z">
                                        </path>
                                        <path d="M7 20l10 0"></path>
                                        <path d="M9 16l0 4"></path>
                                        <path d="M15 16l0 4"></path>
                                        <path d="M8 12l3 -3l2 2l3 -3"></path>
                                    </svg>
                                </span>
                                <input type="text" name="jabatan" id="jabatan" class="form-control"
                                    placeholder="Jabatan">
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-phone"
                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path
                                            d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2">
                                        </path>
                                    </svg>
                                </span>
                                <input type="text" name="no_hp" id="no_hp" class="form-control"
                                    placeholder="No Hanphone">
                            </div>
                        </div>
                        <div class="mb-3">
                            <select name="kode_dept" id="kode_dept" class="form-select">
                                <option value="">Pilih Department</option>
                                @foreach ($department as $d)
                                    <option value="{{ $d->kode_dept }}">
                                        {{ $d->nama_dept }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <div class="input-icon mb-3">
                                <input name="foto" type="file" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary w-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2">
                                    </path>
                                    <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                    <path d="M14 4l0 4l-6 0l0 -4"></path>
                                </svg>
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('myscript')
    <script>
        $(document).ready(function() {

            $('#btnAddKar').click(function(e) {
                e.preventDefault();
                $('#modal-inputkaryawan').modal("show");
            });

            $('#frmKaryawan').submit(function() {
                let nik = $('#nik').val()
                let nama_lengkap = $('#nama_lengkap').val()
                let jabatan = $('#jabatan').val()
                let no_hp = $('#no_hp').val()
                let kode_dept = $('#frmKaryawan').find('#kode_dept').val()

                if (nik == '') {
                    Swal.fire({
                        title: 'Oops!',
                        text: 'Nik Harus Diisi',
                        icon: 'warning',
                        confirmButtonText: 'Ok'
                    }).then(() => {
                        $('#nik').focus()
                    })

                    return false
                } else if (nama_lengkap == '') {
                    Swal.fire({
                        title: 'Oops!',
                        text: 'Nama Lengkap Harus Diisi',
                        icon: 'warning',
                        confirmButtonText: 'Ok'
                    }).then(() => {
                        $('#nama_lengkap').focus()
                    })

                    return false
                } else if (jabatan == '') {
                    Swal.fire({
                        title: 'Oops!',
                        text: 'Jabtan Harus Diisi',
                        icon: 'warning',
                        confirmButtonText: 'Ok'
                    }).then(() => {
                        $('#jabatan').focus()
                    })

                    return false
                } else if (no_hp == '') {
                    Swal.fire({
                        title: 'Oops!',
                        text: 'No Handphone Harus Diisi',
                        icon: 'warning',
                        confirmButtonText: 'Ok'
                    }).then(() => {
                        $('#no_hp').focus()
                    })

                    return false
                } else if (kode_dept == '') {
                    Swal.fire({
                        title: 'Oops!',
                        text: 'Kode Department Harus Diisi',
                        icon: 'warning',
                        confirmButtonText: 'Ok'
                    }).then(() => {
                        $('#kode_dept').focus()
                    })

                    return false
                }

            });
        });
    </script>
@endpush
