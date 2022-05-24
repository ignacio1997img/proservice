@extends('voyager::master')
{{-- @if(auth()->user()->hasPermission('browse_message-people-bandeja')) --}}

@section('page_title', 'Viendo Registros')

@section('page_header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <h1 class="page-title">
                    <i class="fa-regular fa-envelope"></i> Solicitudes pendientes
                </h1>
            </div>
            <div class="col-md-4">

            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="page-content browse container-fluid">
        @include('voyager::alerts')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">                        
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Id&deg;</th>
                                        {{-- <th>NIT</th> --}}
                                        <th>Empresa.</th>
                                        {{-- <th>Rubro.</th> --}}
                                        <th>Detalle</th>
                                        <th>Estado.</th>
                                        <th>Acciones.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($message as $item)
                                    <tr style="text-align: center">
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->busine->name }} <br> {{$item->rubro_busine->name}} </td>                                        
                                        <td>{{ $item->detail }}</td>
                                        <td>
                                            @if ($item->status == 1)
                                                <label class="label label-success">Solicitud Aceptada</label>
                                            @endif
                                            @if ($item->status == 2)

                                                <label class="label label-warning">Solicitud Pendiente</label>
                                            @endif
                                            @if ($item->status == 0)

                                                <label class="label label-danger">Solicitud Rechazada</label>
                                            @endif
                                        </td>
                                        <td class="actions text-right">
                                            @if ($item->status == 1)
                                                <a type="button" data-toggle="modal" href="{{route('message-beneficiary.bandeja.busine-perfil-view',['busine_id'=>$item->busine->id])}}" class="btn btn-success"><span class="hidden-xs hidden-sm">Ver</span></a>
                                            @endif
                                            @if ($item->status == 2)
                                                {{-- <a type="button" data-toggle="modal" data-target="#modal_aprobar" data-id="{{ $item->id}}"  class="btn btn-primary"><span class="hidden-xs hidden-sm">Aceptar</span></a> --}}
                                                <a type="button" data-toggle="modal" data-target="#modal_cancelar" data-id="{{ $item->id}}"  class="btn btn-danger"><span class="hidden-xs hidden-sm">Cancelar</span></a>
                                            @endif

                                           
                                        </td>

                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No hay registros</td>
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

     {{-- para cancelar la solicitud enviada ala empresa --}}
     <div class="modal modal-danger fade" tabindex="-1" id="modal_cancelar" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['route' => 'message-beneficiary.cancelar', 'method' => 'POST']) !!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa-regular fa-envelope"></i>  Cancelar</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">

                    <div class="text-center" style="text-transform:uppercase">
                        <i class="voyager-check" style="color: green; font-size: 5em;"></i>
                        <br>
                        <p><b>Rechazar Solicitud....!</b></p>
                    </div>
                </div>                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <input type="submit" class="btn btn-danger" value="Sí, RECHAZAR">
                </div>
                {!! Form::close()!!} 
            </div>
        </div>
    </div>
@stop

@section('css')
<style>
    /* #subtitle{
        font-size: 18px;
        color: rgb(12, 12, 12);
        font-weight: bold;
    } */
    #dataTable {
    font-family: Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
    }

    #dataTable td, #dataTable th {
    border: 1px solid #ddd;
    padding: 8px;
    }

    #dataTable tr:nth-child(even){background-color: #f2f2f2;}

    #dataTable tr:hover {background-color: #ddd;}

    #dataTable th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: center;
        background-color: #04AA6D;
        color: white;
    }

    /* small{font-size: 15px;
        color: rgb(12, 12, 12);
        font-weight: bold;
    } */
        

</style>
@stop

@section('javascript')
    <script src="{{ url('js/main.js') }}"></script>
    <script>
        $(document).ready(() => {
                $('#dataTable').DataTable({
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
                });

            });

            // $('#modal_aprobar').on('show.bs.modal', function (event) {
            //     var button = $(event.relatedTarget) 

            //     var id = button.data('id')

            //     var modal = $(this)
            //     modal.find('.modal-body #id').val(id)
                
            // });

            // $('#modal_rechazar').on('show.bs.modal', function (event) {
            //     var button = $(event.relatedTarget) 

            //     var id = button.data('id')

            //     var modal = $(this)
            //     modal.find('.modal-body #id').val(id)
                
            // });

             $('#modal_cancelar').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) 

                var id = button.data('id')

                var modal = $(this)
                modal.find('.modal-body #id').val(id)
                
            });

    </script>

@stop
{{-- 
@else
    @section('content')
        <h1>No tienes permiso</h1>
    @stop
@endif --}}