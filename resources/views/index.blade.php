<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>eDow-Learn</title>
  <link rel="icon" href="img/favicon.png" />
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <!-- animate CSS -->
  <link rel="stylesheet" href="css/animate.css" />
  <!-- owl carousel CSS -->
  <link rel="stylesheet" href="css/owl.carousel.min.css" />
  <!-- themify CSS -->
  <link rel="stylesheet" href="css/themify-icons.css" />
  <!-- flaticon CSS -->
  <link rel="stylesheet" href="css/flaticon.css" />
  <!-- font awesome CSS -->
  <link rel="stylesheet" href="css/magnific-popup.css" />
  <!-- swiper CSS -->
  <link rel="stylesheet" href="css/slick.css" />
  <!-- style CSS -->
  <link rel="stylesheet" href="css/style.css" />
</head>

<body>
  <!--::header part start:: Containing Nav Bar Here-->
  <header class="main_menu home_menu">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-12">
          <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="/">
              <img src="img/logo.png" alt="eDow Learn" style="width:50px; height:50px"/>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            @if (Route::has('login'))
                <div class="collapse navbar-collapse main-menu-item justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav align-items-center">
                @auth
                    <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/home') }}">Home</a>
                    </li>
                @else
                    <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="d-none d-lg-block">
                        <a class="btn_1" href="{{ route('register') }}">Sign Up</a>
                        </li>
                    @endif
                @endif
                </ul>
                </div>
            @endif
          </nav>
        </div>
      </div>
    </div>
  </header>
  <!-- Header part end-->

  <!-- banner part start-->
  <section class="banner_part">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 col-xl-6">
          <div class="banner_text">
            <div class="banner_text_iner">
              <h1>Start Learning with eDow Learn</h1>
              <p>eDow Learn, An Integrated Platform to connect tutors and students.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- banner part start-->


  <!-- feature_part start-->
  <section class="feature_part">
    <div class="container">
      <div class="row">
        <div class="col-sm-7 col-xl-3 align-self-center">
          <div class="single_feature_text ">
            <h2>Find Your Medium</h2>
            <p>We have courses under different medium so select your medium and enjoy our courses.</p>
          </div>
        </div>
        <div class="col-sm-6 col-xl-3">
          <div class="single_feature">
            <div class="single_feature_part">
              <span class="single_feature_icon"><i class="ti-layers"></i></span>
              <h4><b>বাংলা মাধ্যম</b></h4>
              <p>বাংলা মাধ্যমের শিক্ষার্থীদের </p>
              <P> জন্য।
              </p>
              <a href="#" class="btn_1">View Course </a>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-xl-3">
          <div class="single_feature">
            <div class="single_feature_part">
              <span class="single_feature_icon"><i class="ti-new-window"></i></span>
              <h4><b>English Version</b></h4>
              <p>For the students of English Version.</p>
              <a href="#" class="btn_1">View Course </a>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-xl-3">
          <div class="single_feature">
            <div class="single_feature_part single_feature_part_2">
              <span class="single_service_icon style_icon"><i class="ti-light-bulb"></i></span>
              <h4><b>English Medium</b></h4>
              <p>For the students of English Medium.</p>
              <a href="#" class="btn_1">View Course </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!--::blog_part start::-->
  <section class="blog_part section_padding">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xl-5">
          <div class="section_tittle text-center">
            <H2>Why eDow-Learn?</H2>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6 col-lg-4 col-xl-4">
          <div class="single-home-blog">
            <div class="card">
              <img src="img/learning.svg" class="card-img-top" alt="blog" />
              <div class="card-body">
                <h5 class="card-title">Customized Learning</h5>
                <p>
                  Choose from over 10,000 teachers for 1-on-1 lessons based on
                  your goals and interests.
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-4 col-xl-4">
          <div class="single-home-blog">
            <div class="card">
              <img src="img/lesson.svg" class="card-img-top" alt="blog" />
              <div class="card-body">
                <h5 class="card-title">Pay Per Lesson</h5>
                <p>
                  On italki you only pay per lesson and at the price that
                  meets your budget
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-4 col-xl-4">
          <div class="single-home-blog">
            <div class="card">
              <img src="img/anytime.svg" class="card-img-top" alt="blog" />
              <div class="card-body">
                <h5 class="card-title">Anytime, Anywhere</h5>
                <p>
                  Take online lessons at the time and place that suits you.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--::blog_part end::-->

  <!--::review_part start::-->
  <section class="special_cource padding_top">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xl-5">
          <div class="section_tittle text-center">
            <h2>How does eDow-Learn work?</h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6 col-lg-4">
          <div class="single_special_cource">
            <img src="img/special_cource_1.png" class="special_img" alt="">
            <div class="special_cource_text">
              <h3>1. Post your Requrements</h3></a>
              <p>Which whose darkness saying were life unto fish wherein all fish of together called</p>
            </div>

          </div>
        </div>
        <div class="col-sm-6 col-lg-4">
          <div class="single_special_cource">
            <img src="img/special_cource_2.png" class="special_img" alt="">
            <div class="special_cource_text">
              <h3>2. Choose your Teacher </h3></a>
              <p>Which whose darkness saying were life unto fish wherein all fish of together called</p>

            </div>

          </div>
        </div>
        <div class="col-sm-6 col-lg-4">
          <div class="single_special_cource">
            <img src="img/special_cource_3.png" class="special_img" alt="">
            <div class="special_cource_text">

              <a href="course-details.html">
                <h3>3. Book Your Lesson</h3>
              </a>
              <p>Which whose darkness saying were life unto fish wherein all fish of together called</p>
            </div>
          </div>
        </div>
  </section>
  <!--::blog_part end::-->

  <!-- footer part start-->
  <footer class="footer-area">
    <div class="container">
      <div class="row justify-content-between">
        <div class="col-sm-6 col-md-4 col-xl-3">
          <div class="single-footer-widget footer_1">
            <p>Learning has no bounderies.ones you learn you can teach everyone. So learn and teach everyone </p>
          </div>
        </div>
        <div class="col-sm-6 col-md-4 col-xl-4">
          <div class="single-footer-widget footer_2">
            <h4>Newsletter</h4>
            <p>Stay updated with our latest trends Seed heaven so said place winged over given forth fruit.
            </p>
            <form action="#">
              <div class="form-group">
                <div class="input-group mb-3">
                  <input type="text" class="form-control" placeholder='Enter email address'
                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'">
                  <div class="input-group-append">
                    <button class="btn btn_1" type="button"><i class="ti-angle-right"></i></button>
                  </div>
                </div>
              </div>
            </form>
            <div class="social_icon">
              <a href="#"> <i class="ti-facebook"></i> </a>
              <a href="#"> <i class="ti-twitter-alt"></i> </a>
              <a href="#"> <i class="ti-instagram"></i> </a>
              <a href="#"> <i class="ti-skype"></i> </a>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-md-4">
          <div class="single-footer-widget footer_2">
            <h4>Contact us</h4>
            <div class="contact_info">
              <p><span> Address :</span> Anywhere you want to meet ;) </p>
              <p><span> Phone :</span> 8881212</p>
              <p><span> Email : </span> Not created yet </p>
            </div>
          </div>
        </div>
      </div>

    </div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="copyright_part_text text-center">
            <div class="row">
              <div class="col-lg-12">
                <p class="footer-text m-0">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- footer part end-->


  <!-- jquery plugins here-->
  <!-- jquery -->
  <script src="js/jquery-1.12.1.min.js"></script>
  <!-- popper js -->
  <script src="js/popper.min.js"></script>
  <!-- bootstrap js -->
  <script src="js/bootstrap.min.js"></script>
  <!-- easing js -->
  <script src="js/jquery.magnific-popup.js"></script>
  <!-- swiper js -->
  <script src="js/swiper.min.js"></script>
  <!-- swiper js -->
  <script src="js/masonry.pkgd.js"></script>
  <!-- particles js -->
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.nice-select.min.js"></script>
  <!-- swiper js -->
  <script src="js/slick.min.js"></script>
  <script src="js/jquery.counterup.min.js"></script>
  <script src="js/waypoints.min.js"></script>
  <!-- custom js -->
  <script src="js/custom.js"></script>
</body>

</html>