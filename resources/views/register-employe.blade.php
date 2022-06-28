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
            <h2>Registrate Como Trabajador</h2>
            <p>Regístrate como trabajador y elige todas las áreas en las que quisieras trabajar. y quédate atento a tus notificaciones ya que te estaremos invitando a capacitaciones gratuitas todos los meses!.</p>
            </div>

            <div class="row">

            <div class="col-lg-6">

                <div class="row">
                    {{-- <div class="col-md-12" style="">
                        <div class="info-box" style="height: 600px; background-image: url(https://cdn.pixabay.com/photo/2015/01/09/11/09/meeting-594091_960_720.jpg)">
                        </div>
                    </div> --}}
                    <div class="col-md-12 div-img" style="height: 600px;">
                        <img src="images/register/BUSCO-TRABAJO-3.jpeg" class="img-fluid" alt="">
                    </div>
                </div>

            </div>

            <div class="col-lg-6 mt-4 mt-lg-0">
                {!! Form::open(['route' => 'people.store','class' => 'was-validated', 'method'=>'POST', 'enctype' => 'multipart/form-data'])!!}
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
                            <select id="department_id" class="form-control select2bs4" required>
                                <option value="">Seleccione un departamento..</option>
                                @foreach($department as $data)
                                    <option value="{{$data->id}}">{{$data->name}}</option>
                                @endforeach
                            </select>
                            {{-- <div class="invalid-feedback">Debes Ingresar datos</div>
                            <div class="valid-feedback">¡Se esta Ingresando Datos!</div> --}}
                        </div>
                        <div class="col-md-6 form-group mt-3 mt-md-0">
                            <span ><b>Ciudad</b></span>
                            <select name="city_id" id="city_id" class="form-control select2bs4" required>
                                 <option value="">Seleccione una Ciudad..</option>
                                {{--@foreach($department as $data)
                                    <option value="{{$data->id}}">{{$data->name}}</option>
                                @endforeach --}}
                            </select>
                            {{-- <div class="invalid-feedback">Debes Ingresar datos</div>
                            <div class="valid-feedback">¡Se esta Ingresando Datos!</div> --}}
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <span ><b>Carnet Identidad</b></span>
                            <input type="text" name="ci" onkeypress='return validaNumericos(event)' class="form-control" id="ci" placeholder="7085555" value="{{ old('ci') }}" required>
                            @error('ci')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group mt-3 mt-md-0">
                            <span ><b>Género</b></span>
                            <select class="form-control select2bs4" name="sex"required>
                                <option value="">Seleccione una opción..</option>
                                <option value="1">Masculino</option>
                                <option value="0">Femenino</option>
                            </select>
                            {{-- <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required> --}}
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <span ><b>Nombre</b></span>
                            <input type="text" name="first_name" class="form-control" id="first_name" placeholder="Juan" value="{{ old('first_name') }}" required>
                        </div>
                        <div class="col-md-6 form-group mt-3 mt-md-0">
                            <span ><b>Apellido</b></span>
                            <input type="text" class="form-control" name="last_name" id="apellido" placeholder="Ortiz Mendoza" value="{{ old('last_name') }}" required>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <span ><b>Telefono</b></span>
                            <input type="text" name="phone1" class="form-control" placeholder="7894878" onkeypress='return validaNumericos(event)' value="{{ old('phone1') }}" required>
                        </div>
                        <div class="col-md-6 form-group mt-3 mt-md-0">
                            <span ><b>Fecha Nacimiento</b></span>
                            <input type="date" class="form-control" name="birth_date" placeholder="Fecha Nacimiento" value="{{ old('birth_date') }}" required>
                        </div>
                    </div>


                    {{-- <div class="form-group mt-3">
                        <textarea class="form-control" name="address" rows="5" placeholder="Dirección" required></textarea>
                    </div> --}}
                    <div class="form-group mt-3">
                        <span ><b>Dirección</b></span>
                        <textarea class="form-control" name="address" id="address" rows="5" placeholder="Calle Patujú" required>{{ old('address') }}</textarea>
                    </div>

                    <br>
                    {{-- <div class="row">
                        <div class="col-md-6 form-group">
                        <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
                        </div>
                        <div class="col-md-6 form-group mt-3 mt-md-0">
                        <input type="password" class="form-control" name="password" id="email" placeholder="Contraseña" required>
                        </div>
                    </div> --}}


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
                    
                    {{-- <div class="my-3">
                        <div class="loading">Loading</div>
                        <div class="error-message"></div>
                        <div class="sent-message">Your message has been sent. Thank you!</div>
                    </div> --}}
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
