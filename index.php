<?PHP

include 'functions/includes.php';
include 'bits/header2.php'; 

?>
<h1 class="title"><a href="<?PHP echo ROOT.'index.php';?>">Camagru</a></h1>
<ul class="menu">
	<li><a href="<?PHP echo ROOT.'main.php';?>">Main Page</a></li>
	<li><a href="<?PHP echo ROOT.'login.php';?>">Sign in</a></li>
	<li><a href="<?PHP echo ROOT.'register.php';?>">Create new user</a></li>
	<li><a href="<?PHP echo ROOT.'forget.php';?>">Forgot my password</a></li>
</ul>

<?PHP include 'bits/footer.php'; ?>
