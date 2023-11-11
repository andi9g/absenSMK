<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\cardM;
use App\Models\adminM;
use Session;

class CekKartu extends Component
{
    public $uid, $nis, $namasiswa, $ket;

    public function render()
    {
        $id = Session::get('id');
        $admin = adminM::where('id', $id)->first();

        $card = cardM::where('uid', $admin->value)->first();
       
        $this->uid = $admin->value;
        $this->nis = empty($card->nis)?"tidak ditemukan":sprintf("%010s", $card->nis);
        $this->namasiswa = empty($card->siswa->namasiswa)?"tidak ditemukan":$card->siswa->namasiswa;
        $this->ket = empty($card->ket)?"tidak ditemukan":$card->ket;

        return view('livewire.cek-kartu');
    }
}
