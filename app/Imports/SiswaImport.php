<?php

namespace App\Imports;

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

        $siswa = siswaM::where("nama", ucwords(strtolower($row['nama'])))->where("tanggallahir", $row['tanggallahir'])->count();

        // dd($siswa);

        $rombel = explode(" ",$row["rombel"]);

        if($rombel[1] == "TKJ") {
            $juru = "TJKT";
        }else {
            $juru = $rombel[1];
        }
        $idjurusan = jurusanM::where("jurusan", $juru)->first()->idjurusan;
        $idkelas = kelasM::where("kelas", $rombel[0])->first()->idkelas;
        
        

        if($siswa == 0) {
            // dd(ucwords(strtolower($row['nama'])));
            return new siswaM([
                'namasiswa'  => ucwords(strtolower($row['nama'])),
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
