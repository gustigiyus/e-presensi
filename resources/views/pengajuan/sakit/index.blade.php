@extends('layouts.admin.tabler')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Pengajuan
                    </div>
                    <h2 class="page-title">
                        Pengajuan Sakit
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl d-flex gap-2 flex-column">
            @if (session('status'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <div class="d-flex">
                        <div>
                            <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M5 12l5 5l10 -10"></path>
                            </svg>
                        </div>
                        <div>
                            {{ session('status') }}
                        </div>
                    </div>
                    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                </div>
            @endif
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>NAMA</th>
                                <th>TGL IZIN</th>
                                <th style="width: 40%;">KETEANGAN</th>
                                <th>STATUS APPROVED</th>
                                <th style="width: 7%; text-align: center">
                                    AKSI
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengajuan as $d)
                                <tr>
                                    <td class="text-secondary">
                                        <span class="text-black">{{ $loop->iteration }}.</span>
                                    </td>

                                    <td class="text-secondary">
                                        <h5 class="d-inline">{{ $d->karyawan->nama_lengkap }}
                                            <span class="badge bg-cyan-lt">{{ $d->nik }}</span>
                                        </h5>
                                    </td>
                                    <td class="text-secondary">
                                        <h5 class="d-inline">{{ $d->tgl_izin }}</h5>
                                    </td>
                                    <td class="text-secondary">
                                        <h5 class="d-inline">{{ $d->keterangan }}</h5>
                                    </td>
                                    <td class="text-secondary">
                                        @if ($d->status_approved == 0)
                                            <span class="badge badge-outline text-blue">Pending</span>
                                        @elseif ($d->status_approved == 1)
                                            <span class="badge badge-outline text-green">Disetujui</span>
                                        @else
                                            <span class="badge badge-outline text-red">Ditolak</span>
                                        @endif
                                    </td>
                                    <td style="text-align: center">
                                        <a href="#" idAju={{ $d->id }} class="editData">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-edit" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                                <path
                                                    d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z">
                                                </path>
                                                <path d="M16 5l3 3"></path>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-blur fade" id="modal-team" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add a new team</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="loadeditForm">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Add Team</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('myscript')
    <script>
        $(document).ready(function() {
            $('.editData').click(function(e) {
                e.preventDefault();
                let idAju = $(this).attr('idAju');

                $.ajax({
                    type: "POST",
                    url: "/pengajuan/sakit/edit",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: idAju,
                    },
                    cache: false,
                    success: function(response) {
                        $('#loadeditForm').html(response);
                        showAndInitializeLitepicker();
                    }
                });

                $('#modal-team').modal('show');

            });


            function showAndInitializeLitepicker() {
                new Litepicker({
                    startDate: new Date(),
                    element: document.querySelector('.datepicker-icon'),
                    buttonText: {
                        previousMonth: `
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" 
                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" 
                    stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>`,
                        nextMonth: `
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" 
                    stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>`,
                    },
                });
            }

        });
    </script>
@endpush
