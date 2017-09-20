<?php 
require("../inc/functions.php");

	if(isset($_GET['acc'])&&$_GET['acc']=='login'){
		$mySql = "SELECT idUser FROM users 
					WHERE email='".$_GET['email']."' password='".$_GET['password'];
		$connexio = connect();
		$resultLogin = mysqli_query($connexio, $mySql);
		disconnect($connexio);

			while ($row=mySqli_fetch_array($resultLogin))
			{
				
				$checkLogin=$row['idUser'];
			}
		echo $checkLogin;
	}

 ?>