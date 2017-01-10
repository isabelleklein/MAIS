
							<!-- Content -->
								<section>
									<header class="main">
										<h1>Vermittlersuche</h1>
										<?php 	if(isset($_POST['query'])) {
												$Suche = $_POST['query'];
												unset($_SESSION['query']);
												}
												else {
													$Suche = $_SESSION['query'];
													}
										?>
									</header>
								

									<!-- Table -->			
									<?php
									if($_GET['msg']=='s'){
									?>
									<!-- Suche nach Vermittler Name -->																		
									<?php 
											$sql = "SELECT DISTINCT t4.Konten_ZN, t4.Konten_GS, t1.Vermittler_ID, t2.Vermittler_ZAD, t3.ZAD_Name, t3.ZAD_PLZ, t3.ZAD_ORT FROM Vermittler_Konto AS t1 INNER JOIN Vermittler AS t2 ON t1.Vermittler_ID = t2.Vermittler_ID INNER JOIN ZAD AS t3 ON t2.Vermittler_ZAD = t3.ZAD_ZAD INNER JOIN Konten_Hierarchie AS t4 ON t1.UV = t4.Konten_UV  WHERE t3.ZAD_Name LIKE '%".$Suche."%'";
										
											$db_erg = mysqli_query($db,$sql);
											
											if ( ! $db_erg ){
	  											die('Ungültige Abfrage: ' . mysqli_error($db));
											}
											
											if (mysqli_num_rows($db_erg)>=1){
												echo "<section>";
												echo "<h3>Suche nach Vermittler Name</h3>";
												
												echo "<table border='1'>";
												echo "<thead>";
													echo "<th>Vermittler_ZN</th>";
													echo "<th>Vermittler_GS</th>";
													echo "<th>Vermittler_Name</th>";
													echo "<th>Vermittler_PLZ</th>";
													echo "<th>Vermittler_Ort</th>";
													echo "<th></th>";
												echo "</thead>";
												
												while ($zeile = mysqli_fetch_array( $db_erg)){	
		  											echo "<tr>";
		  											echo "<td>". $zeile['Konten_ZN'] . "</td>";
		  											echo "<td>". $zeile['Konten_GS'] . "</td>";
		  											echo "<td>". $zeile['ZAD_Name'] . "</td>";
		  											echo "<td>". $zeile['ZAD_PLZ'] . "</td>";
		  											echo "<td>". $zeile['ZAD_ORT'] . "</td>";
												  	echo "<td><a href='?page=200&ID=". $zeile['Vermittler_ID'] ."'  class='button'>auswählen</a></td>";
												  	echo "</tr>";
												}
												echo "</table>";
												echo "</section>";
												
											}
											mysqli_free_result( $db_erg );
									?>

									<!-- Suche nach Vermittler ID -->																		
									<?php 
											$sql = "SELECT DISTINCT t4.Konten_ZN, t4.Konten_GS, t1.Vermittler_ID, t2.Vermittler_ZAD, t3.ZAD_Name, t3.ZAD_PLZ, t3.ZAD_ORT FROM Vermittler_Konto AS t1 INNER JOIN Vermittler AS t2 ON t1.Vermittler_ID = t2.Vermittler_ID INNER JOIN ZAD AS t3 ON t2.Vermittler_ZAD = t3.ZAD_ZAD INNER JOIN Konten_Hierarchie AS t4 ON t1.UV = t4.Konten_UV  WHERE t1.Vermittler_ID LIKE '%".$Suche."%'";
										
											$db_erg = mysqli_query($db,$sql);
											
											if ( ! $db_erg ){
	  											die('Ungültige Abfrage: ' . mysqli_error($db));
											}
											
											if (mysqli_num_rows($db_erg)>=1){
												echo "<section>";
												echo "<h3>Suche nach Vermittler-ID</h3>";
												
												echo "<table border='1'>";
												echo "<thead>";
													echo "<th>Vermittler_ZN</th>";
													echo "<th>Vermittler_GS</th>";
													echo "<th>Vermittler_Name</th>";
													echo "<th>Vermittler_PLZ</th>";
													echo "<th>Vermittler_Ort</th>";
													echo "<th></th>";
												echo "</thead>";
												
												while ($zeile = mysqli_fetch_array( $db_erg)){	
		  											echo "<tr>";
		  											echo "<td>". $zeile['Konten_ZN'] . "</td>";
		  											echo "<td>". $zeile['Konten_GS'] . "</td>";
		  											echo "<td>". $zeile['ZAD_Name'] . "</td>";
		  											echo "<td>". $zeile['ZAD_PLZ'] . "</td>";
		  											echo "<td>". $zeile['ZAD_ORT'] . "</td>";
												  	echo "<td><a href='?page=200&ID=". $zeile['Vermittler_ID'] ."'  class='button'>auswählen</a></td>";
												  	echo "</tr>";
												}
												echo "</table>";
												echo "</section>";
												
											}
											mysqli_free_result( $db_erg );
									?>

									<!-- Suche nach Konto-Name -->																		
									<?php 
											$sql = "SELECT DISTINCT t4.Konten_ZN, t4.Konten_GS, t3.Vermittler_ID, t1.Konten_ZAD, t2.ZAD_Name, t2.ZAD_PLZ, t2.ZAD_ORT FROM Konten as t1 INNER JOIN ZAD as t2 ON t1.Konten_ZAD = t2.ZAD_ZAD INNER JOIN Vermittler_Konto as t3 on t1.KONTEN_UV = t3.UV INNER JOIN Konten_Hierarchie AS t4 ON t1.Konten_UV = t4.Konten_UV WHERE t2.ZAD_Name LIKE '%".$Suche."%'";
										
											$db_erg = mysqli_query($db,$sql);
											
											if ( ! $db_erg ){
	  											die('Ungültige Abfrage: ' . mysqli_error($db));
											}
											
											if (mysqli_num_rows($db_erg)>=1){
												echo "<section>";
												echo "<h3>Suche nach Konto-Name</h3>";
												
												echo "<table border='1'>";
												echo "<thead>";
													echo "<th>Vermittler_ZN</th>";
													echo "<th>Vermittler_GS</th>";
													echo "<th>Vermittler_Name</th>";
													echo "<th>Vermittler_PLZ</th>";
													echo "<th>Vermittler_Ort</th>";
													echo "<th></th>";
												echo "</thead>";
												
												while ($zeile = mysqli_fetch_array( $db_erg)){	
		  											echo "<tr>";
		  											echo "<td>". $zeile['Konten_ZN'] . "</td>";
		  											echo "<td>". $zeile['Konten_GS'] . "</td>";
		  											echo "<td>". $zeile['ZAD_Name'] . "</td>";
		  											echo "<td>". $zeile['ZAD_PLZ'] . "</td>";
		  											echo "<td>". $zeile['ZAD_ORT'] . "</td>";
												  	echo "<td><a href='?page=200&ID=". $zeile['Vermittler_ID'] ."'  class='button'>auswählen</a></td>";
												  	echo "</tr>";
												}
												echo "</table>";
												echo "</section>";
												
											}
											mysqli_free_result( $db_erg );
									?>
									<!-- Suche nach Konto-Nummer -->																		
									<?php 
											$sql = "SELECT DISTINCT t4.Konten_ZN, t4.Konten_GS, t3.Vermittler_ID, t1.Konten_ZAD, t2.ZAD_Name, t2.ZAD_PLZ, t2.ZAD_ORT FROM Konten as t1 INNER JOIN ZAD as t2 ON t1.Konten_ZAD = t2.ZAD_ZAD INNER JOIN Vermittler_Konto as t3 on t1.KONTEN_UV = t3.UV INNER JOIN Konten_Hierarchie AS t4 ON t1.Konten_UV = t4.Konten_UV WHERE t1.Konten_UV LIKE '%".$Suche."%'";
										
											$db_erg = mysqli_query($db,$sql);
											
											if ( ! $db_erg ){
	  											die('Ungültige Abfrage: ' . mysqli_error($db));
											}
											
											if (mysqli_num_rows($db_erg)>=1){
												echo "<section>";
												echo "<h3>Suche nach Konto-Nummer</h3>";
												
												echo "<table border='1'>";
												echo "<thead>";
													echo "<th>Vermittler_ZN</th>";
													echo "<th>Vermittler_GS</th>";
													echo "<th>Vermittler_Name</th>";
													echo "<th>Vermittler_PLZ</th>";
													echo "<th>Vermittler_Ort</th>";
													echo "<th></th>";
												echo "</thead>";
												
												while ($zeile = mysqli_fetch_array( $db_erg)){	
		  											echo "<tr>";
		  											echo "<td>". $zeile['Konten_ZN'] . "</td>";
		  											echo "<td>". $zeile['Konten_GS'] . "</td>";
		  											echo "<td>". $zeile['ZAD_Name'] . "</td>";
		  											echo "<td>". $zeile['ZAD_PLZ'] . "</td>";
		  											echo "<td>". $zeile['ZAD_ORT'] . "</td>";
												  	echo "<td><a href='?page=200&ID=". $zeile['Vermittler_ID'] ."'  class='button'>auswählen</a></td>";
												  	echo "</tr>";
												}
												echo "</table>";
												echo "</section>";
												
											}
											mysqli_free_result( $db_erg );
									} ?>