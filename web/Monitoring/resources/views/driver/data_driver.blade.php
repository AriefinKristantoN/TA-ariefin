@extends('layout.main')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Driver</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Driver</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div><!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-12">
                    <a href="#" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modal-create">Tambah Data</a>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Driver</h3>

                            <div class="card-tools">
                                <form action="{{ route('admin.driver.search') }}" method="GET">
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
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>No Telp</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $d)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $d->nama }}</td>
                                        <td>{{ $d->alamat }}</td>
                                        <td>{{ $d->notelp }}</td>
                                        <td>
                                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal-edit{{ $d->id }}"><i class="fas fa-pen"></i> Edit</a>
                                            <a data-toggle="modal" data-target="#modal-hapus{{ $d->id }}" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Hapus</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Driver</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form tambah data -->
                <form action="{{ route('admin.driver.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama Driver</label>
                        <input type="text" name="nama" class="form-control" id="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat Driver</label>
                        <input type="text" name="alamat" class="form-control" id="alamat" required>
                    </div>
                    <div class="form-group">
                        <label for="notelp">No Telp Driver</label>
                        <input type="text" name="notelp" class="form-control" id="notelp" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit -->
@foreach ($data as $d)
<div class="modal fade" id="modal-edit{{ $d->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Driver</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form edit data -->
                <form action="{{ route('admin.driver.update', ['id' => $d->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nama">Nama Driver</label>
                        <input type="text" name="nama" class="form-control" id="nama" value="{{ $d->nama }}" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat Driver</label>
                        <input type="text" name="alamat" class="form-control" id="alamat" value="{{ $d->alamat }}" required>
                    </div>
                    <div class="form-group">
                        <label for="notelp">No Telp Driver</label>
                        <input type="text" name="notelp" class="form-control" id="notelp" value="{{ $d->notelp }}" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Modal Hapus -->
@foreach ($data as $d)
<div class="modal fade" id="modal-hapus{{ $d->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah kamu yakin akan menghapus data dari driver <b>{{ $d->nama }}</b> ?</p>
            </div>
            <div class="modal-footer">
                <form action="{{ route('admin.driver.delete',['id' => $d->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-primary">Ya, Hapus</button>
                </form>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection
