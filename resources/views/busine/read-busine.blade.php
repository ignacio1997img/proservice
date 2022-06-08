@extends('voyager::master')

@section('page_title', 'Viendo Ingresos')

    @section('page_header')
        
        <div class="container-fluid">
            <div class="row">
                <h1 class="page-title">
                    <i class="fa-solid fa-building"></i> Empresa
                </h1>
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
                                                        <small>Tipo.</small>
                                                        <div class="form-line">
                                                            <b>{{$busine->rubrobusines->name}} </b>
                                                        </div>
                                                    </div>
                                                </div>                                            
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <small>Nit.</small>
                                                        <div class="form-line">
                                                            <b>{{$busine->nit}} </b>
                                                        </div>
                                                    </div>
                                                </div>   
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <small>Razon Social.</small>
                                                        <div class="form-line">
                                                            <b>{{$busine->name}} </b>
                                                        </div>
                                                    </div>
                                                </div>   
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <small>Responsable.</small>
                                                        <div class="form-line">
                                                            <b>{{$busine->responsible}} </b>
                                                        </div>
                                                    </div>
                                                </div>                                                  
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <small>Email.</small>
                                                        <div class="form-line">
                                                            <b>{{$busine->email}} </b>
                                                        </div>
                                                    </div>
                                                </div>                                            
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <small>Telefono 1.</small>
                                                        <div class="form-line">
                                                            <b>{{$busine->phone1? $busine->phone1:'S/N'}} </b>
                                                        </div>
                                                    </div>
                                                </div>   
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <small>Telefono 2.</small>
                                                        <div class="form-line">
                                                            <b>{{$busine->phone2? $busine->phone2:'S/N'}} </b>
                                                        </div>
                                                    </div>
                                                </div>      
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <small>Sitio.</small>
                                                        <div class="form-line">
                                                            <b>{{$busine->website}} </b>
                                                        </div>
                                                    </div>
                                                </div>                                                  
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <small>Direccion.</small>
                                                        <div class="form-line">
                                                            <b>{{$busine->address? $busine->address:'S/N'}} </b>
                                                        </div>
                                                    </div>
                                                </div>     
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <small>descripcion.</small>
                                                        <div class="form-line">
                                                            <b>{{$busine->description? $busine->description:'S/N'}} </b>
                                                        </div>
                                                    </div>
                                                </div>                                                
                                            </div>

                                            @if ($busine->rubro_id == 1)
                                                @include('busine.perfil-requirement.guardia')
                                            @endif
                                            @if ($busine->rubro_id == 2)
                                                @include('busine.perfil-requirement.jardineria')
                                            @endif
                                            @if ($busine->rubro_id == 3)
                                                @include('busine.perfil-requirement.piscina')
                                            @endif
                                            @if ($busine->rubro_id == 4)
                                                @include('busine.perfil-requirement.modelo')
                                            @endif
                                            {{-- <table id="detalles" class="table table-bordered table-striped table-sm">
                                                <thead>
                                                    <tr>
                                                        <th>Tipo</th>
                                                        <th>Estado</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Licencia de funcionamiento</td>
                                                        <td>
                                                            @if ($businerequirements)
                                                                @if ($businerequirements->image_ci)
                                                                    <span class="badge badge-success">Si cargado</span>
                                                                    <a href="{{url('storage/'.$businerequirements->image_ci)}}" title="Ver" target="_blank" class="btn btn-sm btn-success">
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
                                                        <td>Roe</td>
                                                        <td>
                                                            @if ($businerequirements)
                                                                @if ($businerequirements->image_ap)
                                                                    <span class="badge badge-success">Si cargado</span>
                                                                    <a href="{{url('storage/'.$businerequirements->image_ap)}}" title="Ver" target="_blank" class="btn btn-sm btn-success">
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
                                                </tbody>                                        
                                            </table> --}}
                                            
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

    <style>
        img {
            max-width: 10%;
            max-height: 10%;
        }
        .cat {
            height: 100px;
            width: 20px;
        }
    </style>


    @section('css')
    <script src="{{ asset('js/app.js') }}" defer></script>      
    @stop

    @section('javascript')
    
        <script>

           


        </script> 
    @stop