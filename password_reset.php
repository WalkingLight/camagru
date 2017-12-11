<?php

require 'functions/includes.php';

if (isset($_GET['token']) && !empty($_GET['token']) && isset($_GET['email']) && !empty($_GET['email']))
{
	try
	{
		$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$statement = $pdo->prepare("SELECT * FROM users WHERE token = :token");
		$statement->bindParam(':token', escape($_GET['token']), PDO::PARAM_STR);
		$statement->execute();
		$result = $statement->fetch();
		$pdo = NULL;
		if ($result)
			if ($result['email'] == escape($_GET['email']))
			{
				$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
				$sql = "UPDATE users SET active = '1' WHERE token= :token AND email = :email";
				$statement = $pdo->prepare($sql);
				$statement->execute(['token' => $result['token'], 'email' => $result['email']]);
				$_SESSION['email'] = $result['email'];
				$pdo = NULL;
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

if (!empty($_POST))
{
	if (isset($_POST['password']) && !empty($_POST['password']))
	{
		if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,50}$/', $_POST['password']))
		{
			?><blockquote>The password does not meet the requirements!</blockquote><?php
		}
		else
		{
			try
			{
				$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$user = [
					'password' => hash('whirlpool', escape($_POST['password'])),
					'email' => $_SESSION['email']
				];
				$sql = "UPDATE users SET password = :password WHERE email = :email";
				$statement = $pdo->prepare($sql);
				$statement->execute($user);
				$pdo = NULL;
				header('location: login.php');
				echo "password updated";
			}
			catch(PDOException $error)
			{
				echo $sql . "<br>" . $error->getMessage();
			}
		}
	}
	else if (isset($_POST['reset']) && empty($_POST['password']))
		echo "Incomplete form";
}

include 'bits/header2.php';

?>

<div class="connection">
	<h1 class="title"><a href="<?PHP echo ROOT.'index.php';?>">Camagru</a></h1>
	<form method="post">
		<h2>Reset password</h2>
		<div class="forms password">
			<label for="username">New Password:</label>
			<input type="password" id="password" name="password">
		</div>
		<div class="forms submit">
			<input type="submit" value="submit">
		</div>
	</form>
</div>

<?php include 'bits/footer.php'; ?>
