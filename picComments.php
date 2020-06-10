<?php
include("db/auth.php"); //include auth.php file on all secure pages
require('db/db.php');
require('db/errorFuncts.php');

$photo_id = $_POST['photo_id'];

mysqli_set_charset($con,"utf8");
$query = "SELECT * FROM post_comments WHERE post_id = $photo_id";

$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);

$query2 = "SELECT photo_name,photo_path FROM images WHERE photo_id = $photo_id";
$result = mysqli_query($con, $query2);

$row2 = mysqli_fetch_array($result);
//echo $row2['photo_path'].$row2['photo_name'];

?>

<!DOCTYPE html>
<html>

<head>
	<link rel='shortcut icon' type='image/x-icon' href='images/logo.png'/>
    <meta charset="UTF-8">
    <title>Comments - Pik Pok</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <link rel="stylesheet" type="text/css" href="css/animate.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/jquery.range.css">
    <link rel="stylesheet" type="text/css" href="css/line-awesome.css">
    <link rel="stylesheet" type="text/css" href="css/line-awesome-font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="lib/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="lib/slick/slick-theme.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/responsive.css">
</head>

<body oncontextmenu="return false;">
    <div class="wrapper">
        <header>
			<div class="container">
				<div class="header-data">
					<div class="logo">
						<a href="index.php" title=""><img src="images/logo.png" alt=""></a>
					</div><!--logo end-->
					<div class="search-bar">
						<form>
							<input type="text" name="search" placeholder="Search...">
							<button type="submit"><i class="fa fa-search"></i></button>
						</form>
					</div><!--search-bar end-->
					<nav>
						<ul>
							<li>
								<a href="index.php" title="">
									<span>
									<i class="fa fa-home fa-lg"></i>
									</span>
									Home
								</a>
							</li>
							<li>
								<a href="top.php" title="">
									<span>
									<i class="fa fa-thumbs-up "></i>
									</span>
									Trending
								</a>
							</li>
							<li>
								<a href="contact.php" title="">
									<span>
									<i class="fa fa-id-card"></i>
									</span>
									Contact
								</a>
							</li>
							<?php
							if(isset($_SESSION['username']))
							echo '
							<li>
								<a href="post.php" title="">
									<span>
									<i class="fa fa-plus"></i>
									</span>
									Post
								</a>
							</li>
							';?>
						</ul>
					</nav><!--nav end-->
					<div class="menu-btn">
						<a href="#" title=""><i class="fa fa-bars"></i></a>
					</div><!--menu-btn end-->

			<?php
				if(isset($_SESSION['username'])) {

				$uname = $_SESSION['username'];
				// find user id from session name
				$query_picture = "SELECT picture_path, profile_pic FROM members WHERE username = '$uname'";
				$result_picture = mysqli_query($con, $query_picture);
				$row_picture = mysqli_fetch_array($result_picture);
				$picture_path = $row_picture['picture_path'];
				$picture_name = $row_picture['profile_pic'];

				echo "
					<div class='user-account'>
						<div class='user-info'>
							<img style=\"width:32px; height:32px;\" src=\"".$picture_path.$picture_name."\" alt=\"users photo\"/>

							<a href='profile3.php' title=''>";?>
							<?php if(isset($_SESSION['username']))  echo $_SESSION['username'];
							echo "</a>
							<i class='fa fa-angle-down'></i>
						</div>
						<div class='user-account-settingss'>
							<h3>Online Status</h3>
							<ul class='on-off-status'>
								<li>
									<div class='fgt-sec'>
										<input type='radio' name='cc' id='c5'>
										<label for='c5'>
											<span></span>
										</label>
										<small>Online</small>
									</div>
								</li>
								<li>
									<div class='fgt-sec'>
										<input type='radio' name='cc' id='c6'>
										<label for='c6'>
											<span></span>
										</label>
										<small>Offline</small>
									</div>
								</li>
							</ul>
							<h3>Custom Status</h3>
							<div class='search_form'>
								<form>
									<input type='text' name='search'>
									<button type='submit'>Ok</button>
								</form>
							</div><!--search_form end-->
							<h3>Setting</h3>
							<ul class='us-links'>
								<li><a href='profile-account-setting.php' title=''>Account Setting</a></li>
								<li><a href='#' title=''>Privacy</a></li>
								<li><a href='#' title=''>Faqs</a></li>
								<li><a href='termsofuse.php' title=''>Terms & Conditions</a></li>
							</ul>
							<h3 class='tc'><a href='db/logout.php' title=''>Logout</a></h3>
						</div><!--user-account-settingss end-->
					</div>
					";
				}
					else
						echo "<div class='user-account'>
						<div class='user-info' style='margin-left:auto; margin-right:auto;'>

							<a href='signin.php' title=''> <i class='fa fa-sign-in fa-lg'></i> Sign In</a>

						</div>
					";
			?>
				</div><!--header-data end-->
			</div>
		</header><!--header end-->

        <main>
            <div class="main-section">
                <div class="container">
                    <div class="main-section-data">
                        <div class="row">
                            <div class="col-xl-9 col-lg-9 col-md-12">

                                <div class="main-ws-sec">
                                    <div class="posts-section">
                                        <div class="post-bar">
                                            <div class="post_topbar">
                                                <div class="usy-dt">
													<?php
													// user id username
													$query = "SELECT * FROM images WHERE photo_id = $photo_id";
													$result = mysqli_query($con, $query);
													$row = mysqli_fetch_array($result);
													$username = $row['username'];
													$query3 = "SELECT username, picture_path, profile_pic FROM members WHERE username = '$username'";
													$result3 = mysqli_query($con, $query3);
													$row3 = mysqli_fetch_array($result3);
													$user_of_post = $row['username'];
													$post_user_picture_path = $row3['picture_path'];
													$post_user_picture_name = $row3['profile_pic'];
													echo "
                                                  	<img style=\"width:32px; height:32px;\" src=\"".$post_user_picture_path.$post_user_picture_name."\" alt=\"users photo\"/> ";?>
                                                    <div class="usy-name">
													<?php
													
													?>
                                                        <h3><?php echo $user_of_post.'</h3>
														<span><i class="fa fa-clock-o" aria-hidden="true"> '.date("d-m-Y H:i:s", strtotime($row['date_posted'])).'</i></span>'; ?>
                                                    </div>
                                                </div>
                                                <div class="ed-opts">
                                                    <a href="#" title="" class="ed-opts-open"><i class="fa fa-ellipsis-v"></i></a>
                                                    <ul class="ed-options">
                                                        <li><a href="#" title="">Edit Post</a></li>
                                                        <li><a href="#" title="">Unsaved</a></li>
                                                        <li><a href="#" title="">Unbid</a></li>
                                                        <li><a href="#" title="">Close</a></li>
                                                        <li><a href="#" title="">Hide</a></li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="pt-3 job_descp accountnone">
                                                <img src="<?php echo $row2['photo_path'].$row2['photo_name'];?>" class="job-dt"></img>
                                                <ul class="skill-tags">
                                                    <li><a href="#" title="">HTML</a></li>
                                                    <li><a href="#" title="">PHP</a></li>
                                                    <li><a href="#" title="">CSS</a></li>
                                                    <li><a href="#" title="">Javascript</a></li>
                                                    <li><a href="#" title="">Wordpress</a></li>
                                                </ul>
                                            </div>
                                            <div class="job-status-bar btm-line">
                                               <ul class="like-com">
													<li>
														<a href="#" class="active"><i class="fa fa-heart"></i> Like</a> </li>
														<!--<img src="images/liked-img.png" alt="">
														
													</li>
													<li><a href="#" class="com"><i class="fa fa-comment"></i> Comments 15</a></li>-->
												</ul>
												<ul style= "float:right;" class="like-com">
													<li><a style="color:#b2b2b2;" class=""><i class="fa fa-thumbs-up"></i> Likes 15</a></li>
													<li><a style="color:#b2b2b2;" class=""><i class="fa fa-comment"></i> Comments 15</a></li>
												</ul>
                                            </div>

											<div class="comment-area">
												<div class="reply-area">
												   <p><br></p>
												   <span style="cursor:default;" >-- Comments --<br></span>
												   <br>
												</div>
											</div>

											<?php
											$query = "SELECT * FROM post_comments WHERE post_id = $photo_id";
											$result = mysqli_query($con, $query);


											while ($row = mysqli_fetch_array($result)) {

											$user_id = $row['user_id'];
											$query3 = "SELECT username, picture_path, profile_pic FROM members WHERE id = '$user_id'";
											$result3 = mysqli_query($con, $query3);
											$row3 = mysqli_fetch_array($result3);
											$user_of_post= $row3['username'];
											//$newDate = date("d-m-Y", strtotime($row['date_posted']));

											echo '
                                            <div class="comment-area">
                                                <div class="post_topbar">
                                                    <div class="usy-dt">
                                                        <img style="width:40px; height:40px;" src="'.$row3['picture_path'].$row3['profile_pic'].'" alt="users photo"/>
                                                        <div class="usy-name">
                                                            <h3>'.$row3['username'].'</h3>
                                                            <span><img src="images/clock.png" alt="">'.date("d-m-Y H:i:s", strtotime($row['time_commented'])).'</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="reply-area">
                                                    <p class="myp">'.$row['comment_text'];
                                                    echo'</p>
                                                    <span><i class="fa fa-mail-reply"></i>Reply</span>
                                                </div>
                                            </div>
                                        	<br>
											';
											}

											mysqli_close($con);
											?>
                                            <div class="postcomment">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                    	<?php echo "<img style=\"width:40px; height:40px;border-radius: 50%;\" src=\"".$picture_path.$picture_name."\" alt=\"users photo\"/>"; ?>                                                    	
                                                       <!-- <img src="images/bg-img4.png" alt=""> -->
                                                    </div>
                                                    <div class="col-md-8">
                                                        <form class='aform'>
                                                            <div class="form-group">
                                                            	<input type='hidden' name='photo_id' id='photo_id' value='<?php echo $photo_id; ?> '/>
                                                                <input type="text" class="form-control" id="comment-text" name="comment-text"  placeholder="Post a comment"/>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <a style="cursor:pointer;" id="send-comment"  class="send-comment text-white">Send</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--post-bar end-->
                                </div>
                                <!--posts-section end-->
                            </div>
                            <!--main-ws-sec end-->
                            <div class="col-xl-3 col-lg-3 col-md-12">
                                <div class="right-sidebar">
                                     <div class="widget widget-about bid-place">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#applyjob" data-whatever="@mdo">Like</button>
                                    </div>
                                    <!--widget-about end-->
                                    <div class="widget widget-projectid">
                                        <h3>Picture : <?php echo $row2['photo_name']?></h3>
                                        <p>Report Post</p>
                                    </div>
                                    <!--widget-about end-->
                                    <div class="widget widget-jobs">
                                        <div class="sd-title">
                                            <h3>About the Client</h3>
                                            <i class="fa fa-ellipsis-v"></i>
                                        </div>
                                        <div class="sd-title paymethd">
                                            <h4>Payment Method</h4>
                                            <p>Verified</p>
                                            <ul class="star">
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star-half-o"></i></li>
                                                <li><a href="#">5.00 of 5 Reviews</a></li>
                                            </ul>
                                        </div>
                                        <div class="sd-title">
                                            <h4>India</h4>
                                            <p>SKS Nagar, Ludhiana 1 AM</p>
                                        </div>
                                        <div class="sd-title">
                                            <h4>20 Projects Posted | 15 Jobs Posted</h4>
                                            <p>85% Hire Rate, 15% Open Jobs</p>
                                        </div>
                                        <div class="sd-title">
                                            <h4>Member Since</h4>
                                            <p>August 24, 2017</p>
                                        </div>
                                    </div>
                                    <!--widget-jobs end-->
                                    <div class="widget widget-jobs">
                                        <div class="sd-title">
                                            <h3>Project Link</h3>
                                            <i class="fa fa-ellipsis-v"></i>
                                        </div>
                                        <div class="sd-title copylink">
                                            <P>Http://www.workwise.com/pro...</P>
                                            <span><a href="#">Copy Link</a></span>
                                        </div>
                                    </div>
                                    <!--widget-jobs end-->
                                    <div class="widget widget-jobs">
                                        <div class="sd-title">
                                            <h3>Share</h3>
                                        </div>
                                        <div class="sd-title copylink">
                                            <ul>
                                            	<li>
                                                <img src="images/social3.svg" alt="image"></li>
                                                <li>
                                                <img src="images/social5.svg" alt="image"></li>
                                                <li>
                                                <img src="images/social1.svg" alt="image"></li>
                                                <li>
                                                <img src="images/social2.svg" alt="image">
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!--widget-jobs end-->
                                </div>
                                <!--right-sidebar end-->
                            </div>
                        </div>


                    </div><!-- main-section-data end-->
                </div>
            </div>
        </main>
        <footer class="fixed-bottom">
            <div class="footy-sec mn no-margin">
                <div class="container">
                    <ul>
                        <li><a href="help-center.html" title="">Help Center</a></li>
						<li><a href="about.php" title="">About</a></li>
						<li><a href="#" title="">Privacy Policy</a></li>
						<li><a href="#" title="">Community Guidelines</a></li>
						<li><a href="#" title="">Cookies Policy</a></li>
						<li><a href="#" title="">Career</a></li>
						<li><a href="forum.html" title="">Forum</a></li>
						<li><a href="#" title="">Language</a></li>
						<li><a href="#" title="">Copyright Policy</a></li>
                    </ul>
                    <p><img src="images/copy-icon2.png" alt="">Copyright <script type="text/javascript">document.write(new Date().getFullYear());</script></p>
                    <img class="fl-rgt" src="images/logo2.png" alt="">
                </div>
            </div>
        </footer>
        <!--footer end-->


        </div>
        <!--post-project-popup end-->
    </div>
    <!--theme-layout end-->
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/popper.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.range-min.js"></script>
    <script type="text/javascript" src="lib/slick/slick.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
	<script>
	var form = $('.aform');
$('.aform').submit(function(e) {



    e.preventDefault();
        $.ajax({
           type: "POST",
           url: 'db/comments.php',
           data: form.serialize(), // serializes the form's elements.
           success: function(data)
           {
            location.reload();
           }
         });
});

document.getElementById("send-comment").addEventListener("click", function () {
  form.submit();
});
	</script>
</body>

</html>
