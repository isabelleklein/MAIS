<section>
	<header class="main">
		<h2>Vermittler-Kontakte</h2>
	</header>
</section>

<form action="?page=204" method="post">
	<div class="box">
		<div class="row uniform">
			<div class="12u$">
				<label for="datum">Kontaktdatum</label>
				<input id="datum" name="datum" placeholder="" type="date"/>
			</div>
		</div>
	</div>
</form>

<?php 
	if(isset($_POST['suchen'])){
		$filter = "";
		if(isset($_POST['datum'])){
			$filter .= " and t1.Kontakt_Datum='".$_POST['datum']."'";
		}	
		$sql ="SELECT t1.*, t2.Kontaktart_Bez, t3.Kontaktanlass_Bez FROM `Kontakte` AS t1 LEFT JOIN `Index_Kontaktarten` AS t2 ON t1.Kontakt_Art = t2.Kontaktart_ID LEFT JOIN `Index_Kontaktanlass` AS t3 ON t1.Kontakt_Anlass = t3.Kontaktanlass_ID WHERE t1.Kontakt_Vermittler_ID='".$_SESSION['Vermittler_ID']."'".$filter.";";
	} else {
		$sql ="SELECT t1.*, t2.Kontaktart_Bez, t3.Kontaktanlass_Bez FROM `Kontakte` AS t1 LEFT JOIN `Index_Kontaktarten` AS t2 ON t1.Kontakt_Art = t2.Kontaktart_ID LEFT JOIN `Index_Kontaktanlass` AS t3 ON t1.Kontakt_Anlass = t3.Kontaktanlass_ID WHERE t1.Kontakt_Vermittler_ID='".$_SESSION['Vermittler_ID']."';";
	}

	$_SESSION['Kontakt_ID']="";	
	$db_erg = mysqli_query($db,$sql);
			
	if ( ! $db_erg ){
		die('Ungültige Abfrage: ' . mysqli_error($db));
	}
			
	if (mysqli_num_rows($db_erg)>=1){
		echo "<section>";										
		echo "<table border='1'>";
		echo "<thead>";
		echo "<th>Kontaktart</th>";
		echo "<th>Kontaktanlass</th>";
		echo "<th>Kontaktdatum</th>";
		echo "<th>Kontaktperson</th>";
		echo "</thead>";
				
		while ($zeile = mysqli_fetch_array( $db_erg)){	
			echo "<form action='?page=999' method='post'>";
			echo "<tr>";
			echo "<td>". $zeile['Kontaktart_Bez'] . "</td>";
			echo "<td>". $zeile['Kontaktanlass_Bez'] . "</td>";
			echo "<td>". $zeile['Kontakt_Datum'] . "</td>";
			echo "<td>". $zeile['Kontakt_Person'] . "</td>";
			echo "<td><input type='hidden' name='kontakt_id' value='".$zeile['Kontakt_ID']."'></td>";
			echo "<td><input type='submit' name='kontakt' value='Details' />";
			echo "</tr>";
			echo "</form>";
		}
		echo "</table>";
		echo "</section>";			
	}
	mysqli_free_result( $db_erg );	
?>
	<a class="button" href="?page=260">Neuen Kontakt hinzuf&Uuml;gen</a> 
	