<?php

$start = microtime(true);
function printMsg($msg){
	echo date('H:i:s').' | '.$msg . "\n";
}

function printEnd(){
	global $start;
	printMsg('Done in '.(microtime(true)-$start));
}

printMsg('Start');