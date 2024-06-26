<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    protected $table = "tujuan";

    protected $fillable = [
        'awal', 'akhir', 'tambahan','task_id'
    ];

    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }

    public $timestamps = false;
}
