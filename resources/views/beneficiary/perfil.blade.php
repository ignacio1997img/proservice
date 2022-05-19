@extends('voyager::master')
@if(auth()->user()->hasPermission('browse_beneficiary-perfil-view'))
@section('page_title', 'Viendo Ingresos')

    @section('page_header')
        
        <div class="container-fluid">
            <div class="row">
                <h1 class="page-title">
                    <i class="voyager-receipt"></i> Beneficiario 
                </h1>
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
                                            @if(auth()->user()->hasPermission('edit_beneficiary-perfil-data'))
                                                <a type="button" data-toggle="modal" data-target="#modal_edit" class="btn btn-success">
                                                    <i class="voyager-plus"></i> <span>Editar Datos</span>
                                                </a>
                                            @endif
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <small>Razon Social.</small>
                                                        <div class="form-line">
                                                            <b>{{$beneficiary->name}} </b>
                                                        </div>
                                                    </div>
                                                </div>   
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <small>Responsable.</small>
                                                        <div class="form-line">
                                                            <b>{{$beneficiary->responsible}} </b>
                                                        </div>
                                                    </div>
                                                </div>   
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <small>Email.</small>
                                                        <div class="form-line">
                                                            <b>{{$beneficiary->email}} </b>
                                                        </div>
                                                    </div>
                                                </div>                                            
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <small>Telefono 1.</small>
                                                        <div class="form-line">
                                                            <b>{{$beneficiary->phone1? $beneficiary->phone1:'S/N'}} </b>
                                                        </div>
                                                    </div>
                                                </div>                                                
                                            </div>
                                            <div class="row">
                                                  
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <small>Telefono 2.</small>
                                                        <div class="form-line">
                                                            <b>{{$beneficiary->phone2? $beneficiary->phone2:'S/N'}} </b>
                                                        </div>
                                                    </div>
                                                </div> 
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <small>Direccion.</small>
                                                        <div class="form-line">
                                                            <b>{{$beneficiary->address? $beneficiary->address:'S/N'}} </b>
                                                        </div>
                                                    </div>
                                                </div>     
                                            </div>
                                                              
                                            
                                        </div>                      
                                    </main>
                                </div>
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
                    {!! Form::open(['route' => 'beneficiary.perfil-update','class' => 'was-validated'])!!}
                        <!-- Modal body -->
                        <div class="modal-body">
                            <input type="hidden" name="id" value="{{$beneficiary->id}}">
                            
                            <div id="cantcheque">                                   
                                <div class="row" >
                                    <div class="col-md-8">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><b>Razon Social:</b></span>
                                        </div>
                                        <input type="text" class="form-control" name="name" value="{{$beneficiary->name}}">
                                    </div>                                
                                </div>
                            </div>

                            <div id="cantcheque">                                   
                                <div class="row" >
                                    <div class="col-md-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><b>Responsable:</b></span>
                                        </div>
                                        <input type="text" class="form-control" name="responsible" value="{{$beneficiary->responsible}}">
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><b>Email:</b></span>
                                        </div>
                                        <input type="text" class="form-control" name="email" value="{{$beneficiary->email}}">
                                    </div>                            
                                </div>
                            </div>
                            <div id="cantcheque">                                   
                                <div class="row" >
                                    <div class="col-md-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><b>Telefono 1:</b></span>
                                        </div>
                                        <input type="number" class="form-control" name="phone1" value="{{$beneficiary->phone1}}">
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><b>Telefono 2:</b></span>
                                        </div>
                                        <input type="number" class="form-control" name="phone2" value="{{$beneficiary->phone2}}">
                                    </div>                        
                                </div>
                            </div>
                            <div class="row">    
                                    
                                <div class="col-md-12">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text"><b>Direccion:</b></span>
                                    </div>
                                    <textarea class="form-control" name="address" cols="77" rows="3">{{$beneficiary->address}}</textarea>
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

    <style>
        img {
            max-width: 10%;
            max-height: 10%;
        }
        .cat {
            height: 100px;
            width: 20px;
        }
    </style>


    @section('css')
    <script src="{{ asset('js/app.js') }}" defer></script>      
    @stop

    @section('javascript')
    
        <script>

           


        </script> 
    @stop

@else
    @section('content')
        <h1>No tienes permiso</h1>
    @stop
@endif