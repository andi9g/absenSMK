<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class siswaInduk extends Model
{
    use HasFactory;
    protected $table = 'siswa';
    protected $primaryKey = 'idsiswa';
    protected $guarded = [];
    protected $connection = 'mysql2';
}
