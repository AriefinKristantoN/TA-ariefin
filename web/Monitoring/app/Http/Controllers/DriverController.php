<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DriverController extends Controller
{

//data driver
public function index(){

    $data = Driver::get();
    return view('driver/data_driver', compact('data'));
}

public function create(){
    return view('driver/create_driver');
}

public function store(Request $request){

    $validator = Validator::make($request->all(),[
        'nama' => 'required',
        'alamat' => 'required',
        'notelp' => 'required',
    ]);

    if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

    $data['nama'] = $request->nama;
    $data['alamat'] = $request->alamat;
    $data['notelp'] = $request->notelp;

    Driver::create($data);
    return redirect()->route('admin.driver.data');
}

public function edit(Request $request,$id){
    $data = Driver::find($id);

    return view('driver/edit_driver',compact('data'));
}

public function update(Request $request,$id){
    $validator = Validator::make($request->all(), [
        'nama' => 'required',
        'alamat' => 'required',
        'notelp' => 'required',
    ]);

    if($validator->fails()) {
        return redirect()->back()->withInput()->withErrors($validator);
    }

    // Temukan data_driver berdasarkan ID
    $data = Driver::find($id);

    // Perbarui nilai kolom dengan data yang diterima dari form
    $data->nama = $request->nama;
    $data->alamat = $request->alamat;
    $data->notelp = $request->notelp;

    // Simpan perubahan
    $data->save();
    return redirect()->route('admin.driver.data');

}

public function delete(Request $request,$id){
    $data = Driver::find($id);

    if($data){
         $data->delete();
    }

    return redirect()->route('admin.driver.data');
}
public function search(Request $request)
{
    $search = $request->input('search');

    // Query untuk mencari driver berdasarkan nama
    $data = Driver::where('nama', 'LIKE', '%' . $search . '%')->get();

    return view('driver/data_driver', compact('data'));
}
}
