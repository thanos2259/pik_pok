<?php
function send_security_alert()
{
	require('../db/db.php');
	// the location of PHPMailer, where we placed its files.
	require 'PHPMailer/PHPMailerAutoload.php';

	$uname = $_SESSION['username'];
	// we check if user exists in the database
	$query = "SELECT email FROM members WHERE username = '$uname'";
	$result1 = mysqli_query($con,$query) or die("Not able to execute the query");
	$email = mysqli_fetch_array ( $result1 );	

	/*
	 * Server Configuration
	 */

	$myemail = 'sitetest23456@gmail.com';
	    
	$mail = new PHPMailer();
	$mail->isSMTP();// Set mailer to use SMTP                              
	$mail->Host = 'smtp.gmail.com'; // Which SMTP server to use.
	$mail->SMTPAuth = true; // Whether you need to login. This is almost always required.
	$mail->Username = "sitetest23456@gmail.com"; // Your Gmail address.
	$mail->Password = "disisthecode"; // Your Gmail login password or App Specific Password.                       
	$mail->SMTPSecure = 'tls'; // Which security method to use. TLS is most secure.
	$mail->Port = 587; // Which port to use, 587 is the default port for TLS security.
	$mail->setFrom("sitetest23456@gmail.com");
	$mail->addAddress($email[0]);               // Name is+ optional
	$mail->addReplyTo($myemail, 'Team pikpok');
	$mail->isHTML(true);                                  // Set email format to HTML
	$mail->Subject = 'Security Breach. They fucked us (hard)';

	/*
	 * Message Configuration
	 */

	// and finaly send the email to the user to let him know that password has been changed
	$mail->Body = "<span>Hello, You're receiving this email because new a device has been detected or network has been changed</span><br><br><br>";

	if($mail->send()) echo "everything allright"; 
	else echo "an error has occurred during the procedure"; 

}

?>
