@extends('layout.main')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Penugasan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Penugasan</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-12">
                    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#modal-create-task">Tambah Tugas</button>
                    {{-- <button class="btn btn-secondary mb-3" data-toggle="modal" data-target="#modal-create-destination">Tambah Tujuan</button> --}}
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Tugas</h3>

                            <div class="card-tools">
                                <form action="{{ route('admin.tasks.index') }}" method="GET">
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
                                        <th>Driver</th>
                                        <th>Mobil</th>
                                        <th>Penugasan</th>
                                        <th>Tanggal</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tasks as $task)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $task->driver->nama ?? 'N/A' }}</td>
                                        <td>{{ $task->mobil->nopol ?? 'N/A' }}</td>
                                        <td>{{ $task->penugasan }}</td>
                                        <td>{{ $task->tanggal }}</td>
                                        <td>
                                            @if ($task->status != 'finish')
                                                <form action="{{ route('admin.tasks.finish', ['task' => $task->id]) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-success btn-sm">Finish</button>
                                                </form>
                                            @else
                                                <span class="badge badge-success">Tugas Selesai</span>
                                            @endif

                                            @if ($task->status != 'finish')
                                                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-edit-task{{ $task->id }}">Edit</button>
                                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-hapus-task{{ $task->id }}">Delete</button>
                                            @endif
                                        </td>

                                    </tr>

                                    <!-- Modal Edit Task -->
                                    <div class="modal fade" id="modal-edit-task{{ $task->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Tugas</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Form edit data -->
                                                    <form action="{{ route('admin.tasks.update', ['task' => $task->id]) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group">
                                                            <label for="driver_id">Driver</label>
                                                            <select name="driver_id" class="form-control">
                                                                @foreach($drivers as $driver)
                                                                <option value="{{ $driver->id }}" {{ $task->driver_id == $driver->id ? 'selected' : '' }}>{{ $driver->nama }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="mobil_id">Mobil</label>
                                                            <select name="mobil_id" class="form-control">
                                                                @foreach($cars as $car)
                                                                <option value="{{ $car->nopol }}" {{ $task->mobil_id == $car->nopol ? 'selected' : '' }}>{{ $car->nopol }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="penugasan">Penugasan</label>
                                                            <input type="text" name="penugasan" class="form-control" id="penugasan" value="{{ $task->penugasan }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="tanggal">Tanggal</label>
                                                            <input type="date" name="tanggal" class="form-control" id="tanggal" value="{{ $task->tanggal }}" required>
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

                                    <!-- Modal Hapus Task -->
                                    <div class="modal fade" id="modal-hapus-task{{ $task->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus Data</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Apakah kamu yakin akan menghapus data dari penugasan <b>{{ $task->penugasan }}</b>?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('admin.tasks.destroy', ['task' => $task->id]) }}" method="POST">
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
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    {{-- <!-- Data Tujuan -->
                    <div class="card mt-5">
                        <div class="card-header">
                            <h3 class="card-title">Data Tujuan</h3>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tugas</th>
                                        <th>Tujuan Awal</th>
                                        <th>Tujuan Akhir</th>
                                        <th>Tujuan Tambahan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($destinations as $destination)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $destination->task->penugasan }}</td>
                                        <td>{{ $destination->awal }}</td>
                                        <td>{{ $destination->akhir }}</td>
                                        <td>{{ $destination->tambahan }}</td>
                                        <td>
                                            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-edit-destination{{ $destination->id }}">Edit</button>
                                            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-hapus-destination{{ $destination->id }}">Delete</button>
                                        </td>
                                    </tr>

                                    <!-- Modal Edit Destination -->
                                    <div class="modal fade" id="modal-edit-destination{{ $destination->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Tujuan</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Form edit data -->
                                                    <form action="{{ route('admin.destinations.update', ['destination' => $destination->id]) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group">
                                                            <label for="task_id">Tugas</label>
                                                            <select name="task_id" class="form-control">
                                                                @foreach($tasks as $task)
                                                                <option value="{{ $task->id }}" {{ $destination->task_id == $task->id ? 'selected' : '' }}>{{ $task->penugasan }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="awal">Tujuan Awal</label>
                                                            <input type="text" name="awal" class="form-control" id="awal" value="{{ $destination->awal }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="akhir">Tujuan Akhir</label>
                                                            <input type="text" name="akhir" class="form-control" id="akhir" value="{{ $destination->akhir }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="tambahan">Tujuan Tambahan</label>
                                                            <input type="text" name="tambahan" class="form-control" id="tambahan" value="{{ $destination->tambahan }}">
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

                                    <!-- Modal Hapus Destination -->
                                    <div class="modal fade" id="modal-hapus-destination{{ $destination->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus Data</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Apakah kamu yakin akan menghapus data dari tujuan <b>{{ $destination->awal }} - {{ $destination->akhir }}</b>?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('admin.destinations.destroy', ['destination' => $destination->id]) }}" method="POST">
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
</div> --}}

<!-- Modal Tambah Tugas -->
<div class="modal fade" id="modal-create-task" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Tugas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                 <!-- Form tambah data -->
                <form action="{{ route('admin.tasks.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="driver_id">Driver</label>
                        <select id="driver_id" name="driver_id" class="form-control">
                            @foreach($availableDrivers as $driver)
                                <option value="{{ $driver->id }}">{{ $driver->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="mobil_id">Mobil</label>
                        <select id="mobil_id" name="mobil_id" class="form-control">
                            @foreach($availableCars as $car)
                                <option value="{{ $car->nopol }}">{{ $car->nopol }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="penugasan">Penugasan</label>
                        <input type="text" name="penugasan" class="form-control" id="penugasan" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" id="tanggal" required>
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

<!-- Modal Tambah Tujuan -->
{{-- <div class="modal fade" id="modal-create-destination" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Tujuan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                 <!-- Form tambah data -->
                <form action="{{ route('admin.destinations.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="task_id">Tugas</label>
                        <select id="task_id" name="task_id" class="form-control">
                            @foreach($tasks as $task)
                                <option value="{{ $task->id }}">{{ $task->penugasan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="awal">Tujuan Awal</label>
                        <input type="text" name="awal" class="form-control" id="awal" required>
                    </div>
                    <div class="form-group">
                        <label for="akhir">Tujuan Akhir</label>
                        <input type="text" name="akhir" class="form-control" id="akhir" required>
                    </div>
                    <div class="form-group">
                        <label for="tambahan">Tujuan Tambahan</label>
                        <input type="text" name="tambahan" class="form-control" id="tambahan">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> --}}

@endsection
