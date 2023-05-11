<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistem Informasi Absensi</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="icon" href="" type="image/x-icon">
  @include('layout.header')
  @yield('headers')
  <style>
    .nav-link{
        color: white !important;
    }
    .nav-link:hover{
        color: red !important;
        font-weight: bold;
    }
    .active {
        color: red !important;
        font-weight: bold;
    }
  </style>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand text-success" href="https://www.smkn1gunungkijang.sch.id"><b><font class="text-light">SMKN 1 GUNUNG KIJANG</font></b></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarScroll">
      <ul class="navbar-nav mr-auto my-2 my-lg-0 navbar-nav-scroll" style="max-height: 100px;">
        <li class="nav-item ">
          <a class="nav-link @yield('kehadiran')" href="{{ url('/', []) }}">Kehadiran Siswa </span></a>
        </li>
    </ul>
      <form class="d-flex">
        <a class="btn btn-outline-danger" href="{{ url('login', []) }}">Login</a>
      </form>
    </div>
  </nav>

  @yield('content')


@include('layout.script')

@yield('footers')
@yield('script')
</body>
</html>
