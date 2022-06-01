@extends('voyager::master')

@section('page_title', 'Requisitos')
<style>
    
    input.text, select.text, textarea.text{ 
        border-radius: 5px 5px 5px 5px;
        color: #000000;
        border-color: rgb(63, 63, 63);
    }

   
    small{font-size: 32px;
        color: rgb(12, 12, 12);
        font-weight: bold;
    }
    #subtitle{
        font-size: 18px;
        color: rgb(12, 12, 12);
        font-weight: bold;
    }


    #detalles {
    font-family: Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
    }

    #detalles td, #detalles th {
    border: 1px solid #ddd;
    padding: 8px;
    }

    #detalles tr:nth-child(even){background-color: #f2f2f2;}

    #detalles tr:hover {background-color: #ddd;}

    #detalles th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #04AA6D;
        color: white;
    }

    .form-control .select2{
        border-radius: 5px 5px 5px 5px;
        color: #000000;
        border-color: rgb(63, 63, 63);
    }
    

</style>
@section('page_header')
    <h1 class="page-title">
        <i class="voyager-folder"></i> Requisitos para {{$rubro->name}}
        &nbsp; 
        <a href="{{route('people-perfil-experience.index')}}" class="btn btn-warning">
          <i class="fa-solid fa-circle-left"></i>
            Volver
        </a>
    </h1>
@stop

@section('content')
    @if ($rubro_id == 1)
        @include('people.work-experience.include.guardia')
    @endif
    @if ($rubro_id == 2)
        @include('people.work-experience.include.jardinero')
    @endif
    
@stop

@section('javascript')
    <script>
        $(document).ready(function () {
            
        });
    </script>
@stop
