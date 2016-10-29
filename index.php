<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Wahoo - Connexion</title>

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	</head>
	<body>

		<?php
		session_start();
		if(isset($_SESSION['error']))
		{
		echo '<p>'.$_SESSION['error']['username'].'</p>';
		echo '<p>'.$_SESSION['error']['email'].'</p>';
		echo '<p>'.$_SESSION['error']['password'].'</p>';
		unset($_SESSION['error']);
		}
		?>

		<?php
			session_start();
			include('conf/db.inc');

			if(isset($_POST['submit']))
			{
				$email = trim($_POST['email']);
				$password = trim($_POST['password']);
				$query = "SELECT * FROM user WHERE email='$email' AND password='$password'";
				$result = mysqli_query($mysqli,$query)or die(mysqli_error());
				$num_row = mysqli_num_rows($result);
				$row=mysqli_fetch_array($result);

				if( $num_row ==1 )
				{
					$_SESSION['user_name']=$row['username'];
					header("Location: home.php");
					exit;
				}
			} else {
				echo file_get_contents("forms/login.php");
			}
		?>

	</body>
</html>