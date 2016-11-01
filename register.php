<?php

	session_start();

	include('conf/db.inc');

	if(isset($_POST['submit']))
	{
		if($_POST['username'] == '')
		{
			$_SESSION['error']['username'] = "Login manquant";
		}
		if($_POST['email'] == '')
		{
			$_SESSION['error']['email'] = "E-mail manquant";
		} else {
			if(preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9._-]+)+$/", $_POST['email']))
			{
				$email= $_POST['email'];
				$sql1 = "SELECT * FROM user WHERE email = '$email'";
				$result1 = mysqli_query($mysqli,$sql1) or die(mysqli_error());
				if (mysqli_num_rows($result1) > 0)
				{
					$_SESSION['error']['email'] = "Un compte existe déjà avec cet e-mail.";
				}
			} else {
				$_SESSION['error']['email'] = "E-mail non valide";
			}
		}
		if($_POST['password'] == '')
		{
			$_SESSION['error']['password'] = "Mot de passe manquant";
		}

		if(isset($_SESSION['error']))
		{
			header("Location: index.php");
			exit;
		} else {
			$username = $_POST['username'];
			$email = $_POST['email'];
			$password = $_POST['password'];

			$sql2 = "INSERT INTO user (username, email, password) VALUES ('$username', '$email', '$password')";
			$result2 = mysqli_query($mysqli,$sql2) or die(mysqli_error());

			if($result2)
			{
				$to = $email;
				$subject = "Confirmation de création de votre compte Wahoo!";
				$header = "Wahoo! - Votre compte";
				$message = "Vos identifiants Wahoo! : \n";
				$message .= "    Login: $username\n";
				$message .= "    Mot de passe: $password\n";
				$message .= "A bientôt !";

				$sentmail = mail($to,$subject,$message,$header);

				if($sentmail)
				{
				echo "Un mail de confirmation vous a été envoyé à l'adresse $email.";
				} else {
					echo "Erreur lors de l'envoi du mail de confirmation.";
				}
			}
		}
	}
?>