@extends('voyager::master')
@if(auth()->user()->hasPermission('prueba'))

@section('page_title', 'Viendo Porta Folio')
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> --}}
    
@section('page_header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <h1 id="subtitle" class="page-title">
                    <i class="fa-solid fa-photo-film"></i> Porta Folio
                    &nbsp; 
                    
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
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#home">Modelos</a></li>
                            <li><a data-toggle="tab" href="#sol">Porta Folio</a></li>
                        </ul>

                        <div class="tab-content">
                            <div id="home" class="tab-pane fade in active">                                               
                                <div class="table-responsive">
                                    <table id="dataTable" class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center">Id&deg;</th>
                                                <th style="text-align: center">Modelo.</th>
                                                <th style="text-align: center">Porta Folio.</th>
                                                <th style="text-align: right" >Accion.</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($model as $item)
                                                <tr>
                                                    <td style="text-align: center">{{$item->id}}</td>
                                                    <td style="text-align: center">{{$item->first_name}} {{$item->first_name}}</td>
                                                    <td style="text-align: center">
                                                        @if ($item->folio == 1)
                                                            <span class="badge badge-success">Porta Folio</span>
                                                        @else
                                                            <span class="badge badge-danger">Inactivo</span>
                                                        @endif
                                                    </td>
                                                    <td style="text-align: right">
                                                            {{-- <a type="button" data-toggle="modal" data-target="#modal_solicitud" data-id="{{ $item->id}}"  class="btn btn-success"><i class="voyager-check"></i> <span class="hidden-xs hidden-sm">Enviar</span></a> --}}
                                                        @if ($item->folio == 0)
                                                            <a type="button" data-toggle="modal" data-target="#modalFolio" data-id="{{ $item->id}}" title="Agregar el modelo al portafolio" class="btn btn-primary">
                                                                <i class="fa-solid fa-photo-film"></i><span class="hidden-xs hidden-sm"> Agregar</span>
                                                            </a>
                                                        @else       
                                                            {{-- <a type="button" data-toggle="modal" data-target="#modalUpdate" data-id="{{ $item->id}}" title="Eliminar modelo del portafolio" class="btn btn-danger">
                                                                <i class="fa-solid fa-trash"></i><span class="hidden-xs hidden-sm"> Eliminar</span>
                                                            </a> --}}
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    
                                    </table>
                                </div>
                            </div>
                            <div id="sol" class="tab-pane fade">                                               
                                <div class="table-responsive">
                                    <table id="dataTable1" class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center">Id&deg;</th>
                                                <th style="text-align: center">Modelo.</th>
                                                <th style="text-align: center">Porta Folio.</th>
                                                <th style="text-align: right">Accion.</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($folio as $item)
                                                <tr>
                                                    <td style="text-align: center">{{$item->folio_id}}</td>
                                                    <td style="text-align: center">{{$item->first_name}} {{$item->first_name}}</td>
                                                    <td style="text-align: center">
                                                        @if ($item->folio == 1)
                                                            <span class="badge badge-success">Porta Folio</span>
                                                        @else
                                                            <span class="badge badge-danger">Inactivo</span>
                                                        @endif
                                                    </td>
                                                    <td style="text-align: right">    
                                                            <a type="button" data-toggle="modal" data-target="#modalUpdate" data-id="{{ $item->id}}" data-folio_id="{{ $item->folio_id}}" title="Eliminar modelo del portafolio" class="btn btn-danger">
                                                                <i class="fa-solid fa-trash"></i><span class="hidden-xs hidden-sm"> Eliminar</span>
                                                            </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {!! Form::open(['route' => 'modelfolio.store','class' => 'was-validated', 'method'=>'POST', 'enctype' => 'multipart/form-data'])!!}
        <div class="modal fade" tabindex="-1" id="modalFolio" role="dialog">
            <div class="modal-dialog modal-primary">
                <div class="modal-content">
                        
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="fa-solid fa-photo-film"></i> Agregar al Portafolio</h4>
                    </div>
                    <div class="modal-body">

                        <div class="text-center" style="text-transform:uppercase">
                            <i class="fa-solid fa-photo-film" style="color: rgb(87, 87, 87); font-size: 5em;"></i>
                            <br>
                            <p><b>Desea agregar al portafolio..!</b></p>
                        </div>
                        <input type="text" id="id" name="id">
                    </div>       
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <input type="submit" class="btn btn-primary" value="Sí, Agregar">
                        {{-- <button type="button" class="btn btn-success btn-submit" onclick="sendForm('form-pagars', 'Mensaje enviado exitosamente.')">Sí, Enviar</button> --}}

                    </div>
                </div>
            </div>
        </div>
    {!! Form::close()!!} 

    {!! Form::open(['route' => 'modelfolio.update','class' => 'was-validated', 'method'=>'POST', 'enctype' => 'multipart/form-data'])!!}
        <div class="modal fade" tabindex="-1" id="modalUpdate" role="dialog">
            <div class="modal-dialog modal-danger">
                <div class="modal-content">
                        
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="fa-solid fa-photo-film"></i> Eliminar del Portafolio</h4>
                    </div>
                    <div class="modal-body">

                        <div class="text-center" style="text-transform:uppercase">
                            <i class="fa-solid fa-photo-film" style="color: rgb(87, 87, 87); font-size: 5em;"></i>
                            <br>
                            <p><b>Desea eliminar del portafolio..!</b></p>
                        </div>
                        <input type="text" id="id" name="id">
                        <input type="text" id="folio_id" name="folio_id">
                    </div>       
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <input type="submit" class="btn btn-danger" value="Sí, Agregar">
                        {{-- <button type="button" class="btn btn-success btn-submit" onclick="sendForm('form-pagars', 'Mensaje enviado exitosamente.')">Sí, Enviar</button> --}}
                    </div>
                </div>
            </div>
        </div>
    {!! Form::close()!!} 


   
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
        

    #dataTable1 {
    font-family: Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
    }

    #dataTable1 td, #dataTable1 th {
    border: 1px solid #ddd;
    padding: 8px;
    }

    #dataTable1 tr:nth-child(even){background-color: #f2f2f2;}

    #dataTable1 tr:hover {background-color: #ddd;}

    #dataTable1 th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: center;
        background-color: #04AA6D;
        color: white;
    }

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
                $('#dataTable1').DataTable({
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

            $('#modalFolio').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) 

                var id = button.data('id')

                var modal = $(this)
                // alert(id)
                modal.find('.modal-body #id').val(id)
                
            });

            $('#modalUpdate').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) 

                var id = button.data('id')
                var folio_id = button.data('folio_id')

                var modal = $(this)
                // alert(id)
                modal.find('.modal-body #id').val(id)
                modal.find('.modal-body #folio_id').val(folio_id)
                
            });

            


    </script>

 

{{-- <script>
    $(document).ready(function () {
        
    });

    $('#modal_delete').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) //captura valor del data-empresa=""

            var id = button.data('id')
            var modal = $(this)
            modal.find('.modal-body #id').val(id)
            
    });
</script> --}}
    {{-- <script>
        var count;
        function calificar(item)
        {
            console.log(item);
            count = item.id[0];
            let nombre = item.id.substring(1);
            for(let i=0; i<5; i++)
            {
                if(i<count)
                {
                    document.getElementById((i+1)+nombre).style.color = "orange";
                }
                else
                {
                    document.getElementById((i+1)+nombre).style.color = "black";
                }
            }
            // var div =   '<div class="col-md-12">'
                       var div=            '<input type="hidden" class="form-control" name="star" value="'+count+'">'
                        // div+=        '</div>'
                    $('#div_cis').html(div);
                    // $('#stars').val(count);
        }
        $('#modal_calificar').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) 
                var id = button.data('id')
                // alert(id);

                var modal = $(this)
                modal.find('.modal-body #id').val(id)
                
        });
    </script> --}}

@stop

@else
    @section('content')
        <h1>No tienes permiso</h1>
    @stop
@endif