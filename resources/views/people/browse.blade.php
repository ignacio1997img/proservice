@extends('voyager::master')

@section('page_title', 'Viendo Registros')

@section('page_header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <h1 class="page-title">
                    <i class="voyager-person"></i> Personas
                </h1>
                {{-- <a href="" class="btn btn-success btn-add-new">
                    <i class="voyager-plus"></i> <span>Crear</span>
                </a> --}}
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
                                        <th>Ci.</th>
                                        <th>Nombre.</th>
                                        <th>Apellido.</th>
                                        <th>Fecha de Nacimiento.</th>
                                        <th>Email.</th>
                                        <th>Sexo</th>
                                        <th>Direccion.</th>
                                        <th>Estado.</th>
                                        <th>Accion.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($people as $item)
                                    @php
                                        
                                    @endphp
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->ci }}</td>
                                        <td>{{ $item->first_name }}</td>
                                        <td>{{ $item->last_name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->birth_date)->format('d/m/Y') }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>
                                            @if($item->sex == 1)
                                                Masculino
                                            @else
                                                Femenino
                                            @endif
                                        </td>
                                        <td>{{ $item->address }}</td>
                                        <td>
                                            @if ($item->status == 1)
                                                <label class="label label-success">Activo</label>
                                            @else
                                                <label class="label label-danger">Inactivo</label>
                                            @endif
                                        </td>
                                        <td class="actions text-right dt-not-orderable sorting_disabled">
                                            <a type="button" data-toggle="modal" href=""  class="btn btn-warning"><i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">Ver</span></a>                                           
                                        </td>

                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10">No hay registros</td>
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
@stop

@section('css')

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

    </script>

@stop
