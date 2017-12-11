<?PHP

session_start();
require 'functions/includes.php';
include 'bits/header.php';

if (!isset($_SESSION['username']))
	header("Location: index.php");


if (!empty($_POST['image_name']) & !empty($_POST['page']))
{
	$img = escape($_POST['image_name']);
	$page = escape($_POST['page']);
	try
	{
		$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM `likes` WHERE image_name = :image_name AND username = :username";
		$statement = $pdo->prepare($sql);
		$statement->execute([
			'username' => escape($_SESSION['username']),
			'image_name' => escape($_POST['image_name'])
			]);
		$result = $statement->fetch();
		var_dump($result);
		if ($result == false)
		{
			$sql = "INSERT INTO likes (username, image_name) VALUES
			(:username, :image_name)";
			$statement = $pdo->prepare($sql);
			$statement->execute([
				'username' => escape($_SESSION['username']),
				'image_name' => escape($_POST['image_name'])
				]);
		}
		$pdo = null;
		header('Location: main.php?page='.$page);
	}
	catch(PDOException $error)
	{
		echo $sql . "<br>" . $error->getMessage();
	}
}

?>

<h4>Comment submitted</h4>

<?PHP include 'bits/footer.php'; ?>