<?php 
require("../inc/functions.php");

	if(isset($_GET['acc']) && $_GET['acc'] == 'login'){
		$mySql = "SELECT idUser FROM users 
					WHERE email='".$_GET['email']."' AND password='".$_GET['password'].
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
	 		$mensaje = "Usuario y contraseña incorrectos";
	 	}
	 	else if($connexio == "Error al conectar")
	 	{
	 		$mensaje = "Error al conectar";
	 	}
	 	else
	 	{
	 		$mensaje = "Correcto";
	 	}

	 	echo $mensaje;

	}

 ?>