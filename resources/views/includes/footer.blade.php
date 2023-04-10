  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>OnLearning</h3>
            <p>
              Goma <br>
              Nord Kivu, NY 535022<br>
              Congo DR <br><br>
              <strong>Phone:</strong>+243 976 742 676<br>
              <strong>Email:</strong> mlysiasnathan@gmail.com<br>
            </p>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="{{ route("home") }}#hero">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{ route("home") }}#about">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{ route("home") }}#services">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{ route("home") }}#team">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{ route("home") }}#hero">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Caterories</h4>
            <ul>
              @forelse (App\Models\LessonCategory::all() as $category)
                <li><i class="bx bx-chevron-right"></i> <a href="{{ route('category.show', ['cat_name' => $category->cat_name]) }}">{{ $category->cat_name }}</a></li>
              @empty
                <span>Not yet added !</span> 
              @endforelse
            </ul>
          </div>

          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>Join Our Newsletter</h4>
            <p>Found where you can share your ideas, suggestions or blames with us</p>
            <form action="" method="post">
              <input type="email" name="email">
              <input type="submit" value="Subscribe">
            </form>
          </div>

        </div>
      </div>
    </div>

    <div class="container d-md-flex py-4">

      <div class="me-md-auto text-center text-md-start">
        <div class="copyright">
          &copy; Copyright <strong><span>OnLearning</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
          <!-- All the links in the footer should remain intact. -->
          <!-- You can delete the links only if you purchased the pro version. -->
          <!-- Licensing information: https://bootstrapmade.com/license/ -->
          <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/resi-free-bootstrap-html-template/ -->
          Designed by <a href="https://bootstrapmade.com/">LysNBrain</a>
        </div>
      </div>
      <div class="social-links text-center text-md-right pt-3 pt-md-0">
        <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
        <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
        <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
        <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
      </div>
    </div>
  </footer><!-- End Footer -->