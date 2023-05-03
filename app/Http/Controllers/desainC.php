<?php

namespace App\Http\Controllers;

use App\Models\siswaInduk;
use App\Models\kelasM;
use App\Models\jurusanM;
use Illuminate\Http\Request;
use DB;
use Hash;

class desainC extends Controller
{
    public function index(Request $request)
    {
        $keyword = empty($request->keyword)?"":$request->keyword;

        $kelas = DB::connection('mysql2')->table('kelas')->get();
        $jurusan = DB::connection('mysql2')->table('jurusan')->get();

        $pkelas = empty($request->kelas)?"":$request->kelas;
        $pjurusan = empty($request->jurusan)?"":$request->jurusan;

        $siswaInduk = new siswaInduk;
        $siswaInduk->setConnection('mysql2');

        $siswa = $siswaInduk->join('kelas', 'kelas.idkelas', 'siswa.idkelas')
        ->join('jurusan', 'jurusan.idjurusan', 'siswa.idjurusan')
        ->where(function ($query) use ($keyword){
            $query->where('siswa.nama', 'like', "%$keyword%")
            ->orWhere('jurusan.jurusan', 'like', "$keyword%")
            ->orWhere('kelas.kelas', 'like', "$keyword%");
        })
        ->orderBy('kelas.kelas', 'asc')
        ->orderBy('jurusan.jurusan', 'desc')
        ->orderBy('siswa.nama', 'asc')
        ->where('kelas.idkelas','like', $pkelas."%")
        ->where('jurusan.idjurusan','like', $pjurusan."%")
        ->select('siswa.*', 'kelas.kelas', 'jurusan.jurusan', 'jurusan.namajurusan')
        // ->orderBy()
        ->paginate(15);

        $jml = $siswaInduk->join('kelas', 'kelas.idkelas', 'siswa.idkelas')
        ->join('jurusan', 'jurusan.idjurusan', 'siswa.idjurusan')
        ->where(function ($query) use ($keyword){
            $query->where('siswa.nama', 'like', "%$keyword%")
            ->orWhere('jurusan.jurusan', 'like', "$keyword%")
            ->orWhere('kelas.kelas', 'like', "$keyword%");
        })
        ->orderBy('kelas.kelas', 'asc')
        ->orderBy('jurusan.jurusan', 'desc')
        ->orderBy('siswa.nama', 'asc')
        ->where('kelas.idkelas','like', $pkelas."%")
        ->where('jurusan.idjurusan','like', $pjurusan."%")
        ->select('siswa.*', 'kelas.kelas', 'jurusan.jurusan', 'jurusan.namajurusan')
        // ->orderBy()
        ->count();

        $siswa->appends($request->only(['keyword', 'limit', 'kelas', 'jurusan']));

        return view('pages.pagesDesain', [
            'siswa' => $siswa,
            'kelas' => $kelas,
            'jurusan' => $jurusan,

            'pkelas' => $pkelas,
            'pjurusan' => $pjurusan,
            'jml' => $jml,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function updategambar(Request $request, $idsiswa)
    {
        $request->validate([
            'gambar_utama' => 'required|mimes:png,jpg',
        ]);

        try {
            if ($request->hasFile('gambar_utama')) {
                $originName = $request->file('gambar_utama')->getClientOriginalName();
                $fileName = pathinfo($originName, PATHINFO_FILENAME);
                $extension = $request->file('gambar_utama')->getClientOriginalExtension();

                $format = strtolower($extension);
                if($format == 'jpg' || $format == 'jpeg' || $format == 'png') {
                    $fileName = $fileName.'_'.time().'.'.$extension;
                    $upload = $request->file('gambar_utama')->move(\base_path() ."/public/gambar/siswa", $fileName);

                    $update = siswaInduk::where('idsiswa', $idsiswa)->update([
                        'gambar' => $fileName,
                    ]);
                    if($update) {
                        return redirect()->back()->with('toast_success', 'Success')->withInput();
                    }
                }

            }

            return redirect()->back()->with('toast_error', 'terjadi kesalahan')->withInput();
        } catch (\Throwable $th) {
            return redirect()->back()->with('toast_error', 'terjadi kesalahan')->withInput();
            //throw $th;
        }

    }
}
