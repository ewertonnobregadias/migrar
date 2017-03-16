

<?php
echo "Compactando somente arquivos...";

$zip = new ZipArchive;
$res = $zip->open('bkp.zip', ZipArchive::CREATE);
if ($res === TRUE) {
    //$zip->addFromString('test.txt', 'file content goes here');
    
	$zip->addFile(getcwd().'/zipar/arquivo1.txt', 'arquivo1.txt'); 
	$zip->addFile(getcwd().'/zipar/arquivo2.txt', 'arquivo2.txt'); 
	$zip->close();
    
	echo 'Arquivos zipados ok <br>';
	echo getcwd();
} else {
   echo 'Falha ao zipar arquivos<br>';
   echo getcwd();
}
?>

