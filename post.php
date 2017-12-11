<?php
session_start();
require 'functions/includes.php';
include "bits/header.php";


if (!isset($_SESSION['username']))
	header("Location: index.php");

?>

<h2>Post new image</h2>
<h4>1. Select filter below </h4>
<div class="container">
<div class="grid">
<?php
$dirname = "img/filters/";
$images = glob($dirname."*.png");
foreach($images as $image)
{
	echo '<div class="cell" onclick="selected(this)">
		<img class="responsivee_img" src='.$image.'>
		</div>';
}
?>
</div>
</div>
<script>
	function selected(item)
	{
		if (item.getAttribute('name') == 'selected')
		{
			item.style = "";
			item.setAttribute("name", "");
		}
		else
		{
			item.style = "border: 2px solid yellow";
			item.setAttribute("name", "selected");
		}
	}
</script>

<h4>2. Take a photo with your webcam</h4>

<p id="status" style="color: red"></p>
<div class="buttons">
	<button onclick="makeComp()">Take picture</button>
	<button id="notyet" onclick="postComp()">Save it</button>
</div>

<div class="center">
	<div class="grid">
		<div class="cell">
			<video id="camara" onclick="image(this);" width=640 height=484 id="video" autoplay></video>
		</div>
		<div class="cell">
			<canvas id="preview" width="640" height="484"></canvas>
		</div>
	</div>
</div>

<script>
	navigator.getUserMedia = ( navigator.getUserMedia ||
		navigator.webkitGetUserMedia ||
		navigator.mozGetUserMedia ||
		navigator.msGetUserMedia);
	function startWebcam()
	{
		navigator.mediaDevices.getUserMedia({ audio: false, video: true })
			.then(function(stream)
		{
			video = document.querySelector('video');
			video.srcObject = stream;
			webcamStream = stream;
		})
		.catch(function(err)
		{
			console.log("The following error occured: " + err);
		});
	}
	function makeComp()
	{
		var done = document.getElementById('notyet');
		if (done != null)
		{
			done.setAttribute('id', 'yet');
		}
		var canvas = document.getElementById("preview");
		var ctx = canvas.getContext('2d');
		ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
	}
	function postComp()
	{
		var check = document.getElementById('notyet');
		if (check == null)
		{
			var stock = document.getElementsByName("selected");
			var num = stock.length;
			if (num != 0)
			{
				canvas = document.getElementById("preview");
				var data = canvas.toDataURL();
				var form = document.createElement("form");
				form.setAttribute("method", "post");
				form.setAttribute("action", "image_to_data.php");
				var hiddenField = document.createElement("input");
				hiddenField.setAttribute("type", "hidden");
				hiddenField.setAttribute("name", "image");
				hiddenField.setAttribute("value", data);
				form.appendChild(hiddenField);
				for(var i = 1; i < num + 1; i++)
				{
					hiddenField = document.createElement("input");
					hiddenField.setAttribute("type", "hidden");
					hiddenField.setAttribute("name", "stock_image" + i);
					hiddenField.setAttribute("value", stock[i - 1].children[0].src);
					form.appendChild(hiddenField);
				}
				document.body.appendChild(form);
				form.submit();
			}
			else
			{
				var status = document.getElementById('status');
				status.innerHTML = "Please select a filter to apply";
			}
		}
		else
		{
			var status = document.getElementById('status');
			status.innerHTML = "You need to take a photo first";
		}
	}
	window.onload = startWebcam;
</script>
<script>
	function validateMyForm()
	{
		var stock = document.getElementsByName("selected");
		var num = stock.length;
		if (num != 0)
		{
			var form = document.getElementById("upload_form")
			for(var i = 1; i < num + 1; i++)
			{
				hiddenField = document.createElement("input");
				hiddenField.setAttribute("type", "hidden");
				hiddenField.setAttribute("name", "stock_image" + i);
				hiddenField.setAttribute("value", stock[i - 1].children[0].src);
				form.appendChild(hiddenField);
			}
			return true;
		}
		else
		{
			var status = document.getElementById('status2');
			status.innerHTML = "Please select a filter to apply";
			return false;
		}
	}
</script>
<h4>OR upload an image</h4>
<p id="status2" style = "color: red"><p>
<form action="upload.php" method="post" enctype="multipart/form-data" onsubmit="return validateMyForm();" id="upload_form">
	Select image to upload:
	<input type="file" name="fileToUpload" id="fileToUpload">
	<input type="submit" value="Upload Image" name="submit">
</form>

<?php include 'bits/footer.php'; ?>