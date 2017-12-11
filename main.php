<?PHP

session_start();
require 'functions/includes.php';
include 'bits/header.php';

$page = 1;
if (!empty($_GET))
{
	$page = escape($_GET['page']);
	$page = ($page - 1) * 4 + 1;
}
$totalpages = ceil(count_images() / 4);
$images = get_images($page - 1, 4);
$curr_page = ceil($page / 4);

if ($images && isset($_SESSION['username']))
{

	echo '<div class="gallery">';
	foreach ($images as $img)
	{
		$comments = get_comments($img['image_name']);
		$likes = get_likes($img['image_name']);
		$total_likes = sizeof($likes);
		echo '<div class="comments">
			<img class="gallery_auth" src='.$img['image_name'].'>
			<h4>Comments:</h4>
			<ul>';
		foreach ($comments as $comment)
		{
			echo '<li><strong>'.$comment['username'].'</strong>: '.$comment['user_comment'].'</li>';
		}
		echo '</ul>
			<button class="new_comment" onclick="newComment(this)" id='.$img['image_name'].' name='.$curr_page.'>
				New Comment</button>
			<form method="post" action="New_like.php">
				<input type="hidden" name="image_name" value='.$img['image_name'].'>
				<input type="hidden" name="page" value='.$curr_page.'>
				<button class="new_like" name="submit" value="like">Like</button>
			</form>
			<p class="likes">&hearts; '.$total_likes.'</p>
			</div>';
	}
	echo '</div>';
}
else if ($images)
{
	echo '<div class="gallery">';
	foreach ($images as $img)
	{
		echo '<img class="gallery_img" src='.$img['image_name'].'>';
	}
	echo '</div>';
}
?>
<div class="pagination">
<?PHP
if ($totalpages)
	foreach (range(1, $totalpages) as $page)
		echo '<a href="?page='.$page.'">'.$page.'</a>';
?>
</div>

<script>
	function newComment(name)
	{
		var comment = prompt("Please enter your comment");
		var id = name.id;
		var curr_page = name.name;
		if (comment != null)
		{
			var form = document.createElement("form");
			form.setAttribute("method", "post");
			form.setAttribute("action", "new_comment.php");
			var comments = document.createElement("input");
			comments.setAttribute("type", "hidden");
			comments.setAttribute("name", "comment");
			comments.setAttribute("value", comment);
			form.appendChild(comments);
			var pic = document.createElement("input");
			pic.setAttribute("type", "hidden");
			pic.setAttribute("name", "image_name");
			pic.setAttribute("value", id);
			form.appendChild(pic);
			var page = document.createElement("input");
			page.setAttribute("type", "hidden");
			page.setAttribute("name", "page");
			page.setAttribute("value", curr_page);
			form.appendChild(page);
			document.body.appendChild(form);
			form.submit();
		}
	}
</script>

<?php include 'bits/footer.php'; ?>