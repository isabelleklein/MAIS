

<?php

$name = 'db345629978';
$user = 'db345629978';
$pass = 'london2010';
$host = 'db2857.1und1.de';
//connect($name, $user, $pass, $host);

//Klasse einbinden
include_once 'db.php';
 
//Neue Instanz der Klasse erzeugen 
$mydb = new DB_MySQL('db2857.1und1.de','db345629978','db345629978','london2010');
 
//Abfrage schicken
$mydb->query('SELECT * FROM users');
 
//Ausgabe aller Zeilen mit einer While-Schleife 
while($row = $mydb->fetchRow())
	print_r($row);
 
//Anzahl Datensätze ausgeben
echo $mydb->count();

?>

<!-- </body>, </html> -->