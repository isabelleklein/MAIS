<?php
	
	ini_set('display_errors', true);
	error_reporting(E_ALL); 
	//erlaubte dateitypen
	$erlaubt =  array(1 => "image/x-icon",2 => "image/jpg",3 => "image/png",4 => "image/gif");
	//maximale dateigroesse
	$max = 100000;
	//generirte name des Bildes
	$rand = $_FILES['datei']['name'];
	//Verzeichnis vohin die Bilder gespeichert werden sollen
	$verzeichnis = "functions/upload/uploads/news/";
	/*function rand(&$rand)
	{
	    
	} */
	
	
	checkPicture($erlaubt,$max);
	$filename = $verzeichnis.$rand;
	//leerzeichen durch nix ersetzen(fur URL wichtig)
	$filename = str_replace(" ","",$filename);
	
	
	if (move_uploaded_file($_FILES['datei']['tmp_name'], $filename)){
		$path = $filename;	
		}	
	
	?> 