<?php
function logFile($rtn){
	$f=fopen("../logs/log.txt","a");
	fwrite($f, $rtn . "\n");
	fclose($f);
	}
?>