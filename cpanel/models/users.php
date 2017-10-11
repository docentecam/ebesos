<?php 
require("../inc/functions.php");

	if(isset($_GET['acc']) && $_GET['acc'] == 'login'){
		$message='';
		$mySql = "SELECT idUser FROM users 
					WHERE email='".$_GET['email']."' AND password='".sha1(md5($_GET['password'])).
					"' AND active='Y'";
		$connexio = connect();
		$resultLogin = mysqli_query($connexio, $mySql);
		disconnect($connexio);
		$checkLogin="0";
		while ($row=mySqli_fetch_array($resultLogin))
		{
			
			$checkLogin=$row['idUser'];
		}
	 	

	 	if($checkLogin == "0")
	 	{
	 		$message = "L'usuari o la contrasenya no són correctes";
	 	}
	 	else if($connexio == "Error al conectar")
	 	{
	 		$message = "Error al conectar";
	 	}
	 	else
	 	{
	 		$message = "Correct";
	 		$_SESSION['idUser'] = $checkLogin;
	 	}

	 	echo trim($message);
	}
	else if (isset($_GET['acc']) && $_GET['acc'] == 'forgot'){
		$mySql = "SELECT idUser FROM users 
					WHERE email='".$_GET['mail']."'";
		$connexio = connect();
		$resultCheck = mysqli_query($connexio, $mySql);
		disconnect($connexio);
		$checkEmail="0";
		while ($row=mySqli_fetch_array($resultCheck))
		{
			
			$checkEmail=$row['idUser'];
		}
	 	

	 	if($checkEmail == "0")
	 	{
	 		$message = "L'usuari no existeix";
	 	}
	 	else if($connexio == "Error al conectar")
	 	{
	 		$message = "Error al conectar";
	 	}
	 	else
	 	{
	 		$random = rand(0,9);
			for($i=1;$i<149;$i++)
			{
				$random.= rand(0,9);
			}
			
	 		$mySql = "UPDATE users 
					SET forgotToken ='".$random.
					"' WHERE idUser=".$checkEmail;
			$connexio = connect();
			$updateForgotToken = mysqli_query($connexio, $mySql);
			disconnect($connexio);
	 		$message = "Correct";
	 	}

	 	echo $message;
	}
	elseif (isset($_GET['acc']) && $_GET['acc'] == 'loadUser') {
		$mySql = "SELECT idUser, name, email, emailPass, password, address, telephone, logo, history, active, footer FROM users 
					WHERE idUser='".$_GET['idUser']."'";
		$connexio = connect();
		$resultUser = mysqli_query($connexio, $mySql);
		disconnect($connexio);

		$dataUser = "[";
			$i = 0;
			while($row = mysqli_fetch_array($resultUser))
			{
				if($i != 0)
				{
					$dataUser .= ",";
				}
				$dataUser .= '{"idUser":"'.$row['idUser'].'", "name":"'.$row['name'].'", "email":"'.$row['email'].'", "emailPass":"'.$row['emailPass'].'", "password":"'.$row['password'].'", "address":"'.$row['address'].'", "telephone":"'.$row['telephone'].'", "logo":"'.$row['logo'].'", "history":"'.$row['history'].'", "active":"'.$row['active'].'", "footer":"'.$row['footer'].'"}'; 
				$i++;
			}
			$dataUser .= "]";

			echo $dataUser;
	}
	elseif (isset($_GET['acc']) && $_GET['acc'] == 'listUsers') {
		$mySql = "SELECT idUser, name
				FROM users";
		$connexio = connect();
		$resultUser = mysqli_query($connexio, $mySql);
		disconnect($connexio);

		$dataUser = "[";
			$i = 0;
			while($row = mysqli_fetch_array($resultUser))
			{
				if($i != 0)
				{
					$dataUser .= ",";
				}
				$dataUser .= '{"idUser":"'.$row['idUser'].'", "name":"'.$row['name'].'"}'; 
				$i++;
			}
			$dataUser .= "]";

			echo $dataUser;
	}
	elseif (isset($_GET['acc']) && $_GET['acc'] == 'updateUser') {
		$mySql = "UPDATE users
				SET email='".$_GET['email']."', emailPass='".$_GET['pswdMail']."', name='".$_GET['name']."', address='".$_GET['address']."', telephone='".$_GET['telephone']."', history='".$_GET['history']."', active='".$_GET['active']."' 
				WHERE idUser=".$_GET['idUser'];
		$connexio = connect();
		$updateUserData = mysqli_query($connexio, $mySql);
		disconnect($connexio);
	}
	elseif (isset($_GET['acc']) && $_GET['acc'] == 'updatePass') {
		
		$mySql = "SELECT password 
				FROM users 
				WHERE idUser='".$_GET['idUser']."'";
		$connexio = connect();
		$resultUser = mysqli_query($connexio, $mySql);
		disconnect($connexio);

		$dataUser = "[";
			$i = 0;
			/*while($row = mysqli_fetch_array($resultUser))
			{
				if($i != 0)
				{
					$dataUser .= ",";
				}
				$dataUser .= '{"password":"'.$row['password'].'"}'; 
				$i++;
			}
		$dataUser .= "]";*/

		if (sha1(md5($_GET['oldPassword'])) == $row['password'])
		{
			$mySql = "UPDATE users
				SET password='".sha1(md5($_GET['newPassword']))."' 
				WHERE idUser=".$_GET['idUser'];
			$connexio = connect();
			$updateUserData = mysqli_query($connexio, $mySql);
			disconnect($connexio);
		}
		else
		{
			$message = "La contrasenya actual que has escrit no és la correcte";
		}
		echo sha1(md5($_GET['oldPassword']));
	}
?>	
