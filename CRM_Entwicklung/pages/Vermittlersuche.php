
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
									<h3>Suche nach Vermittler ID - <?php echo $Suche; ?></h3>
									<?php } ?>
									
									<?php
									
										$Abfrage_1 = "SELECT DISTINCT t1.Vermittler_ID, t2.Vermittler_ZAD, t3.ZAD_Name, t3.ZAD_ORT FROM Vermittler_Konto AS t1 INNER JOIN Vermittler AS t2 ON t1.Vermittler_ID = t2.Vermittler_ID INNER JOIN ZAD AS t3 ON t2.Vermittler_ZAD = t3.ZAD_ZAD"
									
									?>
									
									<h3>Suche nach Vermittler-Name</h3>

									<h3>Suche nach Vermittler-Konto</h3>
									
									<h3>Suche nach Konto-Name</h3>									
									
													
								</section>