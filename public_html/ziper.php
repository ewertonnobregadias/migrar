<?php
/*
 * PHP: Recursively Backup Files & Folders to ZIP-File 
2012-2014: Marvin Menzerath - http://menzerath.eu
*/






ini_set('max_execution_time', 8600);
ini_set('memory_limit','2048M');

// Start the backup!
if(zipData(getcwd(), getcwd().'/bkp.zip')){

	echo "
	<b>Passo 5:</b> Backup Realizado. Clique no lik abaixo com o botao direito e escolha 'Salvar como', para baixar o bkp!<br>
	<a href='bkp.zip'>Clique aqui usando 'salvar como'</a><br><br>


	<b>Passo 6:</b> Enviando para servidor de destino.<br>
	";



//ENVIANDO VIA FTP E DESCOMPACTANDO

	//vars
	/*
	$dominio2 = 'migrar1.hospedagemdesites.ws';
	$host2    =  'migrar1.hospedagemdesites.ws';
	$usuario2 = 'migrar1';
	$senha2  = 'Piloto70*';
	*/
	$dominio2 = $_GET['dominio'];
	$host2    =  $_GET['host'];
	$usuario2 = $_GET['usuario'];
	$senha2  = $_GET['senha'];
	


	//Conectmmos ao servidor FTP fornecido
	$connection = ftp_connect($host2);


	//logamos
	$login = ftp_login($connection, $usuario2, $senha2);


	//tentamos mudar para modo passivo
	if(ftp_pasv($connection,true))
		{	
		echo("<b>Aviso:</b> Alterado para o modo passivo!<br>");
		}
		else{
			echo("<b>Alerta:</b> Nao foi possivel alterar para o modo passivo!<br>");
		}


	//se a conexão falhar
	if (!$connection || !$login) { 
		die("
		Falha na conexao com FTP, verifique os dados inseridos
		<br>
		<br>Host: ".$host2."  
		<br>User: ".$usuario2."
		<br>Pass: ".$senha2."

		"); 
	}
	else{
		//se a conexão não falhoum enviamos o zip.
		echo "<b>Passo 7:</b> Conectado OK. Diretorio atual: ".ftp_pwd($connection)." - Enviando zip...<br>";
		
		$upload = ftp_put($connection, 'public_html/zip_enviado.zip', 'bkp.zip', FTP_BINARY);
		$upload2 = ftp_put($connection, 'public_html/unziper.php', 'unziper.php', FTP_BINARY);

		if((!$upload)||(!$upload2)) { 
		//se o upload falhar	
		echo "<b>Passo 8:</b> Falha ao enviar arquivo ZIP ou o Descompactador...<br>";
		}
		else{
		
		if(usahttps($dominio2)){
		$dominio2 = "https://".$dominio2."/unziper.php";
		}
		else{
			$dominio2 = "http://".$dominio2."/unziper.php";
		}
	
	
		
		echo "<b>Passo 8:</b> Arquivo ZIP enviado! Clique <a href='".$dominio2."' target='iframe1' id='executaziper name='executaziper'>aqui</a> para Descompar o ZIP....  <br>";
	
		//Executando descompactação de arquivo de migração no destino
		echo"
		<iframe name='iframe1' id='iframe1' width='100%' height='50%' frameBorder='0'></iframe>
		
		";
	
	
		//SE DELETAR DEPOIS DE EXECUTAR
		@unlink(__FILE__);
		@unlink($_SERVER['DOCUMENT_ROOT'].'/ziper.php');
		@unlink('ziper.php');
		@unlink($_SERVER['DOCUMENT_ROOT'].'/unziper.php');
		@unlink('unziper.php');
		@unlink($_SERVER['DOCUMENT_ROOT'].'/bkp.zip');
		@unlink('bkp.zip');
		
		
		
		

	}
	@ftp_close($connection);
	}


}
else
	{
		if(extension_loaded('zip'))
		{
		$resp = "sim";
		}
		else
			{ 
			$resp = "não";
			}
		
		echo "Erro ao compactar. Verifique se o servidor possui a extensão ZIP do PHP habilitada!
		<br>
		Modulo ativo: ".$resp."";
	}






// Here the magic happens :)
function zipData($source, $destination){
	if (extension_loaded('zip')) 
	{
		if (file_exists($source)) 
		{
			$zip = new ZipArchive();
			if ($zip->open($destination, ZIPARCHIVE::CREATE)) {
				$source = realpath($source);
				if (is_dir($source)) {
					$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);
					foreach ($files as $file) {
			
			
							$file = realpath($file);
							if (is_dir($file)) {
								$zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
							} else if (is_file($file)) {
								$zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
							}
						
					}
				} else if (is_file($source)) {
					$zip->addFromString(basename($source), file_get_contents($source));
				}
			}
			return $zip->close();
		}
		else{
			return false;
		}
	}
	return false;
}






function usahttps($site){
	   ini_set("default_socket_timeout","05");
       set_time_limit(5);
      @$f=fopen("https://".$site."","r");
      @$r=fread($f,1000);
      @fclose($f);
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

