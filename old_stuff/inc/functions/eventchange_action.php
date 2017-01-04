<?php

 	include('function_collection.php');
 	
 	//Get Variable auslesen
 
 	$ID = $_GET['id'];
	
	if(!isset($_GET['id'])) {
		$ID = "null";
		}
	
	//Funktion zum ändern von Events


    $title = changeLetter($_POST['title']); 
    $time = $_POST['time'];
    $description = nl2br(changeLetter($_POST['description']));
  	$art = $_POST['termin_art'];
  	
  	$date = modifyDateDB($time);
  	
  	$result = updateEvent($id,$title,$date,$description,$art,$_SESSION['user_id']);    
  	if (!$result) {
        unset($title,$time,$description);
        header("Location: ?page=205&id=$ID&err=2");
  	    }
  	    else {
        	unset($title,$time,$description);
        	header("Location: ?page=205&id=$ID&err=ok");
        	}      
  			
  	?>