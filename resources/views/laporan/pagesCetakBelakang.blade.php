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
            background: url('gambar/kartu/belakang.jpg');
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

        @for ($i=0; $i<9; $i++)
        <div class="kartu">

        </div>

        @endfor




    </div>







</body>
</html>

