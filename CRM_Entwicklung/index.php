<?php 
	session_start();
	/* $user_id = $_SESSION['user_id']; */
	$user_id = "HEDDERSO";
	$page = $_GET['page'];
	
	$_SESSION['Personen_ID']="";
	
	if (!isset($_SESSION['Vermittler_ID'])){$_SESSION['Vermittler_ID']="";}
	if(isset($_GET['ID']) and $_GET['ID'] != $_SESSION['Vermittler_ID']) {
		$_SESSION['Vermittler_ID'] = $_GET['ID'];		
		
	}			
	
	if($page == null) header("Location: ?page=100");
	
	//PHP-Seiten die eine Header-FKT einhalten bitte hier includen

	include('header.php');
	include('dbconnect.php');

	
/*----------------------------*/
/*Errorpage aufrufen*/	
	$pagelist = array(000,001,002,100,101,200,201,202,203,204,205,206,207,208,209,210,250,300,400);
	/*if($page != $pagelist) header("Location: ?page=999");*/
	if (!in_array($page, $pagelist)) {
    	include('pages/error_page.php');;
		}
/*----------Pages-------------*/
	
	if($page == 000) include('pages/vorlage.php');
	if($page == 001) include('pages/vorlage2.php');
	if($page == 002) include('pages/vorlage3.php');
	if($page == 100) include('pages/dashboard.php');
	if($page == 101) include('pages/Vermittlersuche.php');
	if($page == 200) include('pages/Vermittler/Stammdaten.php');
	if($page == 201) include('pages/Vermittler/Personen.php');
	if($page == 202) include('pages/Vermittler/Konten.php');
	if($page == 203) include('pages/Vermittler/Statistik.php');
	if($page == 204) include('pages/Vermittler/Kontakte.php');
	if($page == 205) include('pages/Vermittler/Aufgaben.php');
	if($page == 206) include('pages/Vermittler/Kampange.php');
	if($page == 207) include('pages/Vermittler/Angebote.php');
	if($page == 208) include('pages/Vermittler/Termine.php');
	if($page == 209) include('pages/Vermittler/Vereinbarungen.php');
	if($page == 210) include('pages/Vermittler/GeVo.php');
	if($page == 250) include('pages/Vermittler/Personen_Detail.php');
	if($page == 300) include('pages/Statistiken.php');
	if($page == 400) include('pages/Kampagne.php');
	
	
	
	?>

						</div>
					</div>
<?php
	
	include('sidebar.php');?>
	

			</div>
	
		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>

