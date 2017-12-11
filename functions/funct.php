<?PHP

function escape($html) {
	return htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
}

function get_images($start, $stop)
{
	if ($start < 0 || $stop < 0)
		return null;
	require ROOT_CONFIG . 'database.php';
	try
	{
		$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM images ORDER BY created desc LIMIT " . $start . "," . $stop;
		$statement = $pdo->prepare($sql);
		$statement->execute();
		$results = $statement->fetchAll();
		$pdo = null;
		return ($results);
	}
	catch(PDOException $error)
	{
		echo $sql . "<br>" . $error->getMessage();
	}
}

function get_user_images($username)
{
	require ROOT_CONFIG . 'database.php';
	try
	{
		$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM images WHERE username = :username 
		ORDER BY created DESC";
		$statement = $pdo->prepare($sql);
		$statement->execute(['username' => $username]);
		$results = $statement->fetchAll();
		$pdo = null;
		return ($results);
	}
	catch(PDOException $error)
	{
		echo $sql . "<br>" . $error->getMessage();
	}
}

function count_images()
{
	require ROOT_CONFIG . 'database.php';
	try
	{
		$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM images";
		$statement = $pdo->prepare($sql);
		$statement->execute();
		$results = $statement->rowCount();
		$pdo = null;
		return ($results);
	}
	catch(PDOException $error)
	{
		echo $sql . "<br>" . $error->getMessage();
	}
}

function get_comments($image)
{
	$image = escape($image);
	require ROOT_CONFIG . 'database.php';
	try
	{
		$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM comments WHERE image_name = :image
		ORDER BY created desc LIMIT 8";
		$statement = $pdo->prepare($sql);
		$statement->execute(['image' => $image]);
		$results = $statement->fetchAll();
		$pdo = null;
		return ($results);
	}
	catch(PDOException $error)
	{
		echo $sql . "<br>" . $error->getMessage();
	}
}

function get_likes($image)
{
	$image = escape($image);
	require ROOT_CONFIG . 'database.php';
	try
	{
		$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM likes WHERE image_name = :image_name
		ORDER BY created desc";
		$statement = $pdo->prepare($sql);
		$statement->execute(['image_name' => $image]);
		$results = $statement->fetchAll();
		$pdo = null;
		return ($results);
	}
	catch(PDOException $error)
	{
		echo $sql . "<br>" . $error->getMessage();
	}
}


?>