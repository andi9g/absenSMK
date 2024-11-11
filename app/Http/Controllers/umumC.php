<?php

namespace App\Http\Controllers;

use App\Models\siswaM;
use App\Models\absenM;
use App\Models\jurusanM;
use App\Models\kelasM;
use Illuminate\Http\Request;

class umumC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function root(Request $request)
    {
        $tanggal = empty($request->tanggal)?date('Y-m-d'):$request->tanggal;
        $keyword = empty($request->keyword)?"":$request->keyword;
        $jurusan = empty($request->jurusan)?"":$request->jurusan;
        $kelas = empty($request->kelas)?"":$request->kelas;
        $kehadiran = empty($request->kehadiran)?"hadir":$request->kehadiran;


        $djurusan = jurusanM::get();
        $dkelas = kelasM::get();

        // $siswa = siswaM::join('kelas', 'kelas.idkelas', 'siswa.idkelas')
        // ->join('jurusan', 'jurusan.idjurusan', 'siswa.idjurusan')
        // ->where("siswa.namasiswa", 'like', "%$keyword%")
        // ->where("jurusan.idjurusan", 'like', "$jurusan%")
        // ->where("kelas.idkelas", 'like', "$kelas%")
        // ->select('siswa.*', 'kelas.namakelas','jurusan.namajurusan')
        // ->with(["jurusan", "kelas"])
        // ->paginate(15);


        $hadir = absenM::where("tanggal", date("Y-m-d"))->pluck("nis")->toArray();

        // dd($hadir);
        if($kehadiran == "hadir") {
            $siswa = siswaM::whereIn("nis", $hadir)
            ->where("namasiswa", "like", "%$keyword%")
            ->whereHas("jurusan", function ($query) use ($jurusan){
                if(!empty($jurusan)) {
                    $query->where("namajurusan", "like", "$jurusan%");
                }
            })
            ->whereHas("kelas", function ($query) use ($kelas){
                if(!empty($kelas)) {
                    $query->where("namakelas", "like", "$kelas%");
                }
            })
            ->whereHas("absen", function ($query) use ($tanggal){
                    $query->where("tanggal", "$tanggal");
            })
            ->where("idkelas", "!=", 4)
            ->orderBy("namasiswa", "asc")
            ->paginate(15);
        }else {
            $siswa = siswaM::whereNotIn("nis", $hadir)
            ->where("namasiswa", "like", "%$keyword%")
            ->whereHas("jurusan", function ($query) use ($jurusan){
                if(!empty($jurusan)) {
                    $query->where("namajurusan", "like", "$jurusan%");
                }
            })
            ->whereHas("kelas", function ($query) use ($kelas){
                if(!empty($kelas)) {
                    $query->where("namakelas", "like", "$kelas%");
                }
            })
            ->where("idkelas", "!=", 4)
            ->orderBy("namasiswa", "asc")
            ->paginate(15);
        }

        $siswa->appends($request->only(['limit', 'keyword', 'tanggal', 'jurusan', 'kelas', "kehadiran"]));



        return view('pages.pagesShow1', [
            'siswa' => $siswa,
            'tanggal' => $tanggal,
            'keyword' => $keyword,
            'jurusan' => $jurusan,
            'kelas' => $kelas,
            "hadir" => $kehadiran,
            'datajurusan' => $djurusan,
            'datakelas' => $dkelas,
        ]);
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\siswaM  $siswaM
     * @return \Illuminate\Http\Response
     */
    public function show(siswaM $siswaM)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\siswaM  $siswaM
     * @return \Illuminate\Http\Response
     */
    public function edit(siswaM $siswaM)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\siswaM  $siswaM
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, siswaM $siswaM)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\siswaM  $siswaM
     * @return \Illuminate\Http\Response
     */
    public function destroy(siswaM $siswaM)
    {
        //
    }
}
