<?php

$data = file_get_contents('1.txt');
$open = substr_count($data, '(');
$close = substr_count($data, ')');

echo $open . ' - ' . $close . ' = ' . ($open - $close) . "\n";

$f = 0;
for($i = 0; $i < strlen($data); $i++){
		if ($data[$i] == '('){
				$f++;
		} elseif($data[$i] == ')'){
				$f--;
		}
		if($f == -1){
				echo $i+1 . "\n";
				break;
		}
}
