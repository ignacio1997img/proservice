@extends('layouts.master')

@section('main')
    <main id="main">

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact section-bg mt-5">
        <div class="container">

            <div class="section-title">
            <h2>Registrate Como Trabajador</h2>
            <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
            </div>

            <div class="row">

            <div class="col-lg-6">

                <div class="row">
                    <div class="col-md-12" style="">
                        <div class="info-box" style="height: 600px; background-image: url(https://cdn.pixabay.com/photo/2015/01/09/11/09/meeting-594091_960_720.jpg)">
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-lg-6 mt-4 mt-lg-0">
                {!! Form::open(['route' => 'people.store','class' => 'was-validated', 'method'=>'POST', 'enctype' => 'multipart/form-data'])!!}
                    <div class="row">
                        <div class="col-md-6 form-group">
                        <input type="text" name="ci" onkeypress='return validaNumericos(event)' class="form-control" id="name" placeholder="Carnet de Identidad" required>
                        </div>
                        <div class="col-md-6 form-group mt-3 mt-md-0">
                            <select class="form-control" name="sex"required>
                                <option value="">Sexo</option>
                                <option value="1">Masculino</option>
                                <option value="0">Femenino</option>
                            </select>
                            {{-- <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required> --}}
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6 form-group">
                        <input type="text" name="first_name" class="form-control" id="nombre" placeholder="Nombre" required>
                        </div>
                        <div class="col-md-6 form-group mt-3 mt-md-0">
                        <input type="text" class="form-control" name="last_name" id="apellido" placeholder="Apellido" required>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <input type="text" name="phone1" class="form-control" placeholder="Telefono" onkeypress='return validaNumericos(event)' required>
                        </div>
                        <div class="col-md-6 form-group mt-3 mt-md-0">
                            <input type="date" class="form-control" name="birth_date" placeholder="Fecha Nacimiento" required>
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
                    <div class="text-center col-md-12">
                        <button type="button" class="btn btn-default">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Registrarse</button>
                    </div>
                {!! Form::close()!!} 
            </div>

            </div>

        </div>
    </section><!-- End Contact Section -->

    </main>
@endsection