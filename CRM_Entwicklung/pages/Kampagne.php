						<!-- Banner -->
								<section id="banner">
									<div class="content">
										<header>
											<h1>Kampangen</h1>
											<a href="javascript:AnzeigeUmschalten('Suche');" class="button special">Suche</a>
										</header>
									</div>
									
								</section>
								
						
								<section id="Suche" style="display:none;">
									
									<form action="index.php?page=400" method="post">
										<table>
											<tr>
												<td>Kampangenname</td>
												<td><input type="text" name="Kampangenname"></td>
											</tr>				
										</table>
										<input type="submit" value="Suche">
									</form>
									
								</section>				
									<?php
									if (isset($_POST['Kampangenname'])){
										echo '<section>';
																			
											$sql = "SELECT * FROM Kampange WHERE Kampange_Name LIKE '%".$_POST['Kampangenname']."%'";
										
											$db_erg = mysqli_query($db,$sql);
											
											if ( ! $db_erg ){
	  											die('Ungültige Abfrage: ' . mysqli_error($db));
											}
											
											if (is_null($db_erg)){
											
												echo "Es wurden keine Kampangen gefunden";
											
											}else{
												
												?>
												<table border="1">
												<thead>
													<th>Art</th>
													<th>Beginn</th>
													<th>Ende</th>
													<th>Beschreibung</th>
													<th>Erfasser</th>
													<th>Name</th>
													<th></th>
												</thead>
												<?php 
												while ($zeile = mysqli_fetch_array( $db_erg)){	
		  											echo "<tr>";
		  											echo "<td>". $zeile['Kampange_Art'] . "</td>";
		  											echo "<td>". $zeile['Kampange_Beginn'] . "</td>";
		  											echo "<td>". $zeile['Kampange_Ende'] . "</td>";
		  											echo "<td>". $zeile['Kampange_Beschreibung'] . "</td>";
												  	echo "<td>". $zeile['Kampange_Erfasser'] . "</td>";
												  	echo "<td>". $zeile['Kampange_Name'] . "</td>";
												  	echo "<td><a href='#' class='button'>Details</a></td>";
												  	echo "</tr>";
												}
												echo "</table>";
											}
											mysqli_free_result( $db_erg );
																			
										
										
										echo '</section>';		
									}else{
									
																
										echo '<section>';
																			
											$sql = 'SELECT * FROM Kampange';
										
											$db_erg = mysqli_query($db,$sql);
											
											if ( ! $db_erg ){
	  											die('Ungültige Abfrage: ' . mysqli_error($db));
											}
											
											if (is_null($db_erg)){
											
												echo "Es wurden keine Kampangen gefunden";
											
											}else{
												
												?>
												<table border="1">
												<thead>
													<th>Art</th>
													<th>Beginn</th>
													<th>Ende</th>
													<th>Beschreibung</th>
													<th>Erfasser</th>
													<th>Name</th>
													<th></th>
												</thead>
												<?php 
												while ($zeile = mysqli_fetch_array( $db_erg)){	
		  											echo "<tr>";
		  											echo "<td>". $zeile['Kampange_Art'] . "</td>";
		  											echo "<td>". $zeile['Kampange_Beginn'] . "</td>";
		  											echo "<td>". $zeile['Kampange_Ende'] . "</td>";
		  											echo "<td>". $zeile['Kampange_Beschreibung'] . "</td>";
												  	echo "<td>". $zeile['Kampange_Erfasser'] . "</td>";
												  	echo "<td>". $zeile['Kampange_Name'] . "</td>";
												  	echo "<td><a href='#' class='button'>Details</a></td>";
												  	echo "</tr>";
												}
												echo "</table>";
											}
											mysqli_free_result( $db_erg );
																			
										
										
										echo '</section>';
									}
									?>


								
								<script language="javascript" type="text/javascript" defer="defer">
								
								function AnzeigeUmschalten( i )
								{
								   if ( document.getElementById(i).style.display == 'none' ) {
								      document.getElementById(i).style.display = '';
								   } else {
								      document.getElementById(i).style.display = 'none';
								   }
								}

								</script>

							