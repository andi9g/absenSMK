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
            <div class="col-md-6">
                <div class='form-group'>
                    <input type='date' name='tanggal' onchange="submit()" id='fortanggal' class='form-control' value="{{$tanggal}}">
                </div>
            </div>
            <div class="col-md-6">
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
                    Kehadiran Siswa pada hari <b>{{\Carbon\Carbon::parse($tanggal)->isoFormat('dddd, DD MMMM Y')}}</b>
                </h4>

                <table class="table table-sm table-hover table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Ket.</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($siswa as $item)
                            <tr>
                                <td nowrap width="5px">{{$loop->iteration + $siswa->firstItem() - 1 }}</td>
                                <td>{{ucwords(strtolower($item->namasiswa))}}</td>
                                <td>
                                    @if (!empty($item->tanggal))
                                        @if ($item->ket == "H")
                                        <font class="text-success text-bold">
                                            HADIR
                                        </font>
                                        @elseif ($item->ket == "S")
                                        <font class="text-warning text-bold">
                                            SAKIT
                                        </font>
                                        @elseif ($item->ket == "I")
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

              </div>
              <div class="card-footers">
                {{$siswa->links('vendor.pagination.bootstrap-4')}}
              </div>
            </div>

        </div>
    </div>
</div>



@endsection
