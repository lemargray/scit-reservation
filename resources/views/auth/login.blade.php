<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="img/favicon.png" type="image/png">
        <title>BulkApp</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{asset('/login/css/bootstrap.css')}}">
        <link rel="stylesheet" href="{{asset('/login/vendors/linericon/style.css')}}">
        <link rel="stylesheet" href="{{asset('/login/css/font-awesome.min.css')}}">
        <link rel="stylesheet" href="{{asset('/login/vendors/owl-carousel/owl.carousel.min.css')}}">
        <link rel="stylesheet" href="{{asset('/login/vendors/lightbox/simpleLightbox.css')}}">
        <link rel="stylesheet" href="{{asset('/login/vendors/nice-select/css/nice-select.css')}}">
        <link rel="stylesheet" href="{{asset('/login/vendors/animate-css/animate.css')}}">
        <link rel="stylesheet" href="{{asset('/login/vendors/popup/magnific-popup.css')}}">
        <!-- main css -->
        <link rel="stylesheet" href="{{asset('/login/css/style.css')}}">
		<link rel="stylesheet" href="{{asset('/login/css/responsive.css')}}">
		<style>
			.form-control, .form-control:focus{
				background-color: #31313126 !important;
				color: #fff !important;
			}
			.btn-yellow{
				/* background-color: #ffd203 !important;
				border-radius: 0 !important;*/
				cursor:pointer; 

                background-color: transparent !important;
                color: #ffd203 !important;
                border: 1px solid #ffd203 !important;
                border-radius: 4px !important;
			}

			.btn-yellow:hover{
				outline: o !important;
				box-shadow: 0 !important;

                background-color: #fff !important;
                color: #d5b41d !important;
                border: 1px solid #d5b41d !important;
			}
            .banner_content{
                position:relative !important;
                top:80px !important;
            }

			@media(max-width: 992px){
				.app_btn_area, #download-text{
					display: none;
				}

                .banner_content{
                    position:relative !important;
                    top: 10px !important;
                }

                .welcome-text{
                    font-size: 2rem !important;
                }
			}
		</style>
    </head>
    <body data-spy="scroll" data-target="#mainNav" data-offset="70">
        
        <!--================Header Menu Area =================-->
        <header class="header_area">
            <div class="main_menu" id="mainNav">
            	<nav class="navbar navbar-expand-lg navbar-light">
					<div class="container">
						<!-- Brand and toggle get grouped for better mobile display -->
						<a class="navbar-brand logo_h" href="#" style="">
							<img style="height:120px; width:140px" src="{{asset('images/utech/icon.png')}}" alt="">
						</a>
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>
            	</nav>
            </div>
        </header>
        <!--================Header Menu Area =================-->
        
        <!--================Home Banner Area =================-->
        <section style="min-height:100vh" class="home_banner_area" id="home">
            <div class="banner_inner">
				<div class="container">
					<div class="row banner_content" style="">
						<div class="col-lg-8" style="text-align:left;">
							<h2 class="welcome-text" style="font-weight:300">Welcome to <br>SCIT Reservation System!</h2>
							<h1 id="download-text" style="color:#ffd203; margin-bottom:20px">Download The App.</h1>
							<!-- <p>inappropriate behavior is often laughed off as “boys will be boys,” women face higher conduct standards especially in the workplace. That’s why it’s crucial that, as women.</p> -->
							
							<div class="app_btn_area" style="margin-top:80px">
								<div>
									<div class="app_btn">
										<div class="media">
											<div class="d-flex">
												<i class="fa fa-apple" aria-hidden="true"></i>
											</div>
											<div class="media-body">
												<a href="#"><h4>Available</h4></a>
												<p>on App Store</p>
											</div>
										</div>
									</div>
									<div class="app_btn">
										<div class="media">
											<div class="d-flex">
												<i class="fa fa-android" aria-hidden="true"></i>
											</div>
											<div class="media-body">
												<a href="#"><h4>Available</h4></a>
												<p>on App Store</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="card" style="color:#000;background-color:transparent;">
								<div class="card-header" style="background-color: #00000012">Login</div>
				
								<div class="card-body" style="background-color: #ab4afe7a;">
									<form method="POST" action="{{ route('login') }}">
										@csrf
				
										<div class="form-group">
											<label for="username">Username</label>
				
											<input id="username" type="username" class="form-control" name="username" value="{{old('username')}}" autocomplete="off" required autofocus>
                                            @if ($errors->has('username'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>username</strong>
                                                </span>
                                            @endif
										</div>
				
										<div class="form-group">
											<label for="password">Password</label>
				
											<div>
												<input id="password" type="password" class="form-control" name="password" required>
				
												@if ($errors->has('password'))
													<span class="invalid-feedback" role="alert">
														<strong>password</strong>
													</span>
												@endif
											</div>
                                        </div>
                                        
                                        <div class="form-group" style="margin-left:20px">
                                            <div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                    <label class="form-check-label" for="remember">
                                                        {{ __('Remember Me') }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
				
										<div class="form-group mb-0">
											<div>
												<button type="submit" class="btn btn-yellow" style="background-color:#ffd203">
													Login
                                                </button>
                                                
                                                @if (Route::has('password.request'))
                                                    <a class="btn btn-link" style="font-weight: bold;font-size: 14px;color:#ffd203;" href="{{ route('password.request') }}">
                                                        {{ __('Forgot Your Password?') }}
                                                    </a>
                                                @endif
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
            </div>
        </section>
        <!--================End Home Banner Area =================-->
  
  
        
        
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="{{asset('/login/js/jquery-3.2.1.min.js')}}"></script>
        <script src="{{asset('/login/js/popper.js')}}"></script>
        <script src="{{asset('/login/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('/login/js/stellar.js')}}"></script>
        <script src="{{asset('/login/vendors/lightbox/simpleLightbox.min.js')}}"></script>
        <script src="{{asset('/login/vendors/nice-select/js/jquery.nice-select.min.js')}}"></script>
        <script src="{{asset('/login/vendors/isotope/imagesloaded.pkgd.min.js')}}"></script>
        <script src="{{asset('/login/vendors/isotope/isotope-min.js')}}"></script>
        <script src="{{asset('/login/vendors/owl-carousel/owl.carousel.min.js')}}"></script>
        <script src="{{asset('/login/js/jquery.ajaxchimp.min.js')}}"></script>
        <script src="{{asset('/login/vendors/counter-up/jquery.waypoints.min.js')}}"></script>
        <script src="{{asset('/login/vendors/counter-up/jquery.counterup.js')}}"></script>
        <script src="{{asset('/login/js/mail-script.js')}}"></script>
        <script src="{{asset('/login/vendors/popup/jquery.magnific-popup.min.js')}}"></script>
        <script src="{{asset('/login/js/theme.js')}}"></script>
    </body>
</html>