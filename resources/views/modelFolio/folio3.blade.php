<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>TrabajosTop</title>
  <meta content="" name="description">
  <meta name="keywords" content="trabajostop, servicios, empleos, trabajos, empresas, proservice, trabajadores, beni, bolsa de empleos, oportunidades laborales">

  <!-- Favicons -->
  <link href="{{asset('images/icon.png')}}" rel="icon">
  <link href="{{asset('images/icon.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Cardo:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

  {{-- <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet"> --}}


    <!-- Vendor CSS Files -->
    <link href="{{asset('modelFolio/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('modelFolio/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('modelFolio/assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">
    <link href="{{asset('modelFolio/assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
    <link href="{{asset('modelFolio/assets/vendor/aos/aos.css')}}" rel="stylesheet">
  
    <!-- Template Main CSS File -->
    <link href="{{asset('modelFolio/assets/css/main.css')}}" rel="stylesheet">



    <!-- Vendor CSS Files -->
    <link href="{{asset('modelFolio/assets/vendors/aos/aos.css')}}" rel="stylesheet">
    <link href="{{asset('modelFolio/assets/vendors/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('modelFolio/assets/vendors/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('modelFolio/assets/vendors/swiper/swiper-bundle.min.css')}}" rel="stylesheet">
  
    <!-- Template Main CSS File -->
    <link href="{{asset('modelFolio/assets/css/style.css')}}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: PhotoFolio - v1.0.0
  * Template URL: https://bootstrapmade.com/photofolio-bootstrap-photography-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid d-flex align-items-center justify-content-between">

      <a href="{{url('/')}}" class="logo d-flex align-items-center  me-auto me-lg-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <i class="bi bi-camera"></i>
        <h1><span style="color:rgb(255, 255, 255)">Trabajos</span><span style="color:rgb(255,157,0)">TOP</span></h1>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="{{url('model-folio')}}" class="active">Inicio</a></li>
          <li><a href="#">Servicios</a></li>
          <li><a href="#">Contactos</a></li>
        </ul>
      </nav><!-- .navbar -->

      <div class="header-social-links">
        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
      </div>
      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    </div>
  </header><!-- End Header -->

  <main id="main" data-aos="fade" data-aos-delay="1500">



    <section  class="section site-portfolio">
      <div class="container">
        <div class="row mb-5 align-items-center" style="text-align: center">
          <h1>Galeria</h1>
        </div>
        <div id="portfolio-grid" class="row no-gutter" data-aos="fade-up" data-aos-delay="200" style="text-align: center">
          
          <div class="item profesional col-sm-6 col-md-2 col-lg-2 mb-2">
            <a href="#" class="item-wrap fancybox">
              <div class="work-info">
                <h3>AMF</h3>
                {{-- <span>Profesional</span> --}}
                {{-- <br> --}}
                <small>Peso: 66</small>
                <br>
                <small>Altura: 1,86</small>
                <br>
                <small>Ojo: cafe</small>
                <br>
                <small>Talla Superior: XL</small>
                <br>
                <small>Talla Inferior: 40</small>
               
              </div>
              <img class="img-fluid" src="{{asset('modelFolio/assets/img/portfolio/c_1.jpeg')}}">
            </a>
          </div>
          <div class="item profesional col-sm-6 col-md-2 col-lg-2 mb-2">
            <a href="#" class="item-wrap fancybox">
              <div class="work-info">
                <h3>JAS</h3>
                {{-- <span>Profesional</span> --}}
                {{-- <br> --}}
                <small>Peso: 81</small>
                <br>
                <small>Altura: 1,56</small>
                <br>
                <small>Ojo: Celeste</small>
                <br>
                <small>Talla Superior: XLL</small>
                <br>
                <small>Talla Inferior: 42</small>
               
              </div>
              <img class="img-fluid" src="{{asset('modelFolio/assets/img/portfolio/c_2.jpeg')}}">
            </a>
          </div>
          <div class="item profesional col-sm-6 col-md-2 col-lg-2 mb-2">
            <a href="#" class="item-wrap fancybox">
              <div class="work-info">
                <h3>DAA</h3>
                {{-- <span>Profesional</span> --}}
                {{-- <br> --}}
                <small>Peso: 59</small>
                <br>
                <small>Altura: 1,55</small>
                <br>
                <small>Ojo: azul</small>
                <br>
                <small>Talla Superior: 16</small>
                <br>
                <small>Talla Inferior: 38</small>
               
              </div>
              <img class="img-fluid" src="{{asset('modelFolio/assets/img/portfolio/c_3.jpeg')}}">
            </a>
          </div>
          <div class="item profesional col-sm-6 col-md-2 col-lg-2 mb-2">
            <a href="#" class="item-wrap fancybox">
              <div class="work-info">
                <h3>IFG</h3>
                {{-- <span>Profesional</span> --}}
                {{-- <br> --}}
                <small>Peso: 75</small>
                <br>
                <small>Altura: 1,84</small>
                <br>
                <small>Ojo: cafe</small>
                <br>
                <small>Talla Superior: XL</small>
                <br>
                <small>Talla Inferior: 40</small>
               
              </div>
              <img class="img-fluid" src="{{asset('modelFolio/assets/img/portfolio/c_4.jpeg')}}">
            </a>
          </div>
          <div class="item profesional col-sm-6 col-md-2 col-lg-2 mb-2">
            <a href="#" class="item-wrap fancybox">
              <div class="work-info">
                <h3>TYA</h3>
                {{-- <span>Profesional</span> --}}
                {{-- <br> --}}
                <small>Peso: 55</small>
                <br>
                <small>Altura: 1,64</small>
                <br>
                <small>Ojo: cafe</small>
                <br>
                <small>Talla Superior: 16</small>
                <br>
                <small>Talla Inferior: 41</small>
               
              </div>
              <img class="img-fluid" src="{{asset('modelFolio/assets/img/portfolio/c_5.jpeg')}}">
            </a>
          </div><div class="item profesional col-sm-6 col-md-2 col-lg-2 mb-2">
            <a href="#" class="item-wrap fancybox">
              <div class="work-info">
                <h3>DFA</h3>
                {{-- <span>Profesional</span> --}}
                {{-- <br> --}}
                <small>Peso: 65</small>
                <br>
                <small>Altura: 1,81</small>
                <br>
                <small>Ojo: azul</small>
                <br>
                <small>Talla Superior: 16</small>
                <br>
                <small>Talla Inferior: 39</small>
               
              </div>
              <img class="img-fluid" src="{{asset('modelFolio/assets/img/portfolio/c_6.jpeg')}}">
            </a>
          </div>
          <div class="item profesional col-sm-6 col-md-2 col-lg-2 mb-2">
            <a href="#" class="item-wrap fancybox">
              <div class="work-info">
                <h3>SWA</h3>
                {{-- <span>Profesional</span> --}}
                {{-- <br> --}}
                <small>Peso: 70</small>
                <br>
                <small>Altura: 1,80</small>
                <br>
                <small>Ojo: cafe</small>
                <br>
                <small>Talla Superior: XL</small>
                <br>
                <small>Talla Inferior: 42</small>
               
              </div>
              <img class="img-fluid" src="{{asset('modelFolio/assets/img/portfolio/c_7.jpeg')}}">
            </a>
          </div>
          <div class="item profesional col-sm-6 col-md-2 col-lg-2 mb-2">
            <a href="#" class="item-wrap fancybox">
              <div class="work-info">
                <h3>DDA</h3>
                {{-- <span>Profesional</span> --}}
                {{-- <br> --}}
                <small>Peso: 71</small>
                <br>
                <small>Altura: 1,50</small>
                <br>
                <small>Ojo: cafe</small>
                <br>
                <small>Talla Superior: XL</small>
                <br>
                <small>Talla Inferior: 38</small>
               
              </div>
              <img class="img-fluid" src="{{asset('modelFolio/assets/img/portfolio/c_8.jpeg')}}">
            </a>
          </div>
          <div class="item profesional col-sm-6 col-md-2 col-lg-2 mb-2">
            <a href="#" class="item-wrap fancybox">
              <div class="work-info">
                <h3>APL</h3>
                {{-- <span>Profesional</span> --}}
                {{-- <br> --}}
                <small>Peso: 79</small>
                <br>
                <small>Altura: 1,75</small>
                <br>
                <small>Ojo: cafe</small>
                <br>
                <small>Talla Superior: XL</small>
                <br>
                <small>Talla Inferior: 41</small>
               
              </div>
              <img class="img-fluid" src="{{asset('modelFolio/assets/img/portfolio/c_9.jpeg')}}">
            </a>
          </div>


          
          
        </div>
      </div>
    </section><!-- End  Works Section -->

   

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  {{-- <footer id="footer" class="footer">
    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>PhotoFolio</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/photofolio-bootstrap-photography-website-template/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End Footer --> --}}

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader">
    <div class="line"></div>
  </div>

  {{-- <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script> --}}

    <!-- Vendor JS Files -->
    <script src="{{asset('modelFolio/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('modelFolio/assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
    <script src="{{asset('modelFolio/assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
    <script src="{{asset('modelFolio/assets/vendor/aos/aos.js')}}"></script>
    <script src="{{asset('modelFolio/assets/vendor/php-email-form/validate.js')}}"></script>
  
    <!-- Template Main JS File -->
    <script src="{{asset('modelFolio/assets/js/main.js')}}"></script>

</body>

</html>