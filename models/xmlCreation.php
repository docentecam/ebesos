<?php
  require("../inc/functions.php");

  function parseToXML($htmlStr)
  {
    $xmlStr=str_replace('<','&lt;',$htmlStr);
    $xmlStr=str_replace('>','&gt;',$xmlStr);
    $xmlStr=str_replace('"','&quot;',$xmlStr);
    $xmlStr=str_replace("'",'&#39;',$xmlStr);
    $xmlStr=str_replace("&",'&amp;',$xmlStr);
    return $xmlStr;
  }

  //Opens a connection to a MySQL server

  //$connection=@mysqli_connect("localhost","root","","ddb99266");
  //$connection=@mysqli_connect("mysql.hostinger.es","u535170345_besos","ebesos","u535170345_besos");

  // if (!$connection) die("Error...".mysqli_connect_error());
  // mysqli_set_charset($connection, "utf8");

  // Select all the rows in the markers table

  $mySql = "SELECT s.idShop, s.name, s.lat, s.lng, s.telephone, s.email, s.schedule, s.address, s.logo, cs.name AS NameSubCategoria, c.name AS NameCategoria, u.name AS NameAssociacio FROM shops s, shopCategoriesSub scs, categoriesSub cs, categories c, users u WHERE s.idUser = u.idUser AND s.idShop = scs.idShop AND scs.idSubCategory = cs.idSubCategory AND cs.idCategory = c.idCategory AND scs.preferred = 'Y'";

  if (isset($_GET["acc"])&& ($_GET["acc"] == "shop"))
  {
    $idShop=$_GET['idShop'];
    $mySql .= "AND s.idShop=".$idShop;
  }

  $connexio = connect();

  $result = mysqli_query($connexio, $mySql);

  mysqli_close($connexio);

  header("Content-type: text/xml");

  // Start XML file, echo parent node
  $fp=fopen("../files/shops.xml",'w');
    fputs($fp,'<markers>');

   // echo '<markers>';

  // // Iterate through the rows, printing XML nodes for each

  while($row = mysqli_fetch_array($result)){

    // Add to XML document node

    // echo '<marker ';

    // echo 'name="' . parseToXML(utf8_encode($row['name'])) . '" ';

    // echo 'address="' . parseToXML(utf8_encode($row['address'])) . '" ';

    // echo 'lat="' . $row['lat'] . '" ';

    // echo 'lng="' . $row['lng'] . '" ';

    // echo 'telephone="' . utf8_encode($row['telephone']) . '" ';

    // echo 'email="' . utf8_encode($row['email']) . '" ';

    // echo 'schedule="' . utf8_encode($row['schedule']) . '" ';

    // echo 'nameSubCategoria="' . utf8_encode($row['NameSubCategoria']) . '" ';

    // echo 'nameCategoria="' . utf8_encode($row['NameCategoria']) . '" ';

    // echo 'nameAssociacio="' . utf8_encode($row['NameAssociacio']) . '" ';

    // echo '/>';

    //TODO: schedule, email, address(?)
    fputs($fp,'<marker ');
    fputs($fp,'idShop="' . parseToXML($row['idShop']) . '" ');
    fputs($fp,'name="' . parseToXML($row['name']) . '" ');
    fputs($fp,'address="' . parseToXML($row['address']) . '" ');
    fputs($fp,'lat="' . $row['lat'] . '" ');
    fputs($fp,'lng="' . $row['lng'] . '" ');
    fputs($fp,'nameCategoria="' . parseToXML($row['NameCategoria']) . '" ');
    fputs($fp,'nameAssociacio="' . parseToXML($row['NameAssociacio']) . '" ');
    fputs($fp,'telephone="' . parseToXML($row['telephone']) . '" ');
    fputs($fp,'email="' . parseToXML($row['email']) . '" ');
    fputs($fp,'schedule="' . parseToXML($row['schedule']) . '" ');
    fputs($fp,'logo="' . parseToXML($row['logo']) . '" ');
    fputs($fp,'/>');

  }



  // // End XML file

   // echo '</markers>';

  fputs($fp,'</markers>');
    fclose($fp);

?>