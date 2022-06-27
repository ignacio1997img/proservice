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
                                {!! Form::open(['route' => 'work-experience.requirement-modelos-store','class' => 'was-validated', 'method'=>'POST', 'enctype' => 'multipart/form-data'])!!}                               
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
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="file" name="image_book"  class="form-control" accept="image/*">
                                                </div>
                                                <small>Book (imagen):</small>
                                            </div>
                                        </div> 
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="number" id="nit" name="estatura" class="form-control form-control-sm text" placeholder="Seleccione un Proveedor">
                                                </div>
                                                <small>Estatura.</small>
                                            </div>
                                        </div>
                                        <!-- === -->
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="number" id="responsable" name="peso" class="form-control form-control-sm text" placeholder="Seleccione un Proveedor">
                                                </div>
                                                <small>Peso.</small>
                                            </div>
                                        </div>
                                    </div>

                                    <h4>Idiomas</h4>
                                    <div class="row">
                                       
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <small><input type="checkbox" id="cbox1" value="1" name="spanish"> Español</small><br>

                                                <small><input type="checkbox" id="cbox2" value="1" name="english"> Ingles</small>
                                            </div>
                                        </div> 
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <small><input type="checkbox" id="cbox1" value="1" name="frances"> Frances</small><br>

                                                <small><input type="checkbox" id="cbox2" value="1" name="italiano"> Italiano</small>
                                            </div>
                                        </div> 
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <small><input type="checkbox" id="cbox1" value="1" name="portugues"> portugues</small><br>

                                                <small><input type="checkbox" id="cbox2" value="1" name="aleman"> Aleman</small>
                                            </div>
                                        </div> 
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <textarea name="otro_idioma" class="form-control" rows="2"></textarea>
                                                </div>
                                                <small>Otro Idiomas.</small>
                                            </div>
                                        </div>
                                        <!-- === -->
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <textarea name="curso_modelaje" class="form-control" rows="2"></textarea>
                                                </div>
                                                <small>Curso de Modelaje y otros Relacionado.</small>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <textarea name="exp_modelaje" class="form-control" rows="2"></textarea>
                                                </div>
                                                <small>Experiencia en Modelaje.</small>
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
                                                <td>Book</td>
                                                <td>
                                                    @if ($peoplerequirement)
                                                        @if ($peoplerequirement->image_book)
                                                            <span class="badge badge-success">Si cargado</span>
                                                            <a href="{{url('storage/public/'.$peoplerequirement->image_book)}}" title="Ver" target="_blank" class="btn btn-sm btn-success">
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
                                            <tr>
                                                <td>Idioma</td>
                                                <td>
                                                    @if ($peoplerequirement)
                                                        @if ($peoplerequirement->spanish || $peoplerequirement->english || $peoplerequirement->frances || $peoplerequirement->italiano || $peoplerequirement->portugues || $peoplerequirement->aleman || $peoplerequirement->otro_idioma)
                                                            @if ($peoplerequirement->spanish)
                                                                <span class="badge badge-success">Español</span>
                                                            @endif
                                                            @if ($peoplerequirement->english)
                                                                <span class="badge badge-success">Ingles</span>
                                                            @endif
                                                            @if ($peoplerequirement->frances)
                                                                <span class="badge badge-success">Frances</span>
                                                            @endif
                                                            @if ($peoplerequirement->italiano)
                                                                <span class="badge badge-success">Italiano</span>
                                                            @endif
                                                            @if ($peoplerequirement->portugues)
                                                                <span class="badge badge-success">Portugues</span>
                                                            @endif
                                                            @if ($peoplerequirement->aleman)
                                                                <span class="badge badge-success">Aleman</span>
                                                            @endif
                                                            @if ($peoplerequirement->otro_idioma)
                                                                <span class="badge badge-success">{{$peoplerequirement->otro_idioma}}</span>
                                                            @endif
                                                            {{-- {{$peoplerequirement->spanish}} {{$peoplerequirement->english}} {{$peoplerequirement->frances}} {{$peoplerequirement->italiano}} {{$peoplerequirement->portugues}} {{$peoplerequirement->aleman}} {{$peoplerequirement->otro_idioma}} --}}
                                                        @else
                                                            <span class="badge badge-danger">No cargado</span>
                                                        @endif
                                                    @else
                                                        <span class="badge badge-danger">No cargado</span>
                                                    @endif
                                                </td>           
                                            </tr>
                                            <tr>
                                                <td>Curso de Modelaje y otros Relacionado</td>
                                                <td>
                                                    @if ($peoplerequirement)
                                                        @if ($peoplerequirement->curso_modelaje)
                                                            {{$peoplerequirement->curso_modelaje}}
                                                        @else
                                                            <span class="badge badge-danger">No cargado</span>
                                                        @endif
                                                    @else
                                                        <span class="badge badge-danger">No cargado</span>
                                                    @endif
                                                </td>           
                                            </tr>
                                            <tr>
                                                <td>Experiencia en Modelaje</td>
                                                <td>
                                                    @if ($peoplerequirement)
                                                        @if ($peoplerequirement->exp_modelaje)
                                                            {{$peoplerequirement->exp_modelaje}}
                                                        @else
                                                            <span class="badge badge-danger">No cargado</span>
                                                        @endif
                                                    @else
                                                        <span class="badge badge-danger">No cargado</span>
                                                    @endif
                                                </td>           
                                            </tr>
                                            {{--<tr>
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
                                                        @if ($peoplerequirement->bomba_agua == 1 || $peoplerequirement->| == 0)
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
                                            </tr> --}}
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