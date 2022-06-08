@extends('voyager::master')
{{-- @if(auth()->user()->hasPermission('browse_people-perfil-experience')) --}}
@section('page_title', 'Viendo Registros')

@section('page_header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <h1 class="page-title">
                    <i class="fa-solid fa-person-digging"></i> Datos Personales
                    &nbsp; &nbsp; 
                    <a href="{{ URL::previous()}}" class="btn btn-warning">
                        <i class="fa-solid fa-circle-left"></i>
                            Volver
                    </a>
                </h1>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div id="app">
        <div class="page-content browse container-fluid" >
            @include('voyager::alerts')
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-bordered">
                        <div class="panel-body">                            
                            <div class="table-responsive">
                                <main class="main">   
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <small>CI.</small>
                                                    <div class="form-line">
                                                        <b>{{$people->ci}} </b>
                                                    </div>
                                                </div>
                                            </div>                                            
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <small>Nombre.</small>
                                                    <div class="form-line">
                                                        <b>{{$people->first_name}} </b>
                                                    </div>
                                                </div>
                                            </div>   
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <small>Apellido.</small>
                                                    <div class="form-line">
                                                        <b>{{$people->last_name}} </b>
                                                    </div>
                                                </div>
                                            </div>   
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <small>Fecha de Nacimiento.</small>
                                                    <div class="form-line">
                                                        <b>{{$people->birth_date}}</b>
                                                    </div>
                                                </div>
                                            </div>                                                  
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <small>Email.</small>
                                                    <div class="form-line">
                                                        <b>{{$people->email}}</b>
                                                    </div>
                                                </div>
                                            </div>                                            
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <small>Telefono 1.</small>
                                                    <div class="form-line">
                                                        <b> {{$people->phone1}}</b>
                                                    </div>
                                                </div>
                                            </div>   
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <small>Telefono 2.</small>
                                                    <div class="form-line">
                                                        <b> {{$people->phone2}}</b>
                                                    </div>
                                                </div>
                                            </div>      
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <small>Sexo.</small>
                                                    <div class="form-line">
                                                        <b>{{$people->sex==1? 'Masculino' : 'Femenino'}}</b>
                                                    </div>
                                                </div>
                                            </div>                                                  
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <small>Direccion.</small>
                                                    <div class="form-line">
                                                        <b>{{$people->address? $people->address:'S/N'}} </b>
                                                    </div>
                                                </div>
                                            </div>                                                 
                                        </div>

                                        {{-- para ver los requisitos de guardia --}}
                                        @if($rubro_id == 1)
                                            <table id="detalles" class="table table-bordered table-striped table-sm">
                                                <thead>
                                                    <tr>
                                                        <th>Tipo</th>
                                                        <th>Estado</th>
                                                        {{-- <th>Accion</th>             --}}
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Carnet de identidad</td>
                                                        <td>
                                                            @if ($peoplerequirement)
                                                                @if ($peoplerequirement->image_ci)
                                                                    <span class="badge badge-success">Si cargado</span>
                                                                    <a href="{{url('storage/public/'.$peoplerequirement->image_ci)}}" title="Ver" target="_blank" class="btn btn-sm btn-success">
                                                                        <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">Ver</span>
                                                                    </a>
                                                                @else
                                                                    <span class="badge badge-danger">No cargado</span>
                                                                @endif
                                                            @else
                                                                <span class="badge badge-danger">No cargado</span>
                                                            @endif
                                                        </td>            
                                                    </tr>
                                                    <tr>
                                                        <td>Antecedentes penales</td>
                                                        <td>
                                                            @if ($peoplerequirement)
                                                                @if ($peoplerequirement->image_ap)
                                                                    <span class="badge badge-success">Si cargado</span>
                                                                    <a href="{{url('storage/public/'.$peoplerequirement->image_ap)}}" title="Ver" target="_blank" class="btn btn-sm btn-success">
                                                                        <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">Ver</span>
                                                                    </a>
                                                                @else
                                                                    <span class="badge badge-danger">No cargado</span>
                                                                @endif
                                                            @else
                                                                <span class="badge badge-danger">No cargado</span>
                                                            @endif
                                                        </td>          
                                                    </tr>
                                                    <tr>
                                                        <td>Libreta de servicio militar</td>
                                                        <td>
                                                            @if ($peoplerequirement)
                                                                @if ($peoplerequirement->image_lsm)
                                                                    <span class="badge badge-success">Si cargado</span>
                                                                    <a href="{{url('storage/public/'.$peoplerequirement->image_lsm)}}" title="Ver" target="_blank" class="btn btn-sm btn-success">
                                                                        <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">Ver</span>
                                                                    </a>
                                                                @else
                                                                    <span class="badge badge-danger">No cargado</span>
                                                                @endif
                                                            @else
                                                                <span class="badge badge-danger">No cargado</span>
                                                            @endif
                                                        </td>            
                                                    </tr>
                                                    <tr>
                                                        <td>Foto cuerpo completo de pantalón y camisa</td>
                                                        <td>
                                                            @if ($peoplerequirement)
                                                                @if ($peoplerequirement->image_fcc)
                                                                    <span class="badge badge-success">Si cargado</span>
                                                                    <a href="{{url('storage/public/'.$peoplerequirement->image_fcc)}}" title="Ver" target="_blank" class="btn btn-sm btn-success">
                                                                        <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">Ver</span>
                                                                    </a>
                                                                @else
                                                                    <span class="badge badge-danger">No cargado</span>
                                                                @endif
                                                            @else
                                                                <span class="badge badge-danger">No cargado</span>
                                                            @endif
                                                        </td>           
                                                    </tr>
                                                    <tr>
                                                        <td>Turno</td>
                                                        <td>
                                                            @if ($peoplerequirement)
                                                                @if ($peoplerequirement->t_dia || $peoplerequirement->t_noche)
                                                                    @if ($peoplerequirement->t_dia)
                                                                        Día 
                                                                        @if($peoplerequirement->t_noche)
                                                                        -
                                                                        @endif
                                                                    @endif
                                                                    @if ($peoplerequirement->t_noche)
                                                                        Noche
                                                                    @endif
                                                                @else
                                                                    <span class="badge badge-danger">No cargado</span>
                                                                @endif
                                                            @else
                                                                <span class="badge badge-danger">No cargado</span>
                                                            @endif
                                                        </td>          
                                                    </tr>
                                                    <tr>
                                                        <td>Estatura</td>
                                                        <td>
                                                            @if ($peoplerequirement)
                                                                @if ($peoplerequirement->estatura)
                                                                    {{$peoplerequirement->estatura}}
                                                                @else
                                                                    <span class="badge badge-danger">No cargado</span>
                                                                @endif
                                                            @else
                                                                <span class="badge badge-danger">No cargado</span>
                                                            @endif
                                                        </td>             
                                                    </tr>
                                                    <tr>
                                                        <td>Peso</td>
                                                        <td>
                                                            @if ($peoplerequirement)
                                                                @if ($peoplerequirement->peso)
                                                                    {{$peoplerequirement->peso}}
                                                                @else
                                                                    <span class="badge badge-danger">No cargado</span>
                                                                @endif
                                                            @else
                                                                <span class="badge badge-danger">No cargado</span>
                                                            @endif
                                                        </td>            
                                                    </tr>
                                                </tbody>                                        
                                            </table>
                                        @endif

                                        {{-- para ver los requisitos de jardineria --}}
                                        @if($rubro_id == 2)
                                            <table id="detalles" class="table table-bordered table-striped table-sm">
                                                <thead>
                                                    <tr>
                                                        <th>Tipo</th>
                                                        <th>Estado</th>
                                                        {{-- <th>Accion</th>             --}}
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Carnet de identidad</td>
                                                        <td>
                                                            @if ($peoplerequirement)
                                                                @if ($peoplerequirement->image_ci)
                                                                    <span class="badge badge-success">Si cargado</span>
                                                                    <a href="{{url('storage/public/'.$peoplerequirement->image_ci)}}" title="Ver" target="_blank" class="btn btn-sm btn-success">
                                                                        <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">Ver</span>
                                                                    </a>
                                                                @else
                                                                    <span class="badge badge-danger">No cargado</span>
                                                                @endif
                                                            @else
                                                                <span class="badge badge-danger">No cargado</span>
                                                            @endif
                                                        </td>            
                                                    </tr>
                                                    <tr>
                                                        <td>Antecedentes penales</td>
                                                        <td>
                                                            @if ($peoplerequirement)
                                                                @if ($peoplerequirement->image_ap)
                                                                    <span class="badge badge-success">Si cargado</span>
                                                                    <a href="{{url('storage/public/'.$peoplerequirement->image_ap)}}" title="Ver" target="_blank" class="btn btn-sm btn-success">
                                                                        <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">Ver</span>
                                                                    </a>
                                                                @else
                                                                    <span class="badge badge-danger">No cargado</span>
                                                                @endif
                                                            @else
                                                                <span class="badge badge-danger">No cargado</span>
                                                            @endif
                                                        </td>          
                                                    </tr>
                                                    <tr>
                                                        <td>Experiencia en jardineria</td>
                                                        <td>
                                                            @if ($peoplerequirement)
                                                                @if ($peoplerequirement->exp_jardineria)
                                                                    @if ($peoplerequirement->exp_jardineria == 1)
                                                                        <span class="badge badge-success">Si</span>
                                                                    @else
                                                                        <span class="badge badge-danger">No</span>
                                                                    @endif
                                                                @else
                                                                    <span class="badge badge-danger">No cargado</span>
                                                                @endif
                                                            @else
                                                                <span class="badge badge-danger">No cargado</span>
                                                            @endif
                                                        </td>            
                                                    </tr>
                                                    <tr>
                                                        <td>Experiencia en paisajismo</td>
                                                        <td>
                                                            @if ($peoplerequirement)
                                                                @if ($peoplerequirement->exp_paisajismo)
                                                                    @if ($peoplerequirement->exp_paisajismo == 1)
                                                                        <span class="badge badge-success">Si</span>
                                                                    @else
                                                                        <span class="badge badge-danger">No</span>
                                                                    @endif
                                                                @else
                                                                    <span class="badge badge-danger">No cargado</span>
                                                                @endif
                                                            @else
                                                                <span class="badge badge-danger">No cargado</span>
                                                            @endif
                                                        </td>           
                                                    </tr>
                                                        <td>Experiencia en Maquinaria</td>
                                                        <td>
                                                            @if ($peoplerequirement)
                                                                @if ($peoplerequirement->exp_maquinas)
                                                                    {{$peoplerequirement->exp_maquinas}}
                                                                @else
                                                                    <span class="badge badge-danger">No cargado</span>
                                                                @endif
                                                            @else
                                                                <span class="badge badge-danger">No cargado</span>
                                                            @endif
                                                        </td>             
                                                    </tr>
                                                </tbody>                                        
                                            </table>
                                        @endif

                                        @if($rubro_id == 3)
                                            <table id="detalles" class="table table-bordered table-striped table-sm">
                                                <thead>
                                                    <tr>
                                                        <th>Tipo</th>
                                                        <th>Estado</th>
                                                        {{-- <th>Accion</th>             --}}
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Carnet de identidad</td>
                                                        <td>
                                                            @if ($peoplerequirement)
                                                                @if ($peoplerequirement->image_ci)
                                                                    <span class="badge badge-success">Si cargado</span>
                                                                    <a href="{{url('storage/public/'.$peoplerequirement->image_ci)}}" title="Ver" target="_blank" class="btn btn-sm btn-success">
                                                                        <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">Ver</span>
                                                                    </a>
                                                                @else
                                                                    <span class="badge badge-danger">No cargado</span>
                                                                @endif
                                                            @else
                                                                <span class="badge badge-danger">No cargado</span>
                                                            @endif
                                                        </td>            
                                                    </tr>
                                                    <tr>
                                                        <td>Antecedentes penales</td>
                                                        <td>
                                                            @if ($peoplerequirement)
                                                                @if ($peoplerequirement->image_ap)
                                                                    <span class="badge badge-success">Si cargado</span>
                                                                    <a href="{{url('storage/public/'.$peoplerequirement->image_ap)}}" title="Ver" target="_blank" class="btn btn-sm btn-success">
                                                                        <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">Ver</span>
                                                                    </a>
                                                                @else
                                                                    <span class="badge badge-danger">No cargado</span>
                                                                @endif
                                                            @else
                                                                <span class="badge badge-danger">No cargado</span>
                                                            @endif
                                                        </td>          
                                                    </tr>
                                                    <tr>
                                                        <td>Experiencia en Mantenimiento de Piscinas.</td>
                                                        <td>
                                                            @if ($peoplerequirement)
                                                                @if ($peoplerequirement->exp_mant_piscina == 1 || $peoplerequirement->exp_mant_piscina == 0)
                                                                    @if ($peoplerequirement->exp_mant_piscina == 1)
                                                                        <span class="badge badge-success">Si</span>
                                                                    @else
                                                                        <span class="badge badge-danger">No</span>
                                                                    @endif
                                                                @else
                                                                    <span class="badge badge-danger">No cargado</span>
                                                                @endif
                                                            @else
                                                                <span class="badge badge-danger">No cargado</span>
                                                            @endif
                                                        </td>            
                                                    </tr>
                                                    <tr>
                                                        <td>Saber Medir PH.</td>
                                                        <td>
                                                            @if ($peoplerequirement)
                                                                @if ($peoplerequirement->medir_ph == 1 || $peoplerequirement->medir_ph == 0)
                                                                    @if ($peoplerequirement->medir_ph == 1)
                                                                        <span class="badge badge-success">Si</span>
                                                                    @else
                                                                        <span class="badge badge-danger">No</span>
                                                                    @endif
                                                                @else
                                                                    <span class="badge badge-danger">No cargado</span>
                                                                @endif
                                                            @else
                                                                <span class="badge badge-danger">No cargado</span>
                                                            @endif
                                                        </td>           
                                                    </tr>
                                                    <tr>
                                                        <td>Saber Aspirar Piscina</td>
                                                        <td>
                                                            @if ($peoplerequirement)
                                                                @if ($peoplerequirement->asp_piscina == 1 || $peoplerequirement->asp_piscina == 0)
                                                                    @if ($peoplerequirement->asp_piscina == 1)
                                                                        <span class="badge badge-success">Si</span>
                                                                    @else
                                                                        <span class="badge badge-danger">No</span>
                                                                    @endif
                                                                @else
                                                                    <span class="badge badge-danger">No cargado</span>
                                                                @endif
                                                            @else
                                                                <span class="badge badge-danger">No cargado</span>
                                                            @endif
                                                        </td>          
                                                    </tr>
                                                    <tr>
                                                        <td>Saber Calcular la Cantidad de Quimico para Piscina.</td>
                                                        <td>
                                                            @if ($peoplerequirement)
                                                                @if ($peoplerequirement->cant_quimico == 1 || $peoplerequirement->cant_quimico == 0)
                                                                    @if ($peoplerequirement->cant_quimico == 1)
                                                                        <span class="badge badge-success">Si</span>
                                                                    @else
                                                                        <span class="badge badge-danger">No</span>
                                                                    @endif
                                                                @else
                                                                    <span class="badge badge-danger">No cargado</span>
                                                                @endif
                                                            @else
                                                                <span class="badge badge-danger">No cargado</span>
                                                            @endif
                                                        </td>             
                                                    </tr>
                                                    <tr>
                                                        <td>Tiene Conocimiento de Funcionamiento de Bomba</td>
                                                        <td>
                                                            @if ($peoplerequirement)
                                                                @if ($peoplerequirement->bomba_agua == 1 || $peoplerequirement->bomba_agua == 0)
                                                                    @if ($peoplerequirement->bomba_agua == 1)
                                                                        <span class="badge badge-success">Si</span>
                                                                    @else
                                                                        <span class="badge badge-danger">No</span>
                                                                    @endif
                                                                @else
                                                                    <span class="badge badge-danger">No cargado</span>
                                                                @endif
                                                            @else
                                                                <span class="badge badge-danger">No cargado</span>
                                                            @endif
                                                        </td>            
                                                    </tr>
                                                    <tr>
                                                        <td>¿Donde ha Trabajado ante como Piscinero?</td>
                                                        <td>
                                                            @if ($peoplerequirement)
                                                                @if ($peoplerequirement->trabajado_ante_donde)
                                                                    {{$peoplerequirement->trabajado_ante_donde}}
                                                                @else
                                                                    <span class="badge badge-danger">No cargado</span>
                                                                @endif
                                                            @else
                                                                <span class="badge badge-danger">No cargado</span>
                                                            @endif
                                                        </td>            
                                                    </tr>
                                                </tbody>                                        
                                            </table>
                                        @endif



                                        @if($rubro_id == 4)
                                            <table id="detalles" class="table table-bordered table-striped table-sm">
                                                <thead>
                                                    <tr>
                                                        <th>Tipo</th>
                                                        <th>Estado</th>
                                                        {{-- <th>Accion</th>             --}}
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Carnet de identidad</td>
                                                        <td>
                                                            @if ($peoplerequirement)
                                                                @if ($peoplerequirement->image_ci)
                                                                    <span class="badge badge-success">Si cargado</span>
                                                                    <a href="{{url('storage/public/'.$peoplerequirement->image_ci)}}" title="Ver" target="_blank" class="btn btn-sm btn-success">
                                                                        <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">Ver</span>
                                                                    </a>
                                                                @else
                                                                    <span class="badge badge-danger">No cargado</span>
                                                                @endif
                                                            @else
                                                                <span class="badge badge-danger">No cargado</span>
                                                            @endif
                                                        </td>            
                                                    </tr>
                                                    <tr>
                                                        <td>Book</td>
                                                        <td>
                                                            @if ($peoplerequirement)
                                                                @if ($peoplerequirement->image_book)
                                                                    <span class="badge badge-success">Si cargado</span>
                                                                    <a href="{{url('storage/public/'.$peoplerequirement->image_book)}}" title="Ver" target="_blank" class="btn btn-sm btn-success">
                                                                        <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">Ver</span>
                                                                    </a>
                                                                @else
                                                                    <span class="badge badge-danger">No cargado</span>
                                                                @endif
                                                            @else
                                                                <span class="badge badge-danger">No cargado</span>
                                                            @endif
                                                        </td>          
                                                    </tr>
                                                    <tr>
                                                        <td>Estatura</td>
                                                        <td>
                                                            @if ($peoplerequirement)
                                                                @if ($peoplerequirement->estatura)
                                                                    {{$peoplerequirement->estatura}}
                                                                @else
                                                                    <span class="badge badge-danger">No cargado</span>
                                                                @endif
                                                            @else
                                                                <span class="badge badge-danger">No cargado</span>
                                                            @endif
                                                        </td>            
                                                    </tr>
                                                    <tr>
                                                        <td>Peso</td>
                                                        <td>
                                                            @if ($peoplerequirement)
                                                                @if ($peoplerequirement->peso)
                                                                    {{$peoplerequirement->peso}}
                                                                @else
                                                                    <span class="badge badge-danger">No cargado</span>
                                                                @endif
                                                            @else
                                                                <span class="badge badge-danger">No cargado</span>
                                                            @endif
                                                        </td>           
                                                    </tr>
                                                    <tr>
                                                        <td>Idioma</td>
                                                        <td>
                                                            @if ($peoplerequirement)
                                                                @if ($peoplerequirement->spanish || $peoplerequirement->english || $peoplerequirement->frances || $peoplerequirement->italiano || $peoplerequirement->portugues || $peoplerequirement->aleman || $peoplerequirement->otro_idioma)
                                                                    @if ($peoplerequirement->spanish)
                                                                        <span class="badge badge-success">Español</span>
                                                                    @endif
                                                                    @if ($peoplerequirement->english)
                                                                        <span class="badge badge-success">Ingles</span>
                                                                    @endif
                                                                    @if ($peoplerequirement->frances)
                                                                        <span class="badge badge-success">Frances</span>
                                                                    @endif
                                                                    @if ($peoplerequirement->italiano)
                                                                        <span class="badge badge-success">Italiano</span>
                                                                    @endif
                                                                    @if ($peoplerequirement->portugues)
                                                                        <span class="badge badge-success">Portugues</span>
                                                                    @endif
                                                                    @if ($peoplerequirement->aleman)
                                                                        <span class="badge badge-success">Aleman</span>
                                                                    @endif
                                                                    @if ($peoplerequirement->otro_idioma)
                                                                        <span class="badge badge-success">{{$peoplerequirement->otro_idioma}}</span>
                                                                    @endif
                                                                    {{-- {{$peoplerequirement->spanish}} {{$peoplerequirement->english}} {{$peoplerequirement->frances}} {{$peoplerequirement->italiano}} {{$peoplerequirement->portugues}} {{$peoplerequirement->aleman}} {{$peoplerequirement->otro_idioma}} --}}
                                                                @else
                                                                    <span class="badge badge-danger">No cargado</span>
                                                                @endif
                                                            @else
                                                                <span class="badge badge-danger">No cargado</span>
                                                            @endif
                                                        </td>           
                                                    </tr>
                                                    <tr>
                                                        <td>Curso de Modelaje y otros Relacionado</td>
                                                        <td>
                                                            @if ($peoplerequirement)
                                                                @if ($peoplerequirement->curso_modelaje)
                                                                    {{$peoplerequirement->curso_modelaje}}
                                                                @else
                                                                    <span class="badge badge-danger">No cargado</span>
                                                                @endif
                                                            @else
                                                                <span class="badge badge-danger">No cargado</span>
                                                            @endif
                                                        </td>           
                                                    </tr>
                                                    <tr>
                                                        <td>Experiencia en Modelaje</td>
                                                        <td>
                                                            @if ($peoplerequirement)
                                                                @if ($peoplerequirement->exp_modelaje)
                                                                    {{$peoplerequirement->exp_modelaje}}
                                                                @else
                                                                    <span class="badge badge-danger">No cargado</span>
                                                                @endif
                                                            @else
                                                                <span class="badge badge-danger">No cargado</span>
                                                            @endif
                                                        </td>           
                                                    </tr>
                                                </tbody>                                        
                                            </table>
                                        @endif

                                        {{-- para ver los requisitos de educacion --}}
                                    </div>                      
                                </main>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>   


@stop

@section('css')

@stop

@section('javascript')
    <script src="{{ url('js/main.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.dataTable').DataTable({
                        language: {
                            // "order": [[ 0, "desc" ]],
                            sProcessing: "Procesando...",
                            sLengthMenu: "Mostrar _MENU_ registros",
                            sZeroRecords: "No se encontraron resultados",
                            sEmptyTable: "Ningún dato disponible en esta tabla",
                            sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                            sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
                            sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
                            sSearch: "Buscar:",
                            sInfoThousands: ",",
                            sLoadingRecords: "Cargando...",
                            oPaginate: {
                                sFirst: "Primero",
                                sLast: "Último",
                                sNext: "Siguiente",
                                sPrevious: "Anterior"
                            },
                            oAria: {
                                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                            },
                            buttons: {
                                copy: "Copiar",
                                colvis: "Visibilidad"
                            }
                        },
                        order: [[ 0, 'desc' ]],
                    })
        });
        $('#modal_delete').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) //captura valor del data-empresa=""

                var id = button.data('id')
                var modal = $(this)
                modal.find('.modal-body #id').val(id)
                
        });
    </script>
@stop
{{-- @else
@section('content')
    <h1>No tienes permiso</h1>
@stop
@endif --}}