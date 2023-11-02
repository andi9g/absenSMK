<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class absenM extends Model
{
    use HasFactory;
    protected $table = 'absen';
    protected $primaryKey = 'idabsen';

    public function jurusan()
    {
        return $this->hasOne(jurusanM::class, 'idjurusan', 'idjurusan');
    }

    public function kelas()
    {
        return $this->hasOne(kelasM::class, 'idkelas', 'idkelas');
    }

    public function siswa()
    {
        return $this->hasOne(siswaM::class, 'idsiswa', 'idsiswa');
    }

}
