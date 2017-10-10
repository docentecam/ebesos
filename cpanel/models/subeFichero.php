<?php
require("../inc/functions.php");

$mensaje = "";
$file = $_FILES["file"]["name"];
$name = $_POST["name"];
$n = $_POST["n"];
$u = $_POST["u"];
$descL = $_POST["descL"];
$descS = $_POST["descS"];
$c = $_POST["c"];
$lg = $_FILES["lg"]["name"];;
$url = $_POST["url"];
$lat = $_POST["lat"];
$lng = $_POST["lng"];
$p = $_POST["p"];
$cp = $_POST["cp"];
$a = $_POST["a"];
$s = $_POST["s"];
$e = $_POST["e"];

if(!is_dir("../files/"))
	mkdir("../files/", 0777);

if($file && move_uploaded_file($_FILES["file"]["tmp_name"],	"../files/".$file))
{
	$mensaje .= $file;
}
echo $mensaje." ".$_POST["name"];

$mySql = "UPDATE `ddb99266`.`shops` SET `name`='".$n."', `lat`='".$lat."', `lng`='".$lng."', `telephone`='".$p."', `email`='".$e."', `url`='".$url."', `schedule`='".$s."', `address`='".$a."', `idUser`='".$u."', `description`='".$descS."', `descriptionLong`='".$descL."', `logo`='".$lg."', `cp`='".$cp."', `ciutat`='".$c."' WHERE `idShop`='34';";

$fp=fopen("../files/testFichers.txt",'w');
fputs($fp,'mySql="'.$mySql.'"');
fputs($fp,'acc="'.$_GET["acc"].'"');
fputs($fp,'file="'.$file.'"');
fputs($fp,'name="'.$name.'"');
fputs($fp,'n="'.$n.'"');
fputs($fp,'u="'.$u.'"');
fputs($fp,'descL="'.$descL.'"');
fputs($fp,'descS="'.$descS.'"');
fputs($fp,'c="'.$c.'"');
fputs($fp,'lg="'.$lg.'"');
fputs($fp,'url="'.$url.'"');
fputs($fp,'lat="'.$lat.'"');
fputs($fp,'lng="'.$lng.'"');
fputs($fp,'p="'.$p.'"');
fputs($fp,'cp="'.$cp.'"');
fputs($fp,'a="'.$a.'"');
fputs($fp,'s="'.$s.'"');
fputs($fp,'e="'.$e.'"');
fclose($fp);

if(isset($_GET['acc']) && $_GET['acc'] == 'new')
{
	$mySql = "INSERT INTO `ddb99266`.`shops` (`name`, `lat`, `lng`, `telephone`, `email`, `url`, `schedule`, `address`, `idUser`, `description`, `descriptionLong`, `logo`, `cp`, `ciutat`) VALUES ('".$n."', '".$lat."', '".$lng."', '".$p."', '".$e."', '".$url."', '".$s."', '".$a."', ".$u.", '".$descS."', '".$descL."', '".$lg."', '".$cp."', '".$c."');";

	$fp=fopen("../files/testFichersSQLNew.txt",'w');
fputs($fp,'mySql="'.$mySql.'"');
fclose($fp);

	$connexio = connect();

	$resultNewShop = mysqli_query($connexio, $mySql);

	disconnect($connexio);
}

if(isset($_GET['acc']) && $_GET['acc'] == 'edit')
{
	$mySql = "UPDATE `ddb99266`.`shops` SET `name`='".$n."', `lat`='".$lat."', `lng`='".$lng."', `telephone`='".$p."', `email`='".$e."', `url`='".$url."', `schedule`='".$s."', `address`='".$a."', `idUser`='".$u."', `description`='".$descS."', `descriptionLong`='".$descL."', `logo`='".$lg."', `cp`='".$cp."', `ciutat`='".$c."' WHERE `idShop`='34';";

$fp=fopen("../files/testFichersSQLEdit.txt",'w');
fputs($fp,'mySql="'.$mySql.'"');
fclose($fp);
	$connexio = connect();

	$resultEditShop = mysqli_query($connexio, $mySql);

	disconnect($connexio);
}