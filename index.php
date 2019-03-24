<?php
	session_start();

	if(isset($_POST['logout'])) {
		$_SESSION['username'] = null;
		$_SESSION['userId'] = null;
        session_destroy();
	}

	if (isset($_POST['saveSelectedProject'])) {
		$projectVal = $_POST['selectValFromProject'];
		$_SESSION['project'] = $projectVal;
	}
	$projectId = (isset($_SESSION['project'])) ? $_SESSION['project'] : 1;

	require_once('dbconn.php');
	require_once("dbfunctions.php");
	require_once('loginConn.php');
	
	$site = (isset($_GET['site']))?$_GET['site']:NULL;
	$loggedIn = isset($_SESSION['username']);



	// umgeändert auf Session, weiß aber nicht ob das gut ist
	//$projectId = (isset($_GET['projectId']))?$_GET['projectId']:1;
?>

<!doctype html>
<html lang="en">
	<head>
		<title>Title</title>
		<meta charset="utf-8">

		<link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css">
		<link rel="stylesheet" href="node_modules/font-awesome/css/font-awesome.css">
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
		<?php
			require_once("header.php");
		?>
	
		<div class="container-fluid">
		
			<?php
				if(!isset($site) && $loggedIn) $site="startpage";
				else $site="login";
				$invalide = array('/', '/\/', ':', '.');
				$site = str_replace($invalide, ' ', $site);
				if (!file_exists($site.".php")) $site = "startpage";
				include($site.".php");
			?>


		</div>


		<script src="jsfunctions.js"></script>
		<script src="node_modules/jquery/dist/jquery.js"></script>
		<script src="node_modules/popper.js/dist/popper.js"></script>
		<script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>
	</body>
</html>