@extends('voyager::master')

@section('page_title', 'Requisitos')

@section('page_header')
    <h1 class="page-title" id="subtitle">
        <i class="voyager-folder"></i> Requisitos para {{$rubro->name}}
        &nbsp; 
        <a href="{{ auth()->user()->hasRole('admin')? URL::previous():route('people-perfil-experience.index')}}" class="btn btn-warning">
          <i class="fa-solid fa-circle-left"></i>
            Volver
        </a>
        {{-- <a href="{{ URL::previous() }}" class="btn btn-warning">
            <i class="fa-solid fa-circle-left"></i>
              Volver
        </a> --}}
    </h1>
@stop

@section('content')
    @if ($rubro_id == 1)
        @include('people.work-experience.include.guardia')
    @endif
    @if ($rubro_id == 2)
        @include('people.work-experience.include.jardinero')
    @endif
    @if ($rubro_id == 3)
        @include('people.work-experience.include.piscinero')
    @endif
    @if ($rubro_id == 4)
        @include('people.work-experience.include.modelos')
    @endif
    
@stop

@section('css')
<style>
    
    input.text, select.text, textarea.text{ 
        border-radius: 5px 5px 5px 5px;
        color: #000000;
        border-color: rgb(63, 63, 63);
    }

   
    small{font-size 10px;
        color: rgb(12, 12, 12);
        font-weight: bold;
    }
    


</style>
@stop


@section('javascript')
    <script>
        $(document).ready(function () {
            
        });
    </script>
@stop
