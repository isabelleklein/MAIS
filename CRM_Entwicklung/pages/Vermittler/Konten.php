
<!-- Content -->
<section>
	<header class="main">
		<h1>Vermittler-Konten</h1>
	</header>
</section>

<h3>Konten-&Uuml;bersicht</h3>

<?php 
	$sql = "SELECT t1.Vermittler_ID, t3.*, t5.*, t4.Konten_ZN, t4.Konten_GS, t4.Konten_OB, t4.Konten_AGT FROM (((Vermittler AS t1 LEFT JOIN Vermittler_Konto AS t2 ON t1.Vermittler_ID = t2.Vermittler_ID) LEFT JOIN Konten AS t3 ON t2.UV = t3.Konten_UV) LEFT JOIN Konten_Hierarchie AS t4 ON t2.UV = t4.Konten_UV) LEFT JOIN ZAD AS t5 ON t3.Konten_ZAD = t5.ZAD_ZAD WHERE t1.Vermittler_ID='".$_SESSION['Vermittler_ID']."'";
	$_SESSION['Konten_ID']="";	
	$db_erg = mysqli_query($db,$sql);
			
	if ( ! $db_erg ){
		die('Ungültige Abfrage: ' . mysqli_error($db));
	}
			
	if (mysqli_num_rows($db_erg)>=1){
		echo "<section>";										
		echo "<table border='1'>";
		echo "<thead>";
		echo "<th>GS</th>";
		echo "<th>OB</th>";
		echo "<th>AGT</th>";
		echo "<th>ASNR</th>";
		echo "<th>Name</th>";
		echo "<th>AMNR</th>";
		echo "<th>Status</th>";
		echo "<th>Inkassoart</th>";
		echo "<th></th>";
		echo "</thead>";
				
		while ($zeile = mysqli_fetch_array( $db_erg)){	
			echo "<form action='?page=999' method='post'>";
			echo "<tr>";
			echo "<td>". $zeile['Konten_GS'] . "</td>";
			echo "<td>". $zeile['Konten_OB'] . "</td>";
			echo "<td>". $zeile['Konten_AGT'] . "</td>";
			echo "<td>". $zeile['Konten_UV'] . "</td>";
			echo "<td>". $zeile['ZAD_Name'] . "</td>";
			echo "<td>". $zeile['Konten_AMNR'] . "</td>";
			echo "<td>". $zeile['Konten_AGTSTATUS'] . "</td>";
			echo "<td>". $zeile['Konten_INKA_MV'] . "</td>";
			echo "<td><input type='hidden' name='konten_id' value='".$zeile['Konten_UV']."'></td>";
			echo "<td><input type='submit' name='konten' value='Details' />";
			echo "</tr>";
			echo "</form>";
		}
		echo "</table>";
		echo "</section>";
				
	}

	mysqli_free_result( $db_erg );
