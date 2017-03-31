<section>
	<header class="main">
		<h2>Aufgaben</h2>
	</header>
</section>

<form action="?page=600" method="post">
	<div class="box">
		<div class="row uniform">
			<div class="12u$">
				<label for="besch">Beschreibung</label>
				<input id="besch" name="besch" placeholder="Beschreibung" type="text"/>
			</div>
			<div class="12u$">
				<ul class="actions">
					<li><input class="special" type="submit" value="Suchen" name="suchen" /></li>
				</ul>
			</div>
		</div>
	</div>
</form>


<?php 
	if(isset($_POST['suchen'])){
		$filter = "";
		if(isset($_POST['besch'])){
			$filter .= " and t1.Aufgaben_Beschreibung='".$_POST['besch']."'";
		}	
		$sql ="SELECT t1.* FROM Aufgaben as t1 WHERE '".$filter.";";
	} else {
		$sql ="SELECT t1.* FROM Aufgaben as t1;";
	}
	$_SESSION['Aufgaben_ID']="";	
	$db_erg = mysqli_query($db,$sql);
			
	if ( ! $db_erg ){
		die('Ungültige Abfrage: ' . mysqli_error($db));
	}
			
	if (mysqli_num_rows($db_erg)>=1){
		echo "<section>";										
		echo "<table border='1'>";
		echo "<thead>";
		echo "<th>Titel</th>";
		echo "<th>Beschreibung</th>";
		echo "<th>Termin</th>";
		echo "<th>Verantwortlicher</th>";
		echo "<th>Status</th>";
		echo "</thead>";
				
		while ($zeile = mysqli_fetch_array( $db_erg)){	
			echo "<form action='?page=999' method='post'>";
			echo "<tr>";
			echo "<td>". $zeile['Aufgaben_Titel'] . "</td>";
			echo "<td>". $zeile['Aufgaben_Beschreibung'] . "</td>";
			echo "<td>". $zeile['Aufgaben_GUB'] . "</td>";
			echo "<td>". $zeile['Aufgaben_Verantwortlicher'] . "</td>";
			echo "<td>". $zeile['Aufgaben_Status'] . "</td>";
			echo "<td><input type='hidden' name='aufgaben_id' value='".$zeile['Aufgaben_ID']."VERM'></td>";
			echo "<td><input type='hidden' name='herkunft' value='Vermittler'></td>";
			echo "<td><input type='submit' name='aufgaben' value='Details' />";
			echo "</tr>";
			echo "</form>";
		}
		echo "</table>";
		echo "</section>";			
	}
	mysqli_free_result( $db_erg );	
?>
	<a class="button" href="?page=601&amp;her=n">Neue Aufgabe hinzuf&Uuml;gen</a> 
	