
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

//Weiterleitung für Verbände
if(isset($_POST['verb_id'])){
	$_SESSION['Verb_ID'] = $_POST['verb_id'];
	header("Location: ?page=280");
}

//Weiterleitung für Vollmachten
if(isset($_POST['vollm_id'])){
	$_SESSION['Vollm_ID'] = $_POST['vollm_id'];
	header("Location: ?page=290");
}

//Weiterleitung für GeVo Details
if(isset($_POST['kontakt_id'])){
	$_SESSION['Kontakt_ID'] = $_POST['kontakt_id'];
	header("Location: ?page=260");
}

//Weiterleitung für Augaben Details
if(isset($_POST['aufgaben_id'])){
	$_SESSION['Aufgaben_ID'] = $_POST['aufgaben_id'];
	header("Location: ?page=601");
}

//Weiterleitung für Konto Details
if(isset($_POST['konten_id'])){
	$_SESSION['Konto_ID'] = $_POST['konten_id'];
	header("Location: ?page=220");
}




?>