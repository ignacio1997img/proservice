@extends('voyager::master')

@section('page_title', 'Viendo Registros')

@section('page_header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <h1 class="page-title">
                    <i class="fa-solid fa-people-pulling"></i> Modelos
                </h1>
                <a data-toggle="modal" data-target="#modalAdd" class="btn btn-success btn-add-new">
                    <i class="voyager-plus"></i> <span>Crear</span>
                </a>
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
                                    <tr>
                                        <td>{{ $item->people->id }}</td>
                                        <td>{{ $item->people->ci }}</td>
                                        <td>{{ $item->people->first_name }}</td>
                                        <td>{{ $item->people->last_name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->people->birth_date)->format('d/m/Y') }}</td>
                                        <td>{{ $item->people->email }}</td>
                                        <td>
                                            @if($item->people->sex == 1)
                                                Masculino
                                            @else
                                                Femenino
                                            @endif
                                        </td>
                                        <td>{{ $item->people->address }}</td>
                                        <td>
                                            @if ($item->people->status == 1)
                                                <label class="label label-success">Activo</label>
                                            @else
                                                <label class="label label-danger">Inactivo</label>
                                            @endif
                                        </td>
                                        <td class="actions text-right dt-not-orderable sorting_disabled">
                                            <a type="button" data-toggle="modal" href="{{route('registerModel.show', $item->people->id)}}"  class="btn btn-warning"><i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">Ver</span></a>                                           
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

    <div class="modal fade" data-backdrop="static" role="dialog" id="modalAdd">
        <div class="modal-dialog modal-lg">
            <div class="modal-content  modal-success">                
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa-solid fa-people-pulling"></i> Agregar Modelos</h4>
                </div>
                {!! Form::open(['route' => 'registerModel.store','class' => 'was-validated', 'enctype' => 'multipart/form-data'])!!}
                    <!-- Modal body -->
                    <div class="modal-body">
                            <h1 id="subtitle"><i class="fa-solid fa-person-chalkboard"></i> Datos Personales</h1>
                            <input type="hidden" name="type" value="trabajador">
                            <div class="row">
                                
                                <div class="col-md-4">
                                    <div class="input-group-prepend">
                                        <small class="input-group-text"><b>Departamento:</b></small>
                                    </div>
                                    <select id="department_id" class="form-control select2" required>
                                        <option value="">Seleccione un departamento..</option>
                                        @foreach($department as $data)
                                            <option value="{{$data->id}}">{{$data->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group-prepend">
                                        <small class="input-group-text"><b>Ciudad:</b></small>
                                    </div>
                                    <select name="city_id" id="city_id" class="form-control select2" required>
                                        <option value="">Seleccione una opción..</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group-prepend">
                                        <small class="input-group-text"><b>CI:</b></small>
                                    </div>
                                    <input type="text" class="form-control ci" name="ci" id="ci" value="">
                                    <span id="errorCi"  style="display: none; color:red">
                                        <b>El CI. ya se encuentra registrado..</b>
                                    </span>
                                </div>
                            </div>
                        
                                                     
                            <div class="row" >                                
                                <div class="col-md-4">
                                    <div class="input-group-prepend">
                                        <small class="input-group-text"><b>Nombre:</b></small>
                                    </div>
                                    <input type="text" class="form-control" name="first_name" value="">
                                </div>     
                                <div class="col-md-4">
                                    <div class="input-group-prepend">
                                        <small class="input-group-text"><b>Apellido:</b></small>
                                    </div>
                                    <input type="text" class="form-control" name="last_name" value="">
                                </div>     
                                <div class="col-md-4">
                                    <div class="input-group-prepend">
                                        <small class="input-group-text"><b>Sexo:</b></small>
                                    </div>
                                    <select name="sex" id="sex" class="form-control">
                                        <option value="1">MASCULINO</option>
                                        <option value="0">FEMENINO</option>
                                    </select>
                                </div>                        
                            </div>
                                               
                            <div class="row" >
                                <div class="col-md-4">
                                    <div class="input-group-prepend">
                                        <small class="input-group-text"><b>Fecha de Nacimiento:</b></small>
                                    </div>
                                    <input type="date" class="form-control" name="birth_date" value="">
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group-prepend">
                                        <small class="input-group-text"><b>Email:</b></small>
                                    </div>
                                    <input type="text" class="form-control" name="email" value="">
                                </div>       
                                <div class="col-md-4">
                                    <div class="input-group-prepend">
                                        <small class="input-group-text"><b>Telefono:</b></small>
                                    </div>
                                    <input type="number" class="form-control" name="phone1" value="">
                                </div>     
                                                        
                            </div>
                                                      
                            <div class="row" >
                                                     
                            </div>
                            <div class="row">    
                                
                                <div class="col-md-12">
                                    <div class="input-group-prepend">
                                    <small class="input-group-text"><b>Direccion:</b></small>
                                    </div>
                                    <textarea class="form-control" name="address" cols="77" rows="3"></textarea>
                                </div>                
                            </div>
                            <h1 id="subtitle"><i class="fa-solid fa-share-nodes"></i> Redes sociales</h1>
                            <div class="row" >
                                <div class="col-md-4">
                                    <div class="input-group-prepend">
                                        <small class="input-group-text"><b>Facebook:</b></small>
                                    </div>
                                    <input type="text" class="form-control" name="facebook" value="">
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group-prepend">
                                        <small class="input-group-text"><b>Instagram:</b></small>
                                    </div>
                                    <input type="text" class="form-control" name="instagram" value="">
                                </div>      
                                <div class="col-md-4">
                                    <div class="input-group-prepend">
                                        <small class="input-group-text"><b>TikTok:</b></small>
                                    </div>
                                    <input type="text" class="form-control" name="tiktok" value="">
                                </div>                     
                            </div>
                            <h1 id="subtitle"><i class="fa-solid fa-people-pulling"></i> Categoria de modelo</h1>
                            <div class="row" >
                                <div class="col-md-4">
                                    <div class="input-group-prepend">
                                        <small class="input-group-text"><b>Categoria de Modelaje:</b></small>
                                    </div>
                                    <select name="typeModel_id" id="typeModel_id" class="form-control select2" required>
                                        <option value="">Seleccione un tipo..</option>
                                        @foreach($type as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>                   
                            </div>
                      
                        

                            <h1 id="subtitle"> <i class="fa-solid fa-lock"></i> Autenticación</h1>
                            <div class="row" >
                                <div class="col-md-4">
                                    <div class="input-group-prepend">
                                        <small class="input-group-text"><b>Email:</b></small>
                                    </div>
                                    <input type="email" class="form-control" id="email" name="emails" required>
                                    <span id="errorEmail"  style="display: none; color:red">
                                        <b>El Email. ya se encuentra registrado..</b>
                                    </span>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                            <small class="input-group-text"><b>Contraseña:</b></small>
                                            <input type="password" class="form-control" id="input-password" name="password" required>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                        <span class="input-group-addon" style="background:#fff;border:0px;font-size:25px;cursor:pointer;padding:0px;position: relative;bottom:10px" id="btn-verpassword">
                                            <span class="fa fa-eye"></span>
                                        </span>
                                    </div>                       
                                </div>                        
                            </div>
                            
                            
                            
                            {{-- <input type="password" id="input-password" name="password" placeholder="{{ __('voyager::generic.password') }}" class="form-control" required>
                    <span class="input-group-addon" style="background:#fff;border:0px;font-size:25px;cursor:pointer;padding:0px;position: relative;bottom:10px" id="btn-verpassword">
                        <span class="fa fa-eye"></span> --}}
                    </span>
    
                    </div>
                    
                    <!-- Modal footer -->
                    <div class="modal-footer justify-content-between">
                        <button type="button text-left" class="btn btn-danger" data-dismiss="modal" data-toggle="tooltip" title="Volver">Cancelar
                        </button>
                        <button type="submit"  id="btn_save" class="btn btn-success btn-sm" title="Registrar..">
                            Registrar
                        </button>
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
            $(document).ready(function(){

            $('#department_id').on('change', selectCity);

            let ver_pass = false;
            $('#btn-verpassword').click(function(){
                if(ver_pass){
                    ver_pass = false;
                    $(this).html('<span class="fa fa-eye"></span>');
                    $('#input-password').prop('type', 'password');
                }else{
                    ver_pass = true;
                    $(this).html('<span class="fa fa-eye-slash"></span>');
                    $('#input-password').prop('type', 'text');
                }
            });
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

            ci.oninput = function() {
                // result.innerHTML = input1.value;
                var cis ="";
                var aux = '';
                var i =0;
                cis = ci.value;
                while(i < cis.length){
                    
                        aux = aux + cis.charAt(i);
                  
                    i++;
                }
                $.get('{{route('ajaxQuery.ci')}}/'+aux, function(data){ 
                    if(data == 1)
                    {
                        $('#errorCi').fadeIn();         
                        $('#btn_save').attr('disabled', true);           
                    }      
                    else
                    {
                        $('#errorCi').fadeOut();
                        $('#btn_save').attr('disabled', false);
                    }
                });
                
            };

            email.oninput = function() {
                // result.innerHTML = input1.value;
                var cis ="";
                var aux = '';
                var i =0;
                cis = email.value;
                while(i < cis.length){
                    
                        aux = aux + cis.charAt(i);
                  
                    i++;
                }
                $.get('{{route('ajaxQuery.email')}}/'+aux, function(data){ 
                    if(data == 1)
                    {
                        $('#errorEmail').fadeIn();         
                        $('#btn_save').attr('disabled', true);           
                    }      
                    else
                    {
                        $('#errorEmail').fadeOut();
                        $('#btn_save').attr('disabled', false);
                    }
                });
                
            };

    </script>

@stop
