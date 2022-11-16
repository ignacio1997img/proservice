@extends('voyager::master')
@if(auth()->user()->hasPermission('browse_busines_perfil_view'))
@section('page_title', 'Viendo Ingresos')

    @section('page_header')        
        <div class="container-fluid">
            <div class="row">                
                <div class="col-md-8">
                    <h1 class="page-title">
                        <i class="fa-solid fa-building"></i> Empresa 
                    </h1>
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
                                {{-- <div class="table-responsive">
                                    <main class="main">   
                                        <div class="card-body"> --}}
                                            @if($busine->status == 2)
                                                <div class="alert alert-warning" style="padding: 5px 10px;" >
                                                    <div class="row">
                                                        <div class="col-md-12" style="margin: 0px">
                                                        <p style="margin-top: 10px"><b>Atención!</b> Registre todos los requisitos para que su Empresa en el sistema este verificada.</p></div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if(auth()->user()->hasPermission('edit_busine-perfil-data'))
                                                <a type="button" data-toggle="modal" data-target="#modal_edit" class="btn btn-success">
                                                    <i class="voyager-plus"></i> <span>Editar Datos</span>
                                                </a>
                                            @endif
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

                                            @if(auth()->user()->hasPermission('add_busine-perfil-requirement'))
                                                <a type="button" data-toggle="modal" data-target="#modal_requirement" class="btn btn-success">
                                                    <i class="voyager-plus"></i> <span>Editar Requisitos</span>
                                                </a>
                                            @endif

                                            
                                            {{-- para desplegar los requisitos de GUARDIA --}}
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

                                            @if ($busine->rubro_id == 5)
                                                @include('busine.perfil-requirement.5e-sistemaSeguridad')
                                            @endif






                                           
                                            
                                        {{-- </div>                      
                                    </main>
                                </div> --}}
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

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><b>Departamento:</b></span>
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
                                        <span class="input-group-text"><b>Ciudad:</b></span>
                                    </div>
                                    <select name="city_id" id="city_id" class="form-control select2" required>
                                        <option value="">Seleccione una Ciudad..</option>
                                        @foreach($cities as $data)
                                            <option value="{{$data->id}}" {{$city->id==$data->id? 'selected':''}}>{{$data->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div id="si">                                   
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

                            <div id="">                                   
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
                            <div id="">                                   
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
    <style>
        img.zoom {
            /* width: 350px;
            height: 200px; */
            width: 350px;
            height: 200px;
            -webkit-transition: all .2s ease-in-out;
            -moz-transition: all .2s ease-in-out;
            -o-transition: all .2s ease-in-out;
            -ms-transition: all .2s ease-in-out;
        }
        
        .transition {
            -webkit-transform: scale(5.0); 
            -moz-transform: scale(5.0);
            -o-transform: scale(5.0);
            transform: scale(5.0);
        }
    </style>     
    @stop

    @section('javascript')
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.8.0/sweetalert2.min.js"></script>

        <script>
            $(document).ready(function(){
                $('.zoom').hover(function() {
                    $(this).addClass('transition');
                }, function() {
                    $(this).removeClass('transition');
                });
            });
        </script>
        <script>
            $(document).on('change','.imageLength',function(){
                var fileName = this.files[0].name;
                var fileSize = this.files[0].size;

                if(fileSize > 10000000){
                    // swal({
                    //     title: "Error",
                    //     text: "El archivo no debe superar los 10 MB",
                    //     type: "error",
                    //     showCancelButton: false
                    // });
                    alert('El archivo no debe superar los 10 MB')
                    this.value = '';
                    this.files[0].name = '';
                }
                
                    // recuperamos la extensión del archivo
                    var ext = fileName.split('.').pop();
                    
                    // Convertimos en minúscula porque 
                    // la extensión del archivo puede estar en mayúscula
                    ext = ext.toLowerCase();
                    // console.log(ext);
                    switch (ext) {
                        case 'jpg':
                        case 'jpeg':
                        case 'png': break;
                        default:
                            // swal({
                            //     title: "Error",
                            //     text: "El archivo no tiene la extensión adecuada",
                            //     type: "error",
                            //     showCancelButton: false
                            // });
                            alert('El archivo no tiene la extensión adecuada')
                            this.value = ''; // reset del valor
                            this.files[0].name = '';
                    }
            });
        </script>
    
        <script>

            $(function()
                {
                    $('#department_id').on('change', selectCity);
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


        </script> 
        
    @stop


@else
    @section('content')
        <h1>No tienes permiso</h1>
    @stop
@endif