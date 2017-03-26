<section>
	<header class="main">
		<h2>Vermittler-Stammdaten</h2>
	</header>
</section>
<!-- Table -->
<?php 
	$sql = "SELECT * FROM Personen as t1 WHERE t1.Personen_Vermittler_ID = '".$_SESSION['Vermittler_ID']."'";
								
	$db_erg = mysqli_query($db,$sql);
											
	if ( ! $db_erg ){
	  	die('Ungültige Abfrage: ' . mysqli_error($db));
	}
	
	while ($zeile = mysqli_fetch_array( $db_erg)){ 								
		echo "<section>";										
		echo "<table border='1'>";
		echo "<thead>";
		echo "<th>Vorname</th>";
		echo "<th>Nachname</th>";
		echo "<th>Geb-Datum</th>";
		echo "<th>Titel</th>";
		echo "<th>Personen_ID</th>";
		echo "</thead>";
												
		echo "<tr>";
		echo "<td>". $zeile['Personen_Vorname'] . "</td>";
		echo "<td>". $zeile['Personen_Nachname'] . "</td>";
		echo "<td>". $zeile['Personen_GEB'] . "</td>";
		echo "<td>". $zeile['Personen_Titel'] . "</td>";
		echo "<td>". $zeile['Personen_ID']."</td>";
		echo "</tr>";
		echo "</table>";
		echo "</section>";
		
	}
								
	mysqli_free_result( $db_erg );
									
?>
<section>
<div class="content">
	<h3>&Uuml;bersicht der Verbandsmitgliedschaften</h3>
	
<?php
$sql = "SELECT t1.* FROM Verbaende as t1 WHERE t1.Verb_Vermittler_ID = '".$_SESSION['Vermittler_ID']."'";
$_SESSION['Verb_ID']="";	
$db_erg = mysqli_query($db,$sql);
		
if ( ! $db_erg ){
	die('Ungültige Abfrage: ' . mysqli_error($db));
}
		
if (mysqli_num_rows($db_erg)>=1){
	echo "<section>";										
	echo "<table border='1'>";
	echo "<thead>";
	echo "<th>Verband</th>";
	echo "<th>G&uuml;ltig von</th>";
	echo "<th>G&uuml;ltig bis</th>";
	echo "<th>Mitglied-Nr.</th>";
	echo "<th>Wertung MVG</th>";
	echo "<th></th>";
	echo "</thead>";
			
	while ($zeile = mysqli_fetch_array( $db_erg)){	
		echo "<form action='?page=999' method='post'>";
		echo "<tr>";
		echo "<td>". $zeile['Verb_Verb_ID'] . "</td>";
		echo "<td>". $zeile['Verb_GUV'] . "</td>";
		echo "<td>". $zeile['Verb_GUB'] . "</td>";
		echo "<td>". $zeile['Verb_MitglNR'] . "</td>";
		echo "<td>". $zeile['Verb_Wertung_MVG'] . "</td>";
		echo "<td><input type='hidden' name='verb_id' value='".$zeile['Verb_ID']."'></td>";
		echo "<td><input type='submit' name='verb' value='Details' />";
		echo "</tr>";
		echo "</form>";
	}
	echo "</table>";
	echo "</section>";
			
}

mysqli_free_result( $db_erg );
								
?>		
	<a class="button" href="#">Mitgliedschaft hinzuf&Uuml;gen</a> 
</div>
</section>
