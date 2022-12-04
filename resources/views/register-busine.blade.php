@extends('layouts.master')

@section('main')
<style>
    .div-img {
        width: 600px;
        height: 910px;
        /* background-color: #9FC; */
        }
</style>
    <main id="main">

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact section-bg mt-5">
        <div class="container">

            <div class="section-title">
            <h2>Registrate Como Empresa</h2>
            <p>Registra tu empresa y podrás encontrar los trabajadores que estás necesitando al instante y no te olvides de verificar tu empresa para que encuentres clientes mediante TrabajosTOP.</p>
            </div>

            <div class="row">

            <div class="col-lg-6">

                <div class="row">
                    {{-- <div class="col-md-12" style="">
                        <div class="info-box" style="height: 400px; background-image: url(https://cdn.pixabay.com/photo/2015/07/17/22/43/student-849826_960_720.jpg)">
                        </div>
                    </div> --}}
                    <div class="col-md-12 div-img" style="height: 600px;">
                        <img src="images/register/BUSCO-EMPRESA-2.jpeg" class="img-fluid" alt="">
                    </div>
                </div>

            </div>

            <div class="col-lg-6 mt-4 mt-lg-0">
                @php
                    $rubros = \DB::table('rubro_busines')->where('deleted_at', null)->where('status', 1)->get();
                @endphp
                {!! Form::open(['route' => 'busine.store','class' => 'was-validated', 'method'=>'POST', 'enctype' => 'multipart/form-data'])!!}
                    {{-- @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $item)
                                    <li>{{$item }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif --}}
                    <div class="row">
                        <div class="col-md-6 form-group mt-3 mt-md-0">
                            <span ><b>Departamento</b></span>
                            <select id="department_id" name="department_id" class="form-control select2bs4" required>
                                <option value="">Seleccione un departamento..</option>
                                @foreach($department as $data)
                                    <option value="{{$data->id}}">{{$data->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 form-group mt-3 mt-md-0">
                            <span ><b>Ciudad</b></span>
                            <select name="city_id" id="city_id" class="form-control select2bs4" required>
                                <option value="">Seleccione una Ciudad..</option>
                                {{--@foreach($department as $data)
                                    <option value="{{$data->id}}">{{$data->name}}</option>
                                @endforeach --}}
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <span ><b>Nit</b></span>
                            <input type="text" name="nit" onkeypress='return validaNumericos(event)' class="form-control" id="nit" placeholder="7688596255" value="{{ old('nit') }}" required>
                            @error('nit')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group mt-3 mt-md-0">
                            <span ><b>Rubro</b></span>
                            <select name="rubro_id" id="rubro_id" class="form-control select2bs4" required>
                                <option value="">Seleccione un tipo..</option>
                                @foreach($rubros as $data)
                                    <option value="{{$data->id}}">{{$data->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <span ><b>Razón Social</b></span>
                            <input type="text" name="name" class="form-control" id="name" placeholder="PROTECTION SRL" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group mt-3 mt-md-0">
                            <span ><b>Responsable</b></span>
                            <input type="text" class="form-control" name="responsible" id="responsible" placeholder="Ignacio" value="{{ old('responsible') }}" required>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <span ><b>Teléfono</b></span>
                            <input type="text" name="phone1" id ="phone1" class="form-control" placeholder="76854410" onkeypress='return validaNumericos(event)' value="{{ old('phone1') }}" required>
                        </div>
                        <div class="col-md-6 form-group mt-3 mt-md-0">
                            <span ><b>Página Web</b></span>
                            <input type="text" class="form-control" name="website" placeholder="ejemplo.com" value="{{ old('website') }}">
                        </div>
                    </div>


                    <div class="form-group mt-3">
                        <span ><b>Dirección</b></span>
                        <textarea class="form-control" name="address" id="address" rows="5" placeholder="Calle Patujú" required>{{ old('address') }}</textarea>
                    </div>

                    <br>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <span ><b>Email</b></span>
                            <input type="email" name="email" class="form-control" id="email" placeholder="ejemplo@gmail.com"  value="{{ old('email') }}"required>
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group mt-3 mt-md-0">
                            <span ><b>Contraseña</b></span>
                            <div class="form-group">
                                <div class="input-group">                                  
                                  <input type="password" class="form-control" name="password" id="password" id="email" placeholder="******" required>
                                  
                                  <div class="input-group-prepend">
                                    <button class="btn btn-primary" type="button" onclick="mostrarContrasena()" id="boton"><span class="fa fa-eye"></span></button>
                                    {{-- <span class="input-group-addon" style="background:#fff;border:0px;font-size:25px;cursor:pointer;padding:0px;position: relative;bottom:10px" id="btn-verpassword">
                                        <span class="fa fa-eye"></span>
                                    </span> --}}
                                    
                                  </div>
                                </div>
                            </div>    
                            @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror                       
                        </div>
                    </div>
                    


                    <br>
                    <div id="g-recaptcha"></div>

                    <div style="text-align: right" >
                        <button type="submit" class="btn" id="btn-sumit" disabled style="background-color: #ff9d00;">Registrarse</button>
                        <a type="button" href="{{url('/')}}" class="btn" style="background-color: #526069; color:#ffffff;">Inicio</a>
                    </div>
                {!! Form::close()!!} 
            </div>

            </div>

        </div>
    </section><!-- End Contact Section -->

    </main>

    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
    <script src="{{asset('js/jquery.min.js')}}"></script>

        <script type="text/javascript">
            var onloadCallback = function() {
                grecaptcha.render('g-recaptcha', {
                    'sitekey' : '6LcAThQjAAAAACx7cPNlKT4VS-1l2f5pxdgwvFcG',
                    'callback' : function(response){
                        if (response.length == 0) {

                        }
                        else {
                            var id = setInterval(            
                                function () 
                                {                
                                    // alert(1);
                                    $('#btn-sumit').attr('disabled', 'disabled');
                                    clearInterval(id);
                                }, 60000 //en medio minuto se recargará solo la campana de notificación..
                            );

                            $('#btn-sumit').removeAttr('disabled');
                            $('#alert-captcha').css('display', 'none');
                        }
                    }
                });
            };
        </script>
    <script>
        function mostrarContrasena(){
            
            var tipo = document.getElementById("password");
                if(tipo.type == "password"){
                    $('#boton').html('<span class="fa fa-eye-slash"></span>');
                    $('#password').prop('type', 'text');
                }
                else
                {
                    $('#boton').html('<span class="fa fa-eye"></span>');
                    $('#password').prop('type', 'password');
                }
        }
    </script>
@endsection