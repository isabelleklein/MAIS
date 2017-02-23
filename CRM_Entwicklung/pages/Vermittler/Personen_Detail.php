<?php
			
			if($_SESSION['Personen_ID']=""){
				echo id_berechnen();
				$sql = "INSERT INTO Personen (Personen_ID, Vermittler_ID) VALUES ('".id_berechnen()."','".$_SESSION['Vermittler_ID']."')";
				if (mysqli_query($db,$sql)) {
    				echo "New record created successfully";
				} else {
    				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}
			
			}
			$sql = "SELECT t1.* FROM Personen as t1 WHERE t1.Personen_ID = '".$_SESSION['Personen_ID']."'";
			$db_erg = mysqli_query($db,$sql);
			if ( ! $db_erg ){
	  			die('Ungültige Abfrage: ' . mysqli_error($db));
			}
			
			echo $_SESSION['Personen_ID']." hier sollte die Personen_ID vorne dran stehen";
			while ($zeile = mysqli_fetch_array( $db_erg)){ 		
?>
<section>
	<header class="main">
		<h1>Personen&uuml;bersicht</h1>
	</header>
	<!-- Elements -->
	<h2 id="elements">Personendetails</h2>
	<div class="row 200%">
		<!-- Spalte 1 -->
		<!-- class="6u 12u$(medium)" bedeutet halbe Seite-->
		<!-- class="12u 12u$(medium)" bedeutet ganze Seite-->
		<div class="12u 12u$(medium)">
			<!-- Form -->
			<form action="#" method="post">
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
								</select> </div>
						</div>
						<div class="6u 12u$(small)">
							<label for="nname">Nachname</label>
							<input id="nname" name="bname" placeholder="Nachname" type="text" value="" />
						</div>
						<div class="4u 12u$(small)">
							<label for="vname">Vorname</label>
							<input id="vname" name="vname" placeholder="Vorname" type="text" value="" />
						</div>
						<div class="2u 12u$(small)">
							<label for="geb">Geb-Datum</label>
							<input id="geb" name="geb" placeholder="" type="date" value="" />
						</div>
						<div class="5u 12u$(small)">
							<label for="mail">E-Mail</label>
							<input id="mail" name="mail" placeholder="E-Mail" type="email" value="" />
						</div>
						<div class="5u 15u$(small)">
							<label for="titel">Titel</label>
							<div class="select-wrapper">
								<select id="titel" name="anr">
								<option value="0">- Titel -</option>
								<option value="1">Testtitel1</option>
								<option value="2">Testtitel2</option>
								<option value="3">Testtitel3</option>
								</select> </div>
						</div>
						<div class="6u 12u$(small)">
							<label for="tel">Telefon</label>
							<input id="tel" name="tel" placeholder="Telefon" type="text" value="" />
						</div>
						<div class="6u 12u$(small)">
							<label for="mobil">Mobil</label>
							<input id="mobil" name="mobil" placeholder="Mobil" type="text" value="" />
						</div>
						<div class="12u$">
							<textarea id="notiz" name="notiz" placeholder="Notizen" rows="6"></textarea>
						</div>
					</div>
				</div>
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
								</select> </div>
						</div>
						<div class="4u 12u$(small)">
							<label for="prio">Priorität</label>
							<input id="prio" name="prio" placeholder="Priorität" type="text" value="" />
						</div>
						<div class="6u 12u$(small)">
							<label for="rolle">Rolle</label>
							<input id="rolle" name="rolle" placeholder="Rolle" type="text" value="" />
						</div>
						<div class="6u 12u$(small)">
							<label for="schwerpunkt">Schwerpunkt</label>
							<input id="schwerpunkt" name="schwerpunkt" placeholder="Schwerpunkt" type="text" value="" />
						</div>
						<div class="6u 12u$(small)">
							<label for="kaufmotiv">Kaufmotiv</label>
							<input id="kaufmotiv" name="kaufmotiv" placeholder="Kaufmotiv" type="text" value="" />
						</div>
						<div class="6u 12u$(small)">
							<label for="einstellung">Einstellung</label>
							<input id="einstellung" name="einstellung" placeholder="Einstellung" type="text" value="" />
						</div>
						<div class="6u 12u$(small)">
							<label for="beziehung">Beziehung</label>
							<input id="beziehung" name="beziehung" placeholder="Beziehung" type="text" value="" />
						</div>
					</div>
				</div>
				<h2 id="elements">Personendetails - ExklusivVertrieb</h2>
				<div class="box">
					<div class="row uniform">
						<div class="2u 12u$(small)">
							<label for="nachtrag">Nachtrags-Nr</label>
							<input id="nachtrag" name="nachtrag" placeholder="" type="text" value="" />
						</div>
						<div class="5u 12u$(small)">
							<label for="beginn">Beginn</label>
							<input id="beginn" name="beginn" placeholder="" type="text" value="" />
						</div>
						<div class="5u 12u$(small)">
							<label for="beginn_abw">Beginn abweichend</label>
							<input id="beginn_abw" name="beginn_abe" placeholder="" type="text" value="" />
						</div>
						<div class="4u 12u$(small)">
							<label for="tbeginn">Tätigkeitsbeginn</label>
							<input id="tbeginn" name="tbeginn" placeholder="" type="text" value="" />
						</div>
						<div class="4u 12u$(small)">
							<label for="ende">Vertragsende</label>
							<input id="ende" name="ende" placeholder="" type="text" value="" />
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
								</select> </div>
						</div>
						<div class="6u 12u$(small)">
							<label for="ksr_mod_a">KSR-Modul A</label>
							<input id="ksr_mod_a" name="ksr_mod_a" placeholder="" type="text" value="" />
						</div>
						<div class="6u 12u$(small)">
							<label for="ksr_mod_b">KSR-Modul B</label>
							<input id="ksr_mod_b" name="ksr_mod_b" placeholder="" type="text" value="" />
						</div>
						<div class="6u 12u$(small)">
							<label for="bmv_id">BMV - ID</label>
							<input id="bmv_id" name="bmv_id" placeholder="BMV - ID" type="text" value="" />
						</div>
						<div class="6u 12u$(small)">
							<label for="bmv_pkt">BMV - Punkte</label>
							<input id="bmv_pkt" name="bmv_pkt" placeholder="BMV - Punkte" type="text" value="" />
						</div>
						<div class="6u 12u$(small)">
							<label for="bmv_beginn">BMV - Beginn</label>
							<input id="bmv_beginn" name="bmv_beginn" placeholder="" type="text" value="" />
						</div>
						<div class="6u 12u$(small)">
							<label for="bmv_austritt">BMV - Austritt</label>
							<input id="bmv_austritt" name="bmv_austritt" placeholder="" type="text" value="" />
						</div>
					</div>
				</div>
				<div class="12u$">
					<ul class="actions">
						<li>
						<input class="special" type="submit" value="Speichern" /></li>
						<li><input type="reset" value="Reset" /></li>
					</ul>
				</div>
			</form>
		</div>
	</div>
</section>
<?php 
	}
?>