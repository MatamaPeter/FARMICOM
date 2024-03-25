<?php
if(isset($_POST['reset'])){
	$email = mysqli_real_escape_string($con,$_POST['email']);

	$selectusers = mysqli_query($con, "SELECT * FROM users WHERE email = '$email'") or die ("query failed");
	if($selectusers->num_rows==0){
    
		echo "No user found"
		exit;
	}else{


	

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.example.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'user@example.com';                     //SMTP username
    $mail->Password   = 'secret';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('from@example.com', 'Mailer');
    $mail->addAddress($email);     //Add a recipient

	$token = md5(rand());

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Password rest';
    $mail->Body    = 'To reset password click <a href="http://localhost/Farmicom/files/change_password.php?token='.$token.'">here<a/>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	$user_verify = $selectusers->fetch_assoc();

	mysqli_query($con,"UPDATE users SET token = '$token' WHERE email='$email'")

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

}


?>