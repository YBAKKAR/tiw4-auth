<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<?php
		echo file_get_contents("header.php");
	?>

	<body>

	<?php
		session_start();
		if($_SESSION['username'] == '')
		{
			header("Location: index.php");
			exit;
		}
		
		echo "Bonjour ".$_SESSION['user_name'];
		echo "<br/>";
		echo "Ce compte possède un compte SSH valide";
	?>

	<a href="logout.php">Logout</a>

	</body>
</html>