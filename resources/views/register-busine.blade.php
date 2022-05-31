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
            <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
            </div>

            <div class="row">

            <div class="col-lg-6">

                <div class="row">
                    {{-- <div class="col-md-12" style="">
                        <div class="info-box" style="height: 400px; background-image: url(https://cdn.pixabay.com/photo/2015/07/17/22/43/student-849826_960_720.jpg)">
                        </div>
                    </div> --}}
                    <div class="col-md-12 div-img" style="height: 600px;">
                        <img src="images/register/BUSCO-EMPRESA-2.png" class="img-fluid" alt="">
                    </div>
                </div>

            </div>

            <div class="col-lg-6 mt-4 mt-lg-0">
                @php
                    $rubros = \DB::table('rubro_busines')->where('deleted_at', null)->where('status', 1)->get();
                @endphp
                {!! Form::open(['route' => 'busine.store','class' => 'was-validated', 'method'=>'POST', 'enctype' => 'multipart/form-data'])!!}
                <div class="row">
                        <div class="col-md-6 form-group">
                        <input type="text" name="nit" onkeypress='return validaNumericos(event)' class="form-control" id="name" placeholder="Nit" required>
                        </div>
                        <div class="col-md-6 form-group mt-3 mt-md-0">
                            <select name="rubro_id" id="rubro_id" class="form-control" required>
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
                        <input type="text" name="name" class="form-control" id="name" placeholder="Razon Social" required>
                        </div>
                        <div class="col-md-6 form-group mt-3 mt-md-0">
                        <input type="text" class="form-control" name="responsible" id="responsible" placeholder="Responsable" required>
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