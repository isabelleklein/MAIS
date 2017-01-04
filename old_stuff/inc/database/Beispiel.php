
<?php
	require_once 'database.php';

	//Initialisiere Datenbank
	Database::init();
	
	// Daten selektieren
	$sql = "SELECT * FROM users";
	$result = Database :: query($sql);
	while ($row = mysql_fetch_object($result)) {
		// echo $row->SPALTENNAME
		echo $row->user_id;
	}
	
	// Daten einfügen, ändern, löschen
	$sql = "INSERT INTO TABELLE1 VALUES ('WERT1','WERT2')";
	$result = Database :: query($sql);
	if($result){
		echo "SQL Befehl war erfolgreich";
	}
	else{
		echo "Fehler!!!";
	}
	
	//Datenbankverbindung trennen
	Database::quit();
	
?>
