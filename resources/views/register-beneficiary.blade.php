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
                        <img src="images/register/BUSCO-EMPRESA-1.png" class="img-fluid" alt="">
                    </div>
                </div>

            </div>

            <div class="col-lg-6 mt-4 mt-lg-0">
                {!! Form::open(['route' => 'beneficiary.store', 'method'=>'POST', 'enctype' => 'multipart/form-data'])!!}
                    <div class="row">
                        <div class="col-md-6 form-group">
                        <input type="text" name="name" class="form-control" id="nombre" placeholder="Razon Social" required>
                        </div>
                        <div class="col-md-6 form-group mt-3 mt-md-0">
                        <input type="text" class="form-control" name="responsible" id="apellido" placeholder="Responsable" required>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <input type="text" name="phone1" class="form-control" placeholder="Telefono" onkeypress='return validaNumericos(event)' required>
                        </div>
                        <div class="col-md-6 form-group mt-3 mt-md-0">
                            <input type="text" class="form-control" name="website" placeholder="Sitio Web">
                        </div>
                    </div>


                    <div class="form-group mt-3">
                        <textarea class="form-control" name="address" rows="5" placeholder="Dirección" required></textarea>
                    </div>

                    <br>
                    <div class="row">
                        <div class="col-md-6 form-group">
                        <input type="email" name="email" class="form-control" id="name" placeholder="Email" required>
                        </div>
                        <div class="col-md-6 form-group mt-3 mt-md-0">
                        <input type="password" class="form-control" name="password" id="email" placeholder="Contraseña" required>
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
@endsection