<?php
	
	include('function_collection.php');
      

	$email = $_POST['email'];
	
	//Password verschlüsseln
	$pass = sha1($_POST['pwd']);

	//clean_user_input($email);
	        
//SQL Abfrage, ob der USER vorhanden ist
           
	$sql = "SELECT user_id,user_email,user_role_id FROM users WHERE 
    		user_email = '$email' OR user_name = '$user' AND 
     		user_pw = '$pass' AND user_active='1'"; 
      		
    $result = mysql_query($sql) or die (mysql_error());
    $num = mysql_num_rows($result);
	
	while ( $row = mysql_fetch_array($result) )	{
   		$user_id = $row[0];
   		$user_email = $row[1];
   		$user_role_id = $row[2];
   		}

// User vorhanden, dann starte Session und setze Sessionvariablen    
    if ( $num != 0) {
        session_start();         
    	$_SESSION['user'] = $user_email;
    	$_SESSION['role'] = $user_role_id;
    	$_SESSION['user_id'] = $user_id;

    	header("Location: ?page=700");
    	}
    else {
    	header("Location: ?page=901&msg=fail");
    	}

	