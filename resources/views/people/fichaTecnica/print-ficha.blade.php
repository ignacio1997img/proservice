<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Entrega de fondos</title>
    <link rel="shortcut icon" href="{{ asset('images/icon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body{
            margin: 0px auto;
            font-family: Arial, sans-serif;
            font-weight: 100;
            max-width: 640px;
        }
        #watermark {
            position: absolute;
            opacity: 0.1;
            z-index:  -1000;
        }
        #watermark img{
            position: relative;
            width: 300px;
            height: 300px;
            left: 205px;
        }
        .show-print{
            display: none;
            padding-top: 15px
        }
        .btn-print{
            padding: 5px 10px
        }
        @media print{
            .hide-print, .btn-print{
                display: none
            }
            .show-print, .border-bottom{
                display: block
            }
            .border-bottom{
                border-bottom: 1px solid rgb(90, 90, 90);
                padding: 20px 0px;
            }
        }




        #subtitle{
            font-size: 40px;
            font-weight: bold;
        }
    </style>
</head>

{{-- <tr>
    <td><img src="{{ asset('storage/'.str_replace('.', '-cropped.',$busine->busine->image)) }}" alt="GYM" width="80px"></td>
    <td style="text-align: right">
        <h3 style="margin-bottom: 0px; margin-top: 5px">CAJAS - {{$busine->busine->name}}<br> <small>ENTREGA DE FONDOS</small> </h3>
    </td>
</tr> --}}
<body>
    <div class="hide-print" style="text-align: right; padding: 10px 0px">
        <button class="btn-print" onclick="window.close()">Cancelar <i class="fa fa-close"></i></button>
        <button class="btn-print" onclick="window.print()"> Imprimir <i class="fa fa-print"></i></button>
    </div>
    @for ($i = 0; $i < 2; $i++)
    <div style="height: 120vh" @if ($i == 1) class="show-print" @else class="border-bottom" @endif>
        <h3 id="subtitle" style="text-align: center"><span style="color:rgb(13, 86, 221)">Trabajos</span><span style="color:rgb(255,157,0)">TOP</span></h3></td>

        <table width="100%" style="font-size: 20px">
            <tr>
                <td>
                    <table width="100%" cellpadding="10">
                        <tr>
                            <td width="35%" style="color:rgb(13, 86, 221); background-color:rgb(229,243,254); border-radius: 10px"><b>Nombre:</b></td>
                            <td style="color:rgb(1, 1, 1); background-color:rgb(229,243,254); border-radius: 10px">........</td>
                        </tr>
                        <tr>
                            <td width="35%" style="color:rgb(13, 86, 221); background-color:rgb(229,243,254); border-radius: 10px"><b>Fecha de Nacimiento:</b></td>
                            <td style="color:rgb(1, 1, 1); background-color:rgb(229,243,254); border-radius: 10px">........</td>
                        </tr>
                        <tr>
                            <td width="35%" style="color:rgb(13, 86, 221); background-color:rgb(229,243,254); border-radius: 10px"><b>Nacionalidad:</b></td>
                            <td style="color:rgb(1, 1, 1); background-color:rgb(229,243,254); border-radius: 10px">........</td>
                        </tr>
                        <tr>
                            <td width="15%" style="color:rgb(13, 86, 221); background-color:rgb(229,243,254); border-radius: 10px"><b>Estatura:</b></td>
                            <td width="15%" style="color:rgb(1, 1, 1); background-color:rgb(229,243,254); border-radius: 10px"><b>.....</b></td>
                            <td width="15%" style="color:rgb(13, 86, 221); background-color:rgb(229,243,254); border-radius: 10px"><b>Peso:</b></td>
                            <td width="15%" style="color:rgb(1, 1, 1); background-color:rgb(229,243,254); border-radius: 10px"><b>.....</b></td>                            
                        </tr>
                        <tr>
                            <td width="35%" style="color:rgb(13, 86, 221); background-color:rgb(229,243,254); border-radius: 10px"><b>Talla Superior:</b></td>
                            <td style="color:rgb(1, 1, 1); background-color:rgb(229,243,254); border-radius: 10px"> .......</td>
                        </tr>
                        <tr>
                            <td width="35%" style="color:rgb(13, 86, 221); background-color:rgb(229,243,254); border-radius: 10px"><b>Talla Inferior:</b></td>
                            <td style="color:rgb(1, 1, 1); background-color:rgb(229,243,254); border-radius: 10px">.......</td>
                        </tr>
                        <tr>
                            <td width="10%"></td>
                            <td width="40%" style="color:rgb(13, 86, 221); background-color:rgb(229,243,254); border-radius: 10px"><b>Nro Calzados:</b></td>
                            <td width="40%" style="color:rgb(1, 1, 1); background-color:rgb(229,243,254); border-radius: 10px">........</td>
                            <td width="10%"></td>
                        </tr>
                        <tr>
                            <td width="10%"></td>
                            <td width="80%" style="text-align: center"><h3 style="font-size: 25px"><span style="color:rgb(255, 255, 255); background-color:rgb(13, 86, 221); border-radius: 10px" >Experiencias:</span></h3></td>
                            <td width="10%"></td>
                        </tr>
                        <tr>
                            <td width="5%"></td>
                            <td width="90%" style="color:rgb(13, 86, 221); background-color:rgb(229,243,254); border-radius: 10px"><input type="checkbox" id="cbox1" value="first_checkbox"><b>Pasarelas</b></td>
                            <td width="5%"></td>
                        </tr>
                        <tr>
                            <td width="5%"></td>
                            <td width="90%" style="color:rgb(13, 86, 221); background-color:rgb(229,243,254); border-radius: 10px"><input type="checkbox" id="cbox1" value="first_checkbox"><b>Fotografias</b></td>
                            <td width="5%"></td>
                        </tr>
                        <tr>
                            <td width="5%"></td>
                            <td width="90%" style="color:rgb(13, 86, 221); background-color:rgb(229,243,254); border-radius: 10px"><input type="checkbox" id="cbox1" value="first_checkbox"><b>Publicidades</b></td>
                            <td width="5%"></td>
                        </tr>
                        <tr>
                            <td width="30%"><img src="{{ asset('images/redes/facebook.png') }}" alt="GYM" width="35px"></td>
                            <td style="color:rgb(13, 86, 221); background-color:rgb(229,243,254); border-radius: 10px"><b>Peso:</b></td>
                        </tr>
                        <tr>
                            <td width="30%"><img src="{{ asset('images/redes/instagram.png') }}" alt="GYM" width="35px"></td>
                            <td style="color:rgb(13, 86, 221); background-color:rgb(229,243,254); border-radius: 10px"><b>Peso:</b></td>
                        </tr>
                        <tr>
                            <td width="30%"><img src="{{ asset('images/redes/tiktok.png') }}" alt="GYM" width="35px"></td>
                            <td style="color:rgb(13, 86, 221); background-color:rgb(229,243,254); border-radius: 10px"><b>Peso:</b></td>
                        </tr>
                        
                       
                    </table>
                </td>
            </tr>
        </table>
    </div>
    @endfor

    <script>
        document.body.addEventListener('keypress', function(e) {
            switch (e.key) {
                case 'Enter':
                    window.print();
                    break;
                case 'Escape':
                    window.close();
                default:
                    break;
            }
        });
    </script>
</body>
</html>