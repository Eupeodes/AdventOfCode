<?php

namespace Eupeodes\AdventOfCode\Y2022;

use Eupeodes\AdventOfCode\Day;

class D13 extends Day{
	private $dataFile = __DIR__.'/D13.txt';
	private $chunks = [];
	private $all = [
		[[2]],
		[[6]]
	];
	public function __construct(){
		$data = file(($this->dataFile));
		$this->chunks = array_chunk($data, 3);
		
	}
	
	public function run(){
		foreach($this->chunks as $i=>$chunk){
			$a = json_decode($chunk[0]);
			$b = json_decode($chunk[1]);
			$smaller = $this->smaller($a, $b, true);
			if($smaller == 'a'){
				$this->solution_1 += $i+1;
			}
			$added = false;
			foreach($this->all as $n=>$r){
				if($this->smaller($a, $r) == 'a'){
					array_splice($this->all, $n, 0, [$a]);
					$added = true;
					break;
				}
			}
			if(!$added){
				$this->all[] = $a;
			}
			$added = false;
			foreach($this->all as $n=>$r){
				if($this->smaller($b, $r, 'oei') == 'a'){
					array_splice($this->all, $n, 0, [$b]);
					break;
				}
			}
			if(!$added){
				$this->all[] = $b;
			}
		}
		$this->solution_2 = (array_search([[2]], $this->all) + 1) * (array_search([[6]], $this->all) + 1);
	}

	private function smaller($a, $b, $first = false){
		foreach($a as $n=>$av){
			if(!array_key_exists($n, $b)){
				return 'b';
			}
			$bv = $b[$n];
			$ta = gettype($av);
			$tb = gettype($bv);
			if($av == $bv){
				continue;
			}
			if($ta == $tb){
				if($ta == 'integer'){
					$res = $av < $bv ? 'a' : 'b';
				} else {
					$res = $this->smaller($av, $bv);
				}
			} else {
				if($ta == 'integer'){
					$res = $this->smaller([$av], $bv);
				} else {
					$res = $this->smaller($av, [$bv]);
				}
			}
			if(in_array($res, ['a', 'b'])){
				return $res;
			}
		}
		if(count($a) < count($b)){
			return 'a';
		}
	}
}