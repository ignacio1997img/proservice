@extends('voyager::master')
{{-- @if(auth()->user()->hasPermission('browse_busines_perfil_view')) --}}
@section('page_title', 'Viendo Ingresos')

    @section('page_header')        
        <div class="container-fluid">
            <div class="row">                
                <div class="col-md-8">
                    <h1 id="subtitle" class="page-title">
                        <i class="voyager-receipt"></i> Perfil 
                    </h1>
                    <a href="{{route('message-beneficiary.bandeja')}}" class="btn btn-warning">
                        <span class="glyphicon glyphicon-list"></span>&nbsp;
                        Volver
                    </a>
                </div>
                <div class="col-md-4">
                   
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
                                                        <small>Departamento.</small>
                                                        <div class="form-line">
                                                            <b>{{$city? $city->department->name : 'SN'}}</b>
                                                        </div>
                                                    </div>
                                                </div> 
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <small>Ciudad.</small>
                                                        <div class="form-line">
                                                            <b>{{$city? $city->name : 'SN'}}</b>
                                                        </div>
                                                    </div>
                                                </div>  
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

                                           

                                            
                                            {{-- para desplegar los requisitos de GUARDIA --}}
                                            @if ($busine->rubro_id == 1)
                                                <table id="detalles" class="table table-bordered table-striped table-sm">
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
                                                                    @if ($businerequirements->image_lf)
                                                                        <span class="badge badge-success">Si cargado</span>
                                                    
                                                                            <a href="{{url('storage/public/'.$businerequirements->image_lf)}}" title="Ver" target="_blank" class="btn btn-sm btn-success">
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
                                                                    @if ($businerequirements->image_roe)
                                                                        <span class="badge badge-success">Si cargado</span>
                                                    
                                                                            <a href="{{url('storage/public/'.$businerequirements->image_roe)}}" title="Ver" target="_blank" class="btn btn-sm btn-success">
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
                                                            <td>Permiso de denacev</td>
                                                            <td>
                                                                @if ($businerequirements)
                                                                    @if ($businerequirements->image_pd)
                                                                        <span class="badge badge-success">Si cargado</span>
                                                    
                                                                            <a href="{{url('storage/public/'.$businerequirements->image_pd)}}" title="Ver" target="_blank" class="btn btn-sm btn-success">
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
                                                </table>
                                            @endif
                                            @if ($busine->rubro_id == 2)
                                                <table id="detalles" class="table table-bordered table-striped table-sm">
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
                                                                    @if ($businerequirements->image_lf)
                                                                        <span class="badge badge-success">Si cargado</span>
                                                                        @if(auth()->user()->hasPermission('view_busine-perfil-requirement'))
                                                                            <a href="{{url('storage/public/'.$businerequirements->image_lf)}}" title="Ver" target="_blank" class="btn btn-sm btn-success">
                                                                                <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">Ver</span>
                                                                            </a>
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
                                                            <td>Roe</td>
                                                            <td>
                                                                @if ($businerequirements)
                                                                    @if ($businerequirements->image_roe)
                                                                        <span class="badge badge-success">Si cargado</span>
                                                                        @if(auth()->user()->hasPermission('view_busine-perfil-requirement'))
                                                                            <a href="{{url('storage/public/'.$businerequirements->image_roe)}}" title="Ver" target="_blank" class="btn btn-sm btn-success">
                                                                                <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">Ver</span>
                                                                            </a>
                                                                        @endif
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
                                            @if ($busine->rubro_id == 3)
                                                <table id="detalles" class="table table-bordered table-striped table-sm">
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
                                                                    @if ($businerequirements->image_lf)
                                                                        <span class="badge badge-success">Si cargado</span>
                                                                        
                                                                            <a href="{{url('storage/public/'.$businerequirements->image_lf)}}" title="Ver" target="_blank" class="btn btn-sm btn-success">
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
                                                                    @if ($businerequirements->image_roe)
                                                                        <span class="badge badge-success">Si cargado</span>
                                                                        @if(auth()->user()->hasPermission('view_busine-perfil-requirement'))
                                                                            <a href="{{url('storage/public/'.$businerequirements->image_roe)}}" title="Ver" target="_blank" class="btn btn-sm btn-success">
                                                                                <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">Ver</span>
                                                                            </a>
                                                                        @endif
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


                                            @if ($busine->rubro_id == 4)
                                                <table id="detalles" class="table table-bordered table-striped table-sm">
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
                                                                    @if ($businerequirements->image_lf)
                                                                        <span class="badge badge-success">Si cargado</span>
                                                                        
                                                                            <a href="{{url('storage/public/'.$businerequirements->image_lf)}}" title="Ver" target="_blank" class="btn btn-sm btn-success">
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
                                                                    @if ($businerequirements->image_roe)
                                                                        <span class="badge badge-success">Si cargado</span>
                                                                        @if(auth()->user()->hasPermission('view_busine-perfil-requirement'))
                                                                            <a href="{{url('storage/public/'.$businerequirements->image_roe)}}" title="Ver" target="_blank" class="btn btn-sm btn-success">
                                                                                <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">Ver</span>
                                                                            </a>
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
                                                            <td>Experiencia</td>
                                                            <td>
                                                                @if ($businerequirements)
                                                                    @if ($businerequirements->exp_modelo == 1 || $businerequirements->exp_modelo == 0)
                                                                        @if($businerequirements->exp_modelo == 1)
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
                                                    </tbody>                                        
                                                </table>
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
        
        {{-- modal para editar los datos de la empresa --}}
        <div class="modal fade modal-primary" role="dialog" id="modal_edit">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">                
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="voyager-plus"></i> Editar Datos de la Empresa</h4>
                    </div>
                    {!! Form::open(['route' => 'busines.perfil-update','class' => 'was-validated'])!!}
                        <!-- Modal body -->
                        <div class="modal-body">
                            <input type="hidden" name="id" value="{{$busine->id}}">
                            
                            <div id="cantcheque">                                   
                                <div class="row" >
                                    <div class="col-md-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><b>NIT:</b></span>
                                        </div>
                                        <input type="number" class="form-control" name="nit" value="{{$busine->nit}}">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><b>Razon Social:</b></span>
                                        </div>
                                        <input type="text" class="form-control" name="name" value="{{$busine->name}}">
                                    </div>                                
                                </div>
                            </div>

                            <div id="cantcheque">                                   
                                <div class="row" >
                                    <div class="col-md-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><b>Responsable:</b></span>
                                        </div>
                                        <input type="text" class="form-control" name="responsible" value="{{$busine->responsible}}">
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><b>Email:</b></span>
                                        </div>
                                        <input type="text" class="form-control" name="email" value="{{$busine->email}}">
                                    </div>         
                                    <div class="col-md-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><b>Sitio Web:</b></span>
                                        </div>
                                        <input type="text" class="form-control" name="website" value="{{$busine->website}}">
                                    </div>                         
                                </div>
                            </div>
                            <div id="cantcheque">                                   
                                <div class="row" >
                                    <div class="col-md-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><b>Telefono 1:</b></span>
                                        </div>
                                        <input type="number" class="form-control" name="phone1" value="{{$busine->phone1}}">
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><b>Telefono 2:</b></span>
                                        </div>
                                        <input type="number" class="form-control" name="phone2" value="{{$busine->phone2}}">
                                    </div>                        
                                </div>
                            </div>
                            <div class="row">    
                                    
                                <div class="col-md-12">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text"><b>Direccion:</b></span>
                                    </div>
                                    <textarea class="form-control" name="address" cols="77" rows="3">{{$busine->address}}</textarea>
                                </div>                
                            </div>
                            <div class="row">    
                                    
                                <div class="col-md-12">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text"><b>Descripcion:</b></span>
                                    </div>
                                    <textarea id="description" class="form-control" name="description" cols="77" rows="3">{{$busine->description}}</textarea>
                                </div>                
                            </div>

                        </div>
                        
                        <!-- Modal footer -->
                        <div class="modal-footer justify-content-between">
                            <button type="button text-left" class="btn btn-danger" data-dismiss="modal" data-toggle="tooltip" title="Volver">Cancelar
                            </button>
                            <button type="submit" class="btn btn-success btn-sm" title="Registrar..">
                                Actualizar
                            </button>
                        </div>
                    {!! Form::close()!!} 
                    
                </div>
            </div>
        </div>
    @stop

    {{-- <style>
        img {
            max-width: 10%;
            max-height: 10%;
        }
        .cat {
            height: 100px;
            width: 20px;
        }
    </style> --}}


    @section('css')
    <script src="{{ asset('js/app.js') }}" defer></script>      
    @stop

    @section('javascript')
    
        <script>

           


        </script> 
    @stop

{{-- @else
    @section('content')
        <h1>No tienes permiso</h1>
    @stop
@endif --}}