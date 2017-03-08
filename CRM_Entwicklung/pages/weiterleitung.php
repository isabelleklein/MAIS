
<?php

//Weiterleitung für Personen Details
if(isset($_POST['pers_id'])){
	$_SESSION['Personen_ID'] = $_POST['pers_id'];
	header("Location: ?page=250");
}

//Weiterleitung für GeVo Details
if(isset($_POST['gevo_id'])){
	$_SESSION['GeVo_ID'] = $_POST['gevo_id'];
	header("Location: ?page=501");
}

//Weiterleitung für GeVo Aktion
if(isset($_POST['aktion_id'])){
	$_SESSION['Aktion_ID'] = $_POST['aktion_id'];
	header("Location: ?page=550");
}



?>