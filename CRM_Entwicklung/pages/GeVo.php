<section>
	<header class="main">
		<h2>Gesch&auml;ftsvorf&auml;lle</h2>
	</header>
</section>

<form action="?page=500" method="post">
	<div class="box">
		<div class="row uniform">
			<div class="12u$">
				<label for="sart">Vorgangsart</label>
				<input id="sart" name="sart" placeholder="Vorgangsart" type="text"/>
			</div>
			<div class="12u$">
				<label for="sstatus">Vorgangsstatus</label>
				<input id="sstatus" name="sstatus" placeholder="Vorgangsstatus" type="text"/>
			</div>
			<div class="12u$">
				<label for="sverant">Verantwortlich</label>
				<input id="sverant" name="sverant" placeholder="Verantwortlich" type="text"/>
			</div>
			
			<div class="6u 12u$(small)">
				<label for="gs">Gesch&auml;ftsstelle</label>
				<input id="gs" name="gs" placeholder="GS" type="text"/>
			</div>
			<div class="6u 12u$(small)">
				<label for="asnr">Vermittler-Nummer</label>
				<input id="asnr" name="asnr" placeholder="ASNR" type="text"/>
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
		if(isset($_POST['sart'])){
			if($filter ==""){
				$filter = "t3.GeVo_Vorgangsart='".$_POST['sart']."'";
			}else{
				$filter .= " and t3.GeVo_Vorgangsart='".$_POST['sart']."'";
			}
		}
		if(isset($_POST['sstatus'])){
			if($filter ==""){
				$filter = "t3.GeVo_Status='".$_POST['sstatus']."'";
			}else{
				$filter .= " and t3.GeVo_Status='".$_POST['sstatus']."'";
			}
		}
		if(isset($_POST['sverant'])){
			if($filter ==""){
				$filter = "t3.GeVo_Person_Verantwortlich='".$_POST['sverant']."'";
			}else{
				$filter .=" and t3.GeVo_Person_Verantwortlich='".$_POST['sverant']."'";
			}
		}
		if(isset($_POST['gs'])){
			if($filter ==""){
				$filter = "t3.GeVo_GS='".$_POST['gs']."'";
			}else{
				$filter .=" and t3.GeVo_GS='".$_POST['gs']."'";
			}
		}
		if(isset($_POST['asnr'])){
			if($filter ==""){
				$filter = "t3.GeVo_ASNR='".$_POST['asnr']."'";
			}else{
				$filter .=" and t3.GeVo_ASNR='".$_POST['asnr']."'";
			}
		}	
		echo $filter;	
		$sql ="SELECT t3.*, t4.ZAD_Name, t1.Vermittler_ID FROM ZAD as t4 RIGHT JOIN (Vermittler_Konto as t1 RIGHT JOIN (Konten as t2 RIGHT JOIN GeVo_Vorgang as t3 ON t2.Konten_UV = t3.GeVo_ASNR) ON t1.UV = t2.Konten_UV) ON t4.ZAD_ZAD = t2.Konten_ZAD WHERE ".$filter.";";
	} else {
		$sql ="SELECT t3.*, t4.ZAD_Name, t1.Vermittler_ID FROM ZAD as t4 RIGHT JOIN (Vermittler_Konto as t1 RIGHT JOIN (Konten as t2 RIGHT JOIN GeVo_Vorgang as t3 ON t2.Konten_UV = t3.GeVo_ASNR) ON t1.UV = t2.Konten_UV) ON t4.ZAD_ZAD = t2.Konten_ZAD;";
	}

	$_SESSION['GeVo_ID']="";	
	$db_erg = mysqli_query($db,$sql);
			
	if ( ! $db_erg ){
		die('Ungültige Abfrage: ' . mysqli_error($db));
	}
			
	if (mysqli_num_rows($db_erg)>=1){
		echo "<section>";										
		echo "<table border='1'>";
		echo "<thead>";
		echo "<th>Eingang</th>";
		echo "<th>ASNR</th>";
		echo "<th>Vermittler</th>";
		echo "<th>Vorgangsart</th>";
		echo "<th>Bearbeitungsart</th>";
		echo "<th>Info</th>";
		echo "<th>Status</th>";
		echo "<th>Zuständig</th>";
		echo "</thead>";
				
		while ($zeile = mysqli_fetch_array( $db_erg)){	
			echo "<form action='?page=999' method='post'>";
			echo "<tr>";
			echo "<td>". $zeile['GeVo_Eingang'] . "</td>";
			echo "<td>". $zeile['GeVo_ASNR'] . "</td>";
			echo "<td>". $zeile['ZAD_Name'] . "</td>";
			echo "<td>". $zeile['GeVo_Vorgangsart'] . "</td>";
			echo "<td>". $zeile['GeVo_Bearbeitungsart'] . "</td>";
			echo "<td>". $zeile['GeVo_Infofeld'] . "</td>";
			echo "<td>". $zeile['GeVo_Status'] . "</td>";
			echo "<td>". $zeile['GeVo_Person_Verantwortlich'] . "</td>";
			echo "<td><input type='hidden' name='gevo_id' value='".$zeile['GeVo_ID']."NAVI'></td>";
			echo "<td><input type='submit' name='gevo' value='Details' />";
			echo "</tr>";
			echo "</form>";
		}
		echo "</table>";
		echo "</section>";			
	}
	mysqli_free_result( $db_erg );	
?>
	<a class="button" href="?page=501&her=n">Neuen Gesch&auml;ftsvorfall hinzuf&Uuml;gen</a> 
	