<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = "tugas";


    protected $fillable = [
        'driver_id',
        'mobil_id',
        'admin_id',
        'penugasan',
        'etol',
        'bbm',
        'tanggal',
        'status',
    ];

    public $timestamps = false;

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function mobil()
    {
        return $this->belongsTo(Car::class, 'mobil_id', 'nopol');
    }

    public function lokasi()
    {
        return $this->hasMany(Location::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class);
    }

    public function destinations()
    {
        return $this->hasMany(Destination::class, );
    }
}
