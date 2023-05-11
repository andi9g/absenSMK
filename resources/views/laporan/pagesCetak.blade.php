@php
    $w = 332.03937008 * 3.125;
    $h = 210.06448819 * 3.125;
    // $photo = 56.590551181 * 3.125;
    $photo = 55.590551181 * 3.125;
    $p = 1 * 3.125;

@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        @page {
            margin:0px;
        }
        body   {
            margin-left: 65px;
            margin-top: 200px;
        }
        .kartu {
            border: 1px solid rgb(204, 204, 204);
            width: <?php echo $w;?>px;
            height: <?php echo $h;?>px;
            margin: 15px;
            display: inline-block;
            background: url('gambar/kartu/kartu2.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            border-radius: 30px;
        }

        .lh {
            line-height: 37px;
        }

        .photo {
            border:5px solid white;
        }
        .identitas {
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            text-align: justify;
            font-weight: bold;
        }
        h3 {
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }

        .cetak {
            margin: 0;
            padding: 0;
        }
        /* @media print{
            @page {size: landscape}
            @page { margin: 0px; }
        body { margin: 0px; }
        } */

    </style>
</head>
<body>

    <div class="cetak">


    @foreach ($siswa as $item)
    <div class="kartu">
        <table border="0" style="width:100%;height:100%">
            <tr>
                <td height="100%" width="35%" align="center">
                    <br><br>
                    <img src="{{ url('gambar/siswa', [$item->gambar]) }}" alt="" style="width:{{$photo}}px;margin-top:5px;" class="photo">

                    <p style="font-family:Arial, Helvetica, sans-serif;margin:0;padding: 0px auto;margin:0px auto;color:rgb(57, 26, 230);font-size:6.5pt;line-height: 20px;margin-top: 17px"><b>NISN</b></p>
                    <hr width="43%" style="padding: 0px auto;margin:0px auto">
                    <p style="font-family:Arial, Helvetica, sans-serif;margin:0;padding: 0px auto;margin:0px auto;color:rgb(57, 26, 230);font-size:6.5pt;font-weight: bold">{{$item->nisn}}</p>
                </td>
                <td valign="top" style="padding: 30px" class="identitas">
                    <br><br><br>
                    <table style="font-size: 6pt;border-collapse: collapse;@if($item->jurusan=='DPIB' || $item->jurusan=='ATPH')
                        margin-top:22px
                    @else
                        margin-top:45px
                    @endif" border="0" class="lh">
                        <tr style="background: rgba(194, 194, 194, 0.356)">
                            <td valign="top"  >Nama</td>
                            <td valign="top">:&nbsp;</td>
                            <td valign="top">{{(strtoupper($item->nama))}}</td>
                        </tr>
                        <tr >
                            <td valign="top">Jurusan</td>
                            <td valign="top">:</td>
                            <td valign="top">{{$item->namajurusan}} ({{$item->jurusan}})
                            </td>
                        </tr>
                        <tr style="background: rgba(194, 194, 194, 0.356)">
                            <td valign="top">TTL</td>
                            <td valign="top">:</td>
                            <td valign="top">{{ucwords(strtolower($item->tempatlahir))}}, {{Carbon\Carbon::parse($item->tanggallahir)->isoFormat('DD MMMM Y')}}</td>
                        </tr>
                        <tr>
                            <td valign="top">Alamat </td>
                            <td valign="top">:</td>
                            <td valign="top" style="padding: 5px 0px;line-height: normal">
                                @php
                                    $teks = $item->alamat;
                                    $jumlah = strlen($teks);
                                    
                                    $ekor = mb_substr($teks, -2);
                                    $ekor = str_replace(",", "", $ekor);
                                    $teks = substr($teks, 0, ($jumlah-2));
                                    $teks = $teks.$ekor;
                                @endphp
                                {{$teks}}</td>
                        </tr>
                    </table>

                </td>
            </tr>
        </table>
    </div>

    @endforeach



    </div>







</body>
</html>

