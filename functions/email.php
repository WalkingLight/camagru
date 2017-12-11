<?php

function send_verification_email($user) 
{
	$to = $user['email'];
	$subject = 'Signup | Verification';
	$headers = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
	$headers .= 'From: <walkinglight1@gmail.com>' . "\r\n";
	$message = '
		<html>
			<head>
				<title>' . $subject . '</title>
			</head>
			<body>
				Hello ' . $user['username'] . ' </br>
				Click the link to validate your email </br>
				<a href="http://localhost:8080/camagru/new_user.php?token='
				. $user['token'] . '&email=' .
				$user['email'] . '">Verify email</a>
			</body>
		</html>';
	if (mail($to, $subject, $message, $headers))
		echo "Follow the link sent to your email to validate your signup<br>";
	else
		echo "Sending email validation failed";
}

function send_password_email($user) 
{
	$to = $user['email'];
	$subject = 'Password Reset';
	$headers = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
	$headers .= 'From: <walkinglight1@gmail.com>' . "\r\n";
	$message = '
		<html>
			<head>
				<title>' . $subject . '</title>
			</head>
			<body>
				Hello ' . $user['username'] . ' </br>
				Click the link to reset your password </br>
				<a href="http://localhost:8080/camagru/password_reset.php?token='
				. $user['token'] . '&email=' .
				$user['email'] . '">Reset Password</a>
			</body>
		</html>';
	if (mail($to, $subject, $message, $headers))
		echo "a password reset has been sent to you please follow the link in the email<br>";
	else
		echo "Sending email validation failed";
}

function send_comment_email($userTo, $userFrom) 
{
		$to = $userTo['email'];
		$subject = 'New Comment on Your Image';
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
		$headers .= 'From: <walkinglight1@gmail.com>' . "\r\n";
		$message = '
			<html>
				<head>
					<title>' . $subject . '</title>
				</head>
				<body>
					Hello ' . $userTo['username'] . ' </br>
					'. $userFrom['username']. ' commented on your picture '
					.substr($userTo['image_title'], 21).'</br>
					They said "' . $userFrom['user_comment'] . '" <br><br><br>
					Cheers!
				</body>
			</html>
	';
	if (mail($to, $subject, $message, $headers))
		echo "Comment post sucessfull<br>";
	else
		echo "Sending email validation failed";
}

?>