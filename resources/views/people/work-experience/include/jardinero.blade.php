<div id="app">
    <div class="page-content browse container-fluid" >
        @include('voyager::alerts')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">                            
                        <div class="table-responsive">
                            <main class="main">    
                                @if(!auth()->user()->hasRole('admin'))    
                                {!! Form::open(['route' => 'work-experience.requirement-jardineria-store','class' => 'was-validated', 'method'=>'POST', 'enctype' => 'multipart/form-data'])!!}
                                
                                <div class="card-body">
                                    <input type="hidden" name="people_experience_id" value="{{$id}}">
                                    <input type="hidden" name="rubro_id" value="{{$rubro_id}}">
                                    <div class="row">
                                        <!-- === -->
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="file" name="image_ci"  multiple class="form-control" accept="image/*">
                                                </div>
                                                <small>Carnet de identidad Anverso(imagen):</small>
                                            </div>
                                        </div>      
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="file" name="image_ci2"  multiple class="form-control" accept="image/*">
                                                </div>
                                                <small>Carnet de identidad Reverso(imagen):</small>
                                            </div>
                                        </div>  

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="file" name="image_ap"  multiple class="form-control" accept="image/*">
                                                </div>
                                                <small>Antecedentes penales (imagen):</small>
                                            </div>
                                        </div> 
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <select name="exp_jardineria" id="exp_jardineria" class="form-control">
                                                        <option value="">Seleccione</option>
                                                        <option value="1">SI</option>
                                                        <option value="0">NO</option>
                                                    </select>
                                                </div>
                                                <small>Experiencia en jardineria:</small>
                                            </div>
                                        </div>                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <select name="exp_paisajismo" id="exp_paisajismo" class="form-control">
                                                        <option value="">Seleccione</option>
                                                        <option value="1">SI</option>
                                                        <option value="0">NO</option>
                                                    </select>
                                                </div>
                                                <small>Experiencia en paisajismo:</small>
                                            </div>
                                        </div> 
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <textarea name="exp_maquinas" class="form-control" id="" rows="3"></textarea>
                                                </div>
                                                <small>Experiencia en Maquinaria.</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button id="btn_guardar" type="submit"  class="btn btn-primary"><i class="fas fa-save"></i> Actualizar</button>
                                    </div>   
                                {!! Form::close()!!}
                                @endif    
                                    <table id="detalles" class="table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>Tipo</th>
                                                <th>Detalle</th>
                                                {{-- <th>Accion</th>             --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Carnet de identidad</td>
                                                <td>
                                                    @if ($peoplerequirement)
                                                        @if ($peoplerequirement->image_ci || $peoplerequirement->image_ci2)
                                                            <span class="badge badge-success">Si cargado</span>
                                                            @if ($peoplerequirement->image_ci)                                                            
                                                                <a href="{{url('storage/public/'.$peoplerequirement->image_ci)}}" title="Ver" target="_blank" class="btn btn-sm btn-success">
                                                                    <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">Ver Anverso</span>
                                                                </a>
                                                            @endif

                                                            @if ($peoplerequirement->image_ci2)                                                            
                                                                <a href="{{url('storage/public/'.$peoplerequirement->image_ci2)}}" title="Ver" target="_blank" class="btn btn-sm btn-success">
                                                                    <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">Ver Reverso</span>
                                                                </a>
                                                            @endif

                                                        @else
                                                            <span class="badge badge-danger">No cargado</span>
                                                        @endif
                                                    @else
                                                        <span class="badge badge-danger">No cargado</span>
                                                    @endif
                                                </td>            
                                            </tr>
                                            <tr>
                                                <td>Antecedentes penales</td>
                                                <td>
                                                    @if ($peoplerequirement)
                                                        @if ($peoplerequirement->image_ap)
                                                            <span class="badge badge-success">Si cargado</span>
                                                            <a href="{{url('storage/public/'.$peoplerequirement->image_ap)}}" title="Ver" target="_blank" class="btn btn-sm btn-success">
                                                                <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">Ver</span>
                                                            </a>
                                                        @else
                                                            <span class="badge badge-danger">No cargado</span>
                                                        @endif
                                                    @else
                                                        <span class="badge badge-danger">No cargado</span>
                                                    @endif
                                                </td>          
                                            </tr>
                                            <tr>
                                                <td>Experiencia en jardineria</td>
                                                <td>
                                                    @if ($peoplerequirement)
                                                        @if ($peoplerequirement->exp_jardineria == 1 || $peoplerequirement->exp_jardineria == 0)
                                                            @if ($peoplerequirement->exp_jardineria == 1)
                                                                <span class="badge badge-success">Si</span>
                                                            @else
                                                                <span class="badge badge-danger">No</span>
                                                            @endif
                                                        @else
                                                            <span class="badge badge-danger">No cargado</span>
                                                        @endif
                                                    @else
                                                        <span class="badge badge-danger">No cargado</span>
                                                    @endif
                                                </td>            
                                            </tr>
                                            <tr>
                                                <td>Experiencia en paisajismo</td>
                                                <td>
                                                    @if ($peoplerequirement)
                                                        @if ($peoplerequirement->exp_paisajismo == 1 || $peoplerequirement->exp_paisajismo == 0)
                                                            @if ($peoplerequirement->exp_paisajismo == 1)
                                                                <span class="badge badge-success">Si</span>
                                                            @else
                                                                <span class="badge badge-danger">No</span>
                                                            @endif
                                                        @else
                                                            <span class="badge badge-danger">No cargado</span>
                                                        @endif
                                                    @else
                                                        <span class="badge badge-danger">No cargado</span>
                                                    @endif
                                                </td>           
                                            </tr>
                                                <td>Experiencia en Maquinaria</td>
                                                <td>
                                                    @if ($peoplerequirement)
                                                        @if ($peoplerequirement->exp_maquinas)
                                                            {{$peoplerequirement->exp_maquinas}}
                                                        @else
                                                            <span class="badge badge-danger">No cargado</span>
                                                        @endif
                                                    @else
                                                        <span class="badge badge-danger">No cargado</span>
                                                    @endif
                                                </td>             
                                            </tr>
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