<?php 
/* ********************************************* 
   MySQL-Besucherz�hler mit IP-Sperre 
   --------------------------------------------- 
   by [LC] f�r php-einfach.de , Oktober 2008 
   --------------------------------------------- 
   Das Skript darf frei genutzt werden, jedoch 
   darf weder dieser Kasten entfernt noch ein 
   eigenes Copyright o.�. eingef�gt werden! 
   --------------------------------------------- 
  ********************************************* */ 
$db_location = "db2922.1und1.de"; //Ort der Datenbank (normalerweise "localhost") 
$db_username = "dbo348734303"; //Benutzername f�r DB-Zugriff 
$db_passwort = "london2010"; //Passwort f�r DB-Zugriff 
$db_name = "db348734303"; //Name der Datenbank 

$ip_block_minutes = 10; //Anzahl der Minuten, in der eine IP nicht neu gez�hlt wird 

/* ******************************************* 
   * AB HIER KEINE �NDERUNGEN MEHR VORNEHMEN * 
   ******************************************* */ 

@mysql_connect($db_location, $db_username, $db_passwort) or die ("Verbindung fehlgeschlagen<br />");  
@mysql_select_db($db_name) or die ("Keine Datenbank mit angegebenen Namen vorhanden<br />");  


$timestamp = date(U); 
$ip = $_SERVER['REMOTE_ADDR']; 
$max_timestamp_ip = date(U) - ($ip_block_minutes * 60); //Der Aufnahmezeitpunkt der IP darf nicht kleiner als dieser Wert sein 

$test = mysql_query("SELECT * FROM counter WHERE ip='$ip' AND timestamp >= '$max_timestamp_ip'"); //Testen, ob es bereits eine Eintrag �ber eine identische IP gibt, der noch innerhalb des G�ltigkeitsrahmens liegt 

if(mysql_num_rows($test) != 1) { 
 mysql_query("INSERT INTO counter SET ip='$ip', timestamp='$timestamp'"); //Sonst einen neuen Eintrag vornehmen 
} 

$counter = mysql_num_rows(mysql_query("SELECT timestamp FROM counter")); //Gesamtzahl der eingetragenen Zeilen ist die Besucheranzahl 

echo $counter; 

?>