<?PHP
session_start();
require 'functions/includes.php';
include "bits/header.php";

if (!isset($_SESSION['username']))
	header("Location: index.php");

?>
<h4>User Previous Images:</h4>
<p id="info">Clicking the images will delete them</p>
<div class="container">
<div class="grid">
<?php
$images = get_user_images($_SESSION['username']);
foreach ($images as $image)
{
	echo '<div class="cell">
		<img class="responsivee_img" src='.$image['image_name'].' onclick="delete_user_image(this)">
		</div>';
}
?>
</div>
</div>
<script>
	function delete_user_image(item) 
	{
		if (confirm("Are you sure you want to delete " + item.src) == true)
		{
			var form = document.createElement("form");
			form.setAttribute("method", "post");
			form.setAttribute("action", "delete_img.php");
			var hiddenField = document.createElement("input");
			hiddenField.setAttribute("type", "hidden");
			hiddenField.setAttribute("name", "image");
			hiddenField.setAttribute("value", item.src);
			form.appendChild(hiddenField);
			document.body.appendChild(form);
			form.submit();
		}
	}
</script>