@extends('voyager::master')

@section('page_title', 'Buscar Trabajadores')

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
            <div id="div-results" style="min-height: 100px"></div>
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
