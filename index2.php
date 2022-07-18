<?php

//connessioni dbms e database
$conn = mysql_connect('localhost','root','') or die("Errore di connessione");
$db = mysql_select_db('my_dadaymattiasito') or die("errore con la scelta del DB");

//filtraggio pagina
$pag = filter_input(INPUT_GET,'pag',FILTER_SANITIZE_FULL_SPECIAL_CHARS);

//nome file
$filename="miofile.xml";


function genpremio($id,$xml)
{
  //$q="select * from eventi premi ON idev=";
  $q="select * from premi WHERE rev='".$id."'";
  $rq=mysql_query($q);
  $xml.="<premi>\n";
  while($riga=mysql_fetch_assoc($rq))
  {
    $xml.="<premio>\n";
    $xml.="<idpremio>".htmlspecialchars($riga["idpremio"],ENT_XML1)."</idpremio>\n";
    $xml.="<pos>".htmlspecialchars($riga["pos"],ENT_XML1)."</pos>\n";
    $xml.="<alunni>".htmlspecialchars($riga["alunni"],ENT_XML1)."</alunni>\n";
    //$xml.="<rev>".htmlspecialchars($riga["rev"],ENT_XML1)."</rev>\n";
    $xml.="</premio>\n";
  }
  $xml.="</premi>\n";
  $q=" SELECT * FROM `indirizzi`,`coinvolge`,`eventi` WHERE indirizzi.idind=coinvolge.rind AND coinvolge.rev=eventi.idev and eventi.idev='".$id."'";
  $rq=mysql_query($q);
  //SELECT * FROM `indirizzi`,`coinvolge`,`eventi` WHERE indirizzi.idind=coinvolge.rind AND coinvolge.rev=eventi.idev
  $xml.="<indirizzi>\n";
  while($riga=mysql_fetch_assoc($rq))
  {
    $xml.="<indirizzo>\n";
    $xml.="<idind>".htmlspecialchars ($riga["idind"],ENT_XML1)."</idind>\n";
    $xml.="<desind>".htmlspecialchars ($riga["desind"],ENT_XML1)."</desind>\n";
    $xml.="</indirizzo>\n";
  }
  $xml.="</indirizzi>\n";
  return $xml;

}

//pag main
if($pag=='')
{
  $xml='<?xml version="1.0" encoding="UTF-8"?>'."\n";
  $xml.="<root>\n";

  $q="SELECT * FROM eventi";
  $rq=mysql_query($q) or die(mysql_error());

  $xml.="<eventi>\n";
  while($riga=mysql_fetch_assoc($rq)){

    $xml.="<evento>\n";
    $xml.="<idev>".htmlspecialchars($riga["idev"],ENT_XML1)."</idev>\n";
    $xml.="<titolo>".htmlspecialchars($riga["titolo"],ENT_XML1)."</titolo>\n";
    $xml.="<descev>".htmlspecialchars($riga["descev"],ENT_XML1)."</descev>\n";
    $xml.="<as1>".htmlspecialchars($riga["as1"],ENT_XML1)."</as1>\n";
    $xml.="<as2>".htmlspecialchars($riga["as2"],ENT_XML1)."</as2>\n";
    $xml.="<data>".htmlspecialchars($riga["data"],ENT_XML1)."</data>\n";
    $xml.="<docenti>".htmlspecialchars($riga["docenti"],ENT_XML1)."</docenti>\n";
    $xml.="<luogo>".htmlspecialchars($riga["luogo"],ENT_XML1)."</luogo>\n";
    $xml.="<url>".htmlspecialchars($riga["url"],ENT_XML1)."</url>\n";
    $xml.="<rut>".htmlspecialchars($riga["rut"],ENT_XML1)."</rut>\n";


    $xml=genpremio($riga["idev"],$xml);
    $xml.="</evento>\n";

  }

  $xml.="</eventi>\n";


  //caricamento
  $xml.="</root>\n";
  file_put_contents ($filename,$xml);
  echo '<a href="miofile.xml">Vedi xml</a>';
  echo '<br>';
  echo '<a href="index.php?pag=down">Download</a>';
}


if (file_exists($filename) && $pag=='down') 
{
  header('Content-Description: File Transfer');
  header('Content-Type: application/octet-stream');
  header('Content-Disposition: attachment; filename="'.basename($filename).'"');
  header('Expires: 0');
  header('Cache-Control: must-revalidate');
  header('Pragma: public');
  header('Content-Length: ' . filesize($filename));
  readfile($filename);
  exit;
}


$close=mysql_close($conn);
?>
