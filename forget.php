<?php
require 'functions/includes.php';

if (!empty($_POST))
{
	if ($_POST['email'] != NULL
	&& filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
	{
		try
		{
			$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "SELECT * FROM users WHERE email = :email";
			$statement = $pdo->prepare($sql);
			$statement->execute(['email' => $_POST['email']]);
			$result = $statement->fetch();
			$pdo = NULL;
			if (!empty($result))
			{
				send_password_email(['email' => $_POST['email'],
					'username' => $result['username'],
					'token' => $result['token']]);
			}
			else
			{
				?><blockquote>Email not found</blockquote><?php
			}
			
		}
		catch(PDOException $error)
		{
			echo 'Error: ' . $error->getMessage();
		}
	}
	else if (isset($_POST['submit']) && !empty($_POST['email']) &&
	 !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
	{
		?><blockquote><?php
			echo escape($_POST['email']);
		?> is not a valid email.</blockquote><?php 
	}
	else if (isset($_POST['submit']) && $_POST['email'] == NULL) 
	{
		?><blockquote>Incomplete form</blockquote><?php 
	}
}

include 'bits/header2.php';

?>

<div class="connection">
	<h1 class="title"><a href="<?PHP echo ROOT.'index.php';?>">Camagru</a></h1>
	<form method="post">
		<h2>Reset password</h2>
		<div class="forms email">
			<label for="username">Email:</label>
			<input type="text" id="email" name="email">
		</div>
		<div class="forms submit">
			<input type="submit" value="submit">
		</div>
	</form>
</div>

<?php include 'bits/footer.php'; ?>