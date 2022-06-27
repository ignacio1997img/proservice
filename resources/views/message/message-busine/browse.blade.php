@extends('voyager::master')
{{-- @if(auth()->user()->hasPermission('browse_message-people-bandeja')) --}}

@section('page_title', 'Viendo Registros')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .footer{
            position:fixed;
            bottom:0px;
            left:0px;
            width: 100%;
            background-color:rgba(0, 0, 0, 0.7);
            z-index: 10000;
        }
        .footer-content{
            margin: 10px 20px;
            color: white;
            font-size: 20px;
        }

        img {
            max-width: 100%;
            max-height: 100%;
        }
        .cat {
            height: 100px;
            width: 200px;
        }
    </style>
@section('page_header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <h1 class="page-title">
                    <i class="fa-regular fa-envelope"></i> Solicitudes
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
                            <li class="active"><a data-toggle="tab" href="#home">Solicitudes Recibidas</a></li>
                            <li><a data-toggle="tab" href="#sol">Solicitudes Enviadas</a></li>
                        </ul>

                        <div class="tab-content">
                            <div id="home" class="tab-pane fade in active">                                               
                                <div class="table-responsive">
                                    <table id="dataTable" class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Id&deg;</th>
                                                <th>Empresa.</th>
                                                <th>Detalle</th>
                                                <th>Estado.</th>
                                                <th>Accion.</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($entrada as $item)
                                            <tr @if (!$item->view) style="background-color: rgba(192,57,43,0.3); text-align: center" @endif style="text-align: center">
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->beneficiary->name }}<br>{{$item->rubro_busine->name}} </td>
                                        
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
                                                        <a type="button" data-toggle="modal" href="https://wa.me/591{{$item->beneficiary->phone1? $item->beneficiary->phone1 : $item->beneficiary->phone2}}?text=Hola, quiero contactarme con usted"  class="btn btn-success" title="Contactarme"><i class="fa-brands fa-whatsapp"></i> <span class="hidden-xs hidden-sm"></span></a>                                           
                                                    @endif
                                                    @if ($item->status == 2)
                                                        <a type="button" data-toggle="modal" data-target="#modal_aprobar" data-id="{{ $item->id}}"  class="btn btn-primary"><span class="hidden-xs hidden-sm">Aceptar</span></a>
                                                        <a type="button" data-toggle="modal" data-target="#modal_rechazar" data-id="{{ $item->id}}"  class="btn btn-danger"><span class="hidden-xs hidden-sm">Rechazar</span></a>
                                                    @endif
                                                    {{-- <a type="button" data-toggle="modal" href="{{route('busines.show', $item->id)}}"  class="btn btn-warning"><i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">Ver</span></a>                                            --}}
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
                            <div id="sol" class="tab-pane fade">                                               
                                <div class="table-responsive">
                                    <table id="dataTable1" class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Id&deg;</th>
                                                <th>Rubro.</th>
                                                <th>Nombre.</th>
                                                <th>Apellido.</th>
                                                <th>Precio Estimado <br>a pagar.</th>
                                                <th>Detalle.</th>
                                                <th>Calificacion.</th>
                                                <th>Estado.</th>
                                                <th>Acciones.</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($message as $item)
                                            <tr @if (!$item->date_view && $item->status == 1) style="background-color: rgba(192,57,43,0.3); text-align: center" @endif style="text-align: center">
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->rubro_people->name }}</td>
                                                <td>
                                                    {{$item->people->first_name}}
                                                </td>
                                                <td>
                                                    {{$item->people->last_name}}
                                                </td>
                                                <td>
                                                    @if ($item->imoney || $item->fmoney)
                                                        {{ $item->imoney }} -  {{ $item->fmoney }}<br>
                                                    @else
                                                        <i class="fa-solid fa-bars"></i>
                                                    @endif
        
                                                </td>
                                                <td>{{ $item->detail }}</td>
                                                <td style="text-align: center">
                                                    @if($item->star == 0 && $item->star_date != null)
                                                        <i class="fa fa-star" style="color: #b3b3b3"></i>
                                                        <i class="fa fa-star" style="color: #b3b3b3"></i>
                                                        <i class="fa fa-star" style="color: #b3b3b3"></i>
                                                        <i class="fa fa-star" style="color: #b3b3b3"></i>
                                                        <i class="fa fa-star" style="color: #b3b3b3"></i>
                                                    @endif
                                                    @if( $item->star_date == null && $item->status != 0)

                                                        Sin Calificar
                                                    @endif
                                                    @if($item->star == 1)
                                                        <i class="fa fa-star" style="color: #ffc107"></i>
                                                        <i class="fa fa-star" style="color: #b3b3b3"></i>
                                                        <i class="fa fa-star" style="color: #b3b3b3"></i>
                                                        <i class="fa fa-star" style="color: #b3b3b3"></i>
                                                        <i class="fa fa-star" style="color: #b3b3b3"></i>
                                                    @elseif($item->star == 2)
                                                        <i class="fa fa-star" style="color: #ffc107"></i>
                                                        <i class="fa fa-star" style="color: #ffc107"></i>
                                                        <i class="fa fa-star" style="color: #b3b3b3"></i>
                                                        <i class="fa fa-star" style="color: #b3b3b3"></i>
                                                        <i class="fa fa-star" style="color: #b3b3b3"></i>
                                                    @elseif($item->star == 3)
                                                        <i class="fa fa-star" style="color: #ffc107"></i>
                                                        <i class="fa fa-star" style="color: #ffc107"></i>
                                                        <i class="fa fa-star" style="color: #ffc107"></i>
                                                        <i class="fa fa-star" style="color: #b3b3b3"></i>
                                                        <i class="fa fa-star" style="color: #b3b3b3"></i>
                                                    @elseif($item->star == 4)
                                                        <i class="fa fa-star" style="color: #ffc107"></i>
                                                        <i class="fa fa-star" style="color: #ffc107"></i>
                                                        <i class="fa fa-star" style="color: #ffc107"></i>
                                                        <i class="fa fa-star" style="color: #ffc107"></i>
                                                        <i class="fa fa-star" style="color: #b3b3b3"></i>
                                                    @elseif($item->star == 5)
                                                        <i class="fa fa-star" style="color: #ffc107"></i>
                                                        <i class="fa fa-star" style="color: #ffc107"></i>
                                                        <i class="fa fa-star" style="color: #ffc107"></i>
                                                        <i class="fa fa-star" style="color: #ffc107"></i>
                                                        <i class="fa fa-star" style="color: #ffc107"></i>
                                                    @endif
                                                </td>
                                                <td style="text-align: center">
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
                                                        @if (!$item->star_date)
                                                            <a type="button" data-toggle="modal" data-target="#modal_calificar" data-id="{{$item->id}}" class="btn btn-primary"><span class="hidden-xs hidden-sm">Calificar</span></a>
                                                        @else

                                                        @endif
                                                        <a type="button" data-toggle="modal" href="{{route('message-busine.bandeja.people-perfil-view',['id'=>$item->id, 'people_id'=>$item->people->id, 'rubro_id'=>$item->rubro_people->id, 'experience'=>$item->people_experience_id != null? $item->people_experience_id:0])}}" class="btn btn-success"><span class="hidden-xs hidden-sm">Ver</span></a>
                                                    @endif
                                                    @if ($item->status == 2)
                                                        {{-- <a type="button" data-toggle="modal" data-target="#modal_aprobar" data-id="{{ $item->id}}"  class="btn btn-primary"><span class="hidden-xs hidden-sm">Aceptar</span></a> --}}
                                                        <a type="button" data-toggle="modal" data-target="#modal_cancelar" data-id="{{ $item->id}}"  class="btn btn-danger"><span class="hidden-xs hidden-sm">Cancelar</span></a>
                                                    @endif

                                                   
                                                </td>
        
                                            </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="8" class="text-center">No hay registros</td>
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
        </div>
    </div>

    {{-- para aceptar  la solicitud que recibe la empresa de los beneficiario --}}
    <div class="modal modal-primary fade" tabindex="-1" id="modal_aprobar" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                {!! Form::open(['route' => 'message-busine.aceptar', 'method' => 'POST']) !!}
                <div class="modal-header" >
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa-regular fa-envelope"></i>  Solicitud</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">

                    <div class="text-center" style="text-transform:uppercase">
                        {{-- <i class="voyager-check" style="color: green; font-size: 5em;"></i> --}}
                        <i class="fa-regular fa-envelope" style="color: rgb(51, 161, 75); font-size: 4em;"></i>
                        <br>
                        <p><b>Aceptar Solicitud....!</b></p>
                    </div>
                </div>                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <input type="submit" class="btn btn-dark" value="Sí, ACEPTAR">
                </div>
                {!! Form::close()!!} 
            </div>
        </div>
    </div>

    {{--para rechazar  la solicitud que recibe la empresa de los beneficiario --}}
    <div class="modal modal-danger fade" tabindex="-1" id="modal_rechazar" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['route' => 'message-busine.rechazar', 'method' => 'POST']) !!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa-regular fa-envelope"></i>  Rechazar</h4>
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




    {{-- para cancelar la solicitud enviada al trabajador --}}
    <div class="modal modal-primary fade" data-backdrop="static" data-keyboard="false" id="modal_calificar" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-star"></i> Calificar</h4>
            </div>
            {!! Form::open(['route' => 'message-busine.bandeja.calificacion', 'method' => 'POST']) !!}
            <div class="modal-body">
                <input type="hidden" id="id" name="id">               
                
                <div class="col-12">
                        <div class="card-body">
                          <div class="col-12" style="text-align: center">
                            <h5 class="card-title" style="font-size: 30px">Calificar</h5>
                            <span class="fa fa-star" onclick="calificar(this)" style="cursor: pointer; font-size: 2em;" id="1estrella"></span>
                            <span class="fa fa-star" onclick="calificar(this)" style="cursor: pointer; font-size: 2em;" id="2estrella"></span>
                            <span class="fa fa-star" onclick="calificar(this)" style="cursor: pointer; font-size: 2em;" id="3estrella"></span>
                            <span class="fa fa-star" onclick="calificar(this)" style="cursor: pointer; font-size: 2em;" id="4estrella"></span>
                            <span class="fa fa-star" onclick="calificar(this)" style="cursor: pointer; font-size: 2em;" id="5estrella"></span>
                            <br>
                            <br>
                            {{-- <input type="text" class="from-control"> --}}
                          </div>
                          <div class="col-12">
                            <textarea name="comment" id="" class="from-control" cols="30" rows="3" maxlength="150"></textarea>
                          </div>
                        </div>
                   
                </div>
                <div class="row" id="div_cis">
                                
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-dark">Calificar</button>
            </div>
            {!! Form::close()!!} 
        </div>
        </div>
    </div>


    <div class="modal modal-danger fade" tabindex="-1" id="modal_cancelar" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['route' => 'message-busine.cancelar', 'method' => 'POST']) !!}
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

            $('#modal_aprobar').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) 

                var id = button.data('id')

                var modal = $(this)
                modal.find('.modal-body #id').val(id)
                
            });

            $('#modal_rechazar').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) 

                var id = button.data('id')

                var modal = $(this)
                modal.find('.modal-body #id').val(id)
                
            });

            $('#modal_cancelar').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) 

                var id = button.data('id')

                var modal = $(this)
                modal.find('.modal-body #id').val(id)
                
            });

    </script>

    {{-- <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.4.0/socket.io.js" integrity="sha512-nYuHvSAhY5lFZ4ixSViOwsEKFvlxHMU2NHts1ILuJgOS6ptUmAGt/0i5czIgMOahKZ6JN84YFDA+mCdky7dD8A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    --}}


    <script>
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
    </script>

@stop

{{-- @else
    @section('content')
        <h1>No tienes permiso</h1>
    @stop
@endif --}}