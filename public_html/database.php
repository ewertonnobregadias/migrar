<html>
<head>
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
	
    <link href="css/scrolling-nav.css" rel="stylesheet"> 

</head>
<body>

	<!--   Somente para mobile   -->

	<?php include "menu.php" ?>

	<section class="container-fluid" id="sw-site-section">
		<div class="row">
			<div class="container" id="sw-site-section-content">
				<h1>Migração de Banco de dados Mysql</h1>
				<center><img src='/img/mysql_icon.png' width='20%'/></center>
			</div>	
		</div>
	</section>

	<section class="container-fluid" id="sw-site-old">
		<div class="row">
			<div class="col-md-5">
				<div class="container" id="sw-site-old-content">
					
					<div id="first-step">
						<form action='dbsave.php' method='POST'>
							<h2>Banco Atual</h2>
							
							<p>Endereço do Host</p>
							<input type="text" id="host" name="host" placeholder="Ex: mysql.dominio.com.br">
							
							<p>Nome da Base</p>
							<input type="text" id="base" name="base" placeholder="Ex: mysqlbase">
							
							<p>Usuário do banco</p>
							<input type="text" id="user" name="user" placeholder="Ex: userbase">
							
							<p>Senha</p>
							<input type="password" id="pass" name="pass" placeholder="******"> 
							
							<!--<button id="gerar-arquivo">Gerar Arquivo ZIP</button>
						</form>-->
					</div>
				</div>
			</div>
			
			<div class="col-md-2">
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<img src='https://pkolano.github.io/images/arrow.gif' width='80%'/>
			<br>
			<br>
			<button type='submit' id="importar-arquivo">MIGRAR BASE!</button>
			</div>
			
			<div class="col-md-5">
				<div class="container" id="sw-site-old-content">
					<div id="first-step">
						<!--<form action='ftpsite.php' method='POST'>-->
							<h2>Banco Novo</h2>
							
							<p>Endereço do Host</p>
							<input type="text" id="host2" name="host2" placeholder="Ex: mysqlnovo.dominio.com.br">
							
							<p>Nome da Base</p>
							<input type="text" id="base2" name="base2" placeholder="Ex: mysqlbasenova">
							
							<p>Usuário do banco</p>
							<input type="text" id="user2" name="user2" placeholder="Ex: userbasenova">
							
							<p>Senha</p>
							<input type="password" id="pass2" name="pass2" placeholder="******"> 
							
							<!--<button id="gerar-arquivo">Gerar Arquivo ZIP</button>-->
						</form>
					</div>
				</div>	
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

