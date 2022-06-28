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
            <h2>Registrate para buscar Servicios</h2>
            <p>Mediante TrabajosTOP podrás encontrar  empresas y trabajadores confiables  y con referencias que han sido previamente verificados por nosotros.</p>
            </div>

            <div class="row">

            <div class="col-lg-6">

                <div class="row">
                    {{-- <div class="col-md-12" style="">
                        <div class="info-box" style="height: 400px; background-image: url(https://cdn.pixabay.com/photo/2015/01/09/11/08/startup-594090_960_720.jpg)" >
                        </div>
                    </div> --}}
                    <div class="col-md-12 div-img" style="height: 600px;">
                        <img src="images/register/BUSCO-EMPRESA-1.jpeg" class="img-fluid" alt="">
                    </div>
                </div>

            </div>

            <div class="col-lg-6 mt-4 mt-lg-0">
                {!! Form::open(['route' => 'beneficiary.store','class' => 'was-validated', 'method'=>'POST', 'enctype' => 'multipart/form-data'])!!}
                    <div class="row">                        
                        <div class="col-md-6 form-group">
                            <span ><b>Razón Social</b></span>
                            <input type="text" name="name" class="form-control" id="nombre" placeholder="PROTECTION SRL" value="{{ old('name') }}" required>
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
                            <input type="text" name="phone1" class="form-control" placeholder="7896555" onkeypress='return validaNumericos(event)' value="{{ old('phone1') }}" required>
                        </div>
                        <div class="col-md-6 form-group mt-3 mt-md-0">
                            <span ><b>Página Web</b></span>
                            <input type="text" class="form-control" name="website"  placeholder="ejemplo.com" value="{{ old('website') }}">
                        </div>
                    </div>


                    <div class="form-group mt-3">
                        <textarea class="form-control" name="address" id="address" rows="5" placeholder="Dirección" required>{{ old('address') }}</textarea>
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
                                  <input type="password" class="form-control" name="password" id="password" id="email" placeholder="*********" required>                                 
                                  <div class="input-group-prepend">
                                    <button class="btn btn-primary" type="button" onclick="mostrarContrasena()" id="boton"><span class="fa fa-eye"></span></button>                                   
                                  </div>
                                </div>
                            </div>    
                            @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror                    
                        </div>
                    </div>
                    <br>
                    <div style="text-align: right" >
                        {{-- <button type="button" class="btn btn-default">Cancelar</button> --}}
                        <button type="submit" class="btn" style="background-color: #ff9d00;">Registrarse</button>
                        {{-- <a href="{{url('register-employe')}}" class="btn-get-started scrollto">Busco Trabajo</a> --}}

                    </div>
                {!! Form::close()!!} 
            </div>

            </div>

        </div>
    </section><!-- End Contact Section -->

    </main>
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