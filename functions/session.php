<?PHP

function message()
{
	if (isset($_SESSION['Message']))
	{
		extract($_SESSION['Message']);
		unset($_SESSION['Message']);
		return "<div class='$type'>'$message'</div>";
	}
}

function setMessage($message, $type = 'success')
{
	$_SESSION['Message']['message'] = $message;
	$_SESSION['Message']['type'] = $type;
}

?>