<?php

namespace App\Http\Controllers;

use App\Models\siswaM;
use App\Models\kelasM;
use App\Models\kelulusanM;
use Illuminate\Http\Request;

class kenaikankelasC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cek = kelasM::where("namakelas", "lulus")->count();
        if($cek == 0) {
            kelasM::insert([
                "namakelas" => "lulus",
            ]);
        }

        $kelas = kelasM::get();

        return view("pages.pageskenaikankelas", [
            "kelas" => $kelas,
        ]);

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
        $request->validate([
            'judulkelulusan' => "required",
            'tahun' => "required|max:4",
            'kelas' => "required|numeric",
            'kelas2' => "required|numeric",
        ]);

        // try {
            $judulkelulusan = $request->judulkelulusan;
            $tahun = $request->tahun;
            $kelas = $request->kelas;
            $kelas2 = $request->kelas2;

            $cek = siswaM::where('idkelas', $kelas)->count();
            if($cek>0) {
                $tambah = new kelulusanM;
                $tambah->judulkelulusan = $judulkelulusan;
                $tambah->tahun = $tahun;
                $tambah->save();


                $idkelulusan = $tambah->idkelulusan;
                $siswa = siswaM::where('idkelas', $kelas)->get();
                foreach ($siswa as $s) {
                    dd(siswaM::where("nis", $s->nis)->count());
                    siswaM::where("nis", $s->nis)->update([
                        "idkelas" => $kelas2,
                        "idkelulusan" => $idkelulusan,
                    ]);
                }

                return redirect()->back()->with("toast_success","selamat kelas berhasil ditingkatkan")->withInput();
            }else {
                return redirect()->back()->with("toast_error","tidak ada data ditemukan")->withInput();

            }


        // } catch (\Throwable $th) {
        //     return redirect()->back()->withInput();
        // }
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
