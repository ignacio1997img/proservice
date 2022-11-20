@if(auth()->user()->hasPermission('add_people-perfil-experience') || auth()->user()->hasRole('admin')) 
<div class="page-content edit-add container-fluid">    
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-bordered">
                <div class="panel-body">
                    @endif    

                    @if(auth()->user()->hasPermission('add_people-perfil-experience') && !auth()->user()->hasRole('admin'))   
                        <form id="agent" action="{{route('work-experience.requirement-guardia-store')}}" method="POST" enctype="multipart/form-data">
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
                                <small>Libreta de servicio militar *imagen</small>
                                <input type="file" accept="image/jpeg,image/jpg,image/png,application/pdf" name="image_lsm" class="form-control imageLength">
                            </div>
                        </div>
                        <div class="row">                        
                            <div class="form-group col-md-3">
                                <small>F. completa pantalón y camisa *imagen</small>
                                <input type="file" accept="image/jpeg,image/jpg,image/png,application/pdf" name="image_fcc" class="form-control imageLength">
                            </div>
                            <div class="form-group col-md-3">
                                <small>Turno</small>
                                <select id="provider" name="turno[]" class="form-control select2 text" multiple="multiple">
                                    <option value="1">DIA</option>
                                    <option value="2">NOCHE</option>                                                 
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <small>Estatura</small>
                                <input type="number" name="estatura" class="form-control text" step="0.01" placeholder="Introduzca su estatura">
                            </div>
                            <div class="form-group col-md-3">
                                <small>Peso</small>
                                <input type="number" name="peso" class="form-control text" step="0.01" placeholder="Introduzca su peso">
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
                                            <td style="height: 50px">Libreta de servicio militar</td>
                                            <td style="text-align: center">
                                                @if (!$peoplerequirement->image_lsm)
                                                    <label class="label label-danger">Sin datos</label>
                                                @else
                                                    <a href="{{asset('storage/'.$peoplerequirement->image_lsm)}}" title="Ver" target="_blank">
                                                        <img @if(strpos($peoplerequirement->image_lsm, ".pdf")) src="{{asset('images/icon/pdf.png')}}" @else src="{{asset('storage/'.$peoplerequirement->image_lsm)}}" @endif href="{{asset('storage/'.$peoplerequirement->image_lsm)}}" class="zoom" style="width: 60px; height: 60px; border-radius: 30px; margin-right: 10px"/>
                                                    </a>                                                                
                                                @endif                                                            
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="height: 50px">Foto cuerpo completo de pantalón y camisa</td>
                                            <td style="text-align: center">
                                                @if (!$peoplerequirement->image_fcc)
                                                    <label class="label label-danger">Sin datos</label>
                                                @else
                                                    <a href="{{asset('storage/'.$peoplerequirement->image_fcc)}}" title="Ver" target="_blank">
                                                        <img @if(strpos($peoplerequirement->image_fcc, ".pdf")) src="{{asset('images/icon/pdf.png')}}" @else src="{{asset('storage/'.$peoplerequirement->image_fcc)}}" @endif href="{{asset('storage/'.$peoplerequirement->image_fcc)}}" class="zoom" style="width: 60px; height: 60px; border-radius: 30px; margin-right: 10px"/>
                                                    </a>                                                                
                                                @endif                                                            
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="height: 50px">Turno</td>
                                            <td style="text-align: center">
                                                @if ($peoplerequirement->t_dia || $peoplerequirement->t_noche)
                                                    @if ($peoplerequirement->t_dia)
                                                        <span class="badge badge-success">Día</span>
                                                        @if($peoplerequirement->t_noche)
                                                            -
                                                        @endif
                                                    @endif
                                                    @if ($peoplerequirement->t_noche)                                                        
                                                        <span class="badge badge-success">Noche</span>
                                                    @endif
                                                @else
                                                    <label class="label label-danger">Sin datos</label>
                                                @endif
                                            </td>          
                                        </tr>
                                        <tr>
                                            <td style="height: 50px">Estatura</td>
                                            <td style="text-align: center">
                                                @if ($peoplerequirement->estatura === null)
                                                    <label class="label label-danger">Sin datos</label>
                                                @else
                                                    <span class="badge badge-success">{{$peoplerequirement->estatura}} m.</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="height: 50px">Peso</td>
                                            <td style="text-align: center">
                                                @if ($peoplerequirement->peso === null)
                                                    <label class="label label-danger">Sin datos</label>
                                                @else
                                                    <span class="badge badge-success">{{$peoplerequirement->peso}} kg.</span>
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
