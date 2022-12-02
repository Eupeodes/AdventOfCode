<?php

$lines = file('2.txt');

$t = 0;
$h = 0;
foreach($lines as $line){
	list($x, $y, $z) = explode('x', trim($line));
	$a = $x*$y;
	$b = $x*$z;
	$c = $y*$z;
	$d = min([$a,$b,$c]);
	$s = 2 * ($a + $b + $c) + $d;
	$t += $s;

	$r = [$x, $y, $z];
	sort($r);
	$l = 2 * ($r[0] + $r[1]) + $x *$y * $z;
	$h += $l;
}
echo $t . "\n";
echo $h . "\n";
