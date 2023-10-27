@if ($histori->isEmpty())
    <div class="alert alert-outline-warning">
        <span>Data Belum Ada</span>
    </div>
@endif)
@foreach ($gethistori as $d)
    <ul class="listview image-listview">
        <li>
            <div class="item">
                @php
                    $path = Storage::url('upload/absensi/' . $d->foto_in);
                @endphp
                <img src="{{ url($path) }}" alt="image" class="image">
                <div class="in">
                    <div>
                        <b>{{ date('d-m-Y', strtotime($d->tgl_presensi)) }}</b>
                    </div>
                    <span
                        class="badge {{ $d->jam_in < '07:00' ? 'badge-success' : 'badge-danger' }}">{{ $d->jam_in }}</span>
                </div>
            </div>
        </li>
    </ul>
@endforeach
