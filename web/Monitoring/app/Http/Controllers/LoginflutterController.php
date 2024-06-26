<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Driver;

class LoginflutterController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'notelp' => 'required|string',
        ]);

        $driver = Driver::where('notelp', $request->notelp)->first();

        if ($driver) {
            return response()->json([
                'status' => 'success',
                'message' => 'Login successful',
                'id' => $driver->id,
                'nama' => $driver->nama,
                'notelp' => $driver->notelp,
                'alamat' => $driver->alamat,
            ], 200);
        } else {
            return response()->json([
                'status' => 'fail',
                'message' => 'Invalid phone number',
            ], 401);
        }
    }
}
