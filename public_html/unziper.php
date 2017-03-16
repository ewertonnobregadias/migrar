<?php
//preserva mensagens antigas (So para estética)
echo "
<b>Passo 6:</b> Enviando para servidor de destino.<br>
<b>Aviso:</b> Alterado para o modo passivo!<br>
<b>Passo 7:</b> Conectado OK. Diretorio atual: / - Enviando zip...<br>
<b>Passo 8:</b> Arquivo ZIP enviado! Clique <b>aqui</b> para Descompar o ZIP.... <br>


";

//descompactanto

		$zip = new ZipArchive;
		$teste = $zip->open($_SERVER['DOCUMENT_ROOT'].'/zip_enviado.zip');
		
		if ($zip->open($_SERVER['DOCUMENT_ROOT'].'/zip_enviado.zip') === TRUE) {
			echo "<b>Aviso:</b> Arquivo de backup encontrado.<br>";
			$zip->extractTo('./');
			$zip->close();
			 echo "<hr><b>Passo 9:</b> Descompactado com sucesso. Projeto Migrado com sucesso! <br><br><br>";
		} else {
			echo "<b>Aviso:</b>Erro!<hr>";
			 echo "<b>Passo 9:</b> Falha ao descompactar <br><br><br>
			 ERRO: ".$teste." 
			 <br>
			 Doc root: ".$_SERVER['DOCUMENT_ROOT']."
			 ";
		}
		
		
//SE DELETAR DEPOIS DE EXECUTAR
@unlink(__FILE__);
@unlink($_SERVER['DOCUMENT_ROOT'].'/ziper.php');
@unlink('ziper.php');
@unlink($_SERVER['DOCUMENT_ROOT'].'/unziper.php');
@unlink('unziper.php');
@unlink($_SERVER['DOCUMENT_ROOT'].'/zip_enviado.zip');
@unlink('zip_enviado.zip');


		
?>