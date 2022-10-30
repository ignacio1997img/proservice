@extends('voyager::master')
{{-- @if(auth()->user()->hasPermission('browse_people-perfil-experience') || auth()->user()->hasRole('admin')) --}}
@section('page_title', 'Perfil del Modelo')

@section('page_header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <h1 id="subtitle" class="page-title">
                    <i class="fa-solid fa-person-digging"></i> Perfil
                    &nbsp; 
                    {{-- para el administrador que va a aceptar los rubro de la persona --}}
                    {{-- @if(auth()->user()->hasRole('admin')) --}}
                        <a href="{{route('registerModel.index')}}" class="btn btn-warning">
                        <i class="fa-solid fa-circle-left"></i>
                            Volver
                        </a>
                    {{-- @endif --}}


                    {{-- @if(auth()->user()->hasPermission('browse_people-perfil-experience'))
                        <a href="{{route('people-perfil-experience.index')}}" class="btn btn-warning">
                        <i class="fa-solid fa-circle-left"></i>
                            Volver
                        </a>
                    @endif --}}
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
                               
                                    <div class="card-body">
                                        {{-- @if(auth()->user()->hasPermission('edit_people-perfil-data') && !auth()->user()->hasRole('admin')) --}}
                                            {{-- <a type="button" data-toggle="modal" data-target="#modal_edit" class="btn btn-success">
                                                <i class="voyager-plus"></i> <span>Editar Datos</span>
                                            </a> --}}
                                        {{-- @endif --}}
                                        <a type="button" data-toggle="modal" href="{{route('registerModel-requirement.view', $experiences->id)}}" class="btn btn-success">
                                            <i class="fa-solid fa-people-pulling"></i> <i class="fa-solid fa-list"></i> <span>Requisitos Modelaje</span>
                                        </a>
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
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <img src="{{ asset('images/redes/facebook.png') }}" alt="GYM" width="35px">&nbsp;&nbsp;&nbsp;<small>{{$people->facebook}}</small>
                                                </div>
                                            </div> 
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <img src="{{ asset('images/redes/instagram.png') }}" alt="GYM" width="35px">&nbsp;&nbsp;&nbsp;<small>{{$people->instagram}}</small>

                                                </div>
                                            </div>       
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <img src="{{ asset('images/redes/tiktok.png') }}" alt="GYM" width="35px">&nbsp;&nbsp;&nbsp;<small>{{$people->tiktok}}</small>
                                                </div>
                                            </div>                                         
                                        </div>
                                    </div>      
                            </div>
                        </div>
                    </div>
                </div>
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
{{-- @else --}}
{{-- @section('content')
    <h1>No tienes permiso</h1>
@stop --}}
{{-- @endif --}}