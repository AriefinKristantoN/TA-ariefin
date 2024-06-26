<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $table = "driver";

    protected $fillable = ['nama', 'alamat', 'notelp'];
    public $timestamps = false;

    protected $primaryKey = 'id';

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
