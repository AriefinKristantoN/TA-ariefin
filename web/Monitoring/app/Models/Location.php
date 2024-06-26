<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    protected $table = 'lokasi';

    protected $fillable = [
        'mobil_id', 'latitude', 'longitude', 'created_at', 'updated_at',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
