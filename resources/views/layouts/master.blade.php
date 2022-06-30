<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>TrabajosTop</title>
  <link rel="shortcut icon" href="{{ asset('images/icon.png') }}" type="image/png">
  <title>{{setting('admin.title')}}</title>
  <meta property="og:url"           content="{{url('')}}" />
  {{-- <meta property="og:type"          content="" /> --}}
  <meta property="og:title"         content="{{setting('site.title')}}" />
  <meta property="og:description"   content="{{setting('site.description')}}" />
  <meta property="og:image"         content="{{ asset('images/icon.png') }}" />
  <meta name="keywords" content="trabajostop, servicios, empleos, trabajos, empresas, proservice, trabajadores, beni, bolsa de empleos, oportunidades laborales">

  <!-- Favicons -->
  {{-- <link rel="shortcut icon" href="{{ asset('images/icon.png') }}" type="image/png"> --}}

  {{-- <link href="{{ asset('images/icon.png') }}" rel="icon">
  <link href="{{ asset('images/icon.png') }}" rel="apple-touch-icon"> --}}

  {{-- <link href="template/assets/img/icono.png" rel="icon">
  <link href="template/assets/img/apple-touch-icon.png" rel="apple-touch-icon"> --}}

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">

  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('css/select2.min.css')}}">
  <link rel="stylesheet" href="{{ asset('css/select2-bootstrap4.min.css')}}">
  
{{-- <script src="{{asset('js/jquery.min.js')}}"></script> --}}

  
  <!-- Vendor CSS Files -->
  <link href="template/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="template/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="template/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="template/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="template/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="template/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="template/assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Resi - v4.7.0
  * Template URL: https://bootstrapmade.com/resi-free-bootstrap-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  @include('layouts.header')
  <!-- End Header -->
  

  @yield('main')

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3><span style="color:rgb(13, 86, 221)">Trabajos</span><span style="color:rgb(255,157,0)">TOP</span></a></h1></h3>
            <p>
              Calle Gral. Davo Terrazas #3340 <br>
              <strong>Phone:</strong> +591 78128183<br>
              <strong>Email:</strong> trabajostopContacto@gmail.com<br>
            </p>
          </div>

          <!-- <div class="col-lg-2 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
            </ul>
          </div>

          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>Join Our Newsletter</h4>
            <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form>
          </div>

        </div>
      </div>
    </div> -->

    <div class="container d-md-flex py-4">

      <div class="me-md-auto text-center text-md-start">
        <div class="copyright">
          &copy; Copyright <strong><span>IdeaCreativa</span></strong>. Todos los Derechos son reservados
        </div>
        <div class="credits">
          <!-- All the links in the footer should remain intact. -->
          <!-- You can delete the links only if you purchased the pro version. -->
          <!-- Licensing information: https://bootstrapmade.com/license/ -->
          <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/resi-free-bootstrap-html-template/ -->
          Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
      </div>
      <div class="social-links text-center text-md-right pt-3 pt-md-0">
        <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
        <a href="https://wa.me/59178128183?text=Me gustaría saber más sobre su plataforma" target="_blank" class="twitter"><i class="bx bxl-whatsapp"></i></a>
        <a href="https://www.facebook.com/TrabajosTop/" target="_blank" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
        <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
        <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="template/assets/vendor/purecounter/purecounter.js"></script>
  <script src="template/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="template/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="template/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="template/assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="template/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="template/assets/js/main.js"></script>
  <script type="text/javascript">
    function validaNumericos(event) {
        if(event.charCode >= 48 && event.charCode <= 57){
          return true;
        }
        return false;        
    }
  </script>




<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/select2.full.min.js')}}"></script>
<script type="text/javascript">
    $(function()
    {

      // $('.select2').select2()
      
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })     
      // $('.select2bs5').select2({
      //   theme: 'bootstrap4'
      // })


        $('#department_id').on('change', selectCity);
    });

    function selectCity()
    {
        var id =  $(this).val();    
        if(id >=1)
        {
            $.get('{{route('ajax.get_city')}}/'+id, function(data){
                var html_city=    '<option value="">Seleccione una ciudad..</option>'
                    for(var i=0; i<data.length; ++i)
                    html_city += '<option value="'+data[i].id+'">'+data[i].name+'</option>'

                $('#city_id').html(html_city);;            
            });
        }
        else
        {
            var html_city=    '<option value="">Seleccione una ciudad..</option>'       
            $('#city_id').html(html_city);
        }
    };
</script>

</body>

</html>