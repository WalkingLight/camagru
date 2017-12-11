<?PHP
session_start();
require 'functions/includes.php';
include "bits/header.php";

if (isset($_POST['image']) && !empty($_POST['image']) && isset($_SESSION['username'])) 
{
	$i = 1;
	$filter = array();
	while (isset($_POST['stock_image' . $i]))
	{
		$filter[] = $_POST['stock_image' . $i];
		$i++;
	}
	$b64 = $_POST['image'];
	$b64 = substr($b64, 22); //removes: config:image/png;base64
	$num = 1;
	$file_name =  "./img/user/" . $_SESSION['username'] . $num . ".png";
	while (file_exists($file_name))
	{
		$num++;
		$file_name =  "./img/user/" . $_SESSION['username'] . $num . ".png";
	}
	$file = fopen($file_name, "wb");
	fwrite($file, base64_decode($b64));
	fclose($file);
	$dest = imagecreatefrompng($file_name);
	imagealphablending($dest, true);
	imagesavealpha($dest, true);
	foreach($filter as $fn)
	{
		$cur = imagecreatefrompng($fn);
		imagealphablending($cur, true);
		imagesavealpha($cur, true);
		imagecopy($dest, $cur, 0, 0, 0, 0, 648, 484);
		imagedestroy($cur);
	}
	imagepng($dest, $file_name);
	imagedestroy($dest);
	try
	{
		$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$image = array(
			"username" => escape($_SESSION['username']),
			"image_name" => $file_name
		);
		$sql = "INSERT INTO images (username, image_name) VALUES
		(:username, :image_name)";
		$statement = $pdo->prepare($sql);
		$statement->execute($image);
		$pdo = NULL;
	}
	catch(PDOException $error)
	{
		echo $sql . "<br>" . $error->getMessage();
	}
}
header("location: myimg.php");
?>