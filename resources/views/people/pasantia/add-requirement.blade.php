@extends('voyager::master')

@section('page_title', 'Requisitos')
@if(auth()->user()->hasPermission('edit_pasantes') && !auth()->user()->hasRole('admin'))

@section('page_header')
    <h1 class="page-title" id="subtitle">
        <i class="voyager-folder"></i> Requisitos para la pasantía
        &nbsp; 
        <a href="{{ auth()->user()->hasRole('admin')? URL::previous():route('people-perfil-experience.index')}}" class="btn btn-warning">
          <i class="fa-solid fa-circle-left"></i>
            Volver
        </a>
    </h1>
@stop

@section('content')
    <div class="page-content browse container-fluid">
        @include('voyager::alerts')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">           
                        <div class="row">
                        {!! Form::open(['route' => 'pasantes.update','class' => 'was-validated', 'method'=>'POST', 'enctype' => 'multipart/form-data'])!!}
                            <input type="hidden" name="pasantia_id" value="{{$pasantia_id}}">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <div class="form-line">
                                        <select name="type" class="form-control text">
                                            <option value="" disabled selected>Seleccione una opcion.</option>
                                            <option value="Estudiante Universitario">Estudiante Univ.</option>
                                            <option value="Egresado">Egresado</option>                                                 
                                        </select>
                                    </div>
                                    <small>Nivel Academico.</small>
                                </div>
                            </div>
                        
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="semester" class="form-control form-control-sm text" max="50" placeholder="1re año">
                                    </div>
                                    <small>Año/Semestre.</small>
                                </div>
                            </div>
                        </div>   
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea name="objetive"  class="form-control form-control-sm text" id="" rows="3"></textarea>
                                    </div>
                                    <small>Objetivo de la Pasantia.</small>
                                </div>
                            </div>
                        </div> 
                        @if (auth()->user()->hasPermission('edit_pasantes'))
                            <button id="btn_guardar" type="submit"  class="btn btn-primary"><i class="fas fa-save"></i> Actualizar</button>
                        @endif
                     
                        {!! Form::close()!!}
                               
                        <div class="table-responsive">    
                            <table id="dataTable" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Tipo</th>
                                        <th>Detalle</th>
                                        {{-- <th>Accion</th>             --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    </tr>
                                        <td>Nivel Academico</td>
                                        <td>
                                            @if ($pasantia->type)
                                                {{$pasantia->type}}
                                            @else
                                                <span class="badge badge-danger">No cargado</span>
                                            @endif
                                        </td>             
                                    </tr>
                                    </tr>
                                        <td>Año/Semestre</td>
                                        <td>
                                            @if ($pasantia->semester)
                                                {{$pasantia->semester}}
                                            @else
                                                <span class="badge badge-danger">No cargado</span>
                                            @endif
                                        </td>             
                                    </tr>
                                    </tr>
                                        <td>Objetivo de la pasantía</td>
                                        <td>
                                            @if ($pasantia->objetive)
                                                {{$pasantia->objetive}}
                                            @else
                                                <span class="badge badge-danger">No cargado</span>
                                            @endif
                                        </td>             
                                    </tr>
                                </tbody>                                        
                            </table>  
                            {{-- <div class="row">
                                <div class="col-sm-6" style="text-align: left">
                                    <button id="btn_guardar" type="submit"  class="btn btn-primary"><i class="fas fa-save"></i> Actualizar</button>
                                </div>
                                {!! Form::close()!!}
                                <div class="col-sm-6" style="text-align: right">
                                    @if (auth()->user()->hasPermission('add_course'))
                                        <a type="button" data-toggle="modal" data-target="#modal-create" class="btn btn-success">
                                            <i class="voyager-plus"></i> <span>Agergar Cursos Realisados</span>
                                        </a>
                                    @endif                                    
                                </div>
                            </div> --}}


                            @if (auth()->user()->hasPermission('add_course'))
                                        <a type="button" data-toggle="modal" data-target="#modal-create" class="btn btn-success">
                                            <i class="voyager-plus"></i> <span>Agergar Cursos Realisados</span>
                                        </a>
                                    @endif  
                            <table id="dataTable" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th colspan="2" style="text-align: center">Desde</th>
                                        <th colspan="2" style="text-align: center">Hasta</th>
                                        <th colspan="3" style="text-align: right">
                                            
                                        </th>
                                    </tr>
                                    <tr>
                                        <th style="text-align: center">Mes</th>
                                        <th style="text-align: center">Año</th>
                                        <th style="text-align: center">Mes</th>
                                        <th style="text-align: center">Año</th>
                                        <th style="text-align: center">Universidad - Institución</th>
                                        <th style="text-align: center">Curso</th>
                                        <th style="text-align: right">Accion.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($courses as $item)
                                        <tr>
                                            <td style="text-align: center">{{\Carbon\Carbon::parse($item->start)->format('m')}}</td>
                                            <td style="text-align: center">{{\Carbon\Carbon::parse($item->start)->format('Y')}}</td>
                                            <td style="text-align: center">{{\Carbon\Carbon::parse($item->finish)->format('m')}}</td>
                                            <td style="text-align: center">{{\Carbon\Carbon::parse($item->finish)->format('Y')}}</td>
                                            <td style="text-align: center">{{$item->institution}}</td>
                                            <td style="text-align: center">{{$item->name}}</td>
                                            <td style="text-align: right">
                                                @if (auth()->user()->hasPermission('delete_course'))
                                                    <a title="Eliminar Cursos" data-toggle="modal" data-target="#modal_delete" data-id="{{$item->id}}" class="btn btn-sm btn-danger">
                                                        <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">Eliminar</span>
                                                    </a>
                                                @endif
                                                
                                            </td>

                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" style="text-align: center">Sin cursos realizados</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                               
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade modal-success" role="dialog" id="modal-create">
        <div class="modal-dialog modal-md">
            <div class="modal-content">                
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-plus"></i> Agregar Cursos  Realizados</h4>
                </div>
                {!! Form::open(['route' => 'pasantes-courses.store','class' => 'was-validated'])!!}
                    <!-- Modal body -->
                    <div class="modal-body">
                        <input type="hidden" name="pasantia_id" value="{{$pasantia_id}}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group-prepend">
                                    <small class="input-group-text"><b>Desde:</b></small>
                                </div>
                                <input type="date" class="form-control text" name="start">
                            </div>
                            <div class="col-md-6">
                                <div class="input-group-prepend">
                                    <small class="input-group-text"><b>Hasta:</b></small>
                                </div>
                                <input type="date" class="form-control text" name="finish">
                            </div>
                        </div>     
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group-prepend">
                                    <small class="input-group-text"><b>Universidad - Institución:</b></small>
                                </div>
                                <textarea name="institution"  class="form-control form-control-sm text" id="" rows="2"></textarea>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group-prepend">
                                    <small class="input-group-text"><b>Curso:</b></small>
                                </div>
                                <textarea name="name"  class="form-control form-control-sm text" id="" rows="2"></textarea>
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
                {!! Form::open(['route' => 'pasantes-courses.destroy', 'method' => 'DELETE']) !!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-trash"></i> Eliminar</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="pasantia_id" value="{{$pasantia_id}}">

                    <input type="hidden" name="id" id="id">

                    <div class="text-center" style="text-transform:uppercase">
                        <i class="voyager-trash" style="color: red; font-size: 5em;"></i>
                        <br>
                        
                        <p><b>Desea eliminar..?</b></p>
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
<style>
    
    input.text, select.text, textarea.text{ 
        border-radius: 5px 5px 5px 5px;
        color: #000000;
        border-color: rgb(63, 63, 63);
    }

   
    small{font-size 10px;
        color: rgb(12, 12, 12);
        font-weight: bold;
    }
    


</style>
@stop


@section('javascript')
    <script>
        $(document).ready(function () {
            
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