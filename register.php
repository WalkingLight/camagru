<?php
require 'functions/includes.php';

function in_use($user)
{
	try 
	{
		require ROOT_CONFIG . 'database.php';
		$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$sql = "SELECT * FROM users WHERE email = :email OR username = :username";
		$statement = $pdo->prepare($sql);
		$statement->execute(['email' => $user['email'], 'username' => $user['username']]);
		$result = $statement->fetch();
		if (!empty($result))
		{
			$pdo = NULL;
			return (TRUE);
		}
		$pdo = NULL;
		return (FALSE);
	}
	catch (PDOException $error) 
	{
		echo 'Error: ' . $error->getMessage();
		return (FALSE);
	}
}

if ($_POST != NULL)
{
	if ($_POST['username'] != NULL && $_POST['email'] != NULL
	&& $_POST['password'] != NULL && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)
	&& strlen($_POST['password']) >= 8)
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
				$new_user = array(
					'username' => $_POST['username'],
					'email' => $_POST['email'],
					'password' => $_POST['password'],
					'token' => md5(rand(0,1000)));
				foreach ($new_user as $key => $value)
					$value = escape($value);
				if (!in_use($new_user))
				{
					$new_user['password'] = hash('whirlpool', $new_user['password']);
					$sql = sprintf(
						"INSERT INTO %s (%s) VALUES (%s)",
						"users",
						implode(", ", array_keys($new_user)),
						":" . implode(", :", array_keys($new_user)));
					$statement = $pdo->prepare($sql);
					$statement->execute($new_user);
					send_verification_email($new_user);
				}
				else
					echo "Username or Email allready in use";
				$pdo = NULL;
			}
			catch(PDOException $error)
			{
				echo 'Error: ' . $error->getMessage();
			}
		}
	}
	else if ($_POST != NULL && !empty($_POST['email']) &&
	 !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
	{
		?><blockquote><?php
			echo escape($_POST['email']);
		?> is not a valid email.</blockquote><?php 
	}
	else if ($_POST != NULL && ($_POST['username'] == NULL || 
	$_POST['email'] == NULL || $_POST['password'] == NULL)) 
	{
		?><blockquote>Incomplete form</blockquote><?php 
	}
}
include 'bits/header2.php';

?>

<div class="connection">
	<h1 class="title"><a href="<?PHP echo ROOT.'index.php';?>">Camagru</a></h1>
	<form method="post">
		<div class="forms username">
			<label for="username">Username:</label>
			<input type="text" id="username" name="username">
		</div>
		<div class="forms email">
			<label for="username">Email:</label>
			<input type="text" id="email" name="email">
		</div>
		<div class="forms password">
			<label for="username">Password:</label>
			<input type="password" id="password" name="password">
		</div>
		<div class="forms submit">
			<input type="submit" value="submit">
		</div>
	</form>
</div>

<?php include 'bits/footer.php'; ?>