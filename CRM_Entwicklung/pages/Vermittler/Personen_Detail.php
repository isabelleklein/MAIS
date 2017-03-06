<?php

if(isset($_POST['speichern'])){
	$sql = "UPDATE `Personen` SET `Personen_Anrede`='2', `Personen_Vorname`='".$_POST['vname']."', `Personen_Nachname`='".$_POST['nname']."',	`Personen_GEB`='2000-01-01',	`Personen_EMAIL`='".$_POST['mail']."', `Personen_TEL`='".$_POST['tel']."',	`Personen_MOBIL`='".$_POST['mobil']."', `Personen_DSIG`='y', `Personen_Titel`='Testtitel', `Personen_Rolle`='".$_POST['rolle']."', `Personen_Schwerpunkt`='".$_POST['schwerpunkt']."', `Personen_PRIO`='".$_POST['prio']."', `Personen_Einstellung`='".$_POST['einstellung']."', `Personen_Beziehung`='".$_POST['beziehung']."', `Personen_Kaufmotiv`='".$_POST['kaufmotiv']."', `Personen_Nachtrags_NR`='".$_POST['nachtrag']."', `Personen_Beginn`='2000-01-01', `Personen_Beginn_abw`='2000-01-01', `Personen_Taetigkeitsbeginn`='2000-01-01', `Personen_Vertragsende`='2000-01-01', `Personen_Abgangsgrund`='1', `Personen_Vertragsverhaeltnis`='Vertragsverhältnis', `Personen_BMV_ID`='".$_POST['bmv_id']."', `Personen_BMV_Beginn`='2000-01-01', `Personen_BMV_Austritt`='2000-01-01', `Personen_BMV_Punkte`='".$_POST['bmv_pkt']."', `Personen_KSR_MOD_A`='".$_POST['ksr_mod_a']."', `Personen_KSR_MOD_B`='".$_POST['ksr_mod_b']."', `Personen_Notizen`='".$_POST['notiz']."' WHERE `Personen_ID`='".$_SESSION['Personen_ID']."'";
	if (mysqli_query($db,$sql)) {
	} else {
    	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	header("Location: ?page=201");
}
if(isset($_POST['back'])){
	header("Location: ?page=201");
}


			
			if($_SESSION['Personen_ID']==""){
				require_once('function.php');	
				$new_id = new new_id();	
				$_SESSION['Personen_ID']=$new_id->id_berechnen();
				$sql = "INSERT INTO `personen` (`Personen_ID`, `Personen_Vermittler_ID`) VALUES ('".$_SESSION['Personen_ID']."','".$_SESSION['Vermittler_ID']."')";
				if (mysqli_query($db,$sql)) {
				} else {
    				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}			
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
							<label for="anr">Anrede</label>
							<div class="select-wrapper">
								<select id="anr" name="anr">
								<option value="0">- Anrede -</option>
								<option value="1">Herr</option>
								<option value="2">Frau</option>
								<option value="3">Firma</option>
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
						<div class="2u 12u$(small)">
							<label for="geb">Geb-Datum</label>
							<input id="geb" name="geb" placeholder="02.03.1990" type="date" value="<?php echo $zeile['Personen_GEB']?>" />
						</div>
						<div class="5u 12u$(small)">
							<label for="mail">E-Mail</label>
							<input id="mail" name="mail" placeholder="E-Mail" type="email" value="<?php echo $zeile['Personen_EMAIL']?>" />
						</div>
						<div class="5u 15u$(small)">
							<label for="titel">Titel</label>
							<div class="select-wrapper">
								<select id="titel" name="anr">
								<option value="0">- Titel -</option>
								<option value="1">Testtitel1</option>
								<option value="2">Testtitel2</option>
								<option value="3">Testtitel3</option>
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
							<label for="dsig">DISG</label>
							<div class="select-wrapper">
								<select id="dsig" name="dsig">
								<option value="0">- DISG -</option>
								<option value="1">grün</option>
								<option value="2">rot</option>
								<option value="3">gelb</option>
								<option value="4">blau</option>
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
							<input id="beginn" name="beginn" placeholder="" type="text" value="<?php echo $zeile['Personen_Beginn']?>" />
						</div>
						<div class="5u 12u$(small)">
							<label for="beginn_abw">Beginn abweichend</label>
							<input id="beginn_abw" name="beginn_abe" placeholder="" type="text" value="<?php echo $zeile['Personen_Beginn_abw']?>" />
						</div>
						<div class="4u 12u$(small)">
							<label for="tbeginn">Tätigkeitsbeginn</label>
							<input id="tbeginn" name="tbeginn" placeholder="" type="text" value="<?php echo $zeile['Personen_Taetigkeitsbeginn']?>" />
						</div>
						<div class="4u 12u$(small)">
							<label for="ende">Vertragsende</label>
							<input id="ende" name="ende" placeholder="" type="text" value="<?php echo $zeile['Personen_Vertragsende']?>" />
						</div>
						<div class="4u 12u$(small)">
							<label for="agrund">Abgangsgrund</label>
							<div class="select-wrapper">
								<select id="agrund" name="agrund">
								<option value="0">- Abgangsgrund -</option>
								<option value="1">Kündigung Agentur</option>
								<option value="2">Kündigung FDL</option>
								<option value="3">Alter / Krankheit</option>
								<option value="4">sonstiges</option>
								</select> 
							</div>
						</div>
						<div class="6u 12u$(small)">
							<label for="ksr_mod_a">KSR-Modul A</label>
							<input id="ksr_mod_a" name="ksr_mod_a" placeholder="" type="text" value="<?php echo $zeile['Personen_KSR_MOD_A']?>" />
						</div>
						<div class="6u 12u$(small)">
							<label for="ksr_mod_b">KSR-Modul B</label>
							<input id="ksr_mod_b" name="ksr_mod_b" placeholder="" type="text" value="<?php echo $zeile['Personen_KSR_MOD_B']?>" />
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
							<input id="bmv_beginn" name="bmv_beginn" placeholder="" type="text" value="<?php echo $zeile['Personen_BMV_Beginn']?>" />
						</div>
						<div class="6u 12u$(small)">
							<label for="bmv_austritt">BMV - Austritt</label>
							<input id="bmv_austritt" name="bmv_austritt" placeholder="" type="text" value="<?php echo $zeile['Personen_BMV_Austritt']?>" />
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
<script type="text/javascript">
function showhide(divid) {
obj = document.getElementById(divid);
obj.style.display = obj.style.display == 'block' ? 'none' : 'block';
}
</script>
