@extends('voyager::master')
@if(auth()->user()->hasPermission('browse_people-perfil-experience') || auth()->user()->hasRole('admin'))
@section('page_title', 'Perfil')

@section('page_header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <h1 id="subtitle" class="page-title">
                    <i class="fa-solid fa-person-digging"></i> Perfil
                    &nbsp; 
                    {{-- para el administrador que va a aceptar los rubro de la persona --}}
                    @if(auth()->user()->hasRole('admin'))
                        <a href="{{route('people.index')}}" class="btn btn-warning">
                        <i class="fa-solid fa-circle-left"></i>
                            Volver
                        </a>
                    @endif
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
                            {{-- <div class="table-responsive">                                --}}
                                    {{-- <div class="card-body"> --}}
                                        @if(auth()->user()->hasPermission('edit_people-perfil-data') && !auth()->user()->hasRole('admin'))
                                            <a type="button" data-toggle="modal" data-target="#modal_edit" class="btn btn-success">
                                                <i class="voyager-plus"></i> <span>Editar Datos</span>
                                            </a>
                                        @endif
                                        <h1 id="subtitle">Datos Personales</h1>
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
                                        <h1 id="subtitle">Dirección Actual</h1>
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
                                                        <b>{{$people->address? $people->address:'S/N'}} </b>
                                                    </div>
                                                </div>
                                            </div>                                         
                                        </div>
                                        <h1 id="subtitle">Redes Sociales</h1>
                                        <div class="row">                                              
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <img src="{{ asset('images/redes/facebook.png') }}" alt="GYM" width="35px">&nbsp;&nbsp;&nbsp;<small>{{$people->facebook}}</small>
                                                </div>
                                            </div> 
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <img src="{{ asset('images/redes/instagram.png') }}" alt="GYM" width="35px">&nbsp;&nbsp;&nbsp;<small>{{$people->instagram}}</small>

                                                </div>
                                            </div>       
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <img src="{{ asset('images/redes/tiktok.png') }}" alt="GYM" width="35px">&nbsp;&nbsp;&nbsp;<small>{{$people->tiktok}}</small>
                                                </div>
                                            </div>                                         
                                        </div>

                                        {{-- para pasantes --}}
                                        @if(auth()->user()->hasPermission('add_pasantes') && !auth()->user()->hasRole('admin') && !$pasantia)
                                            <a type="button" data-toggle="modal" data-target="#modal-pasante" class="btn btn-success">
                                                <i class="voyager-plus"></i> <span>Agregar Pasantia</span>
                                            </a>
                                        @endif
                                        <hr>
                                        @if ($pasantia && auth()->user()->hasPermission('browse_pasantes'))
                                            <table id="dataTable" class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align: center">Universidad / Institución Académica / Centro de Enseñanza Superior</th>
                                                        <th style="text-align: center">Carrera / Área de Formación</th>
                                                        <th style="text-align: right">Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td style="text-align: center">{{$pasantia->institution}}</td>
                                                        <td style="text-align: center">{{$pasantia->profession->name}}</td>
                                                        <td style="text-align: right">
                                                            @if (!auth()->user()->hasRole('admin'))
        
                                                                @if(auth()->user()->hasPermission('edit_people-perfil-requirement'))
                                                                   
                                                                        <a title="Ficha Técnica" class="btn btn-sm btn-primary" onclick="openPasante({{$pasantia->id}})">
                                                                            <i class="fa-solid fa-print"></i><span class="hidden-xs hidden-sm"></span>
                                                                        </a>
                                                           
                                                                    <a href="{{route('pasantes.edit', ['pasante'=>$pasantia->id])}}" title="Editar" class="btn btn-sm btn-warning">
                                                                        <i class="voyager-receipt"></i> <span class="hidden-xs hidden-sm">Requisitos</span>
                                                                    </a>
                                                                @endif
                                                                {{-- @if(auth()->user()->hasPermission('delete_people-perfil-requirement'))
                                                                    <a title="Eliminar Rubro" data-toggle="modal" data-target="#modal_delete" data-id="{{$pasantia->id}}" class="btn btn-sm btn-danger">
                                                                        <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">Eliminar</span>
                                                                    </a>
                                                                @endif --}}
                                                            @endif

                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        @endif
                                        <br>

                                        <hr>

                                        {{-- para personas que buscan trabajos --}}
                                        {{-- """""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""" --}}
                                        @if(auth()->user()->hasPermission('add_people-perfil-experience') && !auth()->user()->hasRole('admin'))
                                            <a type="button" data-toggle="modal" data-target="#modal-create" class="btn btn-success">
                                                <i class="voyager-plus"></i> <span>Busco trabajo de</span>
                                            </a>
                                        @endif

                                        <table id="dataTable" class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Nro&deg;</th>
                                                    <th >Experiencia Laboral</th>
                                                    <th style="text-align: center">Estado</th>
                                                    <th style="text-align: right">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $i = 1;
                                                @endphp
                                                @foreach ($experiences as $item)
                                                    <tr>
                                                        <td>{{$i}}</td>
                                                        <td>{{$item->rubro_people->name}} <label class="label label-primary">{{$item->typeModel_id?' - '.$item->type_model->name:''}}</label></td>    
                                                        <td style="text-align: center">
                                                            @if ($item->status == 1)
                                                                <label class="label label-success">Aprobado</label>
                                                            @else
                                                                <label class="label label-danger">Pendiente</label>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="no-sort no-click bread-actions text-right">
        
        
                                                                @if ($item->status == 2 && auth()->user()->hasRole('admin'))
                                                                    @if($item->rubro_id == 4)
                                                                        <a type="button" data-toggle="modal" data-target="#modal_editarModelaje" data-id="{{ $item->id}}"  class="btn btn-primary"><i class="fa-solid fa-edit"></i> <span class="hidden-xs hidden-sm">Editar Categoria Modelaje</span></a>
                                                                    @endif
                                                                    <a type="button" data-toggle="modal" data-target="#modal_aprobar" data-id="{{ $item->id}}"  class="btn btn-success"><i class="fa-solid fa-check-to-slot"></i> <span class="hidden-xs hidden-sm">Aprobar</span></a>
                                                                @endif
        
                                                                @if(auth()->user()->hasPermission('edit_people-perfil-requirement'))
                                                                    @if ($item->rubro_id == 4)
                                                                        <a title="Ficha Técnica" class="btn btn-sm btn-primary" onclick="openWindows({{$people->id}}, {{ $item->id}})">
                                                                            <i class="fa-solid fa-file"></i><span class="hidden-xs hidden-sm"> Ficha Técnica</span>
                                                                        </a>
                                                                    @endif
                                                                    <a href="{{route('work-experience.requirement-create', ['id'=>$item->id, 'rubro_id'=>$item->rubro_id])}}" title="Editar" class="btn btn-sm btn-warning">
                                                                        <i class="voyager-receipt"></i> <span class="hidden-xs hidden-sm">Requisitos</span>
                                                                    </a>
                                                                @endif
                                                                @if(auth()->user()->hasPermission('delete_people-perfil-requirement'))
                                                                    <a title="Eliminar Rubro" data-toggle="modal" data-target="#modal_delete" data-id="{{$item->id}}" class="btn btn-sm btn-danger">
                                                                        <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">Eliminar</span>
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @php
                                                        $i++;
                                                    @endphp
                                                @endforeach                                        
                                            </tbody>
                                        </table>
                                    {{-- </div>                       --}}
            
                                
                            {{-- </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>   

    <div class="modal modal-primary fade" tabindex="-1" id="modal_editarModelaje" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['route' => 'people.updateCategoriaModelaje', 'method' => 'POST']) !!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa-solid fa-edit"></i> Categoria de Modelaje</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">

                    <div class="col-md-12">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Categoria de Modelaje:</b></span>
                        </div>
                        <select name="typeModel_id" id="typeModel_id" class="form-control select2" required>
                            <option value="">Seleccione un tipo..</option>
                            @foreach($model as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>          
                <br>      
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <input type="submit" class="btn btn-dark" value="Sí, VERIFICAR">
                </div>
                {!! Form::close()!!} 
            </div>
        </div>
    </div>

    {{-- modal para aprobar los rubros de cada persona --}}
    <div class="modal modal-primary fade" tabindex="-1" id="modal_aprobar" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['route' => 'people.aprobarRubro', 'method' => 'POST']) !!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa-solid fa-check-to-slot"></i> Verificar Rubro</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">

                    <div class="text-center" style="text-transform:uppercase">
                        <i class="fa-solid fa-check-to-slot" style="color: rgb(53,61,71); font-size: 5em;"></i>
                        <br>
                        <p><b>Verificar Rubro....!</b></p>
                    </div>
                </div>                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <input type="submit" class="btn btn-dark" value="Sí, VERIFICAR">
                </div>
                {!! Form::close()!!} 
            </div>
        </div>
    </div>

{{-- para editar los datos basico de una persona mediante un perfil --}}
{{-- modal para editar los datos de la empresa --}}
<div class="modal fade modal-primary" data-backdrop="static" role="dialog" id="modal_edit">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">                
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="voyager-plus"></i> Editar Datos Personales</h4>
            </div>
            {!! Form::open(['route' => 'people-perfil.update','class' => 'was-validated'])!!}
                <!-- Modal body -->
                <div class="modal-body">
                    <input type="hidden" name="id" value="{{$people->id}}">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group-prepend">
                                    <small class="input-group-text"><b>Departamento:</b></small>
                                </div>
                                <select id="department_id" class="form-control select2" required>
                                    <option value="">Seleccione un departamento..</option>
                                    @foreach($department as $data)
                                        <option value="{{$data->id}}" @if($city) {{$city->department_id==$data->id? 'selected':''}} @endif>{{$data->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group-prepend">
                                    <small class="input-group-text"><b>Ciudad:</b></small>
                                </div>
                                <select name="city_id" id="city_id" class="form-control select2" required>
                                    <option value="">Seleccione una Ciudad..</option>
                                    @foreach($cities as $data)
                                        <option value="{{$data->id}}" {{$city->id==$data->id? 'selected':''}}>{{$data->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    
                                                 
                        <div class="row" >
                            <div class="col-md-4">
                                <div class="input-group-prepend">
                                    <small class="input-group-text"><b>CI:</b></small>
                                </div>
                                <input type="number" class="form-control" name="ci" value="{{$people->ci}}">
                            </div>
                            <div class="col-md-4">
                                <div class="input-group-prepend">
                                    <small class="input-group-text"><b>Nombre:</b></small>
                                </div>
                                <input type="text" class="form-control" name="first_name" value="{{$people->first_name}}">
                            </div>     
                            <div class="col-md-4">
                                <div class="input-group-prepend">
                                    <small class="input-group-text"><b>Apellido:</b></small>
                                </div>
                                <input type="text" class="form-control" name="last_name" value="{{$people->last_name}}">
                            </div>                            
                        </div>
                                           
                        <div class="row" >
                            <div class="col-md-4">
                                <div class="input-group-prepend">
                                    <small class="input-group-text"><b>Fecha de Nacimiento:</b></small>
                                </div>
                                <input type="date" class="form-control" name="birth_date" value="{{$people->birth_date}}">
                            </div>
                            <div class="col-md-4">
                                <div class="input-group-prepend">
                                    <small class="input-group-text"><b>Email:</b></small>
                                </div>
                                <input type="text" class="form-control" name="email" value="{{$people->email}}">
                            </div>         
                            <div class="col-md-4">
                                <div class="input-group-prepend">
                                    <small class="input-group-text"><b>Sexo:</b></small>
                                </div>
                                <select name="sex" id="sex" class="form-control">
                                    <option value="1" {{$people->sex == 1? 'selected':''}}>MASCULINO</option>
                                    <option value="0" {{$people->sex == 0? 'selected':''}}>FEMENINO</option>
                                </select>
                            </div>                         
                        </div>
                                                  
                        <div class="row" >
                            <div class="col-md-4">
                                <div class="input-group-prepend">
                                    <small class="input-group-text"><b>Telefono 1:</b></small>
                                </div>
                                <input type="number" class="form-control" name="phone1" value="{{$people->phone1}}">
                            </div>
                            <div class="col-md-4">
                                <div class="input-group-prepend">
                                    <small class="input-group-text"><b>Telefono 2:</b></small>
                                </div>
                                <input type="number" class="form-control" name="phone2" value="{{$people->phone2}}">
                            </div>                        
                        </div>
                        <h1 id="subtitle">Redes sociales</h1>
                        <div class="row" >
                            <div class="col-md-4">
                                <div class="input-group-prepend">
                                    <small class="input-group-text"><b>Facebook:</b></small>
                                </div>
                                <input type="text" class="form-control" name="facebook" value="{{$people->facebook}}">
                            </div>
                            <div class="col-md-4">
                                <div class="input-group-prepend">
                                    <small class="input-group-text"><b>Instagram:</b></small>
                                </div>
                                <input type="text" class="form-control" name="instagram" value="{{$people->instagram}}">
                            </div>      
                            <div class="col-md-4">
                                <div class="input-group-prepend">
                                    <small class="input-group-text"><b>TikTok:</b></small>
                                </div>
                                <input type="text" class="form-control" name="tiktok" value="{{$people->tiktok}}">
                            </div>                     
                        </div>
                  
                    <div class="row">    
                            
                        <div class="col-md-12">
                            <div class="input-group-prepend">
                            <small class="input-group-text"><b>Direccion:</b></small>
                            </div>
                            <textarea class="form-control" name="address" cols="77" rows="3">{{$people->address}}</textarea>
                        </div>                
                    </div>

                </div>
                
                <!-- Modal footer -->
                <div class="modal-footer justify-content-between">
                    <button type="button text-left" class="btn btn-danger" data-dismiss="modal" data-toggle="tooltip" title="Volver">Cancelar
                    </button>
                    <button type="submit" class="btn btn-dark btn-sm" title="Registrar..">
                        Actualizar
                    </button>
                </div>
            {!! Form::close()!!} 
            
        </div>
    </div>
</div>

    {{-- modal para registrar las experiencia de cada persona --}}
    <div class="modal fade modal-success" role="dialog" id="modal-create">
        <div class="modal-dialog modal-md">
            <div class="modal-content">                
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-plus"></i>Registrar</h4>
                </div>
                {!! Form::open(['route' => 'people-perfil-experience.store','class' => 'was-validated'])!!}
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><b>Tipo de Trabajo:</b></span>
                                </div>
                                <select name="rubro_id" id="rubro_id" class="form-control select2" required>
                                    <option value="">Seleccione un tipo..</option>
                                    @foreach($rubro as $item)
                                        @if ($item->id != 4 && auth()->user()->hasRole('trabajador'))
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endif
                                        
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-12" id="div_model">
                            </div>
                        </div>     

                    </div>
                    
                    <!-- Modal footer -->
                    <div class="modal-footer justify-content-between">
                        <button type="button text-left" class="btn btn-danger" data-dismiss="modal" data-toggle="tooltip" title="Volver">Cancelar
                        </button>
                        <button type="submit" class="btn btn-success btn-sm" title="Registrar..">
                            Registrar
                        </button>
                    </div>
                {!! Form::close()!!} 
                
            </div>
        </div>
    </div>

    {{-- modal para eliminar --}}
    <div class="modal modal-danger fade" tabindex="-1" id="modal_delete" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['route' => 'work-experience.delete', 'method' => 'DELETE']) !!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-trash"></i> Eliminar</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">

                    <div class="text-center" style="text-transform:uppercase">
                        <i class="voyager-trash" style="color: red; font-size: 5em;"></i>
                        <br>
                        
                        <p><b>Desea eliminar la experiencia laboral?</b></p>
                    </div>
                    {{-- <div class="row">   
                        <div class="col-md-12">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><b>Observacion:</b></span>
                            </div>
                            <textarea id="observacion" class="form-control" name="observacion" cols="77" rows="3"></textarea>
                        </div>                
                    </div> --}}
                </div>                
                <div class="modal-footer">
                    
                        <input type="submit" class="btn btn-danger pull-right delete-confirm" value="Sí, eliminar">
                    
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancelar</button>
                </div>
                {!! Form::close()!!} 
            </div>
        </div>
    </div>



    {{-- para agregar pasantes --}}
    {{-- modal para registrar las experiencia de cada persona --}}
    <div class="modal fade modal-success" role="dialog" id="modal-pasante">
        <div class="modal-dialog modal-md">
            <div class="modal-content">                
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-plus"></i>Agregar Pasantía</h4>
                </div>
                {!! Form::open(['route' => 'pasantes.store','class' => 'was-validated'])!!}
                    <!-- Modal body -->
                    <div class="modal-body">
                        <input type="hidden" name="people_id" value="{{$people->id}}">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="input-group-prepend">
                                    <small class="input-group-text"><b>Profesión</b></small>
                                </div>
                                <select name="profession_id" class="form-control select2" required>
                                    <option value="">Seleccione un tipo..</option>
                                    @foreach($profession as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                           
                        </div> 
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="input-group-prepend">
                                    <small class="input-group-text"><b>Universidad / Institución Académica / Centro de Enseñanza Superior</b></small>
                                </div>
                                <input type="text" class="form-control text" name="institution">
                            </div>

                           
                        </div>     

                    </div>
                    
                    <!-- Modal footer -->
                    <div class="modal-footer justify-content-between">
                        <button type="button text-left" class="btn btn-danger" data-dismiss="modal" data-toggle="tooltip" title="Volver">Cancelar
                        </button>
                        <button type="submit" class="btn btn-success btn-sm" title="Registrar..">
                            Registrar
                        </button>
                    </div>
                {!! Form::close()!!} 
                
            </div>
        </div>
    </div>

    <div class="modal modal-danger fade" tabindex="-1" id="modal_delete_pasantia" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['route' => 'work-experience.delete', 'method' => 'DELETE']) !!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-trash"></i> Eliminar</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">

                    <div class="text-center" style="text-transform:uppercase">
                        <i class="voyager-trash" style="color: red; font-size: 5em;"></i>
                        <br>
                        
                        <p><b>Desea eliminar la experiencia laboral?</b></p>
                    </div>
                </div>                
                <div class="modal-footer">
                    
                        <input type="submit" class="btn btn-danger pull-right delete-confirm" value="Sí, eliminar">
                    
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancelar</button>
                </div>
                {!! Form::close()!!} 
            </div>
        </div>
    </div>
@stop

@section('css')

<style>
  
  
    input.text, select.text, textarea.text{ 
        border-radius: 5px 5px 5px 5px;
        color: #000000;
        border-color: rgb(63, 63, 63);
    }
</style>
@stop

@section('javascript')
    <script src="{{ url('js/main.js') }}"></script>
    <script>
        $(document).ready(function() {
            

                $('#rubro_id').on('change', tipo_modelo);
                $('#department_id').on('change', selectCity);

        });

        $('#modal_aprobar').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) 

                var id = button.data('id')

                var modal = $(this)
                modal.find('.modal-body #id').val(id)
                
        });

        
        $('#modal_editarModelaje').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) 

                var id = button.data('id')

                var modal = $(this)
                modal.find('.modal-body #id').val(id)
                
        });

        function tipo_modelo()
            {
                var id =  $(this).val();   
                if(id == 4)
                {
                    var div =   '<div class="input-group-prepend">'
                        div+=   '<span class="input-group-text"><b>Categoria de Modelaje:</b></span>'
                        div+=        '</div>'
                        div+=        '<select name="typeModel_id" id="modelo" class="form-control select2" required>'
                        div+=            '<option value="">Seleccione un tipo..</option>'
                        div+=            '@foreach($model as $item)'
                        div+=                '<option value="{{$item->id}}">{{$item->name}}</option>'
                        div+=            '@endforeach'
                        div+=        '</select>'
                    $('#div_model').html(div);
                }
                else
                {
                    div ='';
                    $('#div_model').html(div);
                }
            }




        $('#modal_delete').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) //captura valor del data-empresa=""

                var id = button.data('id')
                var modal = $(this)
                modal.find('.modal-body #id').val(id)
                
        });

       

                function selectCity()
                {
                    var id =  $(this).val();    
                    if(id >=1)
                    {
                        $.get('{{route('ajax.get_city')}}/'+id, function(data){
                            var html_city=    '<option value="">Seleccione una ciudad..</option>'
                                for(var i=0; i<data.length; ++i)
                                html_city += '<option value="'+data[i].id+'">'+data[i].name+'</option>'

                            $('#city_id').html(html_city);;            
                        });
                    }
                    else
                    {
                        var html_city=    '<option value="">Seleccione una ciudad..</option>'       
                        $('#city_id').html(html_city);
                    }
                };


        function openWindows(id, experience)
        {
            // alert(id)
            window.open("{{ route('work-experience.print-ficha-tecnica')}}/"+id+"/"+experience, 'Apertura de caja', `width=500, height=800`);
        }
        function openPasante(id)
        {
            window.open("{{ route('pasantes.print')}}/"+id, 'print pasantes', `width=500, height=800`);
        }

    </script>
@stop
@else
@section('content')
    <h1>No tienes permiso</h1>
@stop
@endif