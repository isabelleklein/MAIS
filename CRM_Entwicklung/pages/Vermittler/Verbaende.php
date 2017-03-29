<?php

if(isset($_POST['speichern'])){
	$sql = "UPDATE `Verbaende` SET `Verb_Verb_ID`='".$_POST['verb']."', `Verb_GUV`='".$_POST['guv']."' , `Verb_GUB`='".$_POST['gub']."' , `Verb_MitglNR`='".$_POST['nr']."' , `Verb_Wertung_MVG`='".$_POST['wert']."' WHERE `Verb_ID`='".$_SESSION['Verb_ID']."'";
	do_sql_no_return($db, $sql, "280save");
	openlink("200");
}
if(isset($_POST['back'])){
	openlink("200");
}

if($_SESSION['Verb_ID']==""){
	$_SESSION['Verb_ID']=getID();
	$sql = "INSERT INTO `Verbaende` (`Verb_ID`, `Verb_Vermittler_ID`) VALUES ('".$_SESSION['Verb_ID']."','".$_SESSION['Vermittler_ID']."')";
	do_sql_no_return($db, $sql, "280insert");
}

$sql = "SELECT t1.* FROM Verbaende as t1 WHERE t1.Verb_ID = '".$_SESSION['Verb_ID']."'";
$db_erg = mysqli_query($db,$sql);
if ( ! $db_erg ){
	die('Ungültige Abfrage: ' . mysqli_error($db));
}
while ($zeile = mysqli_fetch_array( $db_erg)){ 
?>
<section>
	<h1 id="elements">Vermittler - Verband</h1>
	<div class="row 200%">
		<div class="12u 12u$(medium)">
			<form action="?page=280" method="post"> 
				<div class="box">
					<div class="row uniform">
						<div class="12u$">
							<label for="art">Verband:</label>
							<?php
								$sql_option = "SELECT * FROM Index_Verbaende";
								$result = mysqli_query($db,$sql_option);
								$options = "<option value='0'".($zeile['Verb_ID'] == "0" ? "selected":"").">- Verband-</option>";
								while ($row = mysqli_fetch_array($result)){
									$options .= "<option value ='".$row["Verb_ID"]."' ".($zeile['Verb_Verb_ID'] == $row["Verb_ID"] ? "selected":"").">".$row["Verb_Bezeichnung"]."</option>n";
								}								
							?>
							<div class="select-wrapper">
								<select id="art" name="art">
								<?php
									echo $options;
								?>
								</select> 
							</div>
						</div>
						<div class="12u$">
							<label for="guv">G&uuml;ltig von:</label>
							<input id="guv" name="guv" type="date" value="<?php echo $zeile['Verb_GUV']?>" />
						</div>
						<div class="12u$">
							<label for="gub">G&uuml;ltig bis:</label>
							<input id="gub" name="gub" type="date" value="<?php echo $zeile['Verb_GUB']?>" />
						</div>
						<div class="12u$">
							<label for="nr">Mitlgieds-Nr:</label>
							<input id="nr" name="nr" placeholder="Mitglieds-Nr" type="text" value="<?php echo $zeile['Verb_MitglNR']?>" />
						</div>
						<div class="12u$">
							<label for="wert">Wertung_MVG:</label>
							<div class="select-wrapper">
								<select id="wert" name="wert">
								<option value="0" <?php if ($zeile['Verb_Wertung_MVG']=="0"){echo "selected";} ?>>- Wertung -</option>
								<option value="1" <?php if ($zeile['Verb_Wertung_MVG']=="1"){echo "selected";} ?>>Ja</option>
								<option value="2" <?php if ($zeile['Verb_Wertung_MVG']=="2"){echo "selected";} ?>>Nein</option>
								</select> 
							</div>
						</div>

					</div>
				</div>
				<div class="12u$"><input type="hidden" name="verd_id" value="<?php echo $zeile['Verb_ID']?>"></div>
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