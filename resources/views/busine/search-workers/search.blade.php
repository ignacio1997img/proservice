@extends('voyager::master')
@if(auth()->user()->hasPermission('browse_search-work'))
@section('page_title', 'Buscar Trabajadores')

@section('page_header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body" style="padding: 0px">
                        <div class="col-md-7" style="padding: 0px">
                            <h1 id="subtitle" class="page-title">
                                <i class="fa-solid fa-person-digging"></i> Buscar Trabajadores 
                            </h1>
                        </div>
                        {!! Form::open(['route' => 'search-work.search', 'id' => 'form-search',  'method' => 'POST', 'class' => 'form-search']) !!}
                        
                        <div class="col-md-5" style="margin-top: 30px">       
                            <select name="job" id="job" required class="form-control select2" style="margin-bottom: 10px">
                              <option selected disabled value="">Seleccione una opcion</option>
                              <option value="1">Trabajador</option>
                              <option value="2">Pasantes</option>
                            </select> 
                            <br><br>
                            <div id="trabajador">
                              <select name="rubro_id" id="rubro_id" required class="form-control select2" style="margin-bottom: 10px">
                                  <option selected disabled value="">Seleccione una opcion</option>
                                  @foreach ($rubro_people as $item)
                                      <option value="{{ $item->id }}">{{ $item->name }}</option>
                                  @endforeach
                              </select> 
                              <br><br>
                              <select name="verified" required class="form-control select2" style="margin-bottom: 10px">
                                <option value="">Seleccione una opcion</option>
                                <option value="1">Persona Verificada</option>
                                <option value="2">Persona no Verificada</option>
                              </select>   
                              <br><br>
                              <div id="parametro">
                                
                              </div>
                              <div class="col-sm-12">
                                  <h4 id="subtitle" class="page-title">
                                      Por Rango de Estrellas
                                  </h4>
                                  <span class="fa fa-star" onclick="calificar(this)" style="cursor: pointer; font-size: 1em;" id="1estrella"></span>
                                  <span class="fa fa-star" onclick="calificar(this)" style="cursor: pointer; font-size: 1em;" id="2estrella"></span>
                                  <span class="fa fa-star" onclick="calificar(this)" style="cursor: pointer; font-size: 1em;" id="3estrella"></span>
                                  <span class="fa fa-star" onclick="calificar(this)" style="cursor: pointer; font-size: 1em;" id="4estrella"></span>
                                  <span class="fa fa-star" onclick="calificar(this)" style="cursor: pointer; font-size: 1em;" id="5estrella"></span>
                              </div>
                            
                              <div class="row" id="div_cis"> 
                                  <input type="hidden" class="form-control" name="star" value="0">                               
                              </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-info" style="padding: 5px 10px"> <i class="voyager-settings"></i> Generar</button>
                            </div>                         

                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="page-content browse container-fluid">
        @include('voyager::alerts')
        <div class="row">
            <div id="div-results" style="min-height: 100px">
            </div>
        </div>
    </div>
@stop

@section('css')
<style>

  label{
        font-size: 12px;
        color: rgb(12, 12, 12);
        font-weight: bold;
  }



/* LOADER 3 */

#loader-3:before, #loader-3:after{
content: "";
width: 20px;
height: 20px;
position: absolute;
top: 0;
left: calc(50% - 10px);
background-color: #3498db;
animation: squaremove 1s ease-in-out infinite;
}

#loader-3:after{
bottom: 0;
animation-delay: 0.5s;
}

@keyframes squaremove{
0%, 100%{
  -webkit-transform: translate(0,0) rotate(0);
  -ms-transform: translate(0,0) rotate(0);
  -o-transform: translate(0,0) rotate(0);
  transform: translate(0,0) rotate(0);
}

25%{
  -webkit-transform: translate(40px,40px) rotate(45deg);
  -ms-transform: translate(40px,40px) rotate(45deg);
  -o-transform: translate(40px,40px) rotate(45deg);
  transform: translate(40px,40px) rotate(45deg);
}

50%{
  -webkit-transform: translate(0px,80px) rotate(0deg);
  -ms-transform: translate(0px,80px) rotate(0deg);
  -o-transform: translate(0px,80px) rotate(0deg);
  transform: translate(0px,80px) rotate(0deg);
}

75%{
  -webkit-transform: translate(-40px,40px) rotate(45deg);
  -ms-transform: translate(-40px,40px) rotate(45deg);
  -o-transform: translate(-40px,40px) rotate(45deg);
  transform: translate(-40px,40px) rotate(45deg);
}
}





</style>
@stop

@section('javascript')
    <script>
        var count;
        function calificar(item)
        {
            console.log(item);
            count = item.id[0];
            let nombre = item.id.substring(1);
            for(let i=0; i<5; i++)
            {
                if(i<count)
                {
                    document.getElementById((i+1)+nombre).style.color = "orange";
                }
                else
                {
                    document.getElementById((i+1)+nombre).style.color = "black";
                }
            }
            // var div =   '<div class="col-md-12">'
                       var div=            '<input type="hidden" class="form-control" name="star" value="'+count+'">'
                        // div+=        '</div>'
                    $('#div_cis').html(div);
                    // $('#stars').val(count);
        }

        
        $(document).ready(function() {
          $(".select2").select2({theme: "classic"});
          $('#rubro_id').on('change', div);
          $('#job').on()

            $('#form-search').on('submit', function(e){
                e.preventDefault();
                getData();
            });
        });
        function getData(){
            $('#div-results').empty();
            // $('#div-results').loading({message: 'Cargando...'});
            var loader = '<div class="col-md-12 bg"><div class="loader" id="loader-3"></div></div>'
                $('#div-results').html(loader);
            $.post($('#form-search').attr('action'), $('#form-search').serialize(), function(res){
                $('#div-results').html(res);
            })
            .fail(function() {
                toastr.error('Ocurrió un error.!', 'Oops!');
            })
            .always(function() {
                $('#div-results').loading('toggle');
                $('html, body').animate({
                    scrollTop: $("#div-results").offset().top - 70
                }, 500);
            });
        }




        function div()
        {
          // alert(4)
          var id = $(this).val();
          // alert(id)

          if(id == 1)
          {
            var html = `<div class="col-sm-6">
                                <div class="form-group form-check">
                                  <input type="checkbox" class="form-check-input" id="image_ap" name="image_ap">
                                  <label class="form-check-label" for="image_ap">Antecedentes Penales</label>
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="form-group form-check">
                                  <input type="checkbox" class="form-check-input" id="image_lsm" name="image_lsm">
                                  <label class="form-check-label" for="image_lsm">Libreta de Servio Militar</label>
                                </div>
                              </div>
                              <label>Peso</label>
                              <br>
                              <div class="col-sm-6">
                                <div class="form-group form-check">
                                  <input type="number" class="form-check-input" step="0.01" name="inicio_peso">
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="form-group form-check">
                                  <input type="number" class="form-check-input" step="0.01" name="fin_peso">
                                </div>
                              </div>
                              <label>Estatura</label>
                              <br>
                              <div class="col-sm-6">
                                <div class="form-group form-check">
                                  <input type="number" class="form-check-input" step="0.01" name="inicio_estatura">
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="form-group form-check">
                                  <input type="number" class="form-check-input" step="0.01" name="fin_estatura">
                                </div>
                              </div>
                              
                              <div class="col-sm-6" style="text-align: center">
                                <label>Turnos</label>
                                <br>
                                <div class="col-sm-6">
                                  <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="t_dia" name="t_dia">
                                    <label class="form-check-label" for="t_dia">Día</label>
                                  </div>
                                </div>
                                <div class="col-sm-6">
                                  <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="t_noche" name="t_noche">
                                    <label class="form-check-label" for="t_noche">Noche</label>
                                  </div>
                                </div>
                              </div> `
            $('#parametro').html(html);
          }
          if(id==2)
          {
            var html = `<div class="col-sm-6">
                                <div class="form-group form-check">
                                  <input type="checkbox" class="form-check-input" id="image_ap" name="image_ap">
                                  <label class="form-check-label" for="image_ap">Antecedentes Penales</label>
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="form-group form-check">
                                  <input type="checkbox" class="form-check-input" id="exp_jardineria" name="exp_jardineria">
                                  <label class="form-check-label" for="exp_jardineria">Experiencia en Jardineria</label>
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="form-group form-check">
                                  <input type="checkbox" class="form-check-input" id="exp_paisajismo" name="exp_paisajismo">
                                  <label class="form-check-label" for="exp_paisajismo">Experiencia en paisajismo</label>
                                </div>
                              </div>`
            $('#parametro').html(html);
          }
          if(id==3)
          {
            var html = `<div class="col-sm-6">
                                <div class="form-group form-check">
                                  <input type="checkbox" class="form-check-input" id="image_ap" name="image_ap">
                                  <label class="form-check-label" for="image_ap">Antecedentes Penales</label>
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="form-group form-check">
                                  <input type="checkbox" class="form-check-input" id="exp_mant_piscina" name="exp_mant_piscina">
                                  <label class="form-check-label" for="exp_mant_piscina">Experiencia en Mantenimiento de Piscinas</label>
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="form-group form-check">
                                  <input type="checkbox" class="form-check-input" id="medir_ph" name="medir_ph">
                                  <label class="form-check-label" for="medir_ph">Saber Medir PH</label>
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="form-group form-check">
                                  <input type="checkbox" class="form-check-input" id="asp_piscina" name="asp_piscina">
                                  <label class="form-check-label" for="asp_piscina">Saber Aspirar Piscina</label>
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="form-group form-check">
                                  <input type="checkbox" class="form-check-input" id="cant_quimico" name="cant_quimico">
                                  <label class="form-check-label" for="cant_quimico">Saber Calcular la Cantidad de Quimico para Piscina</label>
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="form-group form-check">
                                  <input type="checkbox" class="form-check-input" id="bomba_agua" name="bomba_agua">
                                  <label class="form-check-label" for="bomba_agua">Conocimiento de Funcionamiento de Bomba</label>
                                </div>
                              </div>`
            $('#parametro').html(html);
          }
          if(id==4)
          {
            var html = `<div class="col-sm-12">
                                <div class="form-group form-check">
                                  <input type="checkbox" class="form-check-input" id="image_book" name="image_book">
                                  <label class="form-check-label" for="image_book">Book</label>
                                </div>
                              </div>

                              <label>Peso</label>
                              <br>
                              <div class="col-sm-6">
                                <div class="form-group form-check">
                                  <input type="number" class="form-check-input" step="0.01" name="inicio_peso">
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="form-group form-check">
                                  <input type="number" class="form-check-input" step="0.01" name="fin_peso">
                                </div>
                              </div>
                              <label>Estatura</label>
                              <br>
                              <div class="col-sm-6">
                                <div class="form-group form-check">
                                  <input type="number" class="form-check-input" step="0.01" name="inicio_estatura">
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="form-group form-check">
                                  <input type="number" class="form-check-input" step="0.01" name="fin_estatura">
                                </div>
                              </div>`
            $('#parametro').html(html);
          }
        }



        
    </script>
@stop
@else
@section('content')
    <h1>No tienes permiso</h1>
@stop
@endif