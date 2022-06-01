@extends('voyager::master')
@if(auth()->user()->hasPermission('browse_people-perfil-experience'))
@section('page_title', 'Viendo Registros')

@section('page_header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <h1 class="page-title">
                    <i class="fa-solid fa-person-digging"></i> Perfil
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
                                        @if(auth()->user()->hasPermission('edit_people-perfil-data'))
                                            <a type="button" data-toggle="modal" data-target="#modal_edit" class="btn btn-success">
                                                <i class="voyager-plus"></i> <span>Editar Datos</span>
                                            </a>
                                        @endif
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
                                        @if(auth()->user()->hasPermission('add_people-perfil-experience'))
                                            <a type="button" data-toggle="modal" data-target="#modal-create" class="btn btn-success">
                                                <i class="voyager-plus"></i> <span>Experiencia de Trabajo</span>
                                            </a>
                                        @endif
                                            <table id="dataTable" class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Nro&deg;</th>
                                                        <th>Experiencia Laboral</th>
                                                        <th>Estado</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $i = 1;
                                                    @endphp
                                                    @foreach ($experiences as $item)
                                                        <tr>
                                                            <td>{{$i}}</td>
                                                            <td>{{$item->rubro_people->name}}</td>    
                                                            <td>
                                                                @if ($item->status == 1)
                                                                    <label class="label label-success">Aprobado</label>
                                                                @else
                                                                    <label class="label label-danger">Pendiente</label>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <div class="no-sort no-click bread-actions text-right">
                                                                    @if(auth()->user()->hasPermission('edit_people-perfil-requirement'))
                                                                        <a href="{{route('work-experience.requirement-create', ['id'=>$item->id, 'rubro_id'=>$item->rubro_id])}}" title="Editar" class="btn btn-sm btn-warning">
                                                                            <i class="voyager-receipt"></i> <span class="hidden-xs hidden-sm">Requisitos</span>
                                                                        </a>
                                                                    @endif
                                                                    {{-- @if(auth()->user()->hasPermission('delete_people-perfil-experience'))
                                                                        <button title="Anular" class="btn btn-sm btn-danger delete" data-toggle="modal" data-id="{{$item->id}}" data-target="#modal_delete">
                                                                            <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">Anular</span>
                                                                        </button>
                                                                    @endif --}}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $i++;
                                                        @endphp
                                                    @endforeach                                        
                                                </tbody>
                                            </table>
                                    </div>                      
                                </main>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>   


{{-- para editar los datos basico de una persona mediante un perfil --}}
{{-- modal para editar los datos de la empresa --}}
<div class="modal fade modal-primary" role="dialog" id="modal_edit">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">                
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="voyager-plus"></i> Editar Datos de la Empresa</h4>
            </div>
            {!! Form::open(['route' => 'people-perfil.update','class' => 'was-validated'])!!}
                <!-- Modal body -->
                <div class="modal-body">
                    <input type="hidden" name="id" value="{{$people->id}}">
                    
                    <div id="cantcheque">                                   
                        <div class="row" >
                            <div class="col-md-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><b>CI:</b></span>
                                </div>
                                <input type="number" class="form-control" name="ci" value="{{$people->ci}}">
                            </div>
                            <div class="col-md-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><b>Nombre:</b></span>
                                </div>
                                <input type="text" class="form-control" name="first_name" value="{{$people->first_name}}">
                            </div>     
                            <div class="col-md-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><b>Apellido:</b></span>
                                </div>
                                <input type="text" class="form-control" name="last_name" value="{{$people->last_name}}">
                            </div>                            
                        </div>
                    </div>

                    <div id="cantcheque">                                   
                        <div class="row" >
                            <div class="col-md-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><b>Fecha de Nacimiento:</b></span>
                                </div>
                                <input type="date" class="form-control" name="birth_date" value="{{$people->birth_date}}">
                            </div>
                            <div class="col-md-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><b>Email:</b></span>
                                </div>
                                <input type="text" class="form-control" name="email" value="{{$people->email}}">
                            </div>         
                            <div class="col-md-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><b>Sexo:</b></span>
                                </div>
                                <select name="sex" id="sex" class="form-control">
                                    <option value="1" {{$people->sex == 1? 'selected':''}}>MASCULINO</option>
                                    <option value="0" {{$people->sex == 0? 'selected':''}}>FEMENINO</option>
                                </select>
                            </div>                         
                        </div>
                    </div>
                    <div id="cantcheque">                                   
                        <div class="row" >
                            <div class="col-md-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><b>Telefono 1:</b></span>
                                </div>
                                <input type="number" class="form-control" name="phone1" value="{{$people->phone1}}">
                            </div>
                            <div class="col-md-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><b>Telefono 2:</b></span>
                                </div>
                                <input type="number" class="form-control" name="phone2" value="{{$people->phone2}}">
                            </div>                        
                        </div>
                    </div>
                    <div class="row">    
                            
                        <div class="col-md-12">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><b>Direccion:</b></span>
                            </div>
                            <textarea class="form-control" name="address" cols="77" rows="3">{{$people->address}}</textarea>
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

    {{-- modal para registrar las experiencia de cada persona --}}
    <div class="modal fade modal-success" role="dialog" id="modal-create">
        <div class="modal-dialog modal-md">
            <div class="modal-content">                
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-plus"></i> Crear cheque</h4>
                </div>
                {!! Form::open(['route' => 'people-perfil-experience.store','class' => 'was-validated'])!!}
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><b>Tipo de Cheque:</b></span>
                                </div>
                                <select name="rubro_id" id="rubro_id" class="form-control select2" required>
                                    <option value="">Seleccione un tipo..</option>
                                    @foreach($rubro as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
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
                    <h4 class="modal-title"><i class="voyager-trash"></i> Desea eliminar el siguiente registro?</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">

                    <div class="text-center" style="text-transform:uppercase">
                        <i class="voyager-trash" style="color: red; font-size: 5em;"></i>
                        <br>
                        
                        <p><b>Desea eliminar el siguiente registro?</b></p>
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
@else
@section('content')
    <h1>No tienes permiso</h1>
@stop
@endif