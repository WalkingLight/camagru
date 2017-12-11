<!DOCTYPE html>
<html>
<head>
	<title>Camagru</title>
	<link rel="stylesheet" href="./stylesheets/main.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="home">
	<div class="topnav" id="myTopnav">
		<?PHP
		if ($_SESSION != NULL)
		{
			echo "<a class='title' href=" . ROOT.'main.php' . "><strong>CAMAGRU</strong></a>";
			echo "<a class='title' href=" . ROOT.'post.php' . ">Post</a>";
			echo "<a class='title' href=" . ROOT.'myimg.php' . ">My images</a>";
			echo "<a class='logout' href=" . ROOT.'logout.php' . ">Logout</a>";
		}
		else
		{
			echo "<a class='title' href=" . ROOT.'index.php' . "><strong>CAMAGRU</strong></a>";
			echo "<a class='logout' href=" . ROOT.'login.php' . ">Sign in</a>";
		}
		?>
	</div>