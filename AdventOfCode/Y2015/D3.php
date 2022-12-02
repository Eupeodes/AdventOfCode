<?php

namespace Eupeodes\AdventOfCode\Y2015;

use Eupeodes\AdventOfCode\Day;

class D3 extends Day{
	private $data;
	private $res1 = ['0|0' => 1];
	private $res2 = ['0|0' => 1];
	private $pos = [
		['x' => 0, 'y' => 0],
		['x' => 0, 'y' => 0]
	];

	public function __construct(){
		$this->data = str_split(file_get_contents(__DIR__.'/D3.txt'));
	}
	
	public function run(){
		$this->solve1();
		$this->solve2();
	}
	
	private function solve1(){
		$x = 0;
		$y = 0;
		foreach($this->data as $step){
			switch($step){
				case '^':
					$y++;
					break;
				case 'v':
					$y--;
					break;
				case '<':
					$x--;
					break;
				case '>':
					$x++;
					break;
			}
			$key = $x . '|' . $y;
			if(array_key_exists($key, $this->res1)){
				$this->res1[$key]++;
			} else {
				$this->res1[$key] = 1;
			}
		}
		$this->solution_1 = count($this->res1);
	}
	
	private function solve2(){
		foreach($this->data as $i=>$step){
			$who = $i % 2;
			switch($step){
				case '^':
					$this->pos[$who]['y']++;
					break;
				case 'v':
					$this->pos[$who]['y']--;
					break;
				case '<':
					$this->pos[$who]['x']--;
					break;
				case '>':
					$this->pos[$who]['x']++;
					break;
			}
			$key = $this->pos[$who]['x'] . '|' . $this->pos[$who]['y'];
			if(array_key_exists($key, $this->res2)){
				$this->res2[$key]++;
			} else {
				$this->res2[$key] = 1;
			}
		}
		$this->solution_2 = count($this->res2);
	}
}
