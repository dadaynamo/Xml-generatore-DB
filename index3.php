<?php

//connessioni dbms e database
$conn = mysql_connect('localhost','root','') or die("Errore di connessione");
$db = mysql_select_db('my_dadaymattiasito') or die("errore con la scelta del DB");
$filename="gomitolo.xml";

//inizio xml
$xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
$xml.="<root>"."\n";
//coinvolge
$a="SELECT * FROM coinvolge";
$ra=mysql_query($a);

$xml.="<coinvolge>"."\n";
  while($riga=mysql_fetch_assoc($ra)){
  $xml.="<coinvolgimento>"."\n";
  $xml.="<idcoin>".htmlspecialchars($riga["idcoin"],ENT_XML1)."</idcoin>"."\n";
  $xml.="<rind>".htmlspecialchars($riga["rind"],ENT_XML1)."</rind>"."\n";
  $xml.="<rev>".htmlspecialchars($riga["rev"],ENT_XML1)."</rev>"."\n";
  $xml.="</coinvolgimento>"."\n";
  }
$xml.="</coinvolge>"."\n";

//*************************************************************************************************
//premi
$a="SELECT * FROM premi";
$ra=mysql_query($a);

$xml.="<premi>"."\n";
while($riga=mysql_fetch_assoc($ra)){
$xml.="<premio>"."\n";
$xml.="<idpremio>".htmlspecialchars($riga["idpremio"],ENT_XML1)."</idpremio>"."\n";
$xml.="<pos>".htmlspecialchars($riga["pos"],ENT_XML1)."</pos>"."\n";
$xml.="<alunni>".htmlspecialchars($riga["alunni"],ENT_XML1)."</alunni>"."\n";
$xml.="<rev>".htmlspecialchars($riga["rev"],ENT_XML1)."</rev>"."\n";
$xml.="</premio>"."\n";
}
$xml.="</premi>"."\n";
//*************************************************************************************************
//eventi
$a="SELECT * FROM eventi";
$ra=mysql_query($a);
$xml.="<eventi>"."\n";
while($riga=mysql_fetch_assoc($ra)){
$xml.="<evento>"."\n";
$xml.="<idev>".htmlspecialchars($riga["idev"],ENT_XML1)."</idev>"."\n";
$xml.="<titolo>".htmlspecialchars($riga["titolo"],ENT_XML1)."</titolo>"."\n";
$xml.="<descev>".htmlspecialchars($riga["descev"],ENT_XML1)."</descev>"."\n";
$xml.="<as1>".htmlspecialchars($riga["as1"],ENT_XML1)."</as1>"."\n";
$xml.="<as2>".htmlspecialchars($riga["as2"],ENT_XML1)."</as2>"."\n";
$xml.="<data>".htmlspecialchars($riga["data"],ENT_XML1)."</data>"."\n";
$xml.="<docenti>".htmlspecialchars($riga["docenti"],ENT_XML1)."</docenti>"."\n";
$xml.="<luogo>".htmlspecialchars($riga["luogo"],ENT_XML1)."</luogo>"."\n";
$xml.="<url>".htmlspecialchars($riga["url"],ENT_XML1)."</url>"."\n";
$xml.="<rut>".htmlspecialchars($riga["rut"],ENT_XML1)."</rut>"."\n";
$xml.="</evento>"."\n";
}
$xml.="</eventi>"."\n";
//*************************************************************************************************
//indirizzi
$a="SELECT * FROM indirizzi";
$ra=mysql_query($a);
$xml.="<indirizzi>"."\n";
while($riga=mysql_fetch_assoc($ra)){
$xml.="<indirizzo>"."\n";
$xml.="<idind>".htmlspecialchars($riga["idind"],ENT_XML1)."</idind>"."\n";
$xml.="<desind>".htmlspecialchars($riga["desind"],ENT_XML1)."</desind>"."\n";
$xml.="</indirizzo>"."\n";
}
$xml.="</indirizzi>"."\n";
//*************************************************************************************************

$xml.="</root>"."\n";
file_put_contents($filename,$xml);
echo '<a href="gomitolo.xml">Vedi xml</a>';
?>
