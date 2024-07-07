<x-root-base :root="true">
  <!-- ======= About Section ======= -->
  <section id="about">
    <div class="container" data-aos="fade-up">
      <div class="row">
        <div class="col-md-12">
          <h3 class="section-title">A propos de nous</h3>
          <div class="section-title-divider"></div>
          <p class="section-description">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam</p>
        </div>
      </div>
    </div>
    <div class="container about-container" data-aos="fade-up" data-aos-delay="200">
      <div class="row">

        <div class="col-lg-6 about-img">
          <img src="{{asset('images/about-img.jpg')}}" alt="">
        </div>

        <div class="col-md-6 about-content">
          <h2 class="about-title">We provide great services and ideass</h2>
          <p class="about-text">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
            in reprehenderit in voluptate
          </p>
          <p class="about-text">
            Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim
            id est laborum
          </p>
          <p class="about-text">
            Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt molli.
          </p>
        </div>
      </div>
    </div>
  </section><!-- End About Section -->


  <!-- ======= Contact Section ======= -->
  <section id="contact">
    <div class="container" data-aos="fade-up">
      <div class="row">
        <div class="col-md-12">
          <h3 class="section-title">Contactez nous </h3>
          <div class="section-title-divider"></div>
          <p class="section-description">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque</p>
        </div>
      </div>

      <div class="row justify-content-center">
        <div class="col-lg-3 col-md-4">
          <div class="info">
            <div>
              <i class="bi bi-geo-alt"></i>
              <p>Belle ville<br>Bobo dioulasso</p>
            </div>

            <div>
              <i class="bi bi-envelope"></i>
              <p>boolkevin2@gmail.com</p>
            </div>

            <div>
              <i class="bi bi-phone"></i>
              <p>+226 65969869</p>
            </div>

          </div>
        </div>

        <div class="col-lg-5 col-md-8">
          <div class="form">
            <form action="#" method="post" role="form" class="php-email-form">
              <div class="form-group">
                <input type="text" name="name" class="form-control" id="name" placeholder="nom et prenom" required>
              </div>
              <div class="form-group mt-3">
                <input type="email" class="form-control" name="email" id="email" placeholder="email" required>
              </div>
              <div class="form-group mt-3">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="objet" required>
              </div>
              <div class="form-group mt-3">
                <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
              </div>
              <div class="text-center"><button type="submit">Send Message</button></div>
            </form>
          </div>
        </div>

      </div>
    </div>
  </section><!-- End Contact Section -->
</x-root-base>