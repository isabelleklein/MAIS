<?php      

	$user_pass1 = sha1($_POST['user_pass1']);
	$user_pass2 = sha1($_POST['user_pass2']);
	
	if($user_pass1 == $user_pass2){
		$result = changePassword($user_pass1, $_SESSION['user_id']);
			
  		if (!$result) {
    	    unset($user_pass1,$user_pass2);
    	    header("Location: ?page=702&msg=pnok");
  		    }
  		    else {
    	    	unset($user_pass1,$user_pass2);
    	    	header("Location: ?page=702&msg=pok");
    	    	}  
		} 
		else {
			header("Location: ?page=702&msg=pnok");
			}

	?>