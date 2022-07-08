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
                                {!! Form::open(['route' => 'work-experience.requirement-piscinero-store','class' => 'was-validated', 'method'=>'POST', 'enctype' => 'multipart/form-data'])!!}                               
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
                                                    <select name="exp_mant_piscina" class="form-control">
                                                        <option value="">Selecione</option>
                                                        <option value="1">Si</option>
                                                        <option value="0">No</option>                                                 
                                                    </select>
                                                </div>
                                                <small>Experiencia en Mantenimiento de Piscinas.</small>
                                            </div>
                                        </div>                                        
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <select name="medir_ph" class="form-control">
                                                        <option value="">Selecione</option>
                                                        <option value="1">Si</option>
                                                        <option value="0">No</option>                                                 
                                                    </select>
                                                </div>
                                                <small>Saber Medir PH.</small>
                                            </div>
                                        </div> 
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <select name="asp_piscina" class="form-control">
                                                        <option value="">Selecione</option>
                                                        <option value="1">Si</option>
                                                        <option value="0">No</option>                                                 
                                                    </select>
                                                </div>
                                                <small>Saber Aspirar Piscina</small>
                                            </div>
                                        </div> 
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <select name="cant_quimico" class="form-control select">
                                                        <option value="">Selecione</option>
                                                        <option value="1">Si</option>
                                                        <option value="0">No</option>                                                 
                                                    </select>
                                                </div>
                                                <small>Saber Calcular la Cantidad de Quimico para Piscina.</small>
                                            </div>
                                        </div>                                        
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <select name="bomba_agua" class="form-control">
                                                        <option value="">Selecione</option>
                                                        <option value="1">Si</option>
                                                        <option value="0">No</option>                                                 
                                                    </select>
                                                </div>
                                                <small>Tiene Conocimiento de Funcionamiento de Bomba</small>
                                            </div>
                                        </div> 
                                        <!-- === -->
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <textarea name="trabajado_ante_donde" class="form-control" rows="2"></textarea>
                                                </div>
                                                <small>¿Donde ha Trabajado ante como Piscinero?.</small>
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
                                                <td>Experiencia en Mantenimiento de Piscinas.</td>
                                                <td>
                                                    @if ($peoplerequirement)
                                                        @if ($peoplerequirement->exp_mant_piscina == 1 || $peoplerequirement->exp_mant_piscina == 0)
                                                            @if ($peoplerequirement->exp_mant_piscina == 1)
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
                                                <td>Saber Medir PH.</td>
                                                <td>
                                                    @if ($peoplerequirement)
                                                        @if ($peoplerequirement->medir_ph == 1 || $peoplerequirement->medir_ph == 0)
                                                            @if ($peoplerequirement->medir_ph == 1)
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
                                                <td>Saber Aspirar Piscina</td>
                                                <td>
                                                    @if ($peoplerequirement)
                                                        @if ($peoplerequirement->asp_piscina == 1 || $peoplerequirement->asp_piscina == 0)
                                                            @if ($peoplerequirement->asp_piscina == 1)
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
                                                <td>Saber Calcular la Cantidad de Quimico para Piscina.</td>
                                                <td>
                                                    @if ($peoplerequirement)
                                                        @if ($peoplerequirement->cant_quimico == 1 || $peoplerequirement->cant_quimico == 0)
                                                            @if ($peoplerequirement->cant_quimico == 1)
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
                                                <td>Tiene Conocimiento de Funcionamiento de Bomba</td>
                                                <td>
                                                    @if ($peoplerequirement)
                                                        @if ($peoplerequirement->bomba_agua == 1 || $peoplerequirement->bomba_agua == 0)
                                                            @if ($peoplerequirement->bomba_agua == 1)
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
                                                <td>¿Donde ha Trabajado ante como Piscinero?</td>
                                                <td>
                                                    @if ($peoplerequirement)
                                                        @if ($peoplerequirement->trabajado_ante_donde)
                                                            {{$peoplerequirement->trabajado_ante_donde}}
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