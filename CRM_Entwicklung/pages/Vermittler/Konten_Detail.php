<?php

if(isset($_POST['back'])){
	openlink("202");
}

$sql = "SELECT t1.*, t3.*, t2.Konten_ZN, t2.Konten_GS, t2.Konten_OB, t2.Konten_AGT, t1.Konten_UV FROM (Konten AS t1 INNER JOIN Konten_Hierarchie AS t2 ON t1.Konten_UV = t2.Konten_UV) INNER JOIN ZAD AS t3 ON t1.Konten_ZAD = t3.ZAD_ZAD WHERE t1.Konten_UV = '".$_SESSION['Konto_ID']."'";
$db_erg = mysqli_query($db,$sql);
if ( ! $db_erg ){
	die('Ungültige Abfrage: ' . mysqli_error($db));
}
while ($zeile = mysqli_fetch_array( $db_erg)){ 
?>

<section>
	<h1 id="elements">Konto - Details</h1>
	<div class="row 200%">
		<div class="12u 12u$(medium)">
			<form action="?page=220" method="post"> 
				<div class="box">
					<div class="row uniform">
						<div class="2u 12u$(small)">
							<label for="zn">Vertriebsweg</label>
							<input id="zn" name="zn" type="text" value="<?php echo $zeile['Konten_ZN']?>" />
						</div>
						<div class="2u 12u$(small)">
							<label for="gs">Gesch&auml;ftsstelle</label>
							<input id="gs" name="gs" type="text" value="<?php echo $zeile['Konten_GS']?>" />
						</div>
						<div class="2u 12u$(small)">
							<label for="ob">OrgaBereich</label>
							<input id="ob" name="ob" type="text" value="<?php echo $zeile['Konten_OB']?>" />
						</div>
						<div class="6u 12u$(small)">
							<label for="agt">Agentur</label>
							<input id="agt" name="agt" type="text" value="<?php echo $zeile['Konten_AGT']?>" />
						</div>
					</div>				
				</div>
				<div class="12u$"><input type="hidden" name="kontakt_id" value="<?php echo $zeile['Konto_UV']?>"></div>
				<div class="12u$">
					<ul class="actions">
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
