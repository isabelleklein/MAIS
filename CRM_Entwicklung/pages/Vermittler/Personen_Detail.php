<?php

if(isset($_POST['speichern'])){
	$sql = "UPDATE `Personen` SET `Personen_Anrede`='".$_POST['anr']."', `Personen_Vorname`='".$_POST['vname']."', `Personen_Nachname`='".$_POST['nname']."',	`Personen_GEB`='".$_POST['geb']."',	`Personen_EMAIL`='".$_POST['mail']."', `Personen_TEL`='".$_POST['tel']."',	`Personen_MOBIL`='".$_POST['mobil']."', `Personen_DSIG`='".$_POST['dsig']."', `Personen_Titel`='".$_POST['titel']."', `Personen_Rolle`='".$_POST['rolle']."', `Personen_Schwerpunkt`='".$_POST['schwerpunkt']."', `Personen_PRIO`='".$_POST['prio']."', `Personen_Einstellung`='".$_POST['einstellung']."', `Personen_Beziehung`='".$_POST['beziehung']."', `Personen_Kaufmotiv`='".$_POST['kaufmotiv']."', `Personen_Nachtrags_NR`='".$_POST['nachtrag']."', `Personen_Beginn`='".$_POST['beginn']."', `Personen_Beginn_abw`='".$_POST['beginn_abw']."', `Personen_Taetigkeitsbeginn`='".$_POST['tbeginn']."', `Personen_Vertragsende`='".$_POST['ende']."', `Personen_Abgangsgrund`='".$_POST['agrund']."', `Personen_Vertragsverhaeltnis`='".$_POST['vertrag']."', `Personen_BMV_ID`='".$_POST['bmv_id']."', `Personen_BMV_Beginn`='".$_POST['bmv_beginn']."', `Personen_BMV_Austritt`='".$_POST['bmv_austritt']."', `Personen_BMV_Punkte`='".$_POST['bmv_pkt']."', `Personen_KSR_MOD_A`='".$_POST['ksr_mod_a']."', `Personen_KSR_MOD_B`='".$_POST['ksr_mod_b']."', `Personen_Notizen`='".$_POST['notiz']."' WHERE `Personen_ID`='".$_SESSION['Personen_ID']."'";

	do_sql_no_return($db, $sql, "250save");
	openlink("201");
}
if(isset($_POST['back'])){
	openlink("201");
}


			
if($_SESSION['Personen_ID']==""){
	$_SESSION['Personen_ID']=getID();
	$sql = "INSERT INTO `personen` (`Personen_ID`, `Personen_Vermittler_ID`) VALUES ('".$_SESSION['Personen_ID']."','".$_SESSION['Vermittler_ID']."')";
	do_sql_no_return($db, $sql, "250insert");		
}
			
$sql = "SELECT t1.* FROM Personen as t1 WHERE t1.Personen_ID = '".$_SESSION['Personen_ID']."'";
$db_erg = mysqli_query($db,$sql);
if ( ! $db_erg ){
	die('Ungültige Abfrage: ' . mysqli_error($db));
}
while ($zeile = mysqli_fetch_array( $db_erg)){ 
?>

<section>
	<h1 id="elements">Personendetails</h1>
	<a href="#" onclick="showhide('mv_details');return false;" class="button">Details MaklerVertrieb</a>
	<a href="#" onclick="showhide('ev_details');return false;" class="button">Details ExklusivVertrieb</a>
	<br><br>
	<div class="row 200%">
		<!-- class="6u 12u$(medium)" bedeutet halbe Seite-->
		<!-- class="12u 12u$(medium)" bedeutet ganze Seite-->
		<div class="12u 12u$(medium)">
			<!-- Form -->
			<form action="?page=250" method="post"> 
				<div class="box">
					<div class="row uniform">
						<div class="2u 15u$(small)">
							<label for="anr">Anrede:</label>
							<?php
								$sql_option = "SELECT * FROM Index_Anrede";
								$result = mysqli_query($db,$sql_option);
								$options = "<option value='0'".($zeile['Anrede_ID'] == "0" ? "selected":"").">- Anrede -</option>";
								while ($row = mysqli_fetch_array($result)){
									$options .= "<option value ='".$row["Anrede_ID"]."' ".($zeile['Personen_Anrede'] == $row["Anrede_ID"] ? "selected":"").">".$row["Anrede_Bez"]."</option>n";
								}								
							?>
							<div class="select-wrapper">
								<select id="anr" name="anr">
								<?php
									echo $options;
								?>
								</select> 
							</div>
						</div>
						<div class="6u 12u$(small)">
							<label for="nname">Nachname</label>
							<input id="nname" name="nname" placeholder="Nachname" type="text" value="<?php echo $zeile['Personen_Nachname']?>" />
						</div>
						<div class="4u 12u$(small)">
							<label for="vname">Vorname</label>
							<input id="vname" name="vname" placeholder="Vorname" type="text" value="<?php echo $zeile['Personen_Vorname']?>" />
						</div>
						<div class="3u 12u$(small)">
							<label for="geb">Geb-Datum</label>
							<input id="geb" name="geb" placeholder="" type="date" value="<?php echo $zeile['Personen_GEB']?>" />
						</div>
						<div class="5u 12u$(small)">
							<label for="mail">E-Mail</label>
							<input id="mail" name="mail" placeholder="E-Mail" type="email" value="<?php echo $zeile['Personen_EMAIL']?>" />
						</div>
						<div class="4u 15u$(small)">
							<label for="titel">Titel:</label>
							<?php
								$sql_option = "SELECT * FROM Index_Personen_Titel";
								$result = mysqli_query($db,$sql_option);
								$options = "<option value='0'".($zeile['Titel_ID'] == "0" ? "selected":"").">- Titel -</option>";
								while ($row = mysqli_fetch_array($result)){
									$options .= "<option value ='".$row["Titel_ID"]."' ".($zeile['Personen_Titel'] == $row["Titel_ID"] ? "selected":"").">".$row["Titel_Bez"]."</option>n";
								}								
							?>
							<div class="select-wrapper">
								<select id="titel" name="titel">
								<?php
									echo $options;
								?>
								</select> 
							</div>
						</div>
						<div class="6u 12u$(small)">
							<label for="tel">Telefon</label>
							<input id="tel" name="tel" placeholder="Telefon" type="text" value="<?php echo $zeile['Personen_TEL']?>" />
						</div>
						<div class="6u 12u$(small)">
							<label for="mobil">Mobil</label>
							<input id="mobil" name="mobil" placeholder="Mobil" type="text" value="<?php echo $zeile['Personen_MOBIL']?>" />
						</div>
						<div class="12u$">
							<textarea id="notiz" name="notiz" placeholder="Notizen" rows="6"><?php echo $zeile['Personen_Notizen']?></textarea>
						</div>
					</div>
				</div>
				<div id="mv_details" style="display: none">
				<h2 id="elements">Personendetails - MaklerVertrieb</h2>
				<div class="box">
					<div class="row uniform">
						<div class="2u 15u$(small)">
							<label for="disg">DISG - Modell:</label>
							<?php
								$sql_option = "SELECT * FROM Index_DSIG";
								$result = mysqli_query($db,$sql_option);
								$options = "<option value='0'".($zeile['DSIG_ID'] == "0" ? "selected":"").">- DISG -</option>";
								while ($row = mysqli_fetch_array($result)){
									$options .= "<option value ='".$row["DSIG_ID"]."' ".($zeile['Personen_DSIG'] == $row["DSIG_ID"] ? "selected":"").">".$row["DSIG_Bez"]."</option>n";
								}								
							?>
							<div class="select-wrapper">
								<select id="disg" name="disg">
								<?php
									echo $options;
								?>
								</select> 
							</div>
						</div>
						<div class="4u 12u$(small)">
							<label for="prio">Priorität</label>
							<input id="prio" name="prio" placeholder="Priorität" type="text" value="<?php echo $zeile['Personen_PRIO']?>" />
						</div>
						<div class="6u 12u$(small)">
							<label for="rolle">Rolle</label>
							<input id="rolle" name="rolle" placeholder="Rolle" type="text" value="<?php echo $zeile['Personen_Rolle']?>" />
						</div>
						<div class="6u 12u$(small)">
							<label for="schwerpunkt">Schwerpunkt</label>
							<input id="schwerpunkt" name="schwerpunkt" placeholder="Schwerpunkt" type="text" value="<?php echo $zeile['Personen_Schwerpunkt']?>" />
						</div>
						<div class="6u 12u$(small)">
							<label for="kaufmotiv">Kaufmotiv</label>
							<input id="kaufmotiv" name="kaufmotiv" placeholder="Kaufmotiv" type="text" value="<?php echo $zeile['Personen_Kaufmotiv']?>" />
						</div>
						<div class="6u 12u$(small)">
							<label for="einstellung">Einstellung</label>
							<input id="einstellung" name="einstellung" placeholder="Einstellung" type="text" value="<?php echo $zeile['Personen_Einstellung']?>" />
						</div>
						<div class="6u 12u$(small)">
							<label for="beziehung">Beziehung</label>
							<input id="beziehung" name="beziehung" placeholder="Beziehung" type="text" value="<?php echo $zeile['Personen_Beziehung']?>" />
						</div>
					</div>
				</div>
				</div>
				<div id="ev_details" style="display: none">
				<h2 id="elements">Personendetails - ExklusivVertrieb</h2>
				<div class="box">
					<div class="row uniform">
						<div class="2u 12u$(small)">
							<label for="nachtrag">Nachtrags-Nr</label>
							<input id="nachtrag" name="nachtrag" placeholder="" type="text" value="<?php echo $zeile['Personen_Nachtrags_NR']?>" />
						</div>
						<div class="5u 12u$(small)">
							<label for="beginn">Beginn</label>
							<input id="beginn" name="beginn" placeholder="" type="date" value="<?php echo $zeile['Personen_Beginn']?>" />
						</div>
						<div class="5u 12u$(small)">
							<label for="beginn_abw">Beginn abweichend</label>
							<input id="beginn_abw" name="beginn_abw" placeholder="" type="date" value="<?php echo $zeile['Personen_Beginn_abw']?>" />
						</div>
						<div class="4u 12u$(small)">
							<label for="tbeginn">Tätigkeitsbeginn</label>
							<input id="tbeginn" name="tbeginn" placeholder="" type="date" value="<?php echo $zeile['Personen_Taetigkeitsbeginn']?>" />
						</div>
						<div class="4u 12u$(small)">
							<label for="ende">Vertragsende</label>
							<input id="ende" name="ende" placeholder="" type="date" value="<?php echo $zeile['Personen_Vertragsende']?>" />
						</div>
						<div class="4u 12u$(small)">
							<label for="agrund">Abgangsgrund:</label>
							<?php
								$sql_option = "SELECT * FROM Index_Abgangsgrund";
								$result = mysqli_query($db,$sql_option);
								$options = "<option value='0'".($zeile['Abgangsgrund_ID'] == "0" ? "selected":"").">- Abgangsgrund -</option>";
								while ($row = mysqli_fetch_array($result)){
									$options .= "<option value ='".$row["Abgangsgrund_ID"]."' ".($zeile['Personen_Abgangsgrund'] == $row["Abgangsgrund_ID"] ? "selected":"").">".$row["Abgangsgrund_Bez"]."</option>n";
								}								
							?>
							<div class="select-wrapper">
								<select id="agrund" name="agrund">
								<?php
									echo $options;
								?>
								</select> 
							</div>
						</div>
						<div class="12u 12u$(small)">
							<label for="vertrag">Vertragsverh&auml;ltnis</label>
							<input id="vertrag" name="vertrag" placeholder="" type="text" value="<?php echo $zeile['Personen_Vertragsverhaeltnis']?>" />
						</div>
						<div class="6u 12u$(small)">
							<label for="ksr_mod_a">KSR-Modul A</label>
							<input id="ksr_mod_a" name="ksr_mod_a" placeholder="" type="date" value="<?php echo $zeile['Personen_KSR_MOD_A']?>" />
						</div>
						<div class="6u 12u$(small)">
							<label for="ksr_mod_b">KSR-Modul B</label>
							<input id="ksr_mod_b" name="ksr_mod_b" placeholder="" type="date" value="<?php echo $zeile['Personen_KSR_MOD_B']?>" />
						</div>
						<div class="6u 12u$(small)">
							<label for="bmv_id">BMV - ID</label>
							<input id="bmv_id" name="bmv_id" placeholder="BMV - ID" type="text" value="<?php echo $zeile['Personen_BMV_ID']?>" />
						</div>
						<div class="6u 12u$(small)">
							<label for="bmv_pkt">BMV - Punkte</label>
							<input id="bmv_pkt" name="bmv_pkt" placeholder="BMV - Punkte" type="text" value="<?php echo $zeile['Personen_BMV_Punkte']?>" />
						</div>
						<div class="6u 12u$(small)">
							<label for="bmv_beginn">BMV - Beginn</label>
							<input id="bmv_beginn" name="bmv_beginn" placeholder="" type="date" value="<?php echo $zeile['Personen_BMV_Beginn']?>" />
						</div>
						<div class="6u 12u$(small)">
							<label for="bmv_austritt">BMV - Austritt</label>
							<input id="bmv_austritt" name="bmv_austritt" placeholder="" type="date" value="<?php echo $zeile['Personen_BMV_Austritt']?>" />
						</div>
					</div>
				</div>
				</div>
				<div class="12u$"><input type="hidden" name="pers_id" value="<?php echo $zeile['Personen_ID']?>"></div>
				<div class="12u$">
					<ul class="actions">
						<li><input class="special" type="submit" value="Speichern" name="speichern" /></li>
						<li><input type="submit" value="Zur&uuml;ck" name="back"/></li>
					</ul>
				</div>
			</form>
		</div>
	</div>
</section>
<?php 
	} 
?>
<section>
	<h2>Vollmachten</h2>

<?php

$sql = "SELECT t1.*, t2.Vollm_Bezeichnung FROM `Vollmachten` as t1 LEFT JOIN `Index_Vollmachten` as t2 ON t1.Vollm_Bez_ID = t2.Vollm_Bez_ID WHERE t1.Vollm_Personen_ID = '".$_SESSION['Personen_ID']."'";
$_SESSION['Vollm_ID']="";	
$db_erg = mysqli_query($db,$sql);
		
if ( ! $db_erg ){
	die('Ungültige Abfrage: ' . mysqli_error($db));
}
		
if (mysqli_num_rows($db_erg)>=1){
	echo "<section>";										
	echo "<table border='1'>";
	echo "<thead>";
	echo "<th>Bezeichnung</th>";
	echo "<th>G&uuml;ltig von</th>";
	echo "<th>G&uuml;ltig bis</th>";
	echo "<th>Notiz</th>";
	echo "<th></th>";
	echo "</thead>";
			
	while ($zeile = mysqli_fetch_array( $db_erg)){	
		echo "<form action='?page=999' method='post'>";
		echo "<tr>";
		echo "<td>". $zeile['Vollm_Bezeichnung'] . "</td>";
		echo "<td>". $zeile['Vollm_GUV'] . "</td>";
		echo "<td>". $zeile['Vollm_GUB'] . "</td>";
		echo "<td>". $zeile['Vollm_Notizen'] . "</td>";
		echo "<td><input type='hidden' name='vollm_id' value='".$zeile['Vollm_ID']."'></td>";
		echo "<td><input type='submit' name='vollm' value='Details' />";
		echo "</tr>";
		echo "</form>";
	}
	echo "</table>";
	echo "</section>";
			
}

mysqli_free_result( $db_erg );
								
?>									
	<a class="button" href="?page=290">Neue Vollmacht hinzuf&Uuml;gen</a> 
</section>
