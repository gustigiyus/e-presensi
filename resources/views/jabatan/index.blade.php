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
                        Data Jabatan
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
                                Tambah Jabatan
                            </a>
                        </div>
                    </div>

                    <div class="card mt-2">
                        <div class="card-body d-flex flex-column gap-3">

                            <div class="table-responsive">
                                <table class="table table-vcenter card-table">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>NAMA JABATAN</th>
                                            <th>GAJI POKOK</th>
                                            <th>DESKRIPSI</th>
                                            <th style="width: 7%; text-align: center">
                                                AKSI
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($jabatan as $d)
                                            <tr>
                                                <td><span class="text-black">{{ $loop->iteration }}.</span></td>
                                                <td class="text-secondary">
                                                    {{ $d->nama_jabatan }}
                                                </td>
                                                <td class="text-secondary">
                                                    {{ $d->gaji_pokok }}
                                                </td>
                                                <td class="text-secondary">
                                                    {{ $d->deskripsi }}
                                                </td>
                                                <td style="text-align: center">
                                                    <div class="d-flex gap-2 justify-content-center">
                                                        <a href="#" class="edit" id_jabatan={{ $d->id }}>
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                class="icon icon-tabler icon-tabler-edit" width="24"
                                                                height="24" viewBox="0 0 24 24" stroke-width="2"
                                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                                stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                                                </path>
                                                                <path
                                                                    d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1">
                                                                </path>
                                                                <path
                                                                    d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z">
                                                                </path>
                                                                <path d="M16 5l3 3"></path>
                                                            </svg>
                                                        </a>
                                                        <a href="#" class="delete" id_jabatan={{ $d->id }}>
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                class="icon icon-tabler icon-tabler-trash text-red"
                                                                width="24" height="24" viewBox="0 0 24 24"
                                                                stroke-width="2" stroke="currentColor" fill="none"
                                                                stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                                                </path>
                                                                <path d="M4 7l16 0"></path>
                                                                <path d="M10 11l0 6"></path>
                                                                <path d="M14 11l0 6"></path>
                                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12">
                                                                </path>
                                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- Modal Input --}}
    <div class="modal modal-blur fade" id="modal-inputjabatan" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Jabatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/jabatan/store" method="POST" id="frmJabatan" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-tie">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M12 22l4 -4l-2.5 -11l.993 -2.649a1 1 0 0 0 -.936 -1.351h-3.114a1 1 0 0 0 -.936 1.351l.993 2.649l-2.5 11l4 4z" />
                                        <path d="M10.5 7h3l5 5.5" />
                                    </svg>
                                </span>
                                <input type="text" name="nama_jabatan" id="nama_jabatan" class="form-control"
                                    placeholder="Nama Jabatan">
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-cash-banknote">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                        <path
                                            d="M3 6m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
                                        <path d="M18 12l.01 0" />
                                        <path d="M6 12l.01 0" />
                                    </svg>
                                </span>
                                <input type="text" name="gaji_pokok" id="gaji_pokok" class="form-control"
                                    placeholder="Gaji Pokok">
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-icon mb-3">
                                <textarea type="text" rows="4" name="deskripsi" id="deskripsi" class="form-control"
                                    placeholder="Deskripsi"></textarea>
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

    {{-- Modal Edit --}}
    <div class="modal modal-blur fade" id="modal-editJabatan" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Jabatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="loadeditForm">

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
                $('#modal-inputjabatan').modal("show");
            });

            $('.delete').click(function(e) {
                e.preventDefault();
                let id_jabatan = $(this).attr('id_jabatan');

                Swal.fire({
                    title: "Do you want to delete",
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: "delete",
                    denyButtonText: `Don't delete`
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: "/jabatan/destroy/" + id_jabatan,
                            cache: false,
                            data: {
                                _token: "{{ csrf_token() }}",
                                id_jabatan: id_jabatan,
                            },
                            success: function(response) {
                                let status = response.success
                                if (status) {
                                    Swal.fire({
                                        position: "top-end",
                                        icon: "success",
                                        title: status,
                                        showConfirmButton: false,
                                        timer: 1500
                                    });

                                    setTimeout(() => {
                                        location.reload();
                                    }, 1800);
                                }
                            }
                        });

                    } else if (result.isDenied) {
                        Swal.fire("Changes are not saved", "", "info");
                    }
                });

            });

            $('.edit').click(function(e) {
                e.preventDefault();
                let id_jabatan = $(this).attr('id_jabatan');
                $.ajax({
                    type: "POST",
                    url: "/jabatan/edit",
                    cache: false,
                    data: {
                        _token: "{{ csrf_token() }}",
                        id_jabatan: id_jabatan,
                    },
                    success: function(response) {
                        $('#loadeditForm').html(response);
                    }
                });
                $('#modal-editJabatan').modal("show");
            });


            $('#frmJabatan').submit(function() {
                let id_jabatan = $('#id_jabatan').val()
                let nama_jabatan = $('#nama_jabatan').val()
                let gaji_pokok = $('#gaji_pokok').val()

                if (nama_jabatan == '') {
                    Swal.fire({
                        title: 'Oops!',
                        text: 'Nama Jabatan Harus Diisi',
                        icon: 'warning',
                        confirmButtonText: 'Ok'
                    }).then(() => {
                        $('#nama_jabatan').focus()
                    })

                    return false
                } else if (gaji_pokok == '') {
                    Swal.fire({
                        title: 'Oops!',
                        text: 'Gaji Pokok Harus Diisi',
                        icon: 'warning',
                        confirmButtonText: 'Ok'
                    }).then(() => {
                        $('#gaji_pokok').focus()
                    })

                    return false
                }
            });
        });
    </script>
@endpush
