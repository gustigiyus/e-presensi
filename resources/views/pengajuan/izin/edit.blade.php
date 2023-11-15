<form action="/pengajuan/izin/update/{{ $pengajuan->id }}" method="POST">
    @csrf
    <div class="row mb-3 align-items-end">
        <div class="col-3">
            <label class="form-label">NIK</label>
            <input type="text" name="nik" class="form-control bg-black text-white cursor-pointer"
                value="{{ $pengajuan->nik }}" readonly />
        </div>
        <div class="col">
            <label class="form-label">Name</label>
            <input name="nama_lengkap" type="text" class="form-control bg-black text-white cursor-pointer"
                value="{{ $pengajuan->karyawan->nama_lengkap }}" readonly />
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label">Keterangan</label>
        <textarea name="keterangan" class="form-control bg-black text-white cursor-pointer" rows="5"
            placeholder="Masukan keterangan" readonly>{{ $pengajuan->keterangan }}</textarea>
    </div>
    <div class="row mb-3 align-items-end">
        <div class="col-5">
            <div class="form-label">Status Approved</div>
            <select name="status_approved" class="form-select">
                <option value="1" {{ $pengajuan->status_approved == '1' ? 'selected' : '' }}>Approved
                </option>
                <option value="2" {{ $pengajuan->status_approved == '2' ? 'selected' : '' }}>Decline</option>
            </select>
        </div>
        <div class="col">
            <div class="form-label">Tanggal Approved</div>
            <div class="input-icon">
                <input name="tgl_approved" class="form-control datepicker-icon" placeholder="Select a date">
                <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z">
                        </path>
                        <path d="M16 3v4"></path>
                        <path d="M8 3v4"></path>
                        <path d="M4 11h16"></path>
                        <path d="M11 15h1"></path>
                        <path d="M12 15v3"></path>
                    </svg>
                </span>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-between">
        <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>

</form>
