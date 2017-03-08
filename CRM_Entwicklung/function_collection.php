<?php
include('dbconnect.php');

	function getID(){
		$dsid = date("YmdHis").$_SESSION['user_id'].rand(10000000,99999999);
				return $dsid;
		}
		
		
	function openlink($page){
		header("Location: ?page=$page");
	}
		
	function do_sql_no_return($db, $sql, $err){
	
		if (mysqli_query($db,$sql)) {
		} else {
	    	echo  $sql;
	    	header("Location: ?page=000&Error=$err");
	    	//echo "Error: " . $sql . "<br>" . mysqli_error($db);
		}

	}
		
		
		?>