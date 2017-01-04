<?php

 	include('function_collection.php');
 	
 	//Get Variable auslesen
 
 	$ID = $_GET['id'];
	
	if(!isset($_GET['id'])) {
		$ID = "null";
		}
	
	//Funktion zum ändern von News

	//Bild hochladen
	if(isset($_FILES['datei']['name']) AND $_FILES['datei']['name'] != '') {
	
    	//erlaubte dateitypen
    	$erlaubt =  array(1 => "image/x-icon",2 => "image/jpg",3 => "image/png",4 => "image/gif",5 => "image/jpeg");
    	//maximale dateigroesse
    	$max = 100000;
    	//generirte name des Bildes
    	$rand = $_FILES['datei']['name'];
    	$random = substr(md5(rand(0000000000, 9999999999)), 0, 10);
    	$type = explode('/',$_FILES['datei']['type']);
    	
    	$picture_name = $random . '.' . $type[1];
    	
    	//Verzeichnis vohin die Bilder gespeichert werden sollen
    	$verzeichnis = "img/uploads/news/";
    	$old_pic = getNewsByID($ID);
    	
    	$error = checkPicture($erlaubt,$max);
    	if($error != 0) {
    		header("Location: ?page=201&id=$ID&err=$error");
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
    		
    		if($old_pic[3] != '') unlink($old_pic[3]);
    		unset($_SESSION['picture_path']);	
    		}
    	}
    	else {
    		$path = $_SESSION['picture_path'];
    		unset($_SESSION['picture_path']);
    		}
    		
    $title = changeLetter($_POST['title']); 
    $description = nl2br(changeLetter($_POST['description']));
  	  	
  	$result = updateNews($id,$title,$description,$_SESSION['user_id'], $path);    
  	if (!$result) {
        unset($title,$description);
        header("Location: ?page=201&id=$ID&err=2");
  	    }
  	    else {
        	unset($title,$description);
        	header("Location: ?page=201&id=$ID&err=ok");
        	}      
  			
  	?>