<?php 
require("../../inc/functions.php");
session_start();
	if(isset($_GET['acc']) && $_GET['acc'] == 'login')
	{
		$message='';
		$con = false;
		$checkLogin=0;
		$mySql = "SELECT idUser, name, privileges, logo FROM users 
					WHERE email='".$_GET['email']."' AND password='".sha1(md5($_GET['password'])).
					"' AND active='Y'";
		$connexio = connect();
		$resultLogin = mysqli_query($connexio, $mySql);
		disconnect($connexio);
		
		$row=mySqli_fetch_array($resultLogin);
		$checkLogin=mysqli_num_rows($resultLogin);
		if($checkLogin!=0)
		{
			$checkLogin = $row['idUser'];
			$getPrivileges = $row['privileges'];
			$getName = str_replace(array("\r\n", "\r", "\n"), "\\n",$row['name']);
			$getLogo = $row['logo'];
		}
		if($checkLogin == 0)
	 	{
	 		$mySql = "SELECT idShop, name, privileges, logo FROM shops 
					WHERE email='".$_GET['email']."' AND passAplication='".sha1(md5($_GET['password']))."'  AND active='Y'";
			$connexio = connect();
			$resultLogin = mysqli_query($connexio, $mySql);
			disconnect($connexio);
			$row=mySqli_fetch_array($resultLogin);
			$checkLogin=mysqli_num_rows($resultLogin);
			if($checkLogin!=0)
			{
				$checkLogin = $row['idShop'];
				$getPrivileges = $row['privileges'];
				$getName = str_replace(array("\r\n", "\r", "\n"), "\\n",$row['name']);
				$getLogo = $row['logo'];
			}
		}
		if($checkLogin == 0)
		{
			$message = "L'usuari o la contrasenya no són correctes";
		}
		else
		{
			$message = "Correct";
		 	$_SESSION['user']['idUser'] = $checkLogin;
		 	$_SESSION['user']['privileges'] = $getPrivileges;
		 	$_SESSION['user']['name'] = $getName;
		 	$_SESSION['user']['logo'] = $getLogo;
		}
		echo '[{"status":"'.$message.'"}]';
	}
	else if (isset($_GET['acc']) && $_GET['acc'] == 'forgot')
	{
		$mySql = "SELECT idUser, emailPass, name FROM users 
					WHERE email='".$_GET['mail']."'";
		$connexio = connect();
		$resultCheck = mysqli_query($connexio, $mySql);
		disconnect($connexio);
		$checkEmail=0;
		$row=mySqli_fetch_array($resultCheck);
		$checkEmail=mysqli_num_rows($resultCheck);
		if($checkEmail!=0)
		{
			$checkEmail = $row['idUser'];
			$name = str_replace(array("\r\n", "\r", "\n"), "\\n",$row['name']);
		}
	 	if($checkEmail == 0)
	 	{
	 		$message = "L'usuari no existeix";
	 	}
	 	else if($connexio == "Error al conectar")
	 	{
	 		$message = "Error al connectar";
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
	 		$mySql = "SELECT value FROM settings
	 					WHERE idSetting = 7";
	 		$connexio = connect();
	 		$resultSetting = mysqli_query($connexio, $mySql);
	 		disconnect($connexio);
	 		$row=mySqli_fetch_array($resultSetting);
			$Setting=mysqli_num_rows($resultSetting);
			$Setting = $row['value'];
			for($i=2;$i<6;$i++)
			{
				${"random". $i} = rand(0,9);
				for($j=1;$j<149;$j++)
				{
					${"random". $i}.= rand(0,9);
				}
			}
			
			$mySql = "SELECT email, emailPass, logo, name FROM users
	 					WHERE idUser = 1";
	 		$connexio = connect();
	 		$resultE = mysqli_query($connexio, $mySql);
	 		disconnect($connexio);
	 		$row=mySqli_fetch_array($resultE);
			$mail=mysqli_num_rows($resultE);
			$mail = $row['email'];
			$passE = $row['emailPass'];
			$logoM = $row['logo'];
			$nameM = str_replace(array("\r\n", "\r", "\n"), "\\n",$row['name']);
			
	 		$body = "
			 		<html>
			 		<head>
			 		</head>
			 		<body>
			 			<label>Benvolgut ".$name.",</label><br><br>
			 			<p>
			 				Hem rebut un avís que ens informa que no recorda la seva contrasenya, li adjuntem un enllaç perquè pugui canviar la seva contrasenya.
			 			</p><br><br>
			 			<a href='".$Setting."/cpanel/recover.php?acc=r&ft=".$random5."&dt=".$random3."&rt=".$random."&nt=".$random4."&pt=".$random2."'>Premi aquí</a>
			 		</body>
			 		</html>";
	 		sendMails($_GET['mail'], "Reiniciar la contrasenya", $nameM, $mail, $passE, $body, $logoM);
	 	}
	 	echo '[{"status":"'.$message.'"}]';
	}
	else if(isset($_GET['acc']) && $_GET['acc'] == 'crPass')
	{
		$mySql = "SELECT forgotToken FROM users
					WHERE forgotToken='".$_GET['fToken']."'";
		$connexio = connect();
		$resultPass = mysqli_query($connexio, $mySql);
		disconnect($connexio);
		$passC = 0;
		$row=mySqli_fetch_array($resultPass);
		$passC=mysqli_num_rows($resultPass);
		if($passC != 0)
		{
			$mySql = "UPDATE users
					SET password='".sha1(md5($_GET['password']))."', forgotToken=NULL 
					WHERE forgotToken='".$_GET['fToken']."'";
			$connexio = connect();
			$updatePass = mysqli_query($connexio, $mySql);
			disconnect($connexio);
			$message = "La contrasenya s'ha actualitzat";
		}
		else
		{
			$message = "La contrasenya no es pot actualitzar";
		}
		echo '[{"status":"'.$message.'"}]';
	}
	else if (isset($_GET['acc']) && $_GET['acc'] == 'footer'){
 		$mySql = "SELECT footer FROM users";
 		$connexio = connect();
 		$resultFooter = mysqli_query($connexio, $mySql);
 		disconnect($connexio);
 		$showFooter = "[";
 		$i = 0;
 		while ($row=mySqli_fetch_array($resultFooter))
 		{
 			if($i != 0)
 				{
 					$showFooter .= ",";
 				}
 				$showFooter .= '{"footerL":"'.$row['footer'].'"}'; 
 				$i++;
 		}
 		$showFooter .= "]";
 	 	echo $showFooter;
 	}
if(isset($_SESSION['user']['idUser'])) 
{
	if(isset($_GET['acc']) && $_GET['acc'] == 'logout')
	{ 
	 		unset($_SESSION['user']['idUser']);
	 		unset($_SESSION['user']['privileges']);
	 		unset($_SESSION['user']['name']);
	 		unset($_SESSION['user']['logo']);
	 		session_destroy();
	 		header('Location: ..');
	}
	
	else if (isset($_GET['acc']) && $_GET['acc'] == 'loadUser') {
		if(isset($_GET['idUser']))
		{
			$mySql = "SELECT idUser, name, email, emailPass, password, address, telephone, logo, history, active, footer FROM users 
				WHERE idUser='".$_GET['idUser']."'";
		}
		else
		{
			$mySql = "SELECT idUser, name, email, emailPass, password, address, telephone, logo, history, active, footer FROM users 
				WHERE idUser='".$_SESSION['user']['idUser']."'";
		}	
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
				$dataUser .= '{"idUser":"'.$row['idUser'].'", "name":"'.str_replace(array("\r\n", "\r", "\n"), "\\n",$row['name']).'", "email":"'.$row['email'].'", "emailPass":"'.$row['emailPass'].'", "password":"'.$row['password'].'", "address":"'.$row['address'].'", "telephone":"'.$row['telephone'].'", "logo":"'.$row['logo'].'", "history":"'.str_replace(array("\'", '\"', "\r\n"), array("&#39",'&#34',"\\n"),$row['history']).'", "active":"'.$row['active'].'", "footer":"'.$row['footer'].'"}'; 
				$i++;
			}
			$dataUser .= "]";
			echo $dataUser;
	}
	else if (isset($_GET['acc']) && $_GET['acc'] == 'listUsers') {
		if($_SESSION['user']['idUser'] == 1)
		{
			$mySql = "SELECT idUser, name, privileges
				FROM users";
		}
		else
		{
			$mySql = "SELECT idUser, name, privileges
				FROM users
				WHERE idUser=".$_SESSION['user']['idUser'];
		}
		
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
				$dataUser .= '{"idUser":"'.$row['idUser'].'", "name":"'.str_replace(array("\r\n", "\r", "\n"), "\\n",$row['name']).'", "privileges":"'.$row['privileges'].'"}'; 
				$i++;
			}
			$dataUser .= "]";
			echo $dataUser;
	}
	else if (isset($_GET['acc']) && $_GET['acc'] == 'updateUser') {
		$message='';

		if(!isset($_POST['currentPswd']))
		{
			$mySql = 'UPDATE users
					SET email="'.$_POST['email'].'", emailPass="'.$_POST['pswdMail'].'", name="'.$_POST['name'].'", address="'.$_POST['address'].'", telephone="'.$_POST['telephone'].'", history="'.str_replace(array("'",'"',"\\n"), array("\'",'\"',"\r\n"),$_POST['history']).'", active="'.$_POST['active'].'" 
					WHERE idUser='.$_POST['idUser'];
			$connexio = connect();
			$updateUserData = mysqli_query($connexio, $mySql);
			disconnect($connexio);
			$message = "L'usuari s'ha actualitzat";
		}
		else
		{
			$mySql = "SELECT password 
				FROM users 
				WHERE idUser='".$_POST['idUser']."'";
			$connexio = connect();
			$resultUser = mysqli_query($connexio, $mySql);
			disconnect($connexio);
			while ($row = mysqli_fetch_row($resultUser))
			if(sha1(md5($_POST['currentPswd'])) == $row[0])
			{
				$mySql = 'UPDATE users
					SET email="'.$_POST['email'].'", emailPass="'.$_POST['pswdMail'].'", name="'.$_POST['name'].'", password="'.sha1(md5($_POST['pswd'])).'", address="'.$_POST['address'].'", telephone="'.$_POST['telephone'].'", history="'.str_replace(array("'",'"',"\\n"), array("\'",'\"',"\r\n"),$_POST['history']).'", active="'.$_POST['active'].'" 
					WHERE idUser='.$_POST['idUser'];
				$connexio = connect();
				$updateUserData = mysqli_query($connexio, $mySql);
				disconnect($connexio);
				$message = "L'usuari s'ha actualitzat";
			}
			else
			{
				$message = "Error al actualitzar";
			}
		}
		if($connexio == "Error al conectar")
	 	{
	 		$message = "Error al connectar";
	 	}
		echo '[{"status":"'.$message.'"}]';
	}
	else if (isset($_GET['acc']) && $_GET['acc'] == 'createUser') {
		$message='';
		$mySql = 'INSERT INTO users (email, emailPass, name, password, address, telephone, logo, history, footer)
				VALUES ("'.$_POST['email'].'","'.$_POST['pswdMail'].'","'.$_POST['name'].'","'.sha1(md5($_POST['pswd'])).'","'.$_POST['address'].'","'.$_POST['telephone'].'","","'.str_replace(array("'",'"',"\\n"), array("\'",'\"',"\r\n"),$_POST['history']).'","")';
		
		$connexio = connect();
		$resultUser = mysqli_query($connexio, $mySql);
		disconnect($connexio);
		
		$message = "S'ha creat l'usuari";
		if($connexio == "Error al conectar")
	 	{
	 		$message = "Error al connectar";
	 	}
		echo '[{"status":"'.$message.'"}]';
	}
	else if (isset($_GET['acc']) && $_GET['acc'] == 'updateImgAsso') {
		
	    if($_POST['nameField'] == 'logo')
	    {
	    	$file = $_POST['idUser']."-".$_FILES["uploadedFile"]["name"];
	    }
	    else
	    {
	    	$file = $_POST['idUser']."f-".$_FILES["uploadedFile"]["name"];
	    }
	    move_uploaded_file($_FILES["uploadedFile"]["tmp_name"], '../../img/logos-assoc/'.$file);
	    
		$mySql = 'UPDATE users
			SET '.$_POST['nameField'].'="'.$file.'" WHERE idUser='.$_POST['idUser'];
		$connexio = connect();
		$updateLogo = mysqli_query($connexio, $mySql);
		disconnect($connexio);
		unlink('../../img/logos-assoc/'.$_POST['deleteLogo']);
		$message = "S'ha pujat la imatge";
		if($connexio == "Error al conectar")
	 	{
	 		$message = "Error al connectar";
	 	}
		echo '[{"status":"'.$message.'"}]';
	}
}
else if(!isset($_GET['acc']))
{
	header("Location: ../index.html");	
} 
?>	