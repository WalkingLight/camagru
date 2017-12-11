<?PHP

session_start();
require 'functions/includes.php';
include 'bits/header.php';

if (!isset($_SESSION['username']))
	header("Location: index.php");

if (!empty($_POST['comment']) && !empty($_POST['image_name']) && !empty($_POST['page']))
{
	$comment = escape($_POST['comment']);
	$img = escape($_POST['image_name']);
	$page = escape($_POST['page']);
	try
	{
		$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "INSERT INTO comments (username, user_comment, image_name) VALUES
		(:username, :user_comment, :image_name)";
		$statement = $pdo->prepare($sql);
		$userFrom = [
				'username' => $_SESSION['username'],
				'user_comment' => $comment,
				'image_name' => $img
		];
		$statement->execute($userFrom);
		$sql = "SELECT * FROM images WHERE image_name = :image_name";
		$statement = $pdo->prepare($sql);
		$statement->execute(['image_name' => $img]);
		$result = $statement->fetch();
		$userTo = ['username' => $result['username']];
		$sql = "SELECT * FROM users WHERE username = :username";
		$statement = $pdo->prepare($sql);
		$statement->execute($userTo);
		$result = $statement->fetch();
		$userTo['email'] = $result['email'];
		$userTo['image_title'] = $img;
		send_comment_email($userTo, $userFrom);
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

<?php include 'bits/footer.php'; ?>