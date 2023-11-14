@php
    function selisih($jam_masuk, $jam_keluar)
    {
        [$h, $m, $s] = explode(':', $jam_masuk);
        $dtAwal = mktime($h, $m, $s, '1', '1', '1');
        [$h, $m, $s] = explode(':', $jam_keluar);
        $dtAkhir = mktime($h, $m, $s, '1', '1', '1');
        $dtSelisih = $dtAkhir - $dtAwal;
        $totalmenit = $dtSelisih / 60;
        $jam = explode('.', $totalmenit / 60);
        $sisamenit = $totalmenit / 60 - $jam[0];
        $sisamenit2 = $sisamenit * 60;
        $jml_jam = $jam[0];
        return $jml_jam . ':' . round($sisamenit2);
    }
@endphp

@foreach ($presensi as $d)
    @php
        $foto_in = Storage::url('upload/absensi/' . $d->foto_in);
        $foto_out = Storage::url('upload/absensi/' . $d->foto_out);
    @endphp
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $d->nik }}</td>
        <td>{{ $d->karyawan->nama_lengkap }}</td>
        <td>{{ $d->karyawan->department->nama_dept }}</td>
        <td>{!! $d->jam_in != null ? $d->jam_in : '<span class="badge bg-red text-red-fg">Belum Masuk</span>' !!}</td>
        <td><img src="{{ url($foto_in) }}" class="avatar" alt="foto_in"></td>
        <td>{!! $d->jam_out != null ? $d->jam_out : '<span class="badge bg-red text-red-fg">Belum Absen</span>' !!}</td>
        <td>
            @if ($d->jam_out != null)
                <img src="{{ url($foto_out) }}" class="avatar" alt="foto_out">
            @else
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-hourglass-high" width="24"
                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M6.5 7h11"></path>
                    <path d="M6 20v-2a6 6 0 1 1 12 0v2a1 1 0 0 1 -1 1h-10a1 1 0 0 1 -1 -1z"></path>
                    <path d="M6 4v2a6 6 0 1 0 12 0v-2a1 1 0 0 0 -1 -1h-10a1 1 0 0 0 -1 1z"></path>
                </svg>
            @endif
        </td>
        <td>
            @if ($d->jam_in >= '07:00')
                @php
                    $jamTerlambat = selisih('07:00:00', $d->jam_in);
                @endphp
                <span class="badge bg-red text-red-fg">Terlambat - {{ $jamTerlambat }}</span>
            @else
                <span class="badge bg-cyan text-cyan-fg">Tepat Waktu</span>
            @endif
        </td>
        <td>
            <a href="#" class="btn btn-primary showmaps" id="{{ $d->id }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-2" width="24"
                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M12 18.5l-3 -1.5l-6 3v-13l6 -3l6 3l6 -3v7.5"></path>
                    <path d="M9 4v13"></path>
                    <path d="M15 7v5.5"></path>
                    <path
                        d="M21.121 20.121a3 3 0 1 0 -4.242 0c.418 .419 1.125 1.045 2.121 1.879c1.051 -.89 1.759 -1.516 2.121 -1.879z">
                    </path>
                    <path d="M19 18v.01"></path>
                </svg>
            </a>
        </td>
    </tr>
@endforeach

<script>
    $(function() {
        $('.showmaps').click(function(e) {
            let id = $(this).attr('id')
            console.log(id);
            $.ajax({
                type: "POST",
                url: "/showmaps",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                },
                cache: false,
                success: function(response) {
                    $('#loadmap').html(response)
                }
            });
            $('#modal-tampilkanpeta').modal('show')
        });
    });
</script>
