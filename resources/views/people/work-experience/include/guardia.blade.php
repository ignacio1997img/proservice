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
                                {!! Form::open(['route' => 'work-experience.requirement-guardia-store','class' => 'was-validated', 'method'=>'POST', 'enctype' => 'multipart/form-data'])!!}                               
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
                                                <small>Carnet de identidad (imagen):</small>
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
                                                    <input type="file" name="image_lsm"  multiple class="form-control" accept="image/*">
                                                </div>
                                                <small>Libreta de servicio militar (imagen ):</small>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="file" name="image_fcc"  multiple class="form-control" accept="image/*">
                                                </div>
                                                <small>Foto cuerpo completo de pantalón y camisa (imagen ):</small>
                                            </div>
                                        </div> 
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <select id="provider" name="turno[]" class="form-control select2" multiple="multiple">
                                                        <option value="1">DIA</option>
                                                        <option value="2">NOCHE</option>                                                 
                                                    </select>
                                                </div>
                                                <small>Turno.</small>
                                            </div>
                                        </div>
                                    
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="number" id="nit" name="estatura" class="form-control form-control-sm text" placeholder="Seleccione un Proveedor">
                                                </div>
                                                <small>Estatura.</small>
                                            </div>
                                        </div>
                                        <!-- === -->
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="number" id="responsable" name="peso" class="form-control form-control-sm text" placeholder="Seleccione un Proveedor">
                                                </div>
                                                <small>Peso.</small>
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
                                                <th>Estado</th>
                                                {{-- <th>Accion</th>             --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Carnet de identidad</td>
                                                <td>
                                                    @if ($peoplerequirement)
                                                        @if ($peoplerequirement->image_ci)
                                                            <span class="badge badge-success">Si cargado</span>
                                                            <a href="{{url('storage/public/'.$peoplerequirement->image_ci)}}" title="Ver" target="_blank" class="btn btn-sm btn-success">
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
                                                <td>Libreta de servicio militar</td>
                                                <td>
                                                    @if ($peoplerequirement)
                                                        @if ($peoplerequirement->image_lsm)
                                                            <span class="badge badge-success">Si cargado</span>
                                                            <a href="{{url('storage/public/'.$peoplerequirement->image_lsm)}}" title="Ver" target="_blank" class="btn btn-sm btn-success">
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
                                                <td>Foto cuerpo completo de pantalón y camisa</td>
                                                <td>
                                                    @if ($peoplerequirement)
                                                        @if ($peoplerequirement->image_fcc)
                                                            <span class="badge badge-success">Si cargado</span>
                                                            <a href="{{url('storage/public/'.$peoplerequirement->image_fcc)}}" title="Ver" target="_blank" class="btn btn-sm btn-success">
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
                                                <td>Turno</td>
                                                <td>
                                                    @if ($peoplerequirement)
                                                        @if ($peoplerequirement->t_dia || $peoplerequirement->t_noche)
                                                            @if ($peoplerequirement->t_dia)
                                                                Día 
                                                                @if($peoplerequirement->t_noche)
                                                                 -
                                                                @endif
                                                            @endif
                                                            @if ($peoplerequirement->t_noche)
                                                                Noche
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
                                                <td>Estatura</td>
                                                <td>
                                                    @if ($peoplerequirement)
                                                        @if ($peoplerequirement->estatura)
                                                            {{$peoplerequirement->estatura}}
                                                        @else
                                                            <span class="badge badge-danger">No cargado</span>
                                                        @endif
                                                    @else
                                                        <span class="badge badge-danger">No cargado</span>
                                                    @endif
                                                </td>             
                                            </tr>
                                            <tr>
                                                <td>Peso</td>
                                                <td>
                                                    @if ($peoplerequirement)
                                                        @if ($peoplerequirement->peso)
                                                            {{$peoplerequirement->peso}}
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