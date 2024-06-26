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
              <li class="breadcrumb-item active">Tambah driver</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('driver.store') }}" method="POST">
                @csrf
                <div class="row">
                  <!-- left column -->
                  <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                      <div class="card-header">
                        <h3 class="card-title">Form Tambah Driver</h3>
                      </div>
                      <!-- /.card-header -->
                      <!-- form start -->
                      <form>
                        <div class="card-body">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Nama Driver</label>
                            <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan Nama">
                            @error('nama')
                            <small>{{ $message }}</small>
                            @enderror
                        </div>
                          <div class="form-group">
                            <label for="exampleInputPassword1">Alamat Driver</label>
                            <input type="text" name="alamat" class="form-control" id="alamat" placeholder="Masukkan Alamat">
                            @error('alamat')
                            <small>{{ $message }}</small>
                            @enderror
                          </div>
                          <div class="form-group">
                            <label for="exampleInputPassword1">No Telp Driver</label>
                            <input type="text" name="notelp" class="form-control" id="notelp" placeholder="Masukkan No Telp">
                            @error('notelp')
                            <small>{{ $message }}</small>
                            @enderror
                          </div>
                        </div>
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
