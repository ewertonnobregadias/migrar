<?php
	   ini_set("default_socket_timeout","05");
       set_time_limit(5);
       $f=fopen("http://migrar1.hospedagemdesites.ws/ziper.php","r");
       $r=fread($f,1000);
       fclose($f);
       if(strlen($r)>1) {
       echo("<span class='online'>Online</span>");
       }
       else {
       echo("<span class='offline'>Offline</span>");
       }
	   
?>