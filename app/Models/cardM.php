<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cardM extends Model
{
    use HasFactory;
    protected $table = 'card';
    protected $primaryKey = 'uid';
    protected $guarded = [];

    public function siswa()
    {
        return $this->hasOne(siswaM::class, 'nis', 'nis');
    }
}
