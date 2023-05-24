@extends('layout.login')

@section('title')
    Kehadiran Siswa
@endsection

@section('kehadiran')
    active
@endsection


@section('content')

<div class="container my-3 mb-5">
    <form action="{{ url()->current() }}">
        <div class="row">
            <div class="col-md-3">
                <div class='form-group'>
                    <input type='date' name='tanggal' onchange="submit()" id='fortanggal' class='form-control' value="{{$tanggal}}">
                </div>
            </div>
            <div class="col-md-3">
                <div class='form-group'>
                    <select name="jurusan" class="form-control" onchange="submit()">
                        <option value="">Seluruh Jurusan</option>
                        @foreach ($datajurusan as $j)
                            <option value="{{$j->idjurusan}}" class="text-capitalize" @if ($j->idjurusan == $jurusan)
                                selected
                            @endif>{{$j->namajurusan}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
                <div class="col-md-3">
                    <div class='form-group'>
                        <select name="kelas" class="form-control" onchange="submit()">
                            <option value="">Seluruh Kelas</option>
                            @foreach ($datakelas as $j)
                                <option value="{{$j->idkelas}}" class="text-capitalize" @if ($j->idkelas == $kelas)
                                    selected
                                @endif>{{$j->namakelas}}</option>
                            @endforeach
                        </select>
                    </div>
            </div>
            <div class="col-md-3">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" value="{{empty($_GET['keyword'])?'':$_GET['keyword']}}" name="keyword" placeholder="Berdasarkan Nama" aria-describedby="button-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-success" type="submit" id="button-addon2">Cari</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="row">
        <div class="col-md-12">
            <div class="card text-left table-responsive">
              <img class="card-img-top" src="holder.js/100px180/" alt="">
              <div class="card-body">
                <h4 class="card-title">
                    Kehadiran Siswa/i pada hari <b>{{\Carbon\Carbon::parse($tanggal)->isoFormat('dddd, DD MMMM Y')}}</b>
                </h4>
                @php
                    $hari = \Carbon\Carbon::parse($tanggal)->isoFormat('dddd');

                @endphp
                @if ($hari === "Minggu" || $hari === "Sabtu")
                <br>
                <h3 class="font-weight">HARI LIBUR</h3>
                @else
                <table class="table table-sm table-hover table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kls</th>
                            <th>Ket.</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($siswa as $item)
                            <tr>
                                <td nowrap width="5px">{{$loop->iteration + $siswa->firstItem() - 1 }}</td>
                                <td>{{ucwords(strtolower($item->namasiswa))}}</td>
                                <td nowrap class="text-center">
                                    {{$item->namakelas}}
                                </td>
                                <td>
                                    @php
                                        $cek = DB::table('absen')->where('nis', $item->nis)
                                        ->where('tanggal', $tanggal);
                                    @endphp
                                    @if ($cek->count() > 0)
                                        @if ($cek->first()->ket == "H")
                                        <font class="text-success text-bold">
                                            HADIR
                                        </font>
                                        @elseif ($cek->first()->ket == "S")
                                        <font class="text-warning text-bold">
                                            SAKIT
                                        </font>
                                        @elseif ($cek->first()->ket == "I")
                                        <font class="text-info text-bold">
                                            IZIN
                                        </font>
                                        @endif
                                    @else
                                        <font class="text-danger">
                                            Tidak Hadir
                                        </font>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif

              </div>
              @if (!($hari === "Minggu" || $hari === "Sabtu"))
              <div class="card-footers">

                {{$siswa->links('vendor.pagination.bootstrap-4')}}
              </div>
              @endif
            </div>

        </div>
    </div>
</div>



@endsection
