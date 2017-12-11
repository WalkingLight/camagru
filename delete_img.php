<?PHP
session_start();
require 'functions/includes.php';
include "bits/header.php";

if (isset($_POST['image']))
{
	var_dump($_POST['image']);
	$image = '.' . substr($_POST['image'], 29);
	try
	{
		$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM images WHERE image_name = :image_name 
		AND username = :username";
		$statement = $pdo->prepare($sql);
		$statement->execute([
			'image_name' => $image,
			'username' => $_SESSION['username']
			]);
		$pdo = null;
		unlink($image);
		header('location: myimg.php');
	}
	catch(PDOException $error)
	{
		echo $sql . "<br>" . $error->getMessage();
	}
 }
?>