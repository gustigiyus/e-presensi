<style>
    #mappres {
        height: 250px;
    }
</style>

<div id="mappres">
</div>

<script>
    var lokasiPres = "{{ $presensi->lokasi_in }}";

    var loksplt = lokasiPres.split(",");
    var lokLat = loksplt[0];
    var lokLon = loksplt[1];

    var mapPresensi = L.map('mappres').setView([lokLat, lokLon], 16);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(mapPresensi);
    var markerPres = L.marker([lokLat, lokLon]).addTo(mapPresensi);
    var circlePres = L.circle([-6.916810104499334, 107.79425030729652], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.5,
        radius: 20
    }).addTo(mapPresensi);


    var popupPres = L.popup()
        .setLatLng([lokLat, lokLon])
        .setContent("{{ $presensi->karyawan->nama_lengkap }}")
        .openOn(mapPresensi);
</script>
