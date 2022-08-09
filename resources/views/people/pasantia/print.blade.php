@extends('layouts.print-template')

@section('page_title', 'Pasantía')

@section('content')
<div id="watermark">
    <br>
    <br>
    <br>
    <br>
    <img src="{{ asset('images/icon.png') }}" /> 
</div>

    <table id="dataTable" style="width: 100%; font-size: 12px" border="1" cellspacing="0" cellpadding="5">
            <tr bgcolor="#0088ff">   
                <th colspan="6" style="color: rgb(255, 255, 255); font-size:20px;">Formulario de Postulación a Pasantías en<br><span style="font-size: 25px">Trabajos</span><span style="color:rgb(255,157,0); font-size: 25px">TOP</span></th>                             
            </tr>
            <tr bgcolor="#eeeef5">   
                <th colspan="6" style="text-align: left; font-size:15px;">1. DATOS GENERALES DEL POSTULANTE </th>  
				{{-- <th colspan="2" rowspan="5" valign="top">CROQUIS UBICACION</th> --}}
            </tr>
            @php
                $image = \Auth::user();
                $image = asset('storage/'. $image->avatar);
            @endphp
            <tr>
                <th colspan="2" style="text-align: center">Apellido Paterno</th>
                <th style="text-align: center">Nombres</th>
                <th style="text-align: center">Sexo</th>
				<th colspan="2" rowspan="4" width="100px" style="text-align: center">
                    <img src="{{ $image }}" alt="{{ $people->first_name }}" style="width: 60px; height: 60px; border-radius: 30px; margin-right: 10px">
                </th>

			</tr>
            <tr>
                <td colspan="2" style="text-align: center">{{$people->last_name}}</td>
                {{-- <td style="text-align: center">Apellido Materno</td> --}}
                <td style="text-align: center">{{$people->first_name}}</td>
                <td style="text-align: center">{{$people->sex==1? 'Masculino':'Femenino'}}</td>
			</tr>
            <tr>
                <th style="text-align: center">Cedula Identidad</th>
                <th style="text-align: center">Teléfono domicilio</th>
                <th style="text-align: center">Teléfono celular</th>
                <th style="text-align: center">Correo electronico</th>
			</tr>
            <tr>
                <td style="text-align: center">{{$people->ci}}</td>
                <td style="text-align: center">{{$people->phone2? $people->phone2:'S/N'}}</td>
                <td style="text-align: center">{{$people->phone1? $people->phone1:'S/N'}}</td>
                <td style="text-align: center">{{$people->email}}</td>
			</tr>

            <tr>
                <th style="text-align: center">Fecha de Nacimiento</th>
                <th style="text-align: center">Nacionalidad</th>
                <th colspan="3" style="text-align: center">Domicilio Actual</th>
			</tr>
            <tr>
                <td style="text-align: center">{{\Carbon\Carbon::parse($people->birth_date)->format('d/m/Y')}}</td>
                <td style="text-align: center">Bolivia</td>
                <td colspan="3" style="text-align: center">{{$people->address}}</td>
			</tr>

            


           

    </table>
    <table id="dataTable" style="width: 100%; font-size: 12px" border="1" cellspacing="0" cellpadding="5">

        <tr bgcolor="#eeeef5">  
            <th colspan="6" style="text-align: left; font-size:15px;" valign="top">2. INFORMACIÓN SOBRE LA FORMACIÓN ACADÉMICA</th>  
        </tr>
        <tr bgcolor="#eeeef5">  
            <th colspan="6" style="text-align: left; font-size:15px;" valign="top">2.1  Máximo nivel académico alcanzado</th>  
        </tr>
        <tr>
            <th colspan="2" style="text-align: center">Estudiante Univ. o Egresado</th>
            <th style="text-align: center">Semestre</th>
            <th colspan="3" style="text-align: center">Carrera/Area de Formación</th>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center">{{$pasantia->type?$pasantia->type:'S/N'}}</td>
            <td style="text-align: center">{{$pasantia->semester?$pasantia->semester:'S/N'}}</td>
            <td colspan="3" style="text-align: center">{{$pasantia->profession->name}}</td>

        </tr>


        <tr>
            <th colspan="6" style="text-align: left">Universidad / Institución Académica / Centro de Enseñanza Superior</th>
        </tr>
        <tr>
            <td colspan="6" style="text-align: left">{{$pasantia->institution}}</td>
        </tr>
    </table>
    <table id="dataTable" style="width: 100%; font-size: 12px" border="1" cellspacing="0" cellpadding="5">
        <tr bgcolor="#eeeef5">  
            <th colspan="6" style="text-align: left; font-size:15px;" valign="top">2.2 Cursos realizados <small style="font-size: 10px">(Relacionados al área de la pasantía)</small></th>  
        </tr>

        <tr>
            <th colspan="2" style="text-align: center">Desde</th>
            <th colspan="2" style="text-align: center">Hasta</th>
            <th rowspan="2" style="text-align: center">Universidad - Institución</th>
            <th rowspan="2" style="text-align: center">Curso</th>
        </tr>
        <tr>
            <th style="text-align: center">Mes</th>
            <th style="text-align: center">Año</th>
            <th style="text-align: center">Mes</th>
            <th style="text-align: center">Año</th>
        </tr>
        @if (count($courses) > 0)
            @foreach ($courses as $item)
                <tr>
                    <td style="text-align: center">{{\Carbon\Carbon::parse($item->start)->format('m')}}</td>
                    <td style="text-align: center">{{\Carbon\Carbon::parse($item->start)->format('Y')}}</td>
                    <td style="text-align: center">{{\Carbon\Carbon::parse($item->finish)->format('m')}}</td>
                    <td style="text-align: center">{{\Carbon\Carbon::parse($item->finish)->format('Y')}}</td>
                    <td style="text-align: center">{{$item->institution}}</td>
                    <td style="text-align: center">{{$item->name}}</td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="6" style="text-align: center">Ninguno</td>
            </tr>
        @endif
        



        <tr bgcolor="#eeeef5">  
            <th colspan="6" style="text-align: left; font-size:15px;" valign="top">3. OBJETIVO DE LA PASANTÍA<small style="font-size: 10px"> (Detallar objetivo por el que postula a la pasantía en YPFB)</small></th>  
        </tr>

        <tr>
            <td colspan="6" style="text-align: left">{{$pasantia->objetive}}</td>
        </tr>

        <tr bgcolor="#eeeef5">  
            <th colspan="6" style="text-align: left; font-size:15px;" valign="top">4. DECLARACIÓN JURADA Y AUTORIZACIÓN DE VERIFICACIÓN DE INFORMACIÓN</small></th>  
        </tr>
        <tr>
            <td colspan="6" style="text-align: left">Declaro que toda la información que se presenta en el formulario es verdadera y que estoy en condiciones de sustentarla con documentos originales en caso de ser solicitado o elegido. Asimismo, 
                autorizo a la Dirección de Recursos Humanos de TrabajosTop a verificar si el caso lo amerite.</td>
        </tr>      

    </table>
    <br>
        
        <div class="row" style="text-align: center">
            <div class="text-center col-3">
                
            </div>
            <div class="text-center col-6">
                <br>
                <br>
                <br>
                .........................
                <br>
                <b>Firma</b>
                <br>
            </div>
            <div class="text-center col-3">
                
            </div>
        </div>

        <div class="row">
            <div class="text-center col-6">
                
            </div>
            
            <div class="text-center col-6" style="text-align: right">
                <b>Fecha: </b>{{\Carbon\Carbon::parse(\Carbon\Carbon::now())->format('d/m/Y')}}
            </div>
        </div>


    <style>
        #dataTable {
    font-family: Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
    }

    #dataTable td, #dataTable th {
    /* border: 0px solid #ddd; */
    padding: 8px;
    color: black;
    }


    #watermark {
            position: absolute;
            opacity: 0.3;
            z-index:  -1000;
        }
        #watermark img{
            position: relative;
            width: 150px;
            height: 100px;
            /* left: 205px; */
        }
    /* #dataTable tr:nth-child(even){background-color: #f2f2f2;} */

    /* #dataTable tr:hover {background-color: #ddd;} */

    </style>

@endsection