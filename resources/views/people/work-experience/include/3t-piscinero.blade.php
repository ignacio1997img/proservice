@if(auth()->user()->hasPermission('add_people-perfil-experience') || auth()->user()->hasRole('admin')) 
<div class="page-content edit-add container-fluid">    
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-bordered">
                <div class="panel-body">
                    @endif    

                    @if(auth()->user()->hasPermission('add_people-perfil-experience') && !auth()->user()->hasRole('admin'))   
                        <form id="agent" action="{{route('work-experience.requirement-piscinero-store')}}" method="POST" enctype="multipart/form-data">
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
                                <small>Experiencia en Mantenimiento de Piscinas</small>
                                <select name="exp_mant_piscina" class="form-control form-control-sm text">
                                    <option selected disabled value="">Seleccione</option>
                                    <option value="1">SI</option>
                                    <option value="0">NO</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">                        
                            <div class="form-group col-md-3">
                                <small>Saber Medir PH</small>
                                <select name="medir_ph" class="form-control form-control-sm text">
                                    <option selected disabled value="">Seleccione</option>
                                    <option value="1">SI</option>
                                    <option value="0">NO</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <small>Saber Aspirar Piscina</small>
                                <select name="asp_piscina" class="form-control form-control-sm text">
                                    <option selected disabled value="">Seleccione</option>
                                    <option value="1">SI</option>
                                    <option value="0">NO</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <small>Saber Calcular la Cantidad de Quimico para Piscina</small>
                                <select name="cant_quimico" class="form-control form-control-sm text">
                                    <option selected disabled value="">Seleccione</option>
                                    <option value="1">SI</option>
                                    <option value="0">NO</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <small>Tiene Conocimiento de Funcionamiento de Bomba</small>
                                <select name="bomba_agua" class="form-control form-control-sm text">
                                    <option selected disabled value="">Seleccione</option>
                                    <option value="1">SI</option>
                                    <option value="0">NO</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">                        
                            <div class="form-group col-md-12">
                                <small>¿Donde ha Trabajado ante como Piscinero?</small>
                                <textarea name="trabajado_ante_donde"  class="form-control form-control-sm text" rows="2"></textarea>
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
                                            <td style="height: 50px">Experiencia en Mantenimiento de Piscinas</td>
                                            <td style="text-align: center">
                                                @if ($peoplerequirement->exp_mant_piscina === null)
                                                    <label class="label label-danger">Sin datos</label>
                                                @else
                                                    @if($peoplerequirement->exp_mant_piscina == 1)
                                                        <span class="badge badge-success">Si</span>
                                                    @else
                                                        <span class="badge badge-dark">No</span>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="height: 50px">Saber Medir PH</td>
                                            <td style="text-align: center">
                                                @if ($peoplerequirement->medir_ph === null)
                                                    <label class="label label-danger">Sin datos</label>
                                                @else
                                                    @if($peoplerequirement->medir_ph == 1)
                                                        <span class="badge badge-success">Si</span>
                                                    @else
                                                        <span class="badge badge-dark">No</span>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="height: 50px">Saber Aspirar Piscina</td>
                                            <td style="text-align: center">
                                                @if ($peoplerequirement->asp_piscina === null)
                                                    <label class="label label-danger">Sin datos</label>
                                                @else
                                                    @if($peoplerequirement->asp_piscina == 1)
                                                        <span class="badge badge-success">Si</span>
                                                    @else
                                                        <span class="badge badge-dark">No</span>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="height: 50px">Saber Calcular la Cantidad de Quimico para Piscina</td>
                                            <td style="text-align: center">
                                                @if ($peoplerequirement->cant_quimico === null)
                                                    <label class="label label-danger">Sin datos</label>
                                                @else
                                                    @if($peoplerequirement->cant_quimico == 1)
                                                        <span class="badge badge-success">Si</span>
                                                    @else
                                                        <span class="badge badge-dark">No</span>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="height: 50px">Tiene Conocimiento de Funcionamiento de Bomba</td>
                                            <td style="text-align: center">
                                                @if ($peoplerequirement->bomba_agua === null)
                                                    <label class="label label-danger">Sin datos</label>
                                                @else
                                                    @if($peoplerequirement->bomba_agua == 1)
                                                        <span class="badge badge-success">Si</span>
                                                    @else
                                                        <span class="badge badge-dark">No</span>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="height: 50px">¿Donde ha Trabajado ante como Piscinero?</td>
                                            <td style="text-align: center">
                                                @if ($peoplerequirement->trabajado_ante_donde === null)
                                                    <label class="label label-danger">Sin datos</label>
                                                @else
                                                    <span class="badge badge-success">{{$peoplerequirement->trabajado_ante_donde}}</span>
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
