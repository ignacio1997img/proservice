@extends('layouts.master')

<!-- ======= Hero Section ======= -->
@include('layouts.banner')
<!-- End Hero -->

@section('main')
<main id="main">

  <!-- ======= About Section ======= -->
  <!-- <section id="about" class="about">
    <div class="container">

      <div class="row content">
        <div class="col-lg-6">
          <h2>Eum ipsam laborum deleniti velitena</h2>
          <h3>Voluptatem dignissimos provident quasi corporis voluptates sit assum perenda sruen jonee trave</h3>
        </div>
        <div class="col-lg-6 pt-4 pt-lg-0">
          <p>
            Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
            velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
            culpa qui officia deserunt mollit anim id est laborum
          </p>
          <ul>
            <li><i class="ri-check-double-line"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequa</li>
            <li><i class="ri-check-double-line"></i> Duis aute irure dolor in reprehenderit in voluptate velit</li>
            <li><i class="ri-check-double-line"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in</li>
          </ul>
          <p class="fst-italic">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
            magna aliqua.
          </p>
        </div>
      </div>

    </div>
  </section>End About Section -->

  <!-- ======= Why Us Section ======= -->
  {{-- <section id="why-us" class="why-us">
    <div class="container">

      <div class="row">

        <div class="col-lg-4">
          <div class="box">
            <span>01</span>
            <h4>Lorem Ipsum</h4>
            <p>Ulamco laboris nisi ut aliquip ex ea commodo consequat. Et consectetur ducimus vero placeat</p>
          </div>
        </div>

        <div class="col-lg-4 mt-4 mt-lg-0">
          <div class="box">
            <span>02</span>
            <h4>Repellat Nihil</h4>
            <p>Dolorem est fugiat occaecati voluptate velit esse. Dicta veritatis dolor quod et vel dire leno para dest</p>
          </div>
        </div>

        <div class="col-lg-4 mt-4 mt-lg-0">
          <div class="box">
            <span>03</span>
            <h4> Ad ad velit qui</h4>
            <p>Molestiae officiis omnis illo asperiores. Aut dolorihero-img vitae sunt debitis quo vel nam quis</p>
          </div>
        </div>

      </div>

    </div>
  </section> --}}
  <!-- End Why Us Section -->

  <!-- ======= Counts Section ======= -->
  <section id="counts" class="counts section-bg">
    <div class="container">

      <div class="row">

        <div class="col-lg-3 col-md-6">
          <div class="count-box">
            <i class="bi bi-emoji-smile"></i>
            <span data-purecounter-start="0" data-purecounter-end="{{$peoplev}}" data-purecounter-duration="1" class="purecounter"></span>
            <p>Personas Verificadas</p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
          <div class="count-box">
            <i class="bi bi-journal-richtext"></i>
            <span data-purecounter-start="0" data-purecounter-end="{{$solicitud_pendiente}}" data-purecounter-duration="1" class="purecounter"></span>
            <p>Solicitudes de Verificacion</p>
          </div>
        </div>


        <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
          <div class="count-box">
            <i class="bi bi-headset"></i>
            <span data-purecounter-start="0" data-purecounter-end="{{$busine}}" data-purecounter-duration="1" class="purecounter"></span>
            <p>Empresas</p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
          <div class="count-box">
            <i class="bi bi-people"></i>
            <span data-purecounter-start="0" data-purecounter-end="{{$miembros}}" data-purecounter-duration="1" class="purecounter"></span>
            <p>Miembros</p>
          </div>
        </div>

      </div>

    </div>


  <!-- ======= Features Section ======= -->
  <section id="features" class="features">
    <div class="container">

      <div class="row">
        <div class="col-lg-3 col-md-4">
          <div class="icon-box">
            <i class="ri-store-line" style="color: #ffbb2c;"></i>
            <h3><a href="">Guardias</a></h3>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
          <div class="icon-box">
            <i class="ri-bar-chart-box-line" style="color: #5578ff;"></i>
            <h3><a href="">Jardineros</a></h3>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
          <div class="icon-box">
            <i class="ri-calendar-todo-line" style="color: #e80368;"></i>
            <h3><a href="">Niñeras</a></h3>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 mt-4 mt-lg-0">
          <div class="icon-box">
            <i class="ri-paint-brush-line" style="color: #e361ff;"></i>
            <h3><a href="">Pintores</a></h3>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 mt-4">
          <div class="icon-box">
            <i class="ri-database-2-line" style="color: #47aeff;"></i>
            <h3><a href="">Albañiles</a></h3>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 mt-4">
          <div class="icon-box">
            <i class="ri-gradienter-line" style="color: #ffa76e;"></i>
            <h3><a href="">Carpinteros</a></h3>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 mt-4">
          <div class="icon-box">
            <i class="ri-file-list-3-line" style="color: #11dbcf;"></i>
            <h3><a href="{{url('model-folio')}}">Modelos</a></h3>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 mt-4">
          <div class="icon-box">
            <i class="ri-price-tag-2-line" style="color: #4233ff;"></i>
            <h3><a href="">Arquitectos</a></h3>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 mt-4">
          <div class="icon-box">
            <i class="ri-anchor-line" style="color: #b2904f;"></i>
            <h3><a href="">Marketing y Publicidad</a></h3>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 mt-4">
          <div class="icon-box">
            <i class="ri-disc-line" style="color: #b20969;"></i>
            <h3><a href="">Limpieza de Piscinas</a></h3>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 mt-4">
          <div class="icon-box">
            <i class="ri-base-station-line" style="color: #ff5828;"></i>
            <h3><a href="">Mantenimiento y reparacion de A/C</a></h3>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 mt-4">
          <div class="icon-box">
            <i class="ri-fingerprint-line" style="color: #29cc61;"></i>
            <h3><a href="">Limpieza en General</a></h3>
          </div>
        </div>
      </div>

    </div>
  </section>
  <!-- End Features Section -->

  <!-- ======= Portfolio Section ======= -->
  <section id="portfolio" class="portfolio">
    <div class="container">

      <div class="row">
        <div class="col-lg-12 d-flex justify-content-center">
          <ul id="portfolio-flters">
            <li data-filter="*" class="filter-active">Todas</li>
            <li data-filter=".filter-app">Guardias</li>
            <li data-filter=".filter-card">Modelos</li>
            <li data-filter=".filter-web">Jardineros</li>
          </ul>
        </div>
      </div>

      <div class="row portfolio-container">

        <div class="col-lg-4 col-md-6 portfolio-item filter-app">
          <div class="portfolio-wrap">
            <img src="template/assets/img/portfolio/SEGURIDAD-1.jpeg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>App 1</h4>
              <p>App</p>
              <div class="portfolio-links">
                <a href="template/assets/img/portfolio/SEGURIDAD-1.jpeg" data-gallery="portfolioGallery" class="portfolio-lightbox" title="App 1"><i class="bx bx-plus"></i></a>
                {{-- <a href="template/portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a> --}}
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 portfolio-item filter-web">
          <div class="portfolio-wrap">
            <img src="template/assets/img/portfolio/JARDINERIA-2.jpeg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Web 3</h4>
              <p>Web</p>
              <div class="portfolio-links">
                <a href="template/assets/img/portfolio/JARDINERIA-2.jpeg" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Web 3"><i class="bx bx-plus"></i></a>
                {{-- <a href="template/portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a> --}}
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 portfolio-item filter-app">
          <div class="portfolio-wrap">
            <img src="template/assets/img/portfolio/SEGURIDAD-2.1.jpeg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>App 2</h4>
              <p>App</p>
              <div class="portfolio-links">
                <a href="template/assets/img/portfolio/SEGURIDAD-2.1.jpeg" data-gallery="portfolioGallery" class="portfolio-lightbox" title="App 2"><i class="bx bx-plus"></i></a>
                {{-- <a href="template/portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a> --}}
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 portfolio-item filter-card">
          <div class="portfolio-wrap">
            <img src="template/assets/img/portfolio/MODELAJE-1.jpeg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Card 2</h4>
              <p>Card</p>
              <div class="portfolio-links">
                <a href="template/assets/img/portfolio/MODELAJE-1.jpeg" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Card 2"><i class="bx bx-plus"></i></a>
                {{-- <a href="template/portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a> --}}
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 portfolio-item filter-web">
          <div class="portfolio-wrap">
            <img src="template/assets/img/portfolio/JARDINERIA-1.jpeg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Web 2</h4>
              <p>Web</p>
              <div class="portfolio-links">
                <a href="template/assets/img/portfolio/JARDINERIA-1.jpeg" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Web 2"><i class="bx bx-plus"></i></a>
                {{-- <a href="template/portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a> --}}
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 portfolio-item filter-app">
          <div class="portfolio-wrap">
            <img src="template/assets/img/portfolio/SEGURIDAD-3.1.jpeg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>App 3</h4>
              <p>App</p>
              <div class="portfolio-links">
                <a href="template/assets/img/portfolio/SEGURIDAD-3.1.jpeg" data-gallery="portfolioGallery" class="portfolio-lightbox" title="App 3"><i class="bx bx-plus"></i></a>
                {{-- <a href="template/portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a> --}}
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 portfolio-item filter-card">
          <div class="portfolio-wrap">
            <img src="template/assets/img/portfolio/MODELAJE-2.jpeg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Card 1</h4>
              <p>Card</p>
              <div class="portfolio-links">
                <a href="template/assets/img/portfolio/MODELAJE-2.jpeg" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Card 1"><i class="bx bx-plus"></i></a>
                {{-- <a href="template/portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a> --}}
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 portfolio-item filter-card">
          <div class="portfolio-wrap">
            <img src="template/assets/img/portfolio/MODELAJE-3.jpeg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Card 3</h4>
              <p>Card</p>
              <div class="portfolio-links">
                <a href="template/assets/img/portfolio/MODELAJE-3.jpeg" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Card 3"><i class="bx bx-plus"></i></a>
                {{-- <a href="template/portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a> --}}
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 portfolio-item filter-web">
          <div class="portfolio-wrap">
            <img src="template/assets/img/portfolio/JARDINERIA-3.jpeg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Web 3</h4>
              <p>Web</p>
              <div class="portfolio-links">
                <a href="template/assets/img/portfolio/JARDINERIA-3.jpeg" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Web 3"><i class="bx bx-plus"></i></a>
                {{-- <a href="template/portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a> --}}
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
  </section><!-- End Portfolio Section -->

  <!-- ======= Team Section ======= -->
  <section id="team" class="team section-bg">
    <div class="container">

      <div class="section-title">
        <h2>Referencias Top</h2>
        <p>Felicitamos y premiamos a nuestros usuarios por el espectacular y confiable trabajo que realizan y ofrecen a través de nuestra plataforma.</p>
      </div>

      <div class="row">

        <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
          <div class="member">
            <div class="member-img">
              <img src="template/assets/img/team/default.jpeg" class="img-fluid" alt="">
              <div class="social">
                <a href=""><i class="bi bi-twitter"></i></a>
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
            <div class="member-info">
              {{-- <h4>Walter White</h4> --}}
              <span>Seguridad</span>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
          <div class="member">
            <div class="member-img">
              <img src="template/assets/img/team/default.jpeg" class="img-fluid" alt="">
              <div class="social">
                <a href=""><i class="bi bi-twitter"></i></a>
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
            <div class="member-info">
              {{-- <h4>Sarah Jhonson</h4> --}}
              <span>Jardineria</span>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
          <div class="member">
            <div class="member-img">
              <img src="template/assets/img/team/default.jpeg" class="img-fluid" alt="">
              <div class="social">
                <a href=""><i class="bi bi-twitter"></i></a>
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
            <div class="member-info">
              {{-- <h4>William Anderson</h4> --}}
              <span>Limpieza de Piscinas</span>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
          <div class="member">
            <div class="member-img">
              <img src="template/assets/img/team/default.jpeg" class="img-fluid" alt="">
              <div class="social">
                <a href=""><i class="bi bi-twitter"></i></a>
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
            <div class="member-info">
              {{-- <h4>Amanda Jepson</h4> --}}
              <span>Modelaje</span>
            </div>
          </div>
        </div>

      </div>

    </div>
  </section><!-- End Team Section -->

  <!-- ======= Pricing Section ======= -->
  <section id="pricing" class="pricing">
    <div class="container">

      <div class="section-title">
        <h2>Verificación de cuenta</h2>
        <p>Verifica tu cuenta para poder acceder a los beneficios que tenemos para ofrecerte y tengas más herramientas y mejores oportunidades para poder impulsarte.</p>
      </div>

      <div class="row no-gutters">

        <div class="col-lg-4 box">
          <h3>Empleados</h3>
          <h4><span>permanente</span></h4>
          <ul>
            <li><i class="bx bx-check"></i> Verificación de cuenta</li>
            <li><i class="bx bx-check"></i> Certificación de documentación</li>
            <li><i class="bx bx-check"></i> Accede a capacitaciones sin costo adicional </li>
            <li><i class="bx bx-check"></i> Aplica a más de un trabajo al mismo tiempo </li>
            <li><i class="bx bx-check"></i> Recibe invitaciones de trabajo sin límites </li>
          </ul>
          <a href="https://trabajostop.com/register-employe" class="btn-buy">Ingresar</a>
        </div>

        <div class="col-lg-4 box featured">
          <h3>Empresas</h3>
          <h4><span>Servicios sin limites</span></h4>
          <ul>
            <li><i class="bx bx-check"></i> Accede a capacitaciones sin costo adicional</li>
            <li><i class="bx bx-check"></i> Podrás recibir invitaciones de ofertas de servicios</li>
            <li><i class="bx bx-check"></i> Busca personal de trabajo sin límites</li>
            <li><i class="bx bx-check"></i> Verificación de tu cuenta</li>
            <li><i class="bx bx-check"></i> Certificación de la documentación de la empresa</li>
          </ul>
          <a href="https://trabajostop.com/register-busine" class="btn-buy">Ingresar</a>
        </div>

        <div class="col-lg-4 box">
          <h3>Búsqueda de servicios</h3>
          <h4><span>ilimitado</span></h4>
          <ul>
            <li><i class="bx bx-check"></i> Verificación de tu cuenta</li>
            <li><i class="bx bx-check"></i> Pago seguro mediante la plataforma </li>
            <li><i class="bx bx-check"></i> Atención personalizada</li>
            <li><i class="bx bx-check"></i> Consultoria sin costo adicional</li>
            <li><i class="bx bx-check"></i> Búsqueda de servicios sin límites</li>
            <li><i class="bx bx-check"></i> Personal verificado y Confiable</li>
          </ul>
          <a href="https://trabajostop.com/register-beneficiary" class="btn-buy">Ingresar</a>
        </div>

      </div>

    </div>
  </section>
  <!-- End Pricing Section -->
  

  <!-- ======= Frequently Asked Questions Section ======= -->
  <!-- <section id="faq" class="faq">
    <div class="container">

      <div class="section-title">
        <h2>Frequently Asked Questions</h2>
      </div>

      <ul class="faq-list">

        <li>
          <div data-bs-toggle="collapse" class="collapsed question" href="#faq1">Non consectetur a erat nam at lectus urna duis? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
          <div id="faq1" class="collapse" data-bs-parent=".faq-list">
            <p>
              Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet non curabitur gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus non.
            </p>
          </div>
        </li>

        <li>
          <div data-bs-toggle="collapse" href="#faq2" class="collapsed question">Feugiat scelerisque varius morbi enim nunc faucibus a pellentesque? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
          <div id="faq2" class="collapse" data-bs-parent=".faq-list">
            <p>
              Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.
            </p>
          </div>
        </li>

        <li>
          <div data-bs-toggle="collapse" href="#faq3" class="collapsed question">Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
          <div id="faq3" class="collapse" data-bs-parent=".faq-list">
            <p>
              Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Faucibus pulvinar elementum integer enim. Sem nulla pharetra diam sit amet nisl suscipit. Rutrum tellus pellentesque eu tincidunt. Lectus urna duis convallis convallis tellus. Urna molestie at elementum eu facilisis sed odio morbi quis
            </p>
          </div>
        </li>

        <li>
          <div data-bs-toggle="collapse" href="#faq4" class="collapsed question">Ac odio tempor orci dapibus. Aliquam eleifend mi in nulla? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
          <div id="faq4" class="collapse" data-bs-parent=".faq-list">
            <p>
              Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.
            </p>
          </div>
        </li>

        <li>
          <div data-bs-toggle="collapse" href="#faq5" class="collapsed question">Tempus quam pellentesque nec nam aliquam sem et tortor consequat? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
          <div id="faq5" class="collapse" data-bs-parent=".faq-list">
            <p>
              Molestie a iaculis at erat pellentesque adipiscing commodo. Dignissim suspendisse in est ante in. Nunc vel risus commodo viverra maecenas accumsan. Sit amet nisl suscipit adipiscing bibendum est. Purus gravida quis blandit turpis cursus in
            </p>
          </div>
        </li>

        <li>
          <div data-bs-toggle="collapse" href="#faq6" class="collapsed question">Tortor vitae purus faucibus ornare. Varius vel pharetra vel turpis nunc eget lorem dolor? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
          <div id="faq6" class="collapse" data-bs-parent=".faq-list">
            <p>
              Laoreet sit amet cursus sit amet dictum sit amet justo. Mauris vitae ultricies leo integer malesuada nunc vel. Tincidunt eget nullam non nisi est sit amet. Turpis nunc eget lorem dolor sed. Ut venenatis tellus in metus vulputate eu scelerisque. Pellentesque diam volutpat commodo sed egestas egestas fringilla phasellus faucibus. Nibh tellus molestie nunc non blandit massa enim nec.
            </p>
          </div>
        </li>

      </ul>

    </div>
  </section>End Frequently Asked Questions Section -->

  <!-- ======= Contact Section ======= -->
  <section id="contact" class="contact section-bg">
    <div class="container">

      <div class="section-title">
        <h2>Contactenos</h2>
        <p>Si quieres representarnos en otra ciudad o tienes  alguna sugerencia, solicitud o si quieres incluir tu rubro, servicio o emprendimiento no dudes en ponerte en contacto con nosotros.</p>
      </div>

      <div class="row">

        <div class="col-lg-6">

          <div class="row">
            <div class="col-md-12">
              <div class="info-box">
                <i class="bx bx-map"></i>
                <h3>Nuestra Direccion</h3>
                <p>Calle Gral. Davo Terrazas #3340</p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="info-box mt-4">
                <i class="bx bx-envelope"></i>
                <h3>Email Us</h3>
                <p>trabajostopContacto@gmail.com<br></p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="info-box mt-4">
                <i class="bx bx-phone-call"></i>
                <h3>Telefono</h3>
                <p>+591 78128183<br></p>
              </div>
            </div>
          </div>

        </div>

        <div class="col-lg-6 mt-4 mt-lg-0">
          <form action="forms/contact.php" method="post" role="form" class="php-email-form">
            <div class="row">
              <div class="col-md-6 form-group">
                <input type="text" name="name" class="form-control" id="name" placeholder="Tu nombre" required>
              </div>
              <div class="col-md-6 form-group mt-3 mt-md-0">
                <input type="email" class="form-control" name="email" id="email" placeholder="Tu Email" required>
              </div>
            </div>
            <div class="form-group mt-3">
              <input type="text" class="form-control" name="subject" id="subject" placeholder="Titulo" required>
            </div>
            <div class="form-group mt-3">
              <textarea class="form-control" name="message" rows="5" placeholder="Mensaje" required></textarea>
            </div>
            <div class="my-3">
              <div class="loading">Enviando</div>
              <div class="error-message"></div>
              <div class="sent-message">Tu mensaje ha sido Enviado!</div>
            </div>
            <div class="text-center"><button type="submit">Enviar mensaje</button></div>
          </form>
        </div>

      </div>

    </div>
  </section><!-- End Contact Section -->

</main>
<!-- End #main -->
@endsection