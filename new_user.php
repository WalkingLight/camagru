<?php

require 'functions/includes.php';
session_start();
include 'bits/header.php';

if (isset($_GET['token']) && !empty($_GET['token'])
	&& isset($_GET['email']) && !empty($_GET['email']))
{
	try
	{
		$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$statement = $pdo->prepare("SELECT * FROM users WHERE token = :token");
		$token = escape($_GET['token']);
		$statement->bindParam(':token', $token , PDO::PARAM_STR);
		$statement->execute();
		$result = $statement->fetch();
		$pdo = NULL;
		if ($result)
			if ($result['email'] == escape($_GET['email']))
			{
				$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "UPDATE users SET verified = '1' WHERE token= :token AND email = :email";
				$statement = $pdo->prepare($sql);
				$statement->execute(['token' => $result['token'], 'email' => $result['email']]);
				$_SESSION['username'] = $result['username'];
				$pdo = NULL;
				header('Location: main.php');
			}
			else
				echo "email in get params does not match email address in database";
		else
			echo "could not find token";
	}
	catch(PDOException $error)
	{
		echo $sql . "<br>" . $error->getMessage();
	}
}
?>
<?php include "public/templates/footer.php"; ?>