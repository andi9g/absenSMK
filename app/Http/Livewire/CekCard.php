<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\adminM;
use Session;

class CekCard extends Component
{
    public $uid;

    public function render()
    {
        $iduser = Session::get('id');
        $this->uid = adminM::where("id", $iduser)->first()->value;
        // dd($this->uid);
        return view('livewire.cek-card');
    }
}
