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
	<a class="button" href="#">Mitgliedschaft hinzuf&Uuml;gen</a> 
</div>
</section>
