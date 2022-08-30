<table id="detalles" class="table table-bordered table-striped table-sm">
    <thead>
        <tr>
            <th>Tipo</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Licencia de funcionamiento</td>
            <td>
                @if ($businerequirements)
                    @if ($businerequirements->image_lf)
                        <span class="badge badge-success">Si cargado</span>
                        
                            <a href="{{url('storage/'.$businerequirements->image_lf)}}" title="Ver" target="_blank" class="btn btn-sm btn-success">
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
            <td>Roe</td>
            <td>
                @if ($businerequirements)
                    @if ($businerequirements->image_roe)
                        <span class="badge badge-success">Si cargado</span>
                        @if(auth()->user()->hasPermission('view_busine-perfil-requirement'))
                            <a href="{{url('storage/'.$businerequirements->image_roe)}}" title="Ver" target="_blank" class="btn btn-sm btn-success">
                                <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">Ver</span>
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
            <td>Experiencia</td>
            <td>
                @if ($businerequirements)
                    @if ($businerequirements->exp_modelo == 1 || $businerequirements->exp_modelo == 0)
                        @if($businerequirements->exp_modelo == 1)
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
    </tbody>                                        
</table>


<div class="modal fade modal-primary" role="dialog" id="modal_requirement">
    <div class="modal-dialog modal-md">
        <div class="modal-content">                
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="voyager-plus"></i> Editar Datos de la Empresa</h4>
            </div>
            {!! Form::open(['route' => 'busine.perfil.requirement-modelo-store','class' => 'was-validated', 'method'=>'POST', 'enctype' => 'multipart/form-data'])!!}
                <!-- Modal body -->
                <div class="modal-body">
                    <input type="hidden" name="busine_id" value="{{$busine->id}}">
                    
                    <div >                                   
                        <div class="row" >
                            <div class="col-md-6">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><b>Licencia de funcionamiento:</b></span>
                                </div>
                                <input type="file" name="image_lf"  multiple class="form-control" accept="image/*">
                            </div>
                            <div class="col-md-6">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><b>Roe:</b></span>
                                </div>
                                <input type="file" name="image_roe"  multiple class="form-control" accept="image/*">
                            </div>                           
                        </div>
                        <div class="row" >
                            <div class="col-md-6">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><b>Experiencia:</b></span>
                                </div>
                                <select name="exp_modelo" class="form-control">
                                    <option value="">Seleccione</option>
                                    <option value="1">Si</option>
                                    <option value="0">No</option>
                                </select>
                            </div>                        
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