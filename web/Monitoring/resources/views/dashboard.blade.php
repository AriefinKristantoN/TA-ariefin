@extends('layout.main')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <a href="#" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modal-tambah">Tambah Data</a>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Kendaraan</h3>
                        <div class="card-tools">
                            <form action="{{ route('admin.dashboard') }}" method="GET">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="search" class="form-control float-right" placeholder="Search">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>No Polisi</th>
                                    <th>Jenis Kendaraan</th>
                                    <th>Tahun</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kendaraan as $k)
                                <tr>
                                    <td>{{ $k->nopol }}</td>
                                    <td>{{ $k->jenisKendaraan }}</td>
                                    <td>{{ $k->tahun }}</td>
                                    <td>
                                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal-edit-{{ $k->nopol }}"><i class="fas fa-pen"></i> Edit</a>
                                        <a data-toggle="modal" data-target="#modal-hapus-{{ $k->nopol }}" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Hapus</a>
                                        {{-- <a href="#" class="btn btn-info"><i class="fas fa-map-marker"></i> Tracking </a> --}}
                                    </td>
                                </tr>
                                <div class="modal fade" id="modal-edit-{{ $k->nopol }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Edit Data Kendaraan</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Form edit data -->
                                                <form action="{{ route('admin.car.update',['nopol' => $k->nopol]) }}" method="POST" id="form-edit-{{ $k->nopol }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <label for="edit-nopol">No Polisi</label>
                                                        <input type="text" class="form-control" id="edit-nopol" name="nopol" value="{{ $k->nopol }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="edit-jenisKendaraan">Jenis Kendaraan</label>
                                                        <input type="text" class="form-control" id="edit-jenisKendaraan" name="jenisKendaraan" value="{{ $k->jenisKendaraan }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="edit-tahun">Tahun</label>
                                                        <input type="text" class="form-control" id="edit-tahun" name="tahun" value="{{ $k->tahun }}">
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="modal-hapus-{{ $k->nopol }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Konfirmasi Hapus Data</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Apakah kamu yakin akan menghapus data dari kendaraan <b>{{ $k->nopol }}</b> ?</p>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <form action="{{ route('admin.car.delete',['nopol' => $k->nopol]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-primary">Ya, Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>
<!-- /.content -->

<!-- Modal Tambah Data -->
<div class="modal fade" id="modal-tambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Kendaraan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form tambah data -->
                <form action="{{ route('admin.car.store') }}" method="POST" id="form-tambah">
                    @csrf
                    <div class="form-group">
                        <label for="nopol">No Polisi</label>
                        <input type="text" class="form-control" id="nopol" name="nopol">
                        @error('nopol')
                        <small>{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="jenisKendaraan">Jenis Kendaraan</label>
                        <input type="text" class="form-control" id="jenisKendaraan" name="jenisKendaraan">
                        @error('jenisKendaraan')
                            <small>{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="tahun">Tahun</label>
                        <input type="text" class="form-control" id="tahun" name="tahun">
                        @error('tahun')
                            <small>{{ $message }}</small>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if ($message = Session::get('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: '{{ $message }}',
    });
</script>
@endif

@if ($message = Session::get('failed'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Failed!',
        text: '{{ $message }}',
    });
</script>
@endif
     <!-- Map section -->
     <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Map</h3>
                </div>
                <div class="card-body">
                    <div style="width: 100%; height: 500px;" id="map"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.Map section -->

    <!-- Leaflet JavaScript -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        // Inisialisasi peta Leaflet
        var map = L.map('map', { attributionControl: false });

        // Tambahkan tile layer untuk menampilkan peta
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {}).addTo(map);

        // Inisialisasi objek untuk menampung koordinat berdasarkan mobil_id
        var coordinatesByMobilId = {};

        // Array warna untuk membedakan setiap mobil_id
        var colors = ['red', 'green', 'blue', 'purple', 'orange', 'cyan', 'magenta'];
        var colorIndex = 0;

        // Ambil data marker dari server
        @foreach($lokasi as $location)
            (function() {
                var latitude = {{ $location->latitude }};
                var longitude = {{ $location->longitude }};
                var mobil_id = "{{ $location->mobil_id }}";
                var created_at = "{{ $location->created_at }}";

                // Inisialisasi array koordinat untuk mobil_id jika belum ada
                if (!coordinatesByMobilId[mobil_id]) {
                    coordinatesByMobilId[mobil_id] = {
                        coords: [],
                        color: colors[colorIndex % colors.length] // Tentukan warna berdasarkan index
                    };
                    colorIndex++;
                }

                // Tambahkan marker untuk lokasi awal dan akhir
                if (coordinatesByMobilId[mobil_id].coords.length === 0) {
                    // Marker awal
                    var marker = L.marker([latitude, longitude]).addTo(map)
                        .bindPopup('Nomor Polisi: ' + mobil_id + '<br>Tanggal dan Waktu: ' + created_at);
                } else {
                    // Tambahkan marker titik bulat warna sesuai dengan warna mobil_id
                    var circle = L.circleMarker([latitude, longitude], {
                        radius: 5,
                        color: coordinatesByMobilId[mobil_id].color,
                        fillOpacity: 1
                    }).addTo(map);

                    // Tambahkan event click pada titik bulat
                    circle.on('click', function(e) {
                        var popup = L.popup()
                            .setLatLng(e.latlng)
                            .setContent('Nomor Polisi: ' + mobil_id + '<br>Tanggal dan Waktu: ' + created_at)
                            .openOn(map);
                    });
                }

                // Tambahkan koordinat marker ke array berdasarkan mobil_id
                coordinatesByMobilId[mobil_id].coords.push({
                    coords: [latitude, longitude],
                    created_at: created_at
                });
            })();
        @endforeach

        // Buat polyline untuk setiap mobil_id
        for (var mobil_id in coordinatesByMobilId) {
            var coordsArray = coordinatesByMobilId[mobil_id].coords.map(function(loc) {
                return loc.coords;
            });

            var polyline = L.polyline(coordsArray, {color: coordinatesByMobilId[mobil_id].color}).addTo(map);

            // Tambahkan marker untuk titik akhir
            var lastCoord = coordinatesByMobilId[mobil_id].coords[coordinatesByMobilId[mobil_id].coords.length - 1].coords;
            var lastCreatedAt = coordinatesByMobilId[mobil_id].coords[coordinatesByMobilId[mobil_id].coords.length - 1].created_at;
            L.marker(lastCoord).addTo(map)
                .bindPopup('Nomor Polisi: ' + mobil_id + '<br>Tanggal dan Waktu: ' + lastCreatedAt);
        }

        // Atur tampilan peta agar semua titik atau lintasan masuk dalam tampilan peta dengan zoom yang optimal
        var allCoordinates = Object.values(coordinatesByMobilId).flatMap(function(loc) {
            return loc.coords.map(function(coord) {
                return coord.coords;
            });
        });
        if (allCoordinates.length > 0) {
            var bounds = L.latLngBounds(allCoordinates);
            map.fitBounds(bounds);
        }
    </script>
@endsection

