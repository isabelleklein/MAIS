
<?php
if(isset($_POST['pers_id'])){
	$_SESSION['Personen_ID'] = $_POST['pers_id'];
	header("Location: ?page=250");
}

?>