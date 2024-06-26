<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function dashboard(Request $request){
        // Ambil nilai pencarian dari input form
    $search = $request->input('search');

    // Query untuk mencari kendaraan berdasarkan nopol atau jenis kendaraan
    $kendaraan = Car::where('nopol', 'LIKE', '%' . $search . '%')
                    ->orWhere('jenisKendaraan', 'LIKE', '%' . $search . '%')
                    ->get();

        $lokasi = Location::all();
        return view('dashboard', compact('kendaraan', 'lokasi'));
    }

    public function create(){
        return view('kendaraan/create_kendaraan');
    }

    public function store(Request $request){
        // Validasi input
        $validator = Validator::make($request->all(),[
            'nopol' => 'required',
            'jenisKendaraan' => 'required',
            'tahun' => 'required',
        ]);

        // Jika validasi gagal, kembali ke halaman sebelumnya dengan pesan kesalahan
        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        // Buat objek kendaraan baru
        $kendaraan['nopol'] = $request->nopol;
        $kendaraan['jenisKendaraan'] = $request->jenisKendaraan;
        $kendaraan['tahun'] = $request->tahun;

        // Simpan objek kendaraan baru
        Car::create($kendaraan);

        // Redirect kembali ke dashboard dengan pesan sukses
        return redirect()->route('admin.dashboard');
    }


    public function edit(Request $request,$nopol){
        $kendaraan = Car::find($nopol);

        return view('kendaraan/edit_kendaraan',compact('kendaraan'));
    }

    public function update(Request $request,$nopol){
        $validator = Validator::make($request->all(), [
            'nopol' => 'required',
            'jenisKendaraan' => 'required',
            'tahun' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        // Temukan data_driver berdasarkan ID
        $kendaraan = Car::find($nopol);

        // Perbarui nilai kolom dengan data yang diterima dari form
        $kendaraan->nopol = $request->nopol;
        $kendaraan->jenisKendaraan = $request->jenisKendaraan;
        $kendaraan->tahun = $request->tahun;


        // Simpan perubahan
        $kendaraan->save();
        return redirect()->route('admin.dashboard');

    }

    public function delete(Request $request,$nopol){
        $kendaraan = Car::find($nopol);

        if ($kendaraan) {
            // Hapus data lokasi yang berhubungan terlebih dahulu
            Location::where('mobil_id', $nopol)->delete();

            // Hapus data kendaraan
            $kendaraan->delete();
        }

        return redirect()->route('admin.dashboard');
    }

    // public function getLokasiTerbaru()
    // {
    //     $lokasi = Location::all();
    //     return response()->json($lokasi);
    // }

//     public function search(Request $request)
// {
//     $search = $request->input('search');

//     // Query untuk mencari kendaraan berdasarkan nopol atau jenis kendaraan
//     $kendaraan = Car::where('nopol', 'LIKE', '%' . $search . '%')
//                     ->orWhere('jenisKendaraan', 'LIKE', '%' . $search . '%')
//                     ->get();

//     // Load ulang view dashboard dengan data hasil pencarian
//     return view('dashboard', compact('kendaraan'));
// }

}


