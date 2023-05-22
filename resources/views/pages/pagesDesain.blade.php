@extends('layout.layoutAdmin')

@section('activekuDesain')
    activeku
@endsection

@section('judul')
    <i class="fa fa-users"></i> Cetak Kartu
@endsection


@section('atas')
<script src="https://code.jquery.com/jquery-3.5.0.slim.min.js" integrity="sha256-MlusDLJIP1GRgLrOflUQtshyP0TwT/RHXsI1wWGnQhs=" crossorigin="anonymous"></script>
<link href="{{ url('select2/dist/css/select2.min.css', []) }}" rel="stylesheet" />
<script src="{{ url('select2/dist/js/select2.min.js', []) }}"></script>
@endsection


<style>
    span .select2-selection__choice__display {
        color: black;
    }
</style>
@section('content')


<div class="row">
    <div class="col-md-12">

        <a href="{{ route('cetak.berdasarkan', [empty($pkelas)?'0':$pkelas, empty($pjurusan)?'0':$pjurusan]) }}" target="_blank" class="btn btn-danger my-2">
            <i class="fa fa-print"></i> CETAK KARTU
        </a>

        <a href="{{ route('cetak.belakang')}}" target="_blank" class="btn btn-secondary my-2">
            <i class="fa fa-print"></i> CETAK BELAKANG
        </a>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#nisncetak">
          <i class="fa fa-print"></i> NISN
        </button>

        <!-- Modal -->
        <div class="modal fade" id="nisncetak" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">CETAK</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>

                    <form action="{{ route('cetak.nisn', []) }}" method="get" target="_blank">
                    <div class="modal-body">

                        <select required class="form-control pilihannisn text-dark" name="nisn[]" style="width:100%" multiple="multiple">
                            <option value="">Pilih</option>
                            @foreach ($nisndata as $id)
                                <option value="{{$id->nisn}}">{{$id->nisn." - ".$id->nama}}</option>

                            @endforeach

                        </select>
                        <script>
                            $(".pilihannisn").select2({
                                tags: true
                            });
                        </script>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
                </div>
            </div>
        </div>

    </div>
</div>
<form action="{{ url()->current() }}" class="d-block ">
    <div class="row">
        <div class="col-md-8 d-inline">
            <div class="row">
                <div class="col-md-4">
                    <select name="kelas" id="" class="form-control" onchange="submit()">
                        <option value="">Keseluruhan</option>
                        @foreach ($kelas as $item)
                            <option value="{{$item->idkelas}}" @if ($item->idkelas == $pkelas)
                                selected
                            @endif>{{$item->kelas}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <select name="jurusan" id="" class="form-control" onchange="submit()">
                        <option value="">Keseluruhan</option>
                        @foreach ($jurusan as $item)
                            <option value="{{$item->idjurusan}}" @if ($item->idjurusan == $pjurusan)
                                selected
                            @endif>{{$item->jurusan}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-4 d-inline" >

                <div class="input-group mb-3">
                    <input type="text" class="form-control" value="{{empty($_GET['keyword'])?'':$_GET['keyword']}}" name="keyword" aria-describedby="button-addon2">
                    <div class="input-group-append">
                    <button class="btn btn-outline-success" type="submit" id="button-addon2">Cari</button>
                    </div>
                </div>

            </div>
    </div>
</form>

    <div class="card">
        <div class="card-body">
            <h5 class="text-right py-0 my-0">Jumlah Siswa : <b>{{$jml}}</b></h5>
            <table class="table table-striped table-bordered table-sm">
                <thead class="bg-secondary">
                    <tr>
                        <th>No</th>
                        <th>NISN</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Jurusan</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($siswa as $item)
                    <tr>
                        <td width="1%">{{$loop->iteration + $siswa->firstItem() - 1}}</td>
                        <td width="1%">{{$item->nisn}}</td>
                        <td class="text-bold">{{ucwords(strtolower($item->nama))}}</td>
                        <td width="5%" align="center">{{$item->kelas}}</td>
                        <td width="5%" align="center">{{$item->jurusan}}</td>
                        <td>
                            @if (!empty($item->gambar))
                            <font class="text-success">Tersedia</font>
                            @else
                            <font class="text-danger">Tidak Tersedia</font>
                            @endif
                        </td>
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="badge badge-primary border-0 py-1" data-toggle="modal" data-target="#tambahgambar{{$item->idsiswa}}">
                              <i class="fa fa-image"></i> Tambar Gambar
                            </button>

                            <a target="_blank" href="{{ route('cetak.satuan', [$item->nisn]) }}" class="badge badge-danger border-0 py-1">
                                <i class="fa fa-print"></i> Kartu Ujian
                            </a>
                        </td>
                    </tr>


                    <!-- Modal -->
                    <div class="modal fade" id="tambahgambar{{$item->idsiswa}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Gambar <b>{{ucwords(strtolower($item->nama))}}</b></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <form action="{{ route('update.gambar', [$item->idsiswa]) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="modal-body">
                                        <div class="text-center">
                                            <img src="{{ url('/gambar/siswa', [$item->gambar]) }}" width="30%" alt="">

                                        </div>
                                        <div class="form-group">
                                            <label for="">Masukan Gambar</label>
                                            <input type="file" name="gambar_utama" id="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            {{$siswa->links('vendor.pagination.bootstrap-4')}}
        </div>
    </div>


@endsection

@section('myScript')
@include('layout.layoutJS')
@endsection

