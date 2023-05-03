@extends('layout.login2')

@section('title')
    Login
@endsection
@section('headers')
<style>
    body {
    font-family: "Lato", sans-serif;
}



.main-head{
    height: 150px;
    background: #FFF;

}

.sidenav {
    height: 100%;
    background-color: #000;
    overflow-x: hidden;
    padding-top: 20px;
}


.main {
    padding: 0px 10px;
}

@media screen and (max-height: 450px) {
    .sidenav {padding-top: 15px;}
}

@media screen and (max-width: 450px) {
    .login-form{
        margin-top: 5%;
    }

    .register-form{
        margin-top: 5%;
    }
}

@media screen and (min-width: 768px){
    .main{
        margin-left: 40%;
    }

    .sidenav{
        width: 40%;
        position: fixed;
        z-index: 1;
        top: 0;
        left: 0;
    }

    .login-form{
        margin-top: 50%;
    }

    .register-form{
        margin-top: 50%;
    }
}


.login-main-text{
    margin-top: 10%;
    padding: 60px;
    color: #fff;
}

.login-main-text h2{
    font-weight: 300;
}

.btn-black{
    background-color: #000 !important;
    color: #fff;
}
</style>
@endsection

@section('content')
<div class="sidenav">
    <div class="login-main-text">
       <h2>ABSENSI SMKN 1 GUNUNG KIJANG<br> Login Page</h2>
       <p>Login here to access.</p>
       <a href="{{ url('/', []) }}" class="btn btn-danger btn-sm">Kembali Halaman Utama</a>
    </div>
 </div>
 <div class="main">
    <div class="col-md-6 col-sm-12">
       <div class="login-form">
            <form action="{{ route('login.proses', []) }}" method="post">
                @csrf
                <div class="form-group">
                    <label>User Name</label>
                    <input type="text" class="form-control" name="username" placeholder="User Name">
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password">
                </div>

                <div class="form-group">
                    <label>Sebagai</label>
                    <select name="sebagai" id="" class="form-control">
                        <option value="admin">Admin</option>
                        <option value="superadmin">Superadmin</option>

                    </select>
                </div>

                <button type="submit" class="btn btn-black mb-5">Login</button>
            </form>
       </div>
    </div>
 </div>
@endsection
