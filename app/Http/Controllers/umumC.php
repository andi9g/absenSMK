<?php

namespace App\Http\Controllers;

use App\Models\siswaM;
use App\Models\absenM;
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

        $siswa = siswaM::leftJoin('absen', 'absen.nis', 'siswa.nis')
        ->where("siswa.namasiswa", 'like', "%$keyword%")
        ->where('absen.tanggal', 'like', "$tanggal%")
        ->select('siswa.*', 'absen.tanggal', 'absen.ket')
        ->paginate(15);

        $siswa->appends($request->only(['limit', 'keyword', 'tanggal']));



        return view('pages.pagesShow1', [
            'siswa' => $siswa,
            'tanggal' => $tanggal,
            'keyword' => $keyword,
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
