<?php
if(isset($_POST['speichern'])){
	$sql = "UPDATE `Personen` SET `Personen_Anrede`='2', `Personen_Vorname`='".$_POST['vname']."', `Personen_Nachname`='".$_POST['nname']."',	`Personen_GEB`='2000-01-01',	`Personen_EMAIL`='".$_POST['mail']."', `Personen_TEL`='".$_POST['tel']."',	`Personen_MOBIL`='".$_POST['mobil']."', `Personen_DSIG`='y', `Personen_Titel`='Testtitel', `Personen_Rolle`='".$_POST['rolle']."', `Personen_Schwerpunkt`='".$_POST['schwerpunkt']."', `Personen_PRIO`='".$_POST['prio']."', `Personen_Einstellung`='".$_POST['einstellung']."', `Personen_Beziehung`='".$_POST['beziehung']."', `Personen_Kaufmotiv`='".$_POST['kaufmotiv']."', `Personen_Nachtrags_NR`='".$_POST['nachtrag']."', `Personen_Beginn`='2000-01-01', `Personen_Beginn_abw`='2000-01-01', `Personen_Taetigkeitsbeginn`='2000-01-01', `Personen_Vertragsende`='2000-01-01', `Personen_Abgangsgrund`='1', `Personen_Vertragsverhaeltnis`='Vertragsverhältnis', `Personen_BMV_ID`='".$_POST['bmv_id']."', `Personen_BMV_Beginn`='2000-01-01', `Personen_BMV_Austritt`='2000-01-01', `Personen_BMV_Punkte`='".$_POST['bmv_pkt']."', `Personen_KSR_MOD_A`='".$_POST['ksr_mod_a']."', `Personen_KSR_MOD_B`='".$_POST['ksr_mod_b']."', `Personen_Notizen`='".$_POST['notiz']."' WHERE `Personen_ID`='".$_SESSION['Personen_ID']."'";
	//$sql = "UPDATE `personen` SET `Personen_Vorname`='".$_POST['vname']."', `Personen_Nachname`='".$_POST['nname']."' WHERE `Personen_ID`='".$_POST['pers_id']."'";
	echo $sql;
	if (mysqli_query($db,$sql)) {
	} else {
    	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
}

?>

							<!-- Content -->
								<section>
									<header class="main">
										<h2>Vermittler-Personen</h2>
									</header>
								</section>

								<!-- Table -->
								<h3>Personen-&Uuml;bersicht</h3>

								<?php 
									$sql = "SELECT * FROM Personen as t1 WHERE t1.Personen_Vermittler_ID = '".$_SESSION['Vermittler_ID']."'";
									$_SESSION['Personen_ID']="";	
									$db_erg = mysqli_query($db,$sql);
											
									if ( ! $db_erg ){
	  									die('Ungültige Abfrage: ' . mysqli_error($db));
									}
											
									if (mysqli_num_rows($db_erg)>=1){
										echo "<section>";										
										echo "<table border='1'>";
										echo "<thead>";
										echo "<th>Vorname</th>";
										echo "<th>Nachname</th>";
										echo "<th>Geb-Datum</th>";
										echo "<th>Titel</th>";
										echo "<th></th>";
										echo "</thead>";
												
										while ($zeile = mysqli_fetch_array( $db_erg)){	
		  									echo "<form action='?page=999' method='post'>";
		  									echo "<tr>";
		  									echo "<td>". $zeile['Personen_Vorname'] . "</td>";
		  									echo "<td>". $zeile['Personen_Nachname'] . "</td>";
		  									echo "<td>". $zeile['Personen_GEB'] . "</td>";
		  									echo "<td>". $zeile['Personen_Titel'] . "</td>";
		  									echo "<td><input type='hidden' name='pers_id' value='".$zeile['Personen_ID']."'></td>";
		  									echo "<td><input type='submit' name='personen' value='Details' />";
											echo "</tr>";
											echo "</form>";
										}
										echo "</table>";
										echo "</section>";
												
									}
								
									mysqli_free_result( $db_erg );
									
								?>
								<a href="?page=250" class="button">Neue Person hinzuf&Uuml;gen</a>
			
			
								