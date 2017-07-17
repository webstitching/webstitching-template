<?php
include 'includes/quoteprocess.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Web Stitching</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Facebook Opengraph integration: https://developers.facebook.com/docs/sharing/opengraph -->
  <meta property="og:title" content="">
  <meta property="og:image" content="">
  <meta property="og:url" content="">
  <meta property="og:site_name" content="">
  <meta property="og:description" content="">

  <!-- Twitter Cards integration: https://dev.twitter.com/cards/  -->
  <meta name="twitter:card" content="summary">
  <meta name="twitter:site" content="">
  <meta name="twitter:title" content="">
  <meta name="twitter:description" content="">
  <meta name="twitter:image" content="">

  <!-- Place your favicon.ico and apple-touch-icon.png in the template root directory -->
  <link rel="shortcut icon" href="favicon/favicon.ico" type="image/x-icon" />
 <link rel="apple-touch-icon" href="favicon/apple-touch-icon.png" />
 <link rel="apple-touch-icon" sizes="57x57" href="favicon/apple-touch-icon-57x57.png" />
 <link rel="apple-touch-icon" sizes="72x72" href="favicon/apple-touch-icon-72x72.png" />
 <link rel="apple-touch-icon" sizes="76x76" href="favicon/apple-touch-icon-76x76.png" />
 <link rel="apple-touch-icon" sizes="114x114" href="favicon/apple-touch-icon-114x114.png" />
 <link rel="apple-touch-icon" sizes="120x120" href="favicon/apple-touch-icon-120x120.png" />
 <link rel="apple-touch-icon" sizes="144x144" href="favicon/apple-touch-icon-144x144.png" />
 <link rel="apple-touch-icon" sizes="152x152" href="favicon/apple-touch-icon-152x152.png" />
 <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon-180x180.png" />

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="css/style.css" rel="stylesheet">

  <script src="lib/jquery/jquery.min.js"></script>
  <script type="text/javascript" src="js/jquery.js"></script>
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.js"></script> -->
  <script type="text/javascript" src="js/maskinput.js"></script>
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
  <script type="text/javascript" src="js/contactvalidation.js"></script>
  <script type="text/javascript" src="js/quotevalidation.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <script>
  function _(id){ return document.getElementById(id); }
  function submitForm(){
    _("mybtn").disabled = true;
    _("status").innerHTML = 'please wait ...';
    var formdata = new FormData();
    formdata.append( "fullname", _("fullname").value );
    formdata.append( "emailaddress", _("emailaddress").value );
    formdata.append( "messagebody", _("messagebody").value );
    formdata.append( "g-recaptcha-response", _("g-recaptcha-response").value );
    var ajax = new XMLHttpRequest();
    ajax.open( "POST", "includes/contactprocess.php" );
    ajax.onreadystatechange = function() {
      if(ajax.readyState == 4 && ajax.status == 200) {
        if(ajax.responseText == "success"){
          _("contact_form").innerHTML = '<h3>Thanks '+_("name").value+', your message has been sent.</h3>';
        } else {
          _("status").innerHTML = ajax.responseText;
          _("mybtn").disabled = false;
          _("contact_form").reset();
        }
      }
    }
    ajax.send( formdata );
  }
  </script>

  <style>
    .error {
      color: #a03131;
    }
  </style>
</head>

<body>
  <?php include_once("includes/analyticstracking.php") ?>
  <div id="preloader"></div>
  <!--==========================
    Modal
  ============================-->
  <div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="exampleModalLabel">Request A Quote</h4>
        </div>

        <div class="modal-body">
          <form id="quote_form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" novalidate="novalidate">
            <?php
              if($sent === true) {
                echo "<h4 class='success'>Thanks, your message has been sent successfuly!</h4>";
              } elseif($hasError === true) {
                echo '<ul class="errorlist">';
                foreach ($errorArray as $key => $val) {
                  echo "<li>" . ucfirst($key) . " field error - $val</li>";
                }
                echo '</ul>';
              }
             ?>
            <div class="form-group">
              <div class="row">
                <div class="col-sm-6">
                  <label for="first name" class="control-label">First Name:<i style="color:#ff0022;">&ast;</i></label>
                  <input type="text" class="form-control" name="firstname" id="firstname">
                </div>
                <div class="col-sm-6">
                  <label for="last name" class="control-label">Last Name:<i style="color:#ff0022;">&ast;</i></label>
                  <input type="text" class="form-control" name="lastname" id="lastname">
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <label for="company name" class="control-label">Company Name:</label>
                  <input type="text" class="form-control" id="company">
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <label for="email" class="control-label">Email:<i style="color:#ff0022;">&ast;</i></label>
                  <input type="email" class="form-control" name="email" id="email">
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <label for="phone" class="control-label">Phone number:</label>
                  <input id="phone" type="text" class="form-control"/>
                </div>
                <div class="col-sm-6">
                  <label for="website" class="control-label">Website:</label>
                  <input type="text" class="form-control" id="website" placeholder="http://">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="details" class="control-label">Tell us about your project:<i style="color:#ff0022;">&ast;</i></label>
              <textarea class="form-control" name="details" id="details" rows="7"></textarea>
            </div>

        </div>

        <div class="modal-footer">
          <span id="success_message" class="text-success"></span>
          <span id="error_message" class="text-danger"></span>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <input type="button" name="submit_quote" id="submit_quote" class="btn btn-primary" value="Send Request" />
        </div>
        </form>
      </div>
    </div>
  </div>
<!--==========================
  Hero Section
============================-->
  <section id="hero">
    <div class="hero-container">
      <div class="wow fadeIn">
        <div class="hero-logo">
          <!-- <object>
            <embed src="img/weblogo.svg" >
          </object> -->

          <img class="" src="image/weblogo.png"  alt="webStitching">
        </div>

        <h2>We tailor <span class="rotating">beautiful designs, functional websites, wire framing mobile apps</span></h2>
        <div class="actions">
          <a href="#about" class="btn-get-started">Get Strated</a>
          <a href="#services" class="btn-services">Our Services</a>
        </div>
      </div>
    </div>
  </section>

<!--==========================
  Header Section
============================-->
  <header id="header">
    <div class="container">

      <div id="logo" class="pull-left">
        <a href="#hero"><img src="image/logo.png" alt="" title="" /></a>
        <!-- Uncomment below if you prefer to use a text image -->
        <!--<h1><a href="#hero">Header 1</a></h1>-->
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <!-- <li class="menu-active"><a href="#hero">Home</a></li> -->
          <li><a href="#about">About Us</a></li>
          <li><a href="#services">Services</a></li>
          <li class="menu-has-children"><a href="#templates">Templates</a>
            <ul>
              <li><a href="#desktop">Desktop</a></li>
              <li><a href="#mobile">Mobile</a></li>
            </ul>
          </li>
          <li><a href="#portfolio">Portfolio</a></li>
          <li><a href="#contact">Contact Us</a></li>
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- #header -->

<!--==========================
  About Section
============================-->
  <section id="about">
    <div class="container wow fadeInUp">
      <div class="row">
        <div class="col-md-12">
          <h3 class="section-title">About Us</h3>
          <div class="section-title-divider"></div>
          <p class="section-description">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam</p>
        </div>
      </div>
    </div>
    <div class="container about-container wow fadeInUp">
      <div class="row">
        <div class="col-md-6 col-md-push-6 about-content">
          <h2 class="about-title">We provide great services and ideass</h2>
          <p class="about-text">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
          </p>
          <p class="about-text">
            Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum
          </p>
          <p class="about-text">
            Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum
          </p>
        </div>
      </div>
    </div>
  </section>

<!--==========================
  Services Section
============================-->
  <section id="services">
    <div class="container wow fadeInUp">
      <div class="row">
        <div class="col-md-12">
          <h3 class="section-title">Our Services</h3>
          <div class="section-title-divider"></div>
          <p class="section-description">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium</p>
        </div>
      </div>

      <div class="row">
        <div class="col-md-4 service-item">
          <div class="service-icon"><i class="fa fa-desktop"></i></div>
          <h4 class="service-title"><a href="">CMS development</a></h4>
          <p class="service-description">Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident</p>
        </div>
        <div class="col-md-4 service-item">
          <div class="service-icon"><i class="fa fa-window-restore"></i></div>
          <h4 class="service-title"><a href="">Responsive Design</a></h4>
          <p class="service-description">Minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat tarad limino ata</p>
        </div>
        <div class="col-md-4 service-item">
          <div class="service-icon"><i class="fa fa-shopping-cart "></i></div>
          <h4 class="service-title"><a href="">E-Commerce</a></h4>
          <p class="service-description">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur</p>
        </div>
        <div class="col-md-4 service-item">
          <div class="service-icon"><i class="fa fa-picture-o "></i></div>
          <h4 class="service-title"><a href="">Graphic Manipulation</a></h4>
          <p class="service-description">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
        </div>
        <div class="col-md-4 service-item">
          <div class="service-icon"><i class="fa fa-pencil-square-o"></i></div>
          <h4 class="service-title"><a href="">Wire Framing</a></h4>
          <p class="service-description">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque</p>
        </div>
        <div class="col-md-4 service-item">
          <div class="service-icon"><i class="fa fa-server"></i></div>
          <h4 class="service-title"><a href="">Web Hosting</a></h4>
          <p class="service-description">Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi</p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="quote">
              <button type="button" class="btn btn-primary" id="quote"
                data-toggle="modal" data-target="#exampleModal"
                data-whatever="@mdo">Request a quote
              </button>
          </div>

              <!-- <a href="#" class="btn btn-primary btn-lg">Request a quote</a> -->
        </div>
      </div>
    </div>
  </section>

<!--========================
    Templates Section
  ===========================-->
  <!--<section id="templates">
    <div class="container wow fadeInUp">
        <div class="row">
          <div class="col-md-12">
            <h3 class="section-title">Templates</h3>
            <div class="section-title-divider"></div>
            <p class="section-description">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium</p>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
              <h4 id="desktop">Desktop</h2>
          </div>
          <div class="col-md-6">
              <h4 id="mobile">Mobile</h2>
          </div>
        </div>
    </div>
  </section>-->
<!--==========================
  Porfolio Section
============================-->
  <section id="portfolio">
    <div class="container wow fadeInUp">
      <div class="row">
        <div class="col-md-12">
          <h3 class="section-title">Portfolio</h3>
          <div class="section-title-divider"></div>
          <p class="section-description">Si stante, hoc natura videlicet vult, salvam esse se, quod concedimus ses haec dicturum fuisse</p>
        </div>
      </div>

      <div class="row">
        <div class="col-md-3">
          <a class="portfolio-item" style="background-image: url(image/portfolio-1.jpg);" href="">
            <div class="details">
              <h4>Portfolio 1</h4>
              <span>Alored dono par</span>
            </div>
          </a>
        </div>

        <div class="col-md-3">
          <a class="portfolio-item" style="background-image: url(image/portfolio-2.jpg);" href="">
            <div class="details">
              <h4>Portfolio 2</h4>
              <span>Alored dono par</span>
            </div>
          </a>
        </div>

        <div class="col-md-3">
          <a class="portfolio-item" style="background-image: url(image/portfolio-3.jpg);" href="">
            <div class="details">
              <h4>Portfolio 3</h4>
              <span>Alored dono par</span>
            </div>
          </a>
        </div>

        <div class="col-md-3">
          <a class="portfolio-item" style="background-image: url(image/portfolio-4.jpg);" href="">
            <div class="details">
              <h4>Portfolio 4</h4>
              <span>Alored dono par</span>
            </div>
          </a>
        </div>

        <div class="col-md-3">
          <a class="portfolio-item" style="background-image: url(image/portfolio-5.jpg);" href="">
            <div class="details">
              <h4>Portfolio 5</h4>
              <span>Alored dono par</span>
            </div>
          </a>
        </div>

        <div class="col-md-3">
          <a class="portfolio-item" style="background-image: url(image/portfolio-6.jpg);" href="">
            <div class="details">
              <h4>Portfolio 6</h4>
              <span>Alored dono par</span>
            </div>
          </a>
        </div>

        <div class="col-md-3">
          <a class="portfolio-item" style="background-image: url(image/portfolio-7.jpg);" href="">
            <div class="details">
              <h4>Portfolio 7</h4>
              <span>Alored dono par</span>
            </div>
          </a>
        </div>

        <div class="col-md-3">
          <a class="portfolio-item" style="background-image: url(image/portfolio-8.jpg);" href="">
            <div class="details">
              <h4>Portfolio 8</h4>
              <span>Alored dono par</span>
            </div>
          </a>
        </div>

      </div>
    </div>
  </section>
<!--==========================
  Contact Section
============================-->
  <section id="contact">
    <div class="container wow fadeInUp">
      <div class="row">
        <div class="col-md-12">
          <h3 class="section-title">Contact Us</h3>
          <div class="section-title-divider"></div>
          <p class="section-description">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque</p>
        </div>
      </div>

      <div class="row">
        <div class="col-md-4 col-md-push-1">
          <div class="info">
            <div>
              <i class="fa fa-map-marker"></i>
              <p>Greenville, SC</p>
            </div>

            <div>
              <i class="fa fa-envelope"></i>
              <p>info@webstitching.com</p>
            </div>

            <div>
              <i class="fa fa-phone"></i>
              <p>(864) 354-6587</p>
            </div>
            <div class="social-icons">
              <ul class="social-link">
                  <li class="linkedin"><a href="#"><i class="fa fa-linkedin"></i></a></li>
              	  <li class="github"><a href="#"><i class="fa fa-github"></i></a></li>
                  <li class="facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
                  <li class="instagram"><a href="#"><i class="fa fa-instagram"></i></a></li>
                  <li class="dribbble"><a href="#"><i class="fa fa-dribbble"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-5 col-md-push-2">
          <form id="contact_form" onsubmit="submitForm(); return false;">
            <div class="form-group">
              <input type="text" name="fullname" id="fullname" placeholder="Your Name" class="form-control" required="required">
            </div>
            <div class="form-group">
              <input type="email" name="emailaddress" id="emailaddress" placeholder="Your Email" class="form-control" required="required">
            </div>
            <div class="form-group">
              <textarea name="messagebody" id="messagebody" rows="6" cols="80" class="form-control" placeholder="Your Message" required="required"></textarea>
            </div>
            <div class="form-group">
              <div class="g-recaptcha" data-sitekey="6LfM0SMUAAAAAApudvLe0i1-ckXEdbod3H3PcF-F"></div>
            </div>
            <div class="form-group">
              <input id="mybtn" type="submit" name="submitbtn" class="btn btn-primary" value="Send Message">
              <span id="status"></span>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

<!--==========================
  Footer
============================-->
  <footer id="footer">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="copyright">
              &copy; Copyright 2017 <strong>Web Stitching</strong>. All Rights Reserved
            </div>
            <div class="credits">
              Powered and Designed by <a href="http://webstitching.com/">Web Stitching</a>
            </div>
          </div>
        </div>
      </div>
  </footer><!-- #footer -->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

  <!-- Libraries CSS Files -->
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet">
  <link href="lib/animate-css/animate.min.css" rel="stylesheet">

  <!-- Required JavaScript Libraries -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <script src="js/hoverIntent.js"></script>
  <script src="lib/superfish/superfish.min.js"></script>
  <script src="lib/morphext/morphext.min.js"></script>
  <script src="lib/wow/wow.min.js"></script>
  <script src="js/sticky.js"></script>
  <script src="js/easing.js"></script>
  <script src='https://www.google.com/recaptcha/api.js'></script>
  <script src="js/custom.js"></script>
  <script src="js/quoteprocess.js"></script>
  <script src="https://cdn.jsdelivr.net/ga-lite/latest/ga-lite.min.js" async></script>
</body>
</html>
