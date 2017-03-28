<?php

if(isset($_POST['speichern'])){
	$sql = "UPDATE `Vollmachten` SET `Vollm_Bez_ID`='".$_POST['bez']."', `Vollm_GUV`='".$_POST['guv']."' , `Vollm_GUB`='".$_POST['gub']."' , `Vollm_Erlaeuterung`='".$_POST['erl']."' , `Vollm_Notizen`='".$_POST['notiz']."' WHERE `Vollm_ID`='".$_SESSION['Vollm_ID']."'";
	do_sql_no_return($db, $sql, "290save");
	openlink("250");
}
if(isset($_POST['back'])){
	openlink("250");
}

if($_SESSION['Vollm_ID']==""){
	$_SESSION['Vollm_ID']=getID();
	$sql = "INSERT INTO `Vollmachten` (`Vollm_ID`, `Vollm_Personen_ID`, `Vollm_Erfasser`) VALUES ('".$_SESSION['Vollm_ID']."','".$_SESSION['Personen_ID']."','".$_SESSION['user_id']."')";
	do_sql_no_return($db, $sql, "290insert");
}

$sql = "SELECT DISTINCT t1.*, t2.Vollm_Bezeichnung FROM `Vollmachten` as t1 LEFT JOIN `Index_Vollmachten` as t2 ON t1.Vollm_Bez_ID = t2.Vollm_Bez_ID WHERE t1.Vollm_ID = '".$_SESSION['Vollm_ID']."'";
$db_erg = mysqli_query($db,$sql);
if ( ! $db_erg ){
	die('Ungültige Abfrage: ' . mysqli_error($db));
}
while ($zeile = mysqli_fetch_array( $db_erg)){ 
?>
<section>
	<h1 id="elements">Vollmacht</h1>
	<div class="row 200%">
		<div class="12u 12u$(medium)">
			<form action="?page=290" method="post"> 
				<div class="box">
					<div class="row uniform">
						<div class="12u$">
							<label for="bez">Bezeichnung:</label>
							<?php
								$sql_option = "SELECT * FROM Index_Vollmachten";
								$result = mysqli_query($db,$sql_option);
								$options = "<option value='0'".($zeile['Vollm_Bez_ID'] == "0" ? "selected":"").">- Bezeichnung -</option>";
								while ($row = mysqli_fetch_array($result)){
									$options .= "<option value ='".$row["Vollm_Bez_ID"]."' ".($zeile['Vollm_Bez_ID'] == $row["Vollm_Bez_ID"] ? "selected":"").">".$row["Vollm_Bezeichnung"]."</option>n";
								}								
							?>
							<div class="select-wrapper">
								<select id="bez" name="bez">
								<?php
									echo $options;
								?>
								</select> 
							</div>
						</div>
						<div class="12u$">
							<label for="guv">G&uuml;ltig von:</label>
							<input id="guv" name="guv" type="date" value="<?php echo $zeile['Vollm_GUV']?>" />
						</div>
						<div class="12u$">
							<label for="gub">G&uuml;ltig bis:</label>
							<input id="gub" name="gub" type="date" value="<?php echo $zeile['Vollm_GUB']?>" />
						</div>
						<div class="12u$">
							<label for="erl">Erl&auml;uterung:</label>
							<textarea id="erl" name="erl" placeholder="Erl&auml;uterung" rows="6"><?php echo $zeile['Vollm_Erlaeuterung']?></textarea>
						</div>
						<div class="12u$">
							<label for="notiz">Notizen:</label>
							<textarea id="notiz" name="notiz" placeholder="Notizen" rows="6"><?php echo $zeile['Vollm_Notizen']?></textarea>
						</div>
					</div>
				</div>
				<div class="12u$"><input type="hidden" name="vollm_id" value="<?php echo $zeile['Vollm_ID']?>"></div>
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