<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<?php
		echo file_get_contents("header.php");
	?>

	<body>

		<?php
			session_start();

			if(isset($_GET['action']) && ($_GET['action']=='logout'))
			{
				session_destroy();
			}

			if(isset($_SESSION['error']))
			{
				echo "<div id=\"error-message\" style=\"margin-top:50px;\" class=\"mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2\">";
				echo "<p class=\"text-danger\">".$_SESSION['error']['username']."</p>";
				echo "<p class=\"text-danger\">".$_SESSION['error']['email']."</p>";
				echo "<p class=\"text-danger\">".$_SESSION['error']['password']."</p>";
				echo "</div>";
				unset($_SESSION['error']);
			}

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
					echo file_get_contents("forms/login.php");
					echo file_get_contents("forms/create.php");	
				}
			}
		?>

	</body>
</html>