@extends('layouts.admin.tabler')

@section('content')
    <style>
        #map {
            height: 350px;
            width: 100vw;
        }
    </style>
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Master Data
                    </div>
                    <h2 class="page-title">
                        Add Office
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="#" class="btn btn-warning d-none d-sm-inline-block" data-bs-toggle="modal"
                            data-bs-target="#modal-report">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back-up"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M9 14l-4 -4l4 -4"></path>
                                <path d="M5 10h11a4 4 0 1 1 0 8h-1"></path>
                            </svg>
                            Back
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl d-flex gap-2 flex-column">
            @php
                $success = Session::get('success');
                $error = Session::get('errors');
            @endphp

            @if ($success)
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
                            {{ $success }}
                        </div>
                    </div>
                    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                </div>
            @endif

            <div class="card">
                <div class="card-header card-header-light">

                </div>
                <div class="card-body">
                    <form action="/kantor/store" method="POST" id="frmKaryawan" enctype="multipart/form-data">
                        @csrf
                        <div class="d-flex gap-4">
                            <div class="w-full">
                                <div class="mb-3">
                                    <div class="input-icon">
                                        <span class="input-icon-addon" style="height: 40px;">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-building" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M3 21l18 0"></path>
                                                <path d="M9 8l1 0"></path>
                                                <path d="M9 12l1 0"></path>
                                                <path d="M9 16l1 0"></path>
                                                <path d="M14 8l1 0"></path>
                                                <path d="M14 12l1 0"></path>
                                                <path d="M14 16l1 0"></path>
                                                <path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16"></path>
                                            </svg>
                                        </span>
                                        <input type="text" name="nm_kantor" id="nm_kantor"
                                            class="form-control @error('nm_kantor') is-invalid @enderror"
                                            placeholder="Office Name" value="{{ old('nm_kantor') }}">
                                        @error('nm_kantor')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>

                                <div class="mb-3">
                                    <div class="input-icon mb-3">
                                        <span class="input-icon-addon" style="height: 40px;">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-current-location" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                                                <path d="M12 12m-8 0a8 8 0 1 0 16 0a8 8 0 1 0 -16 0"></path>
                                                <path d="M12 2l0 2"></path>
                                                <path d="M12 20l0 2"></path>
                                                <path d="M20 12l2 0"></path>
                                                <path d="M2 12l2 0"></path>
                                            </svg>
                                        </span>
                                        <input type="number" name="radius" id="radius"
                                            class="form-control @error('radius') is-invalid @enderror"
                                            placeholder="Office Radius" value="{{ old('radius') }}">
                                        @error('radius')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="input-icon mb-3">
                                        <span class="input-icon-addon" style="height: 40px;">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-map" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M3 7l6 -3l6 3l6 -3v13l-6 3l-6 -3l-6 3v-13"></path>
                                                <path d="M9 4v13"></path>
                                                <path d="M15 7v13"></path>
                                            </svg>
                                        </span>
                                        <input type="text" name="location" id="location"
                                            class="form-control @error('location') is-invalid @enderror"
                                            style="background: #f1eded" placeholder="Office Location"
                                            value="{{ old('location') }}" readonly>
                                        @error('location')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="input-icon mb-3">
                                        <span class="input-icon-addon" style="height: 40px;">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-brand-google-maps" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M12 9.5m-2.5 0a2.5 2.5 0 1 0 5 0a2.5 2.5 0 1 0 -5 0"></path>
                                                <path d="M6.428 12.494l7.314 -9.252"></path>
                                                <path d="M10.002 7.935l-2.937 -2.545"></path>
                                                <path d="M17.693 6.593l-8.336 9.979"></path>
                                                <path
                                                    d="M17.591 6.376c.472 .907 .715 1.914 .709 2.935a7.263 7.263 0 0 1 -.72 3.18a19.085 19.085 0 0 1 -2.089 3c-.784 .933 -1.49 1.93 -2.11 2.98c-.314 .62 -.568 1.27 -.757 1.938c-.121 .36 -.277 .591 -.622 .591c-.315 0 -.463 -.136 -.626 -.593a10.595 10.595 0 0 0 -.779 -1.978a18.18 18.18 0 0 0 -1.423 -2.091c-.877 -1.184 -2.179 -2.535 -2.853 -4.071a7.077 7.077 0 0 1 -.621 -2.967a6.226 6.226 0 0 1 1.476 -4.055a6.25 6.25 0 0 1 4.811 -2.245a6.462 6.462 0 0 1 1.918 .284a6.255 6.255 0 0 1 3.686 3.092z">
                                                </path>
                                            </svg>
                                        </span>
                                        <input type="text" name="longitude" id="longitude"
                                            class="form-control @error('longitude') is-invalid @enderror"
                                            style="background: #f1eded" placeholder="Longitude"
                                            value="{{ old('longitude') }}" readonly>
                                        @error('longitude')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="input-icon mb-3">
                                        <span class="input-icon-addon" style="height: 40px;">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-brand-google-maps" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M12 9.5m-2.5 0a2.5 2.5 0 1 0 5 0a2.5 2.5 0 1 0 -5 0"></path>
                                                <path d="M6.428 12.494l7.314 -9.252"></path>
                                                <path d="M10.002 7.935l-2.937 -2.545"></path>
                                                <path d="M17.693 6.593l-8.336 9.979"></path>
                                                <path
                                                    d="M17.591 6.376c.472 .907 .715 1.914 .709 2.935a7.263 7.263 0 0 1 -.72 3.18a19.085 19.085 0 0 1 -2.089 3c-.784 .933 -1.49 1.93 -2.11 2.98c-.314 .62 -.568 1.27 -.757 1.938c-.121 .36 -.277 .591 -.622 .591c-.315 0 -.463 -.136 -.626 -.593a10.595 10.595 0 0 0 -.779 -1.978a18.18 18.18 0 0 0 -1.423 -2.091c-.877 -1.184 -2.179 -2.535 -2.853 -4.071a7.077 7.077 0 0 1 -.621 -2.967a6.226 6.226 0 0 1 1.476 -4.055a6.25 6.25 0 0 1 4.811 -2.245a6.462 6.462 0 0 1 1.918 .284a6.255 6.255 0 0 1 3.686 3.092z">
                                                </path>
                                            </svg>
                                        </span>
                                        <input type="text" name="latitude" id="latitude"
                                            class="form-control @error('latitude') is-invalid @enderror"
                                            style="background: #f1eded" placeholder="Latitude"
                                            value="{{ old('latitude') }}" readonly>
                                        @error('latitude')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-device-floppy" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2">
                                            </path>
                                            <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                            <path d="M14 4l0 4l-6 0l0 -4"></path>
                                        </svg>
                                        Save
                                    </button>
                                </div>
                            </div>
                            <div id="map" style="z-index: 99;"></div>
                        </div>


                    </form>

                </div>
            </div>


        </div>
    </div>
    </div>
@endsection

@push('myscript')
    <script>
        var MARKERS_MAX = 1;
        var RADIUS_MAX = 1;
        var NEW_RADIUS = 20;

        var osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        });

        var osmHOT = L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors, Tiles style by Humanitarian OpenStreetMap Team hosted by OpenStreetMap France'
        });

        var map = L.map('map', {
            center: [-6.620957270326323, 109.32527427841454],
            zoom: 7,
            layers: [osm]
        });

        var baseMaps = {
            "OpenStreetMap": osm,
            "OpenStreetMap.HOT": osmHOT
        };

        var layerControl = L.control.layers(baseMaps).addTo(map);

        // a layer group, used here like a container for markers
        var markersGroup = L.layerGroup();
        map.addLayer(markersGroup);

        map.on('click', function(e) {
            // get the count of currently displayed markers
            var markersCount = markersGroup.getLayers().length;

            if (markersCount < MARKERS_MAX) {
                var marker = L.marker(e.latlng).addTo(markersGroup)

                let lat = marker._latlng.lat;
                let lng = marker._latlng.lng;

                let data = $.get('https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=' + lat +
                    '&lon=' +
                    lng,
                    function(data) {
                        $('#location').val(data.display_name)
                        $('#latitude').val(lat)
                        $('#longitude').val(lng)
                        setTimeout(() => {
                            marker.bindPopup(data.display_name)
                                .openPopup();
                            $('#radius').prop("disabled", false);
                            $('#radius').focus();
                        }, 300);
                    }
                );

                if (markersCount < RADIUS_MAX) {
                    var circle = L.circle([lat, lng], {
                        color: 'red',
                        fillColor: '#f03',
                        fillOpacity: 0.5,
                        radius: NEW_RADIUS
                    }).addTo(markersGroup);
                } else {
                    markersGroup.clearLayers();
                }
                return;
            }

            // remove the markers when MARKERS_MAX is reached
            markersGroup.clearLayers();
        });

        $('#radius').on('change', function() {
            NEW_RADIUS = $(this).val();
            markersGroup.clearLayers();

            let checkRadius = $('#radius').val()
            let checkLocation = $('#location').val()

            if (checkRadius != '' && checkLocation != '') {
                console.log('ada')
                setTimeout(() => {
                    mapReady()
                }, 300);
            } else {
                console.log('Location masih kosong')
            }
        });



        function mapReady() {
            let zoomOut = 15;
            if (NEW_RADIUS <= 80) {
                zoomOut = 18
            } else if (NEW_RADIUS <= 150) {
                zoomOut = 17
            } else if (NEW_RADIUS <= 300) {
                zoomOut = 16
            } else if (NEW_RADIUS <= 600) {
                zoomOut = 15
            }

            map.flyTo([$('#latitude').val(), $('#longitude').val()], zoomOut, {
                animate: true,
                duration: 2
            });

            L.circle([$('#latitude').val(), $('#longitude').val()], {
                color: 'red',
                fillColor: '#f03',
                fillOpacity: 0.5,
                radius: NEW_RADIUS
            }).addTo(markersGroup);

        }

        // IF DATA EXIST
        let locationExist = $('#location').val();
        let latitudeExist = $('#latitude').val();
        let longitudeExist = $('#longitude').val();

        if (locationExist != '' && latitudeExist != '' && longitudeExist != '') {
            let zoomOut2 = 15;
            if (NEW_RADIUS <= 80) {
                zoomOut2 = 18
            } else if (NEW_RADIUS <= 150) {
                zoomOut2 = 17
            } else if (NEW_RADIUS <= 300) {
                zoomOut2 = 16
            } else if (NEW_RADIUS <= 600) {
                zoomOut2 = 15
            }

            map.flyTo([$('#latitude').val(), $('#longitude').val()], zoomOut2, {
                animate: true,
                duration: 2
            });

            setTimeout(() => {
                L.circle([$('#latitude').val(), $('#longitude').val()], {
                    color: 'red',
                    fillColor: '#f03',
                    fillOpacity: 0.5,
                    radius: NEW_RADIUS
                }).addTo(markersGroup);
            }, 1200);

        }
    </script>
@endpush
