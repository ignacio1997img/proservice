@extends('voyager::master')

@section('page_title', 'Buscar Trabajadores')
<style>
    a{
  text-decoration: none;
}

.main-wrap {
    background: #000;
        text-align: center;
}
.main-wrap h1 {
        color: #fff;
            margin-top: 50px;
    margin-bottom: 100px;
}
.col-md-3 {
	display: block;
	float:left;
	margin: 1% 0 1% 1.6%;
	  background-color: #eee;
  padding: 50px 0;
}

.col:first-of-type {
  margin-left: 0;
}


/* ALL LOADERS */

.loader{
  width: 100px;
  height: 100px;
  border-radius: 100%;
  position: relative;
  margin: 0 auto;
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


/* LOADER 7 */

#loader-7{
  -webkit-perspective: 120px;
  -moz-perspective: 120px;
  -ms-perspective: 120px;
  perspective: 120px;
}

#loader-7:before{
  content: "";
  position: absolute;
  left: 25px;
  top: 25px;
  width: 50px;
  height: 50px;
  background-color: #3498db;
  animation: flip 1s infinite;
}

@keyframes flip {
  0% {
    transform: rotate(0);
  }

  50% {
    transform: rotateY(180deg);
  }

  100% {
    transform: rotateY(180deg)  rotateX(180deg);
  }
}

/* LOADER 8 */

#loader-8:before{
  /* content: ""; */
  position: absolute;
  width: 10px;
  height: 10px;
  top: calc(50% - 10px);
  left: 0px;
  background-color: #3498db;
  animation: rotatemove 1s infinite;
}

@keyframes rotatemove{
  0%{
    -webkit-transform: scale(1) translateX(0px);
    -ms-transform: scale(1) translateX(0px);
    -o-transform: scale(1) translateX(0px);
    transform: scale(1) translateX(0px);
  }

  100%{
    -webkit-transform: scale(2) translateX(45px);
    -ms-transform: scale(2) translateX(45px);
    -o-transform: scale(2) translateX(45px);
    transform: scale(2) translateX(45px);
  }
}
</style>
@section('page_header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body" style="padding: 0px">
                        <div class="col-md-7" style="padding: 0px">
                            <h1 class="page-title">
                                <i class="fa-solid fa-person-digging"></i> Buscar Trabajadores 
                            </h1>
                        </div>
                        {!! Form::open(['route' => 'search-work.search', 'id' => 'form-search',  'method' => 'POST', 'class' => 'form-search']) !!}
                        <div class="col-md-5" style="margin-top: 30px">       
                            <select name="rubro_id" required class="form-control select2" style="margin-bottom: 10px">
                                <option value="">Seleccione una opcion</option>
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
                                <h4 class="page-title">
                                    Por Rango de Estrellas
                                </h4>
                                <span class="fa fa-star" onclick="calificar(this)" style="cursor: pointer; font-size: 1em;" id="1estrella"></span>
                                <span class="fa fa-star" onclick="calificar(this)" style="cursor: pointer; font-size: 1em;" id="2estrella"></span>
                                <span class="fa fa-star" onclick="calificar(this)" style="cursor: pointer; font-size: 1em;" id="3estrella"></span>
                                <span class="fa fa-star" onclick="calificar(this)" style="cursor: pointer; font-size: 1em;" id="4estrella"></span>
                                <span class="fa fa-star" onclick="calificar(this)" style="cursor: pointer; font-size: 1em;" id="5estrella"></span>
                           
                            <div class="row" id="div_cis"> 
                                <input type="hidden" class="form-control" name="star" value="0">                               
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
        
    </script>
@stop
