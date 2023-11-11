@extends('layout.layoutAdmin')

@section('activekuCekCard')
    activeku
@endsection

@section('judul')
    <i class="fa fa-check"></i> Identitas Kartu
@endsection

@section('content')
  
  
  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
      <p class="text-success text-center text-uppercase">Silahkan Scan Kartu Pada RFID Reader</p>
        
      @livewire("cek-kartu")
      
    </div>
  </div>


@endsection


@section('myScript')
