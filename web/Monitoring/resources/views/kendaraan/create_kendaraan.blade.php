@extends('layout.main')
@section('content')



<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">

        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Kendaraan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Tambah kendaraan</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('car.store') }}" method="POST">
                @csrf
                <div class="row">
                  <!-- left column -->
                  <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                      <div class="card-header">
                        <h3 class="card-title">Form Tambah Kendaraan</h3>
                      </div>
                      <!-- /.card-header -->
                      <!-- form start -->
                      <form>
                        <div class="card-body">
                          <div class="form-group">
                            <label for="exampleInputEmail1">No Polisi</label>
                            <input type="text" name="nopol" class="form-control" id="nopol" placeholder="Masukkan No Polisi">
                            @error('nopol')
                            <small>{{ $message }}</small>
                            @enderror
                        </div>
                          <div class="form-group">
                            <label for="exampleInputPassword1">Jenis Kendaraan</label>
                            <input type="text" name="jenisKendaraan" class="form-control" id="jenisKendaraan" placeholder="Masukkan Jenis Kendaraan">
                            @error('jenisKendaraan')
                            <small>{{ $message }}</small>
                            @enderror
                        </div>
                            <div class="form-group">
                              <label for="exampleInputEmail2">Tahun</label>
                              <input type="text" name="tahun" class="form-control" id="tahun" placeholder="Masukkan Tahun">
                              @error('tahun')
                              <small>{{ $message }}</small>
                              @enderror
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                      </form>
                    </div>
                    <!-- /.card -->
                  </div>
                  <!--/.col (left) -->
                </div>
            </form>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>


  </div>



@endsection
