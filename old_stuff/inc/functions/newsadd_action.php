<?php

 	include('function_collection.php');
	
	if(empty($_POST['title']) OR empty($_POST['description'])){ // Wenn eins der Felder nicht ausgef黮lt wurde, dann wird darauf hingewiesen, dass man alle Felder ausf黮len muss.
		header("Location: ?page=200&err=1");
    	}

    	else{ // Wenn alle Felder ausgef黮lt wurden, dann wird das Mail verschickt:
      		  // Vorher gebe ich den einzelnen POST Daten kürzere Namen.

      		$title = changeLetter($_POST['title']); 
      		$description = nl2br(changeLetter($_POST['description']));
      		
      		//Variable für das erneute füllen des Formulars
      		
      		$_SESSION['add_news'] = $title . '#' . $description;
      		
			//Bild hochladen
			
			//ini_set('display_errors', true);
			//error_reporting(E_ALL); 
			//erlaubte dateitypen
			$erlaubt =  array(1 => "image/x-icon",2 => "image/jpg",3 => "image/png",4 => "image/gif",5 => "image/jpeg");							//maximale dateigroesse
			$max = 100000;
   			//generirte name des Bildes
   			$rand = $_FILES['datei']['name'];
   			$random = substr(md5(rand(0000000000, 9999999999)), 0, 10);
   			$type = explode('/',$_FILES['datei']['type']);
   			
   			$picture_name = $random . '.' . $type[1];
			//Verzeichnis vohin die Bilder gespeichert werden sollen
			$verzeichnis = "img/uploads/news/";
			
			
			$error = checkPicture($erlaubt,$max);
			if($error != 0) {
				header("Location: ?page=200&err=$error");
				die();
				}
				else {
					$path = "";
					}
			
			$filename = $verzeichnis.$picture_name;
			//leerzeichen durch nix ersetzen(fur URL wichtig)
			$filename = str_replace(" ","",$filename);
			
			
			if (move_uploaded_file($_FILES['datei']['tmp_name'], $filename)){
				$path = $filename;	
				}	
			
			$result = insertNews($title,$description,$_SESSION['user_id'],$path);    
    		if (!$result) {
        		unset($title,$description);
        		header("Location: ?page=200&err=2");
    			}
    			else {
        			unset($title,$description, $_SESSION['add_news']);
        			header("Location: ?page=200&err=ok");
        			}     
    		}
  			
  	?>