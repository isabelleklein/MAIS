<?php

	include('function_collection.php');
	
		
	$ID = $_GET['id'];
	
	if(!isset($_GET['id'])) {
		$ID = "null";
		}
		
	$result = deleteNews($ID);    
    if (!$result) {
		header("Location: ?page=200&err=5");
    	}
    	else {
			header("Location: ?page=200&err=del");
			}      
	?>