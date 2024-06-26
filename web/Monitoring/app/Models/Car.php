<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $table = "kendaraan";

    protected $fillable = ['nopol', 'jenisKendaraan','tahun',];
    public $timestamps = false;

    protected $primaryKey = 'nopol';
    public $incrementing = false;

    public function tasks()
    {
        return $this->hasMany(Task::class, 'mobil_id', 'nopol');
    }
}
