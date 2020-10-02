<?php
include("db/auth.php"); //include auth.php file on all secure pages 
?>

<!DOCTYPE html>
<html>
<head>
	<link rel='shortcut icon' type='image/x-icon' href='images/logo.png'/>
	<meta charset="UTF-8">
	<title>Pik Pok - Login or sign up</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<link rel="stylesheet" type="text/css" href="css/animate.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/flatpickr.min.css">
	<link rel="stylesheet" type="text/css" href="lib/slick/slick.css">
	<link rel="stylesheet" type="text/css" href="lib/slick/slick-theme.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/responsive.css">
	<!-- font awesome icons kit -->
	<script src="https://kit.fontawesome.com/fac8ebb301.js" crossorigin="anonymous"></script>
</head>

<body class="sign-in" oncontextmenu="return false;">
	<div class="wrapper">		
		<div class="sign-in-page">
			<div class="signin-popup">
				<div class="signin-pop">
					<div class="row">
						<div class="col-lg-6">
							<div class="cmp-info">
								<div class="cm-logo">
									<a href="index.php"><img src="images/pp.png" alt=""></a>
									<p>Pik Pok, is the destination for short-form pictures. Our mission is to capture and present the world's creativity, knowledge, and precious life moments.</p>
								</div><!--cm-logo end-->	
								<img src="images/main.png" alt="">			
							</div><!--cmp-info end-->
						</div>
						<div class="col-lg-6">
							<div class="login-sec">
								<ul class="sign-control">
									<li data-tab="tab-1" class="current"><a href="#" title="">Sign in</a></li>				
									<li data-tab="tab-2"><a href="#" title="">Sign up</a></li>				
								</ul>			
								<div class="sign_in_sec current" id="tab-1">
									
									<h3>Sign in</h3>
									<form id="sign_in" name="sign_in" method = "post" action="db/login.php">
										<div class="row">
											<div class="col-lg-12 no-pdd">
												<div class="sn-field">
													<input type="text" id = "username" name="username" placeholder="Username" required>
													<i class="fa fa-user"></i>
												</div><!--sn-field end-->
											</div>
											<div class="col-lg-12 no-pdd">
												<div class="sn-field">
													<input type="password" id="psw" name="psw" placeholder="Password" required>
													<i class="fa fa-lock"></i>
												</div>
											</div>
											<div class="col-lg-12 no-pdd">
												<div class="checky-sec">
													<div class="fgt-sec">
														<input type="checkbox" name="cc" id="c1">
														<label for="c1">
															<span></span>
														</label>
														<small>Remember me</small>
													</div><!--fgt-sec end-->
													<a href="forgot_password.php" title="">Forgot Password?</a>
												</div>
											</div>
											
											<div class="col-lg-12 no-pdd">
												<button type="submit" id = "submit_signin" value="submit">Sign in</button>
											</div>
										</div>
									</form>
									<div class="login-resources">
										<h4>Login Via Social Account</h4>
										<ul>
											<li><a href="https://www.facebook.com" title="" class="fb"><i class="fa fa-facebook"></i>Login Via Facebook</a></li>
											<li><a href="https://twitter.com" title="" class="tw"><i class="fa fa-twitter"></i>Login Via Twitter</a></li>
										</ul>
									</div><!--login-resources end-->
								</div><!--sign_in_sec end-->
								<div class="sign_in_sec" id="tab-2">	
									<h3>Sign Up</h3>	
									<div class="dff-tab current" id="tab-3">
										<form id="sign_up" name="sign_up" method = "post" action="db/sign_up.php" enctype= "multipart/form-data" onsubmit="validatePass();">
											<div class="row">
												<div class="col-lg-12 no-pdd">
													<div class="sn-field">
														<input type="text" id="fname" name="fname" placeholder="First Name" required>
														<i class="fa fa-user"></i>
													</div>
												</div>
												<div class="col-lg-12 no-pdd">
													<div class="sn-field">
														<input type="text" id="lname" name="lname" placeholder="Surname" required>
														<i class="fa fa-user-circle"></i>
													</div>
												</div>
												<div class="col-lg-12 no-pdd">
													<div class="sn-field">
														<input type="date" id="date_of_birth" name="date_of_birth" placeholder="date of birth" required>
														<i class="fa fa-birthday-cake"></i>
													</div>
												</div>
												<div class="col-lg-12 no-pdd">
													<div class="sn-field">
														<select id="sex" name="sex">
															<option value="0">Male</option>
															<option value="1">Female</option>
														</select>
														<i class="fa fa-venus-mars"></i>
														<span><i class="fa fa-ellipsis-h"></i></span>
													</div>
												</div>
												<div class="col-lg-12 no-pdd">
													<div class="sn-field">
														<input type="email" id="email" name="email" placeholder="email" required>
														<i class="fa fa-at"></i>
													</div>
												</div>
												<div class="col-lg-12 no-pdd">
													<div class="sn-field">
														<input type="text" id="username" name="username" placeholder="username" required>
														<i class="fa fa-user"></i>
													</div>
												</div>
												<div class="col-lg-12 no-pdd">
													<div class="sn-field">
														<input type="password" id ="password" name="psw" placeholder="Password" onkeyup='check();' required>
														<i class="fa fa-lock"></i>
													</div>
												</div>
												<div class="col-lg-12 no-pdd">
													<div class="sn-field">
														<input type="password" id="repeat_password" name="repeat-password" placeholder="Repeat Password" onkeyup='check();' required>
														<i class="fa fa-lock"></i>
													</div>
													<span id='message'></span>
												</div>
												
												
												<div class="g-recaptcha mt-1" id="signup_robot" data-sitekey="6LfmCc0ZAAAAAMnp0Sxs59aUCInXiUSw1r6tn1EY" required></div>

												<div class="col-lg-12 no-pdd">
													<div class="checky-sec st2">
														<div class="fgt-sec">
															<input type="checkbox" name="cc" id="c2" required>
															<label for="c2">
																<span></span>
															</label>
															<small>Yes, I understand and agree to the pik pok Terms & Conditions.</small>
														</div><!--fgt-sec end-->
													</div>
												</div>
												<div class="col-lg-12 no-pdd">
													<button type="submit" id="submit_signup" value="submit">Get Started</button>
												</div>
											</div>
										</form>
									</div><!--dff-tab end-->

								</div>		
							</div><!--login-sec end-->
						</div>
					</div>		
				</div><!--signin-pop end-->
			</div><!--signin-popup end-->
			<div class="footy-sec">
				<div class="container">
					<ul>
						<li><a href="help_center.php" title="">Help Center</a></li>
						<li><a href="about.php" title="">About</a></li>
						<!--<li><a href="#" title="">Privacy Policy</a></li>-->
						<li><a href="community_guidelines.php" title="">Community Guidelines</a></li>
						<!--<li><a href="#" title="">Cookies Policy</a></li>-->
						<li><a href="termsofuse.php" title="">Terms of Use</a></li>
						<li><a href="#" title="">Language: English</a></li>
						<!--<li><a href="#" title="">Copyright Policy</a></li>-->
					</ul>
					<p><img src="images/copy-icon.png" alt="">Copyright <script type="text/javascript">document.write(new Date().getFullYear());</script></p>
				</div>
			</div><!--footy-sec end-->
		</div><!--sign-in-page end-->


	</div><!--theme-layout end-->


<script src="https://www.google.com/recaptcha/api.js"></script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/popper.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="lib/slick/slick.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<script>
		window.onload = function() {
    	var $recaptcha = document.querySelector('#g-recaptcha-response');

    		if($recaptcha) {
        		$recaptcha.setAttribute("required", "required");
    		}

		};


		//var form = document.getElementById("sign_in");
		var form_signup = document.getElementById("sign_in_sec");

		document.getElementById("submit_signup").addEventListener("click", function () {
			if(grecaptcha && grecaptcha.getResponse().length > 0) {
			     form_signup.submit();
			}
			else {
			    // The recaptcha is not cheched
			    // we display an error message here
			    alert('Oops, you have to check the I\'m not a robot box !');
			}

		});
	
</script>
<script>
	/* Passwords do not match functionality */
	  var check = function() { //check passwords if are the same

	  if (document.getElementById('password').value ==
		document.getElementById('repeat_password').value) {
		document.getElementById('message').innerHTML = null;

	  } 
	  else {
		document.getElementById('message').style.color = 'red';
		document.getElementById('message').innerHTML = 'Passwords do not match';
	  }
	}
	
	function validatePass()
	{
	  if(document.getElementById('message').innerHTML == 'Passwords do not match') { 
		alert("Passwords do not match");
		event.preventDefault();
	  }
	}
</script>
</body>
</html>