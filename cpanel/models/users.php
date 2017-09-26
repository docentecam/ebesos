<?php 
require("../inc/functions.php");
$random = rand(0,9);
for($i=1;$i<149;$i++)
{
	$random.= rand(0,9);
}
echo $random;


	if(isset($_GET['acc']) && $_GET['acc'] == 'login'){
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
	 		$mensaje = "L'usuari o la contrasenya no són correctes";
	 	}
	 	else if($connexio == "Error al conectar")
	 	{
	 		$mensaje = "Error al conectar";
	 	}
	 	else
	 	{
	 		$mensaje = "Correcto";
	 		$_SESSION['user'] = $checkLogin;
	 	}

	 	echo $mensaje;

	}
	else if (isset($_GET['acc']) && $_GET['acc'] == 'forgot'){
		$mySql = "SELECT idUser FROM users 
					WHERE email='".$_GET['email'];
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
	 		$mensaje = "L'usuari no existeix";
	 	}
	 	else if($connexio == "Error al conectar")
	 	{
	 		$mensaje = "Error al conectar";
	 	}
	 	else
	 	{
	 		$random = rand(0,9);
			for($i=1;$i<149;$i++)
			{
				$random.= rand(0,9);
			}
			
	 		$mySql = "UPDATE users 
					SET forgotToken =".$random;
			$connexio = connect();
			$updateForgotToken = mysqli_query($connexio, $mySql);
			disconnect($connexio);
	 		$mensaje = "Correcto";
	 	}

	 	echo $mensaje;


	}
?>	
