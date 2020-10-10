<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Municipalidad de Nacimiento - Bienvenid@s</title>
  <meta content="" name="descriptison">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Raleway:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i,900" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/icofont/icofont.min.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/animate.css/animate.min.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/venobox/venobox.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/owl.carousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/aos/aos.css')}}" rel="stylesheet">

  <!-- CSS File -->
  <link href="{{ asset('assets/css/style.css')}}" rel="stylesheet">

  @stack('scriptsCSS')

</head>

<body>

  <!-- ======= Top Bar ======= -->
  <section id="topbar" class="d-none d-lg-block">
    <div class="container clearfix">
      <div class="contact-info float-left">
        <i class="icofont-envelope"></i><a href="mailto:contact@example.com">oirs@nacimiento.cl</a>
        <i class="icofont-phone"></i> <a href="#">(43) 2404601</a>
      </div>
      <div class="social-links float-right">
        <a href="https://twitter.com/muninacto" class="twitter" data-placement="bottom" title="Twitter Municipal" target="_blank"><i class="icofont-twitter"></i></a>
        <a href="https://www.facebook.com/MunicipalidadDeNacimiento" class="facebook" data-placement="bottom" title="Facebook Municipal" target="_blank"><i class="icofont-facebook"></i></a>
        <a href="https://www.instagram.com/muninacto/" class="instagram" data-placement="bottom" title="Instagram Municipal" target="_blank"><i class="icofont-instagram"></i></a> / 
        <a href="https://www.portaltransparencia.cl/PortalPdT/pdtta/-/ta/MU178" target="_blank"><i class="icofont-search-document"></i> Transparencia Activa</a>
        <a href="https://www.leylobby.gob.cl/instituciones/mu178" target="_blank"><i class="icofont-search-user"></i></i> Ley de Lobby</a>
        <a href="https://www.portaltransparencia.cl/PortalPdT/ingreso-sai-v2?idOrg=613" target="_blank"><i class="icofont-pen-alt-2"></i> Solicitud de Información</a> /
        <a href="#"><i class="icofont-car-alt-1"></i> P.C.V.</a>

      </div>
    </div>
  </section>

  <!-- ======= Header ======= -->
  <header id="header">
    <div class="container">

      <div class="logo float-left">
        <a href="index.html"><img src="assets/img/LogoMunicipal.png" alt="" ></a>
      </div>

    	<nav class="nav-menu float-right d-none d-lg-block">
        
        	<ul>
              <li class="active"><a href="{{ route('permissions.index') }}"><i class="icofont-home"></i> Inicio</a></li>
	          	<li><a href="#"><i class="icofont-google-map"></i> Comuna</a></li>
	          	<li><a href="#"><i class="icofont-institution"></i> Municipalidad</a></li>
	          	<li><a href="#"> <i class="icofont-people"></i> Concejo Municipal</a></li>
	          	<li><a href="{{ route('noticias.index') }}"><i class="icofont-newspaper"></i> Sala de Prensa</a></li>
              <li><a href="{{ route('login') }}"><i class="icofont-lock"></i> Intranet</a></li>
	        
	        </ul>

	    </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->

	<main class="py-4">
    
        @yield('content')
    
    </main>

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-info">
            <h3>Municipalidad de Nacimiento</h3>
            <p>
              Calle Freire #614 <br>
              <br>
              <strong>Teléfono:</strong> (43) 2404601 <br>
              <strong>Email:</strong> oirs@nacimiento.cl<br>
            </p>
            <div class="social-links mt-3">
              <a href="https://twitter.com/muninacto" class="twitter" data-placement="bottom" title="Twitter Municipal" target="_blank"><i class="bx bxl-twitter"></i></a>
              <a href="https://www.facebook.com/MunicipalidadDeNacimiento" data-placement="bottom" title="Facebook Municipal" target="_blank" class="facebook"><i class="bx bxl-facebook"></i></a>
              <a href="https://www.instagram.com/muninacto/" data-placement="bottom" title="Instagram Municipal" target="_blank" class="instagram"><i class="bx bxl-instagram"></i></a>
            </div>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Menú Principal</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Inicio</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Comuna</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Municipalidad</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Concejo Municipal</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Sala de Prensa</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Nuestros Servicios (otro Menú)</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Menú 1</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Menú 2</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Menú 3</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Menú 4</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Menú 5</a></li>
            </ul>
          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Municipalidad de Nacimiento</span></strong>. Todos los Derechos son Reservados
      </div>
      <div class="credits">

      <i class="icofont-terminal px-1" style="font-size: 1.5em;"></i><small style="font-size: 1em;">Desarrollado por Unidad de Informática Municipal</small>
      
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ asset('assets/vendor/jquery.easing/jquery.easing.min.js')}}"></script>
  <script src="{{ asset('assets/vendor/php-email-form/validate.js')}}"></script>
  <script src="{{ asset('assets/vendor/jquery-sticky/jquery.sticky.js')}}"></script>
  <script src="{{ asset('assets/vendor/venobox/venobox.min.js')}}"></script>
  <script src="{{ asset('assets/vendor/waypoints/jquery.waypoints.min.js')}}"></script>
  <script src="{{ asset('assets/vendor/counterup/counterup.min.js')}}"></script>
  <script src="{{ asset('assets/vendor/owl.carousel/owl.carousel.min.js')}}"></script>
  <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
  <script src="{{ asset('assets/vendor/aos/aos.js')}}"></script>

  <!-- Main JS File -->
  <script src="{{ asset('assets/js/main.js')}}"></script>

</body>

</html>