<?php

namespace App\Imports;

use App\Models\siswaInduk;
use App\Models\siswaM;
use App\Models\kelasM;
use App\Models\jurusanM;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SiswaImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        $rt = empty($row['rt'])?"":"RT.".sprintf("%02s", $row['rt']);
        $rw = empty($row['rw'])?"":"RW.".sprintf("%02s", $row['rw']);
        $kelurahan = strtolower($row['kelurahan']);
        $kelurahan = str_replace("kel. ", "", $kelurahan);
        $kelurahan = str_replace("kel.", "", $kelurahan);
        $kelurahan = str_replace("kel", "", $kelurahan);
        $kelurahan = strtolower(empty($row['kelurahan'])?"":"Kel.".$kelurahan);
        
        $kecamatan = strtolower($row['kecamatan']);
        $kecamatan = str_replace("kec.", "", $kecamatan);
        $kecamatan = str_replace("kec", "", $kecamatan);
        $kecamatan = strtolower(empty($row['kecamatan'])?"":"Kec.".$kecamatan);
        
        $alamat = strtolower($row['alamat']).", ".$rt." ".$rw.", ".$kelurahan.", ".$kecamatan;
        $alamat = ucwords($alamat);
        $alamat = str_replace(", ,", ", ", $alamat);
        $alamat = str_replace(", , ,", ", ", $alamat);

        $siswa = siswaM::where("nis", sprintf("%010s", $row['nisn']))->count();

        // dd($siswa);

        $rombel = explode(" ",$row["rombel"]);

        if($rombel[1] == "TKJ") {
            $juru = "TJKT";
        }else {
            $juru = $rombel[1];
        }
        $idjurusan = jurusanM::where("namajurusan", $juru)->first()->idjurusan;
        
        $idkelas = kelasM::where("namakelas", $rombel[0])->first()->idkelas;
        
        $idsiswa = siswaInduk::orderBy("idsiswa", "desc")->first()->idsiswa;
        $idsiswa = $idsiswa + 1;

        if($siswa == 0) {
            // dd(ucwords(strtolower($row['nama'])));
            siswaM::create([
                'nis' => sprintf("%010s", $row['nisn']),
                'namasiswa'  => ucwords(strtolower($row['nama'])),
                'jk' => $row['jk'],
                'tahunmasuk' => date('Y'),
                "idjurusan" => $idjurusan,
                "idkelas" => $idkelas,
                "idkelulusan" => 2,
                "tanggallahir" => $row['tanggallahir'],
            ]);

            return new siswaInduk([
                // "idsiswa" => $idsiswa,
                'nama'  => ucwords(strtolower($row['nama'])),
                'jk' => $row['jk'],
                'nisn' => sprintf("%010s", $row['nisn']),
                'tempatlahir' => $row['tempatlahir'],
                'tanggallahir' => $row['tanggallahir'],
                'agama' => $row['agama'],
                'alamat' => $row['alamat'],
                "idjurusan" => $idjurusan,
                "idkelas" => $idkelas,
            ]);
        }
    }
}
