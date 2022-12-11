<?php

namespace Eupeodes\AdventOfCode;


class helpers {
	static function printMsg($msg){
		echo date('H:i:s').' | '.$msg . "\n";
	}

	/**
	 * function from https://github.com/Qronicle/advent-of-code-2022/blob/main/src/Common/functions.php
	 *
	 * @param integer $n
	 * @param integer $m
	 * @return integer
	 */
	static function least_common_multiple(int $n, int $m): int
    {
        $x = $n;
        for ($y = 0; ; $x += $n) {
            while ($y < $x) {
                $y += $m;
            }
            if ($x == $y) {
                break;
            }
        }
        return $x;
    }
}