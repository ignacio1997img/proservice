<div class="row"  style="min-height: 120px">
    <div class="col-md-12">
        <div class="table-responsive">
            <table id="dataTable" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Tipo</th>                
                        <th style="text-align: center">Detalle</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="height: 50px">NIT</td>
                        <td style="text-align: center">
                            @if (!$businerequirements->image_nit)
                                <label class="label label-danger">Sin datos</label>
                            @else                                                                
                                <a href="{{asset('storage/'.$businerequirements->image_nit)}}" title="Ver" target="_blank">
                                    <img @if(strpos($businerequirements->image_nit, ".pdf")) src="{{asset('images/icon/pdf.png')}}" @else src="{{asset('storage/'.$businerequirements->image_nit)}}" @endif href="{{asset('storage/'.$businerequirements->image_nit)}}" class="zoom" style="width: 60px; height: 60px; border-radius: 30px; margin-right: 10px"/>
                                </a> 
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="height: 50px">Licencia de funcionamiento</td>
                        <td style="text-align: center">
                            @if (!$businerequirements->image_lf)
                                <label class="label label-danger">Sin datos</label>
                            @else                                                                
                                <a href="{{asset('storage/'.$businerequirements->image_lf)}}" title="Ver" target="_blank">
                                    <img @if(strpos($businerequirements->image_lf, ".pdf")) src="{{asset('images/icon/pdf.png')}}" @else src="{{asset('storage/'.$businerequirements->image_lf)}}" @endif href="{{asset('storage/'.$businerequirements->image_lf)}}" class="zoom" style="width: 60px; height: 60px; border-radius: 30px; margin-right: 10px"/>
                                </a> 
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="height: 50px">Roe</td>
                        <td style="text-align: center">
                            @if (!$businerequirements->image_roe)
                                <label class="label label-danger">Sin datos</label>
                            @else
                                <a href="{{asset('storage/'.$businerequirements->image_roe)}}" title="Ver" target="_blank">
                                    <img @if(strpos($businerequirements->image_roe, ".pdf")) src="{{asset('images/icon/pdf.png')}}" @else src="{{asset('storage/'.$businerequirements->image_roe)}}" @endif href="{{asset('storage/'.$businerequirements->image_roe)}}" class="zoom" style="width: 60px; height: 60px; border-radius: 30px; margin-right: 10px"/>
                                </a> 
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>                                    
</div>

<div class="modal fade modal-primary" role="dialog" id="modal_requirement">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">                
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="voyager-plus"></i> Requisito de la Empresa</h4>
            </div>
            {!! Form::open(['route' => 'busine.perfil.requirement-jardineria-store','class' => 'was-validated', 'method'=>'POST', 'enctype' => 'multipart/form-data'])!!}
                <!-- Modal body -->
                <div class="modal-body">
                    <input type="hidden" name="busine_id" value="{{$busine->id}}">
                           
                        <div class="row" >
                            <div class="form-group col-md-6">
                                <small>Nit *imagen</small>                            
                                <input type="file" accept="image/jpeg,image/jpg,image/png,application/pdf" name="image_nit" class="form-control imageLength">                            
                            </div>
                            <div class="form-group col-md-6">
                                <small>Licencia de funcionamiento *imagen</small>                            
                                <input type="file" accept="image/jpeg,image/jpg,image/png,application/pdf" name="image_lf" class="form-control imageLength">                            
                            </div>
                            <div class="form-group col-md-6">
                                <small>Roe *imagen</small>                            
                                <input type="file" accept="image/jpeg,image/jpg,image/png,application/pdf" name="image_roe" class="form-control imageLength">                            
                            </div>                       
                        </div>


                </div>
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