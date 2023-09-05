@extends('layout.layoutAdmin')

@section('activekukenaikankelas')
    activeku
@endsection


@section('judul')
    <i class="fa fa-door-open"></i> Data kenaikan Kelas
@endsection




@section('content')

<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4>KELOLA KENAIKAN KELAS</h4>
            </div>
            <form action="{{ route('naikan.kelas', []) }}" method="post">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="judulkelulusan">Keterangan Kenaikan</label>
                        <input id="judulkelulusan" class="form-control" placeholder="contoh: naik kelas" type="text" name="judulkelulusan">
                    </div>

                    <div class="form-group">
                        <label for="tahun">Tahun Kenaikan</label>
                        <select id="tahun" class="form-control" name="tahun">
                            @php
                                $awal = ((int)date("Y")) - 5;
                                $akhir = ((int)date("Y")) + 2;
                                $sekarang = (int)date("Y");
                            @endphp
                            @for ($i=$awal;$i<= $akhir; $i++)
                            <option value="{{$i}}" @if ($i==$sekarang)
                                selected
                            @endif>{{$i}}</option>

                            @endfor
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="kelas1">Kelas</label>
                        <select id="kelas1" class="form-control" name="kelas">
                            @foreach ($kelas as $item)
                                @if ($item->namakelas!="lulus")
                                <option value="{{$item->idkelas}}">{{$item->namakelas}}</option>

                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="kelas2">Pindah Ke Kelas</label>
                        <select id="kelas2" class="form-control" name="kelas2">
                            @foreach ($kelas as $item)
                                <option value="{{$item->idkelas}}">{{strtoupper($item->namakelas)}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="bnt btn-success" onclick="return confirm('Yakin ingin melanjutkan proses kenaikan?')">PROSES</button>

                </div>
            </form>
        </div>
    </div>
</div>


@endsection

@section('myScript')
@include('layout.layoutJS')
@endsection
