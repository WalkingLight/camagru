<?php

require 'functions/includes.php';

if (!empty($_POST))
{
	if ($_POST['username'] != NULL && $_POST['password'] != NULL)
	{
		try
		{
			$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$user = array(
				"username" => escape($_POST['username']),
				"password" => escape($_POST['password'])
			);
			$user['password'] = hash('whirlpool', $user['password']);
			$sql = "SELECT * FROM users WHERE username = :username";
			$statement = $pdo->prepare($sql);
			$statement->bindParam(':username', $user['username'], PDO::PARAM_STR);
			$statement->execute();
			$result = $statement->fetch();
			$pdo = NULL;
			if ($result)
			{
				if ($result['password'] == $user['password'] && $result['verified'] == 1)
				{
					session_start();
					$_SESSION['username'] = $result['username'];
					header('Location: main.php');
				}
				else if ($result['password'] == $user['password'] && $result['verified'] == 0)
					echo "Hello " . $result['username'] . ", you still have to validate your email";
				else
					echo "Hello " . $result['username'] . ", you have entered the wrong password";
			}
			else
				echo "User not found";
		}
		catch(PDOException $error)
		{
			echo $sql . "<br>" . $error->getMessage();
		}
	}
	else if (isset($_POST['submit']) && empty($_POST['username']) || empty($_POST['password']))
		echo "Incomplete form";
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
		<div class="forms password">
			<label for="password">Password:</label>
			<input type="password" id="password" name="password">
		</div>
		<div class="forms submit">
			<input type="submit" value="submit">
		</div>
	</form>
</div>

<?php include 'bits/footer.php'; ?> 
