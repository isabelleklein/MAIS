<?php

class new_id{	
	public function id_berechnen(){
		$dsid = date("YmdHis").$_SESSION['user_id'].rand(10000000,99999999);
				return $dsid;
	}

}
	

?>