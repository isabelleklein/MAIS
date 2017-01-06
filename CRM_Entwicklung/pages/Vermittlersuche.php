
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
											$sql = "SELECT DISTINCT t1.Vermittler_ID, t2.Vermittler_ZAD, t3.ZAD_Name, t3.ZAD_ORT FROM Vermittler_Konto AS t1 INNER JOIN Vermittler AS t2 ON t1.Vermittler_ID = t2.Vermittler_ID INNER JOIN ZAD AS t3 ON t2.Vermittler_ZAD = t3.ZAD_ZAD  WHERE t3.ZAD_Name LIKE '%".$Suche."%'";
										
											$db_erg = mysqli_query($db,$sql);
											
											if ( ! $db_erg ){
	  											die('Ungültige Abfrage: ' . mysqli_error($db));
											}
											
											if (!isset($db_erg)){
												echo "<section>";
												echo "<h3>Suche nach Vermittler Name</h3>";
												
												echo "<table border='1'>";
												echo "<thead>";
													echo "<th>Vermittler_ID</th>";
													echo "<th>Vermittler_ZAD</th>";
													echo "<th>Vermittler_Name</th>";
													echo "<th>Vermittler_Ort</th>";
													echo "<th></th>";
												echo "</thead>";
												
												while ($zeile = mysqli_fetch_array( $db_erg)){	
		  											echo "<tr>";
		  											echo "<td>". $zeile['Vermittler_ID'] . "</td>";
		  											echo "<td>". $zeile['Vermittler_ZAD'] . "</td>";
		  											echo "<td>". $zeile['ZAD_Name'] . "</td>";
		  											echo "<td>". $zeile['ZAD_ORT'] . "</td>";
												  	echo "<td><a href='#' class='button'>auswählen</a></td>";
												  	echo "</tr>";
												}
												echo "</table>";
												echo "</section>";
												
											}
											mysqli_free_result( $db_erg );
									?>

									
									
									<section>
									<h3>Suche nach Vermittler-Name</h3>
									</section>	
																
									<section>
									<h3>Suche nach Vermittler-Konto</h3>
									</section>
																	
									<section>
									<h3>Suche nach Konto-Name</h3>
									</section>																
									
<!-- gehört zum IF msg = s -->		<?php } ?>
			
								<!-- </section> -->