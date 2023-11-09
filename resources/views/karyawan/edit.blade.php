<form action="/karyawan/{{ $karyawan->nik }}/update" method="POST" id="frmKaryawan" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <div class="input-icon mb-3">
            <span class="input-icon-addon">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-barcode" width="24"
                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
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
            <input type="text" name="nik" id="nik" class="form-control" value="{{ $karyawan->nik }}"
                placeholder="NIK">
        </div>
    </div>
    <div class="mb-3">
        <div class="input-icon mb-3">
            <span class="input-icon-addon">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="24"
                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                </svg>
            </span>
            <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control"
                value="{{ $karyawan->nama_lengkap }}" placeholder="Nama Lengkap">
        </div>
    </div>
    <div class="mb-3">
        <div class="input-icon mb-3">
            <span class="input-icon-addon">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-analytics"
                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M3 4m0 1a1 1 0 0 1 1 -1h16a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-16a1 1 0 0 1 -1 -1z">
                    </path>
                    <path d="M7 20l10 0"></path>
                    <path d="M9 16l0 4"></path>
                    <path d="M15 16l0 4"></path>
                    <path d="M8 12l3 -3l2 2l3 -3"></path>
                </svg>
            </span>
            <input type="text" name="jabatan" id="jabatan" class="form-control" value="{{ $karyawan->jabatan }}"
                placeholder="Jabatan">
        </div>
    </div>
    <div class="mb-3">
        <div class="input-icon mb-3">
            <span class="input-icon-addon">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-phone" width="24"
                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path
                        d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2">
                    </path>
                </svg>
            </span>
            <input type="text" name="no_hp" id="no_hp" value="{{ $karyawan->no_hp }}" class="form-control"
                placeholder="No Hanphone">
        </div>
    </div>
    <div class="mb-3">
        <select name="kode_dept" id="kode_dept" class="form-select">
            <option value="">Pilih Department</option>
            @foreach ($department as $d)
                <option value="{{ $d->kode_dept }}" {{ $karyawan->kode_dept == $d->kode_dept ? 'selected' : '' }}>
                    {{ $d->nama_dept }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <div class="input-icon mb-3">
            <input name="foto" type="file" class="form-control">
            <input type="hidden" name="old_foto" value="{{ $karyawan->foto }}">
        </div>
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary w-100">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24"
                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                stroke-linecap="round" stroke-linejoin="round">
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
