<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class siswaM extends Model
{
    use HasFactory;
    protected $table = 'siswa';
    protected $primaryKey = 'nis';
    protected $guarded = [];
    protected $connection = "mysql";

    public function jurusan()
    {
        return $this->hasOne(jurusanM::class, 'idjurusan', 'idjurusan');
    }

    public function kelas()
    {
        return $this->hasOne(kelasM::class, 'idkelas', 'idkelas');
    }
    public function absen()
    {
        return $this->belongsTo(absenM::class, 'nis', 'nis');
    }

}
