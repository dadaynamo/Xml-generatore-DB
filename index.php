<?php
//connessioni dbms e database
$conn = mysql_connect('localhost','root','') or die("Errore di connessione");
$db = mysql_select_db('my_dadaymattiasito') or die("errore con la scelta del DB");

$filename="daddysimp.xml";
$xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
//*****************************************************************************************
$q="SELECT * FROM indirizzi";
$rq=mysql_query($q);
$xml.="<indirizzo>\n";
while($riga=mysql_fetch_assoc($rq)){
$xml.="<indirizzo>\n";
$xml.="<idind>".htmlspecialchars ($riga["idind"],ENT_XML1)."</idind>\n";
$xml.="<desind>".htmlspecialchars ($riga["desind"],ENT_XML1)."</desind>\n";
$xml.="</indirizzo>\n";
}
$xml.="</indirizzo>\n";
//*******************************************************************************************



file_put_contents($filename, $xml);
?>
