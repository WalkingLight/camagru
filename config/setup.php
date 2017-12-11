<?PHP
require 'database.php';

try
{
	$db = new PDO('mysql:host=127.0.0.1;', $DB_USER, $DB_PASSWORD);
	$db->setattribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "DROP DATABASE if EXISTS camagru; CREATE DATABASE camagru";
	$db->exec($sql);
	$sql = "USE camagru;
			CREATE TABLE users (
				id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				username VARCHAR(30) NOT NULL,
				email VARCHAR(255) NOT NULL,
				password VARCHAR(128) NOT NULL,
				create_date datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
				token VARCHAR(32) NOT NULL,
				verified INT(1) NOT NULL DEFAULT '0'
			);
			CREATE TABLE comments (
				id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				username VARCHAR(30) NOT NULL,
				user_comment VARCHAR(144) NOT NULL,
				image_name VARCHAR(140) NOT NULL,
				created datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
			);
			CREATE TABLE images (
				id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				username VARCHAR(30) NOT NULL,
				image_name VARCHAR(140) NOT NULL,
				created datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
			);
			CREATE TABLE likes (
				id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				username VARCHAR(30) NOT NULL,
				image_name VARCHAR(140) NOT NULL,
				created datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
			);";
	$db->exec($sql);
	echo "Database created sucessfully\n";
}
catch(PDOException $e)
{
	echo 'Error: ' + $e->getMessage();
	die();
}

?>
