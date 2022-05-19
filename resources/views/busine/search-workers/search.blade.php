@extends('voyager::master')

@section('page_title', 'Buscar Trabajadores')

@section('page_header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body" style="padding: 0px">
                        <div class="col-md-3" style="padding: 0px">
                            <h1 class="page-title">
                                <i class="voyager-people"></i> Buscar Trabajadores
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
                            <div class="text-right">
                                <button type="submit" class="btn btn-info" style="padding: 5px 10px"> <i class="voyager-settings"></i> Generar</button>
                            </div>                         

                        </div>
                        {!! Form::close() !!}
                        <div class="col-md-4">

                        </div>
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
