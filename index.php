<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<?php
		echo file_get_contents("header.php");
	?>

	<body>

		<?php
			session_start();
			if(isset($_SESSION['username']))
			{
				header("Location: home.php");
			} else {
				if(isset($_GET['submit']))
				{
					include('conf/db.inc');
					$username = trim($_GET['username']);
					$password = trim($_GET['password']);
					$query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
					$result = mysqli_query($mysqli,$query)or die(mysqli_error());
					$num_row = mysqli_num_rows($result);
					$row=mysqli_fetch_array($result);

					if( $num_row == 1 )
					{
						$_SESSION['username']=$row['username'];
						header("Location: home.php");
						exit;
					} else {
						echo "Erreur d'identification";
						exit;
					}
				} else {
					echo file_get_contents("forms/login.html");
					echo file_get_contents("forms/create.html");	
				}
			}
		?>

	</body>
</html>