
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
					<h1>Migrando Site:</h1>
					
				</div>
			</div>	
		</div>
	</section>
<?php 
//vars
$dominio = $_POST['dominio'];
$host    = $_POST['host'];
$usuario = $_POST['user'];
$senha   = $_POST['pass'];



$dominio2 = $_POST['dominio2'];
$host2    = $_POST['host2'];
$usuario2 = $_POST['user2'];
$senha2   = $_POST['pass2'];
 


//Conectmmos ao servidor FTP fornecido
$connection = ftp_connect($host);


//logamos
$login = ftp_login($connection, $usuario, $senha);


echo "<div style='margin-left:0.5%;'>";

//tentamos mudar para modo passivo
if(ftp_pasv($connection,true))
	{	
	$msg = $msg."<b>Aviso:</b> Alterado para o modo passivo!!<br>";
	}
	else{
		$msg = $msg."<b>Alerta:</b> Nao foi possivel alterar para o modo passivo!<br>";
	}

//mudando para o dir raiz
ftp_chdir($connection, 'public_html');


//se a conexão falhar
if (!$connection || !$login) { 
	$msg = $msg."
	Falha na conexao com FTP, verifique os dados inseridos
	<br>
	<br>Host: ".$_POST['host']."  
	<br>User: ".$_POST['user']."
	<br>Pass: ".$_POST['pass']."

	"; 
}
else{
	//se a conexão não falhoum enviamos o script ZIPADOR
	$msg = $msg."<b>Passo 1:</b> Conectado OK. Diretorio atual: ".ftp_pwd($connection)." - Enviando compactador...<br>";
	
	$upload = ftp_put($connection, 'ziper.php', 'ziper.php', FTP_ASCII);
	$upload2 = ftp_put($connection, 'unziper.php', 'unziper.php', FTP_BINARY);

	if (!$upload) { 
	//se o upload falhar	
	$msg = $msg."<b>Passo 2:</b> Falha ao enviar script compactador...<br>";
	}
	else if (!$upload2) {
			//se o upload2 falhar	
			$msg = $msg."<b>Passo 2.1:</b> Falha ao enviar arquivo descompactador...<br>";
		}
	else{
	if(usahttps($dominio)){
	$dominio = "https://".$dominio."/ziper.php?dominio=".$dominio2."&host=".$host2."&usuario=".$usuario2."&senha=".$senha2."";
	}
	else{
		$dominio = "http://".$dominio."/ziper.php?dominio=".$dominio2."&host=".$host2."&usuario=".$usuario2."&senha=".$senha2."";
	}
	
	$msg = $msg."<b>Passo 3:</b> Compactador e descompactador enviados! Criando arquivo ZIP....  <br>
	<b>Passo 4:</b> Criado com sucesso. Clique <a href='".$dominio."' target='iframe1' id='executaziper name='executaziper'>aqui</a> para compactar!<br>
	<script>
	
	document.getElementById('executaziper').click();
	</script>
	
	";
	
	echo "</div>";
	
	//Executando arquivo de migração na origem
	echo"
	<iframe name='iframe1' id='iframe1' width='100%' height='50%' frameBorder='0'></iframe>
	
	";
	
	
	}
	ftp_close($connection);

	
	
	
}
ftp_close($connection);



function usahttps($site){
	   ini_set("default_socket_timeout","05");
       set_time_limit(5);
       $f=fopen("https://".$site."","r");
       $r=fread($f,1000);
       fclose($f);
       if(strlen($r)>1) {
       //echo("<span class='online'>Online</span>");
	   return true;
       }
       else {
       //echo("<span class='offline'>Offline</span>");
	   return false;
       }
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



