@extends('layouts.web')

@section('content')

<!-- ======= Carousel Section ======= -->
  <section id="hero">
    <div class="hero-container">
      <div id="heroCarousel" class="carousel slide carousel-fade" data-ride="carousel">

        <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

        <div class="carousel-inner" role="listbox">

          <!-- Slide 1 -->
          <div class="carousel-item active" style="background-image: url('{{asset('images/Covid.png')}}');">
            <div class="carousel-container">
              <div class="carousel-content container">
                <h2 class="animate__animated animate__fadeInDown">#CuidemonosEntreTodos</h2>
                <p class="animate__animated animate__fadeInUp"></p>
                <a href="#" class="btn-get-started animate__animated animate__fadeInUp scrollto">Leer Más</a>
              </div>
            </div>
          </div>

          <!-- Slide 2 -->
          <div class="carousel-item" style="background-image: url('{{asset('images/Plebicito.png')}}');">
            <div class="carousel-container">
              <div class="carousel-content container">
                <h2 class="animate__animated animate__fadeInDown">Plebicito Nacional</h2>
                <p class="animate__animated animate__fadeInUp"></p>
                <a href="#" class="btn-get-started animate__animated animate__fadeInUp scrollto">Leer más</a>
              </div>
            </div>
          </div>

          <!-- Slide 3 -->
          <div class="carousel-item" style="background-image: url('assets/img/slide/slide-3.jpg');">
            <div class="carousel-container">
              <div class="carousel-content container">
                <h2 class="animate__animated animate__fadeInDown">Sequi ea ut et est quaerat</h2>
                <p class="animate__animated animate__fadeInUp">Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel. Minus et tempore modi architecto.</p>
                <a href="#" class="btn-get-started animate__animated animate__fadeInUp scrollto">Leer más</a>
              </div>
            </div>
          </div>

        </div>

        <a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon icofont-rounded-left" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next">
          <span class="carousel-control-next-icon icofont-rounded-right" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>

      </div>
    </div>
  </section><!-- End Carousel Section -->


  <!-- ======= Sección Noticias ======= -->
    <section class="p-5">
      <div data-aos="fade-up" data-aos-delay="100">
        <div class="section-title">
          <h2>Últimas Noticias</h2>
          <p class="text-muted text-center">{{ $dateCarbon }}</p>
          
        </div>
        @foreach($posts->chunk(4) as $chunk)
          <div class="row mb-3">
            @foreach($chunk as $post)
              <div class="col-md-3">
                <div class="card">
                  <div class="card-body">
                    <div class="portfolio">
                      <div class="portfolio-wrap mb-3">
                        @if($post->file)
                          <img src="{{ $post->file }}" class="img-fluid rounded-lg">
                        @endif
                      </div>
                      <h5><strong>{{ Illuminate\Support\Str::limit($post->name, 50) }}</strong></h5>
                      <blockquote class="blockquote mb-3">
                        <footer class="blockquote-footer">{{ Illuminate\Support\Str::limit($post->excerpt, 200) }}</footer>  
                      </blockquote>
                      <a href="{{ route('noticias.show', $post->slug) }}" class="btn btn-success btn-sm"><i class="icofont-thin-double-right"></i> Leer más</a>    
                    </div>  
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        @endforeach
        <div class="text-center">
          <a href="{{ route('noticias.index') }}" class="btn btn-success"><i class="icofont-newspaper h5"></i> Acceder a Sala de Prensa</a>          
        </div>
      </div>
    </section><!-- Fin Seccion Noticias -->

    <!-- ======= Section Redes Sociales ======= -->
    <section class="p-5" style="background-image: url('{{asset('images/RedesSociales.png')}}');background-size: cover;">
      <div data-aos="fade-up" data-aos-delay="100">
        <div class="text-white text-center mb-5">
          <h2>Redes Sociales</h2>
          <p></p>
        </div>
          <div class="row">
            <div class="col-md-4">
              <p><iframe width="405" height="280" src="https://www.youtube.com/embed/dmdNWGJ6hAU" frameborder="0" allowfullscreen></iframe></p>    
              <p>
                <iframe width="200" height="auto" src="https://www.youtube.com/embed/6YOxkRqNf54" frameborder="0" allowfullscreen></iframe>
                <iframe width="200" height="auto" src="https://www.youtube.com/embed/SFtBWzqkpXg" frameborder="0" allowfullscreen></iframe>
              </p>

            </div>
            <div class="col-md-4">
              <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FMunicipalidadDeNacimiento&tabs=timeline&width=500&height=500&small_header=true&adapt_container_width=true&hide_cover=true&show_facepile=false&appId=510189959140161" width="500" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>        
            </div>
            <div class="col-md-4">
              
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Section -->
  @endsection 