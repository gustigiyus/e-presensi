<form action="/department/{{ $department->kode_dept }}/update" method="POST" id="frmDepartment">
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
            <input type="text" name="kode_dept" id="kode_dept" readonly
                style="cursor: pointer; background: rgb(235, 227, 227)" value="{{ $department->kode_dept }}"
                class="form-control" placeholder="Kode Depertment">
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
            <input type="text" name="nama_dept" id="nama_dept" autofocus value="{{ $department->nama_dept }}"
                class="form-control" placeholder="Nama Department">
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
