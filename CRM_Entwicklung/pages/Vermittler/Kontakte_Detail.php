<?php

if(isset($_POST['speichern'])){
	$sql = "UPDATE `Kontakte` SET `Kontakt_Datum`='".$_POST['datum']."', `Kontakt_Art`='".$_POST['art']."', `Kontakt_Anlass`='".$_POST['anlass']."', `Kontakt_Details`='".$_POST['detail']."', `Kontakt_Ergebnis`='".$_POST['erg']."', `Kontakt_Wiedervorlage`='".$_POST['wvl']."' WHERE `Kontakt_ID`='".$_SESSION['Kontakt_ID']."'";
	do_sql_no_return($db, $sql, "260save");
	openlink("204");
}
if(isset($_POST['back'])){
	openlink("204");
}
			
if($_SESSION['Kontakt_ID']==""){
	$_SESSION['Kontakt_ID']=getID();
	$sql = "INSERT INTO `Kontakte` (`Kontakt_ID`, `Kontakt_Vermittler_ID`) VALUES ('".$_SESSION['Kontakt_ID']."','".$_SESSION['Vermittler_ID']."')";
	do_sql_no_return($db, $sql, "260insert");		
}
$sql = "SELECT t1.* FROM Kontakte as t1 WHERE t1.Kontakt_ID = '".$_SESSION['Kontakt_ID']."'";
$db_erg = mysqli_query($db,$sql);
if ( ! $db_erg ){
	die('Ungültige Abfrage: ' . mysqli_error($db));
}
while ($zeile = mysqli_fetch_array( $db_erg)){ 
?>

<section>
	<h1 id="elements">Kontaktdetails</h1>
	<div class="row 200%">
		<div class="12u 12u$(medium)">
			<form action="Kontakte_Detail.php?page=260" method="post"> 
				<div class="box">
					<div class="row uniform">
						<div class="12u$(small)">
							<label for="datum">Kontaktdatum</label>
							<input id="datum" name="datum" type="date" value="<?php echo $zeile['Kontakt_Datum']?>" />
						</div>
						<div class="12u$">
							<label for="art">Kontaktart:</label>
							<?php
								$sql_option = "SELECT * FROM Index_Kontaktarten";
								$result = mysqli_query($db,$sql_option);
								$options = "<option value='0'".($zeile['Kontakt_Art'] == "0" ? "selected":"").">- Kontaktart -</option>";
								while ($row = mysqli_fetch_array($result)){
									$options .= "<option value ='".$row["Kontaktart_ID"]."' ".($zeile['Kontakt_Art'] == $row["Kontaktart_ID"] ? "selected":"").">".$row["Kontaktart_Bez"]."</option>n";
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
							<label for="anlass">Kontaktanlass:</label>
							<?php
								$sql_option = "SELECT * FROM Index_Kontaktanlass";
								$result = mysqli_query($db,$sql_option);
								$options = "<option value='0'".($zeile['Kontakt_Anlass'] == "0" ? "selected":"").">- Kontaktanlass -</option>";
								while ($row = mysqli_fetch_array($result)){
									$options .= "<option value ='".$row["Kontaktanlass_ID"]."' ".($zeile['Kontakt_Anlass'] == $row["Kontaktanlass_ID"] ? "selected":"").">".$row["Kontaktanlass_Bez"]."</option>n";
								}								
							?>
							<div class="select-wrapper">
								<select id="anlass" name="anlass">
								<?php
									echo $options;
								?>
								</select> 
							</div>
						</div>
						<div class="12u$">
							<label for="detail">Details</label>
							<textarea id="detail" name="detail" placeholder="Details" rows="6"><?php echo $zeile['Kontakt_Details']?></textarea>
						</div>
						<div class="12u$">
							<label for="erg">Ergebnis</label>
							<textarea id="erg" name="erg" placeholder="Ergebnis" rows="6"><?php echo $zeile['Kontakt_Ergebnis']?></textarea>
						</div>
						<div class="12u$(small)">
							<label for="wvl">Wiedervorlage</label>
							<input id="wvl" name="wvl" type="date" value="<?php echo $zeile['Kontakt_Wiedervorlage']?>" />
						</div>
					</div>
				</div>
				<div class="12u$"><input type="hidden" name="kontakt_id" value="<?php echo $zeile['Kontakt_ID']?>"></div>
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
