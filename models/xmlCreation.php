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

  // Select all the rows in the markers table

  $mySql = "SELECT s.idShop, s.name, s.lat, s.lng, s.telephone, s.email, s.schedule, s.address, s.logo, cs.idSubCategory, cs.name AS NameSubCategoria, c.idCategory, c.name AS NameCategoria, u.name AS NameAssociacio, scs.preferred FROM shops s, shopcategoriessub scs, categoriessub cs, categories c, users u WHERE s.idUser = u.idUser AND s.idShop = scs.idShop AND scs.idSubCategory = cs.idSubCategory AND cs.idCategory = c.idCategory AND scs.preferred = 'Y'";

  if(isset($_GET['idShop'])) $mySql .= "AND s.idShop=".$_GET['idShop'];

  $connexio = connect();

  $result = mysqli_query($connexio, $mySql);

  mysqli_close($connexio);

  header("Content-type: text/xml");

  // Start XML file, echo parent node

  $fp=fopen("../files/shops.xml",'w');
    fputs($fp,'<markers>');

  // Iterate through the rows, printing XML nodes for each

  while($row = mysqli_fetch_array($result))
  {
    //Add to XML document node
    fputs($fp,'<marker ');
    fputs($fp,'idShop="' . parseToXML($row['idShop']) . '" ');
    fputs($fp,'idCategory="' . parseToXML($row['idCategory']) . '" ');
    fputs($fp,'idSubCategory="' . parseToXML($row['idSubCategory']) . '" ');
    fputs($fp,'name="' . parseToXML($row['name']) . '" ');
    fputs($fp,'address="' . parseToXML($row['address']) . '" ');
    fputs($fp,'lat="' . $row['lat'] . '" ');
    fputs($fp,'lng="' . $row['lng'] . '" ');
    fputs($fp,'nameCategoria="' . parseToXML($row['NameCategoria']) . '" ');
    fputs($fp,'nameSubCategoria="' . parseToXML($row['NameSubCategoria']) . '" ');
    fputs($fp,'nameAssociacio="' . parseToXML($row['NameAssociacio']) . '" ');
    fputs($fp,'telephone="' . parseToXML($row['telephone']) . '" ');
    fputs($fp,'email="' . parseToXML($row['email']) . '" ');
    fputs($fp,'schedule="' . parseToXML($row['schedule']) . '" ');
    fputs($fp,'logo="' . parseToXML($row['logo']) . '" ');
    fputs($fp,'preferred="' . parseToXML($row['preferred']) . '" ');
    fputs($fp,'/>');

  }
  //End XML file

    fputs($fp,'</markers>');
  fclose($fp);
?>