<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Guardia - Bienvenido</title>
  <title>{{setting('admin.title')}}</title>
  <meta property="og:url"           content="{{url('')}}" />
  {{-- <meta property="og:type"          content="" /> --}}
  <meta property="og:title"         content="{{setting('site.title')}}" />
  <meta property="og:description"   content="{{setting('site.description')}}" />
  <meta property="og:image"         content="{{ asset('images/icon.png') }}" />
  <meta name="keywords" content="beni, mamore, pagos, gadbeni, gobernacion">

  <!-- Favicons -->
  <link href="{{ asset('images/icon.png') }}" rel="icon">
  {{-- <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon"> --}}

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('vendor/landingpage/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/landingpage/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/landingpage/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/landingpage/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/landingpage/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('vendor/landingpage/css/style.css') }}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NewBiz - v4.3.0
  * Template URL: https://bootstrapmade.com/newbiz-bootstrap-business-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
      <div class="container d-flex justify-content-between">

      <div class="logo">
          <!-- Uncomment below if you prefer to use an text logo -->
          <!-- <h1><a href="index.html">NewBiz</a></h1> -->
          <a href="#">
              <img src="{{ asset('images/icon-alt.png') }}" alt="GADBENI" class="img-fluid">
          </a>
      </div>

      <nav id="navbar" class="navbar">
          <ul>
          <li><a class="nav-link scrollto active" href="#hero">Inicio</a></li>
          <li><a class="nav-link scrollto" href="#about">Acerca de</a></li>
          <li><a class="nav-link scrollto" href="#services">Servicios</a></li>
          <li><a class="nav-link scrollto" href="{{ url('admin') }}">Administración</a></li>
          </ul>
          <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

      </div>
  </header><!-- #header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="clearfix">
    <div class="container" data-aos="fade-up">
        <div class="col-md-4 text-right" style="margin-top: 30px">
            <a href="{{route('people.create')}}" class="btn btn-success">
                <i class="voyager-plus"></i> <span>Registrarme como trabajador</span>
            </a>
        </div>
        <div class="col-md-4 text-right" style="margin-top: 30px">
            <a href="{{route('busine.create')}}" class="btn btn-success">
                <i class="voyager-plus"></i> <span>Registrarme como empresa  proveedora de servicios</span>
            </a>
        </div>
        <div class="col-md-4 text-right" style="margin-top: 30px">
            <a href="{{route('beneficiary.create')}}" class="btn btn-success">
                <i class="voyager-plus"></i> <span>Busco servicios</span>
            </a>
        </div>

    </div>
  </section><!-- End Hero Section -->

  <main id="main">



  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  {{-- <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-4 col-md-6 footer-info">
            <h3>NewBiz</h3>
            <p>Cras fermentum odio eu feugiat lide par naso tierra. Justo eget nada terra videa magna derita valies darta donna mare fermentum iaculis eu non diam phasellus. Scelerisque felis imperdiet proin fermentum leo. Amet volutpat consequat mauris nunc congue.</p>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><a href="#">Home</a></li>
              <li><a href="#">About us</a></li>
              <li><a href="#">Services</a></li>
              <li><a href="#">Terms of service</a></li>
              <li><a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-contact">
            <h4>Contact Us</h4>
            <p>
              A108 Adam Street <br>
              New York, NY 535022<br>
              United States <br>
              <strong>Phone:</strong> +1 5589 55488 55<br>
              <strong>Email:</strong> info@example.com<br>
            </p>

            <div class="social-links">
              <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
              <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>

          </div>

          <div class="col-lg-3 col-md-6 footer-newsletter">
            <h4>Our Newsletter</h4>
            <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna veniam enim veniam illum dolore legam minim quorum culpa amet magna export quem marada parida nodela caramase seza.</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form>
          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong>NewBiz</strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!--
        All the links in the footer should remain intact.
        You can delete the links only if you purchased the pro version.
        Licensing information: https://bootstrapmade.com/license/
        Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=NewBiz
      -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End Footer --> --}}

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('vendor/landingpage/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('vendor/landingpage/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/landingpage/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('vendor/landingpage/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('vendor/landingpage/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('vendor/landingpage/vendor/purecounter/purecounter.js') }}"></script>
    <script src="{{ asset('vendor/landingpage/vendor/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('vendor/landingpage/js/main.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    {{-- Loading --}}
    <link rel="stylesheet" href="{{ asset('vendor/loading/loading.css') }}">
    <script src="{{ asset('vendor/loading/loading.js') }}"></script>

    {{-- SweetAlert2 --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function(){
            $('#form-search').submit(function(e){
                $('body').loading({message: 'Buscando...'});
                e.preventDefault();
                $.post($(this).attr('action'), $(this).serialize(), function(res){
                    $('body').loading('toggle');
                    if(res.error){
                        Swal.fire({
                            title: 'Error',
                            text: res.error,
                            icon: 'error',
                            confirmButtonText: 'Entendido'
                        });
                        return;
                    }

                    if(res.aguinaldo){
                      Swal.fire({
                        title: 'Cobro de aguinaldo',
                        text: 'Puede realizar el cobro de aguinaldo en caja!',
                        icon: 'success',
                        confirmButtonText: 'Entendido'
                      });
                      return;
                    }

                    let months = ['', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
                    if(res.search.length > 0){
                      let data = '';
                      res.search.forEach(function(item){
                        data += `${months[parseInt(item.Mes)]}, `;
                      });
                      Swal.fire({
                        title: `Habilitado para pago del mes de ${data.substr(0, data.length-2)}.`,
                        text: 'Puedes pasar por caja a realizar el cobro.',
                        icon: 'success',
                        confirmButtonText: 'Entendido'
                      });
                    }else{
                      Swal.fire({
                        title: 'Trámite de pago no encontrado',
                        text: 'La cedula de identidad ingresada no tiene trámites de pago en el sistema.',
                        icon: 'warning',
                        confirmButtonText: 'Entendido'
                      });
                    }
                })
                .catch(function(err){
                    $('body').loading('toggle');
                    Swal.fire({
                        title: 'Error',
                        text: 'Ocurrio un error al realizar la busqueda',
                        icon: 'error',
                        confirmButtonText: 'Entendido'
                    });
                });
            });
        });
    </script>

    {{-- Snowfall --}}
    @if (setting('plantillas.navidad'))
      <div id="flake">&#10052;</div>
      <link rel="stylesheet" href="{{ asset('css/snowfall.css') }}">
      <script src="{{ asset('js/snowfall.js') }}"></script>
    @endif

    {{-- Socket.io --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.4.0/socket.io.js" integrity="sha512-nYuHvSAhY5lFZ4ixSViOwsEKFvlxHMU2NHts1ILuJgOS6ptUmAGt/0i5czIgMOahKZ6JN84YFDA+mCdky7dD8A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        const socket = io("{{ env('APP_URL') }}"+":3001");
    </script>
    <style>
      #odometer{
        background: white;
        border-radius: 7px;
        border: 3px solid #3f3f3f;
        font-size: 30px;
        padding: 0px 20px
      }
    </style>
    <!-- Odometr includes -->
    <link rel="stylesheet" href="{{ asset('vendor/odometer/odometer-theme-default.css') }}" />
    <script src="{{ asset('vendor/odometer/odometer.js') }}"></script>
    <script>
      socket.on('get new ticket', data => {
        odometer.innerHTML = data.ticket;
      });
    </script>
</body>

</html>