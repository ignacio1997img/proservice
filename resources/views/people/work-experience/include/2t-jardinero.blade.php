@if(auth()->user()->hasPermission('add_people-perfil-experience') || auth()->user()->hasRole('admin')) 
<div class="page-content edit-add container-fluid">    
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-bordered">
                <div class="panel-body">
                    @endif    

                    @if(auth()->user()->hasPermission('add_people-perfil-experience') && !auth()->user()->hasRole('admin'))   
                        <form id="agent" action="{{route('work-experience.requirement-jardineria-store')}}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="people_experience_id" value="{{$id}}">
                            <input type="hidden" name="rubro_id" value="{{$rubro_id}}">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <small>Carnet de identidad Anverso *imagen</small>                            
                                <input type="file" accept="image/jpeg,image/jpg,image/png,application/pdf" name="image_ci" class="form-control imageLength">                            
                            </div>
                            <div class="form-group col-md-3">
                                <small>Carnet de identidad Reverso *imagen</small>
                                <input type="file" accept="image/jpeg,image/jpg,image/png,application/pdf" name="image_ci2" class="form-control imageLength">
                            </div>
                            <div class="form-group col-md-3">
                                <small>Antecedentes penales *imagen</small>
                                <input type="file" accept="image/jpeg,image/jpg,image/png,application/pdf" name="image_ap" class="form-control imageLength">
                            </div>
                            
                            <div class="form-group col-md-3">
                                <small>Experiencia en jardineria</small>
                                <select name="exp_jardineria" class="form-control form-control-sm text">
                                    <option selected disabled value="">Seleccione</option>
                                    <option value="1">SI</option>
                                    <option value="0">NO</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">                        
                            <div class="form-group col-md-3">
                                <small>Experiencia en paisajismo</small>
                                <select name="exp_paisajismo" class="form-control form-control-sm text">
                                    <option selected disabled value="">Seleccione</option>
                                    <option value="1">SI</option>
                                    <option value="0">NO</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">                        
                            <div class="form-group col-md-12">
                                <small>Experiencia en Maquinaria</small>
                                <textarea name="exp_maquinas"  class="form-control form-control-sm text" rows="2"></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                        </form>  
                    @endif    


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
                                            <td style="height: 50px">Carnet de identidad Anverso</td>
                                            <td style="text-align: center">
                                                @if (!$peoplerequirement->image_ci)
                                                    <label class="label label-danger">Sin datos</label>
                                                @else                                                                
                                                    <a href="{{asset('storage/'.$peoplerequirement->image_ci)}}" title="Ver" target="_blank">
                                                        <img @if(strpos($peoplerequirement->image_ci, ".pdf")) src="{{asset('images/icon/pdf.png')}}" @else src="{{asset('storage/'.$peoplerequirement->image_ci)}}" @endif  href="{{asset('storage/'.$peoplerequirement->image_ci)}}" class="zoom" style="width: 60px; height: 60px; border-radius: 30px; margin-right: 10px"/>
                                                    </a> 
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="height: 50px">Carnet de identidad Reverso</td>
                                            <td style="text-align: center">
                                                @if (!$peoplerequirement->image_ci2)
                                                    <label class="label label-danger">Sin datos</label>
                                                @else
                                                    <a href="{{asset('storage/'.$peoplerequirement->image_ci2)}}" title="Ver" target="_blank">
                                                        <img @if(strpos($peoplerequirement->image_ci2, ".pdf")) src="{{asset('images/icon/pdf.png')}}" @else src="{{asset('storage/'.$peoplerequirement->image_ci2)}}" @endif href="{{asset('storage/'.$peoplerequirement->image_ci2)}}" class="zoom" style="width: 60px; height: 60px; border-radius: 30px; margin-right: 10px"/>
                                                    </a> 
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="height: 50px">Antecedentes penales</td>
                                            <td style="text-align: center">
                                                @if (!$peoplerequirement->image_ap)
                                                    <label class="label label-danger">Sin datos</label>
                                                @else
                                                    <a href="{{asset('storage/'.$peoplerequirement->image_ap)}}" title="Ver" target="_blank">
                                                        <img @if(strpos($peoplerequirement->image_ap, ".pdf")) src="{{asset('images/icon/pdf.png')}}" @else src="{{asset('storage/'.$peoplerequirement->image_ap)}}" @endif href="{{asset('storage/'.$peoplerequirement->image_ap)}}" class="zoom" style="width: 60px; height: 60px; border-radius: 30px; margin-right: 10px"/>
                                                    </a>                                                                
                                                @endif                                                            
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="height: 50px">Experiencia en jardineria</td>
                                            <td style="text-align: center">
                                                @if ($peoplerequirement->exp_jardineria === null)
                                                    <label class="label label-danger">Sin datos</label>
                                                @else
                                                    @if($peoplerequirement->exp_jardineria == 1)
                                                        <span class="badge badge-success">Si</span>
                                                    @else
                                                        <span class="badge badge-dark">No</span>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="height: 50px">Experiencia en paisajismo</td>
                                            <td style="text-align: center">
                                                @if ($peoplerequirement->exp_paisajismo === null)
                                                    <label class="label label-danger">Sin datos</label>
                                                @else
                                                    @if($peoplerequirement->exp_paisajismo == 1)
                                                        <span class="badge badge-success">Si</span>
                                                    @else
                                                        <span class="badge badge-dark">No</span>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="height: 50px">Experiencia en Maquinaria</td>
                                            <td style="text-align: center">
                                                @if ($peoplerequirement->exp_maquinas === null)
                                                    <label class="label label-danger">Sin datos</label>
                                                @else
                                                    <span class="badge badge-success">{{$peoplerequirement->exp_maquinas}}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>                                    
                    </div>
                    
                    @if(auth()->user()->hasPermission('add_people-perfil-experience') || auth()->user()->hasRole('admin')) 
                </div>
            </div>
        </div>
    </div>                        
</div>
@endif    
