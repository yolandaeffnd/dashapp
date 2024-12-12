<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Meta -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta name="description" content="Penn - Education HTML Template">
		<meta name="keywords" content="theme_ocean, college, course, e-learning, education, high school, kids, learning, online, online courses, school, student, teacher, tutor, university">
		<meta name="author" content="theme_ocean">
		<!-- SITE TITLE -->
		<title>DATA UNAND</title>
		<!-- Latest Bootstrap min CSS -->
		<link rel="stylesheet" href="assets/home/bootstrap/css/bootstrap.min.css">
		<!-- Google Font -->
		<link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
		<!-- Font Awesome CSS -->
		<link rel="stylesheet" href="assets/home/fonts/font-awesome.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
		<link rel="stylesheet" href="assets/home/fonts/themify-icons.css">
		<!--- owl carousel Css-->
		<link rel="stylesheet" href="assets/home/owlcarousel/css/owl.carousel.css">
		<link rel="stylesheet" href="assets/home/owlcarousel/css/owl.theme.css">
		<!--slicknav Css-->
        <link rel="stylesheet" href="assets/home/css/slicknav.css">
		<!-- MAGNIFIC CSS -->
		<link rel="stylesheet" href="assets/home/css/magnific-popup.css">
		<!-- animate CSS -->
		<link rel="stylesheet" href="assets/home/css/animate.css">
		<!-- Style CSS -->
		<link rel="stylesheet" href="assets/home/css/style.css" />
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
</head>
<body>

<style>
.call_to_action {
    display: flex;
    align-items: center;
    gap: 50px; /* Jarak antara tombol */
}

.nav-link {
    display: inline-block;
}

.counts .count-box {
  display: flex;
  align-items: center;
  padding: 25px;
  width: 55%;
  background: #fff;
  box-shadow: 0px 0 30px rgba(1, 41, 112, 0.08);
  border: 1px solid #ededed;
  margin-top: 50px;
}

.owl-carousel  .owl-wrapper,
.owl-carousel  .owl-item{
	-webkit-backface-visibility: hidden;
	-moz-backface-visibility:    hidden;
	-ms-backface-visibility:     hidden;
	-webkit-transform: translate3d(0,0,0);
	-moz-transform: translate3d(0,0,0);
	-ms-transform: translate3d(0,0,0);
	margin-right: -170px;
}

.icon-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            background-color: #1DA1F2;
            color: white;
            border-radius: 50%;
            text-decoration: none;
            font-size: 24px;
        }

        .icon-link:hover {
            background-color: #0d8bd7;
        }
</style>


	<!-- START PRELOADER -->
    <div id="loader-wrapper">
        <div id="loader"></div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>
	<!-- END PRELOADER -->

	<!-- START NAVBAR -->
	<div id="navigation" class="fixed-top navbar-light bg-faded site-navigation">
		<div class="container">
			<div class="row">
				<div class="col-lg-2 col-md-3 col-sm-4">
					<div class="site-logo">
						<a href="https://www.unand.ac.id/"><img src="assets/admin/images/logo/logo.svg" alt=""></a> 
					</div>
				</div><!--- END Col -->

				<div class="col-lg-6 col-md-9 col-sm-8 ">
					<div class="header_right ">
						<div id="mobile_menu"></div>
					</div>
				</div><!--- END Col -->
    <div class="col-lg-4 col-md-3 col-sm-8">
    <div class="call_to_action">
        <nav id="main-menu" class="ms-auto">
            <ul>
                <li><a class="nav-link" href="blog.html">Chart <span class="ti-angle-down"></span></a>
                    <ul>
                        <li><a class="nav-link" href="blog.html">Mahasiswa</a></li>
                        <li><a class="nav-link" href="blog_single.html">IPK</a></li>
                        <li><a class="nav-link" href="blog.html">Angkatan</a></li>
                        <li><a class="nav-link" href="blog_single.html">Lulusan</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <a class="btn_one" href="login.html">Login</a>
    </div><!-- END call_to_action -->
				</div><!-- END col -->
			</div><!--- END ROW -->
		</div><!--- END CONTAINER -->
	</div>
	<!-- END NAVBAR -->

	<!-- START HOME -->
	<section  id="home" class="home_bg" style="background-image: url(assets/home/images/banner/home.png);  background-size:cover; background-position: center center;">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-sm-6 col-xs-12">
					<div class="home_content">
						<h1>Universitas <span>Andalas</span> </h1>
                    `    <h1>in one data display</h1>
						<p>Explore UNAND achievements with one click on Data UNAND!</p>
					</div>
					<div class="home_btn">
						<a href="#" class="cta"><span>Explore</span>
						  <svg width="13px" height="10px" viewBox="0 0 13 10">
							<path d="M1,5 L11,5"></path>
							<polyline points="8 1 12 5 8 9"></polyline>
						  </svg>
						</a>
					</div>
				</div><!-- END COL-->
				<div class="col-lg-6 col-sm-6 col-xs-12">
					<div class="home_me_img">
						<img src="assets/admin/images/logo/bg2.svg" class="img-fluid" alt="" />
						<div class="home_ps">
							<img src="assets/home/images/icon/user2.svg" alt="" />
							<h2>35000+</h2>
							<span>Active student</span>
						</div>
						<div class="home_ps2">
							<img src="assets/home/images/icon/file2.svg" alt="" />
							<h2>15</h2>
							<span>Faculty</span>
						</div>
					</div>
				</div><!-- END COL-->
			</div><!--- END ROW -->
		</div><!--- END CONTAINER -->
	</section>
	<!-- END  HOME -->

    
	<!-- START NUmbers-->
	{{-- <section class="testi_home_area section-padding"> --}}
		<section id="counts" class="counts section-padding">
        <div class="container" data-aos="fade-up">
             <div class="section-title">
                 {{-- <h2>Test</h2> --}}
				 <p>UNAND <span><u>IN THE NUMBERS</u></span></p>
             </div>
             <div class="row gy-4">
                 <div class="col-lg-12">
                     <div id="testimonial-slider" class="owl-carousel">
                         <div class="count-box">
							<i class="ti-user" style="color: #15be56;"></i>
							<div>
							  <span data-purecounter-start="0" data-purecounter-end="35000" data-purecounter-duration="1" class="purecounter"></span>
							  <p>Current Student Enrollment</p>
							</div>
                         </div><!-- 1 END numbers -->

						 <div class="count-box">
							<i class="ti-agenda" ></i>
							<div>
							  <span data-purecounter-start="0" data-purecounter-end="146" data-purecounter-duration="1" class="purecounter"></span>
							  <p>Degree program offered</p>
							</div>
						 </div><!-- 2 END numbers -->

						 <div class="count-box">
							<i class="ti-crown" style="color: #ee6c20;"></i>
							<div>
							  <span data-purecounter-start="0" data-purecounter-end="150000" data-purecounter-duration="1" class="purecounter"></span>
							  <p>Alumni</p>
							  <p  style="color: #ffffff;" >.</p>
							</div>
						 </div><!-- 3 END numbers -->

						 <div class="count-box">
							<i class="ti-world" style="color: #2068ee;"></i>
							<div>
							  <span data-purecounter-start="0" data-purecounter-end="20" data-purecounter-duration="1" class="purecounter"></span>
							  <p>Country</p>
							  <p  style="color: #ffffff;" >.</p>
							</div>
						 </div><!-- 4 END numbers -->

						 <div class="count-box">
							<i class="ti-face-smile" style="color: #0eb381;"></i>
							<div>
							  <span data-purecounter-start="0" data-purecounter-end="600" data-purecounter-duration="1" class="purecounter"></span>
							  <p>International Students</p>
							</div>
						 </div><!-- 10 END numbers -->

						 <div class="count-box">
							<i class="ti-medall"></i>
							<div>
							  <span data-purecounter-start="0" data-purecounter-end="17" data-purecounter-duration="1" class="purecounter"></span>
							  <p>International Accreditation</p>
							</div>
						 </div><!-- 7 END numbers -->

						 {{-- <div class="count-box">
							<i class="ti-crown" style="color: #ee6c20;"></i>
							<div>
							  <span data-purecounter-start="0" data-purecounter-end="1401" data-purecounter-duration="1" class="purecounter"></span>
							  <p>QS University Rank</p>
							  <p  style="color: #ffffff;" >.</p>
							</div>
						 </div><!-- 5 END numbers --> --}}

						 <div class="count-box">
							<i class="ti-user" style="color: #e9156d;"></i>
							<div>
							  <span data-purecounter-start="0" data-purecounter-end="1613" data-purecounter-duration="1" class="purecounter"></span>
							  <p>Lecture</p>
							  <p  style="color: #ffffff;" >.</p>
							</div>
						 </div><!-- 6 END numbers -->

						 <div class="count-box">
							<i class="ti-flag-alt"></i>
							<div>
							  <span data-purecounter-start="0" data-purecounter-end="15" data-purecounter-duration="1" class="purecounter"></span>
							  <p>Faculty</p>
							  <p  style="color: #ffffff;" >.</p>
							</div>
						 </div><!-- 8 END numbers -->
                       
						 <div class="count-box">
							<i class="ti-thumb-up" style="color: #ee6c20;"></i>
							<div>
							  <span data-purecounter-start="0" data-purecounter-end="77" data-purecounter-duration="1" class="purecounter"></span>
							  <p>Study Program with "A"</p>
							</div>
						 </div><!-- 9 END numbers -->

                     </div><!-- END Numbers SLIDER -->
                 </div><!-- END COL  -->
             </div><!-- END ROW -->
         </div><!-- END CONTAINER -->
     </section>
     <!-- END Numbers -->

	<!-- START COURSE PROMOTION -->
	<section class="course_promo section-padding">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s" data-wow-offset="0">
					<div class="cp_content">
						<h4>Introduction</h4>
						<h2>DATA <span><u>UNAND</u></span></h2>
						<p>DATA UNAND is responsible for collecting, managing, presenting, and analyzing data to support university management.</p>
						<ul>
							<li><span class="ti-check"></span>Excellent Accreditation</li>
							<li><span class="ti-check"></span>Collaborative Environment</li>
							<li><span class="ti-check"></span>Friendly Environment & Expert Teacher</li>
						</ul>
					</div>
					<div class="cp_btn">
						<a href="#" class="cta"><span>Explore</span>
						  <svg width="13px" height="10px" viewBox="0 0 13 10">
							<path d="M1,5 L11,5"></path>
							<polyline points="8 1 12 5 8 9"></polyline>
						  </svg>
						</a>
					</div>
				</div><!--- END COL -->
				<div class="col-lg-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s" data-wow-offset="0">
					<div class="cp_img">
						{{-- <img src="assets/home/images/all-img/promo.png" class="img-fluid" alt="image"> --}}
						{{-- <img src="assets/home/images/all-img/PERPUS.jpg" class="img-fluid" alt="image"> --}}
	
						<!-- <div class="wc_year">
							<h3>20 Years of Experience <br />from 2002</h3>
						</div> -->
					</div>
				</div><!--- END COL -->
			</div><!--- END ROW -->
		</div><!--- END CONTAINER -->
	</section>
	<!-- END COURSE PROMOTION -->

	<!-- START COMPANY PARTNER LOGO  -->
	<div class="partner-logo section-padding">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 text-center" >
					<div class="partner_title">
						<h3>Trusted Company Arround The World! </h3>
					</div>
						<img src="assets/home/images/all-img/Akreditasi/pddikti.png" alt="image" style="width: 80px; margin-right: 10px;">
						<img src="assets/home/images/all-img/Akreditasi/banpt.png" alt="image" style="width: 80px; margin-right: 10px;">
						<img src="assets/home/images/all-img/Akreditasi/asiin.png" alt="image" style="width: 80px; margin-right: 10px;">
						<img src="assets/home/images/all-img/Akreditasi/rsc.png" alt="image" style="width: 80px; margin-right: 10px;">
						<img src="assets/home/images/all-img/Akreditasi/iabee.jpg" alt="image" style="width: 80px; margin-right: 10px;">
						<img src="assets/home/images/all-img/Akreditasi/abet.png" alt="image" style="width: 80px; margin-right: 10px;">
						<img src="assets/home/images/all-img/Akreditasi/fibaa.png" alt="image" style="width: 80px; margin-right: 10px;">
						<img src="assets/home/images/all-img/Akreditasi/abest.png" alt="image" style="width: 80px; margin-right: 10px;">
						<img src="assets/home/images/all-img/Akreditasi/lamptkes.png" alt="image" style="width: 80px; margin-right: 10px;">
						<img src="assets/home/images/all-img/Akreditasi/lamsama.png" alt="image" style="width: 80px; margin-right: 10px;">
						<img src="assets/home/images/all-img/Akreditasi/lamemba.png" alt="image" style="width: 80px; margin-right: 10px;">
						<img src="assets/home/images/all-img/Akreditasi/lamfokom.png" alt="image" style="width: 80px; margin-right: 10px;">
						<img src="assets/home/images/all-img/Akreditasi/lamtek.png" alt="image" style="width: 80px; margin-right: 10px;">
				</div><!-- END COL  -->
			</div><!--END  ROW  -->
		</div><!-- END CONTAINER  -->
	</div>
	<!-- END COMPANY PARTNER LOGO -->

	<!-- START FOOTER -->
	<div class="footer section-padding">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-sm-6 col-xs-12">
					<div class="single_footer">
						<a href="index.html"><img src="assets/admin/images/logo/logo.svg" alt="" style="width: 300px;"></a>
						<p>DATA UNAND is responsible for collecting, managing, presenting, and analyzing data to support university management.</p>
					</div>
					<div class="foot_social">
						<ul>
							<li><a href="https://x.com/unandofficial" class="ti-twitter" target="_blank"></a></li>
							<li><a href="https://www.facebook.com/unandofficial/" class="ti-facebook" target="_blank"></a></li>
							<li><a href="https://www.instagram.com/unandofficial/" class="ti-instagram" target="_blank"></a></li>
							<li><a href="https://www.tiktok.com/@unandofficial" class="fab fa-tiktok" target="_blank"></a></li>
							<li><a href="https://www.youtube.com/@UniversitasAndalas" class="fab fa-youtube" target="_blank"></a></li>
							<li><a href="https://www.linkedin.com/school/unand/posts/?feedView=all" class="ti-linkedin" target="_blank"></a></li>

						</ul>
					</div>
				</div><!--- END COL -->
				<div class="col-lg-3 col-sm-6 col-xs-12" >
					<div class="single_footer" style="margin-left: 100px;">
						<h4>Resources</h4>
						<ul>
							<li><a href="https://ilearn.unand.ac.id/">Portal iLearn</a></li>
							<li><a href="https://sso.unand.ac.id/auth/realms/unand/protocol/openid-connect/auth?response_type=code&redirect_uri=https%3A%2F%2Fsso.unand.ac.id%2Fcallback&client_id=dashboard-sso&nonce=1d05deda2156fb63f109eb5a3f114475&state=3e12d51b26b138b571022a0ea4fc3b88&scope=openid+openid">SSO</a></li>
							<li><a href="http://repo.unand.ac.id/">Repository</a></li>
							<li><a href="https://dosen.unand.ac.id/">Direktori Dosen</a></li>
							<li><a href="https://login.microsoftonline.com/common/oauth2/v2.0/authorize?scope=service%3A%3Aaccount.microsoft.com%3A%3AMBI_SSL+openid+profile+offline_access&response_type=code&client_id=81feaced-5ddd-41e7-8bef-3e20a2689bb7&redirect_uri=https%3A%2F%2Faccount.microsoft.com%2Fauth%2Fcomplete-signin-oauth&client-request-id=c26f047b-5101-4c77-83f0-9f841abbf378&x-client-SKU=MSAL.Desktop&x-client-Ver=4.61.3.0&x-client-OS=Windows+Server+2019+Datacenter&prompt=login&client_info=1&state=H4sIAAAAAAAEAAXBN6KCMAAA0Lu4ZqAXhz8IEnozWDdKKAJBhCBw-v_e4ZK9n7e4dWtW-40F3_EPKzsVBrrP1oZEJpAwBZaugkXbBEvsXthblQX4ZzYBcjgd8zwe_aepL32D1pwMbO0JOkSOnGBR9u2W40uJRzcpfmG8JT1naSiFjTsEKRG42n9ELbypqaQuut9ugxthZmyDMsxX-yWeQuoVjLxELIcJPJrjCqsff5eIipS0CgDuXdwGybhXSt93WAK0KhIVZhUAn6vHf1BwHQ3-G2mCc6eXakIL2S0z-U5Dw4qSaUWk6caZK-fTmykuSu3s7NkLW8H8xYSwrOGmJpz7jHOI4aOTLWa0WNc8TycKzWZ-DAk-e-hdG_ZgS5SWzB7UZW405dJVf3-Hf4sOAGlaAQAA&msaoauth2=true&lc=1033">Email Institusi</a></li>
							<li><a href="https://simanis.unand.ac.id/">Simanis</a></li>
						</ul>
					</div>
				</div><!--- END COL -->
				<div class="col-lg-3 col-sm-6 col-xs-12">
					<div class="single_footer" style="margin-left: 80px;">
						<h4>Unit</h4>
						<ul>
							<li><a href="https://pustaka.unand.ac.id/" >Perpustakaan</a></li>
							<li><a href="https://lc.unand.ac.id/" >Pusat Bahasa</a></li>
							<li><a href="https://labsentral.unand.ac.id/" >Laboratorium</a></li>
							<li><a href="https://pdk.unand.ac.id/" >PDK</a></li>
							<li><a href="http://spi.unand.ac.id/" >SPI</a></li>
							<li><a href="https://uld.unand.ac.id/" >Disabilitas</a></li>
						</ul>
					</div>
				</div><!--- END COL -->
				<div class="col-lg-3 col-sm-6 col-xs-12">
					<div class="single_footer">
						<h4>Contact Info</h4>
						<div class="sf_contact">
							<span class="ti-mobile"></span>
							<h3>Phone number</h3>
							<p>(0751) 77050</p>
						</div>
						<div class="sf_contact">
							<span class="ti-email"></span>
							<h3>Email Address</h3>
							<p> helpdesk@unand.ac.id</p>
						</div>
						<div class="sf_contact">
							<span class="ti-map"></span>
							<h3>Office Address</h3>
							<p>Direktorat Teknologi Informasi Gedung Perpustakaan Lantai Dasar, Limau Manis, Pauh, Padang</p>
						</div>
					</div>
				</div><!--- END COL -->
			</div><!--- END ROW -->
			<div class="row fc">
				<div class="col-lg-6 col-sm-6 col-xs-12">
					<div class="footer_copyright">
						<p>&copy; 2024. All Rights Reserved.</p>
					</div>
				</div>
				<div class="col-lg-6 col-sm-6 col-xs-12">
					<div class="footer_menu">
						<ul>
							<li><a href="#" style="color: #1a2d62;">Terms of use</a></li>
							<li><a href="#" style="color: #1a2d62;">Privacy Policy</a></li>
							<li><a href="#" style="color: #1a2d62;">Cookie Policy</a></li>
						</ul>
					</div>
				</div><!-- END COL -->
			</div>
		</div><!--- END CONTAINER -->
	</div>
	<!-- END FOOTER -->

	<!-- Latest jQuery -->
		<script src="assets/home/js/jquery-1.12.4.min.js"></script>
	<!-- Latest compiled and minified Bootstrap -->
		<script src="assets/home/bootstrap/js/bootstrap.min.js"></script>
	<!-- owl-carousel min js  -->
		<script src="assets/home/owlcarousel/js/owl.carousel.min.js"></script>
	<!-- jquery.slicknav -->
		<script src="assets/home/js/jquery.slicknav.js"></script>
	<!-- magnific-popup js -->
		<script src="assets/home/js/jquery.magnific-popup.min.js"></script>
	<!-- jquery mixitup min js -->
		<script src="assets/home/js/jquery.mixitup.js"></script>
	<!-- scrolltopcontrol js -->
		<script src="assets/home/js/scrolltopcontrol.js"></script>
	<!-- jquery purecounter vanilla js -->
		<script src="assets/home/js/purecounter_vanilla.js"></script>
	<!-- WOW - Reveal Animations When You Scroll -->
		<script src="assets/home/js/wow.min.js"></script>
	<!-- scripts js -->
		<script src="assets/home/js/scripts.js"></script>
</body>
</html>
