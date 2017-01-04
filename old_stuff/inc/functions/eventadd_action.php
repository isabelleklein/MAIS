<?php

 	include('function_collection.php');

	//Funktion zum hinzuf¨¹gen von Events
	
	if(empty($_POST['title']) OR empty($_POST['time']) OR empty($_POST['description'])){ // Wenn eins der Felder nicht ausgefüllt wurde, dann wird darauf hingewiesen, dass man alle Felder ausfüllen muss.
		header("Location: ?page=202&err=1");
    	}

    	else{ // Wenn alle Felder ausgefüllt wurden, dann wird das Mail verschickt:
      		  // Vorher gebe ich den einzelnen POST Daten kürzere Namen.

      		$title = changeLetter($_POST['title']); 
      		$time = $_POST['time'];
      		$description = nl2br(changeLetter($_POST['description']));
			$art = $_POST['termin_art'];
			
			$date = modifyDateDB($time);
			
			$result = insertEvent($title,$date,$description,$art,$_SESSION['user_id']);    
    		if (!$result) {
        		unset($title,$time,$description);
        		header("Location: ?page=202&err=2");
    			}
    			else {
        			unset($title,$time,$description);
        			header("Location: ?page=202&err=ok");
        			}      
    		}
  			
  	?>