<?php

namespace App\Http\Controllers;

use App\Models\siswaInduk;
use Illuminate\Http\Request;
use PDF;

class kartuC extends Controller
{
    public function cetak(Request $request, $kelas, $jurusan)
    {
        $pkelas = ($kelas==0)?"":$kelas;
        $pjurusan = ($jurusan==0)?"":$jurusan;

        // dd($pkelas);
        $siswaInduk = new siswaInduk;
        $siswaInduk->setConnection('mysql2');
        $siswa = $siswaInduk->join('kelas', 'kelas.idkelas', 'siswa.idkelas')
        ->join('jurusan', 'jurusan.idjurusan', 'siswa.idjurusan')
        ->orderBy('kelas.kelas', 'asc')
        ->orderBy('jurusan.jurusan', 'desc')
        ->orderBy('siswa.nama', 'asc')
        ->where('siswa.gambar', "!=", null)
        ->where('kelas.idkelas','like', $pkelas."%")
        ->where('jurusan.idjurusan','like', $pjurusan."%")
        ->select('siswa.*', 'kelas.kelas', 'jurusan.jurusan', 'jurusan.namajurusan')
        ->get();




        $pdf = PDF::LoadView('laporan.pagesCetak', [
            'siswa' => $siswa,
        ])->setPaper('a4', 'landscape');

        return $pdf->stream('buka.pdf');
    }

    public function cetakbelakang(Request $request)
    {
        $pdf = PDF::LoadView('laporan.pagesCetakBelakang')->setPaper('a4', 'landscape');

        return $pdf->stream('buka.pdf');
    }
}
