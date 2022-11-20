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
    </h1>
@stop

@section('content')
    @if ($rubro_id == 1)
        @include('people.work-experience.include.1t-guardiaSeguridad')
    @endif
    @if ($rubro_id == 2)
        @include('people.work-experience.include.2t-jardinero')
    @endif
    @if ($rubro_id == 3)
        @include('people.work-experience.include.3t-piscinero')
    @endif
    @if ($rubro_id == 4)
        @include('people.work-experience.include.modelos')
    @endif
    @if ($rubro_id == 5)
        @include('people.work-experience.include.5t-sistemaSeguridad')
    @endif
    
@stop


@section('css')
<style>
    
    input.text, select.text, textarea.text{ 
        border-radius: 1px 1px 1px 1px;
        color: #000000;
        border-color: rgb(63, 63, 63);
    }

   
    small{font-size 10px;
        color: rgb(12, 12, 12);
        font-weight: bold;
    }


        img.zoom {
            /* width: 350px;
            height: 200px; */
            width: 350px;
            height: 200px;
            -webkit-transition: all .2s ease-in-out;
            -moz-transition: all .2s ease-in-out;
            -o-transition: all .2s ease-in-out;
            -ms-transition: all .2s ease-in-out;
        }
        
        .transition {
            -webkit-transform: scale(5.0); 
            -moz-transform: scale(5.0);
            -o-transform: scale(5.0);
            transform: scale(5.0);
        }
    </style>
@stop


@section('javascript')
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script> --}}
    <script>
        $(document).ready(function(){
            $('.zoom').hover(function() {
                $(this).addClass('transition');
            }, function() {
                $(this).removeClass('transition');
            });
        });
    </script>

    <script>
            $(document).on('change','.imageLength',function(){
                var fileName = this.files[0].name;
                var fileSize = this.files[0].size;

                if(fileSize > 10000000){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'El archivo no debe superar los 10 MB!'
                    })
                    this.value = '';
                    this.files[0].name = '';
                }
                
                    // recuperamos la extensión del archivo
                    var ext = fileName.split('.').pop();
                    
                    // Convertimos en minúscula porque 
                    // la extensión del archivo puede estar en mayúscula
                    ext = ext.toLowerCase();
                    // console.log(ext);
                    switch (ext) {
                        case 'jpg':
                        case 'jpeg':
                        case 'png': 
                        case 'pdf': break;
                        default:
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'El archivo no tiene la extensión adecuada!'
                            })
                            this.value = ''; // reset del valor
                            this.files[0].name = '';
                    }
            });
    </script>
@stop
