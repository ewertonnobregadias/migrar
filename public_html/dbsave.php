
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="icon" href="img/favicon.png" />

	<title>Stormweb Migration</title>

	<link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>

	<link href='https://fonts.googleapis.com/css?family=Raleway:400,300,300italic' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="css/font-awesome.css">

	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="css/default.css">

	<link rel="stylesheet" type="text/css" href="css/mobile.css">

	<link rel="stylesheet" type="text/css" href="css/layout.css">

	<link rel="stylesheet" type="text/css" href="css/modal.css_"/>
	
    <link rel="stylesheet" type="text/css" href="css/scrolling-nav.css">

</head>
<body>
	

	<nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="sw-header">
        <div class="container">
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!--<a id="sw-header-logo" class="navbar-brand page-scroll" href="index.php">Stormweb</a>-->
                <img id="sw-header-logo-img" src="img/logo.png">
            </div>

<?php include "menu.php" ?>

        </div>
        <!-- /.container -->
    </nav>

	<!--  Somente para mobile   -->
	<section class="container-fluid" id="sw-banner">
		<div class="row">
			<div class="container">
				<div class="col-md-12" id="sw-banner-content">
					<h1>Migrando Banco de Dados:</h1>
					
				</div>
			</div>	
		</div>
	</section>
	
	
	<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Vars
$hostOrigem = $_POST['host'];
$baseOrigem = $_POST['base'];
$userOrigem = $_POST['user'];
$passOrigem = $_POST['pass'];

$hostDestino = $_POST['host2'];
$baseDestino = $_POST['base2'];
$userDestino = $_POST['user2'];
$passDestino = $_POST['pass2'];

define("BACKUP_PATH", "./");


if(($hostOrigem and $baseOrigem and $userOrigem and $passOrigem)and($hostDestino and $baseDestino and $userDestino and $passDestino)){
	//Migrando
	$server_name   = $hostOrigem;
	$database_name = $baseOrigem;
	$username      = $userOrigem;
	$password      = $passOrigem;

	//$date_string   = date("Ymd");


	$cmd = "mysqldump --routines -h ".$server_name." -u ".$username." -p".$password." ".$database_name." >". BACKUP_PATH ."/bkp".$userOrigem.".sql";

	if(print_r(exec($cmd))==1){
		$msg = "Dump executado com sucesso, restaurando no destino...<br>";
	}else{
	$msg = "ERRO1 - "+print_r(exec($cmd))+"<br>";
	}


	$restore_file  = "bkp.sql";
	$server_name   = $hostDestino;
	$database_name = $baseDestino;
	$username      = $userDestino;
	$password      = $passDestino;


	$cmd = "mysql -h ".$server_name." -u ".$username." -p".$password." ".$database_name." < ".$restore_file."";

	if(print_r(exec($cmd))==1){
		$msg = $msg."Restore executado com sucesso!<br>";
	}else
	{
	$msg = $msg."ERRO2 - "+print_r(exec($cmd))+"<br>";
	}
	
}else{
	
	$msg = "Nenhum dado pode estar em branco!";
}


?>

	<section class="container-fluid" id="sw-static-section">
		<div class="row">
			<div class="container" id="sw-static-section-content">
				<h2><?php echo $msg; ?></h2>
				<br>
				<br>
				<br>
			</div>	
		</div>
	</section>

	

	<section class="container-fluid" id="sw-blog-section">
		<div class="row">
			<div class="container" id="sw-blog-section-content">
				<h2>Tem alguma dúvida ? Entre em contato</h2>
				migrar@migrar.tk
			</div>	
		</div>
	</section>

	<section class="container-fluid" id="sw-footer-section">
		<div class="row">
			<div class="container" id="sw-footer-section-content">
				<p>Copyright Stormweb IDC 2017</p>
			</div>	
		</div>
	</section>

	<!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Scrolling Nav JavaScript -->
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/scrolling-nav.js"></script>
	
</body>
</html>

