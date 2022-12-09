<?php

namespace Eupeodes\AdventOfCode\Y2022;

use Eupeodes\AdventOfCode\Day;

class D9 extends Day{
	private $locs = ['0|0' => 1];
	private $locs2 = ['0|0' => 1];
	private $head = [
		'x' => 0,
		'y' => 0
	];
	private $tail = [
		'x' => 0,
		'y' => 0
	];
	
	private $tail2 = [];
	private $dataFile = __DIR__.'/D9.txt';
	public function __construct(){
		for($i = 0;$i <= 9; $i ++){
			$this->tail2[$i] = ['x' => 0, 'y' => 0];
		}
	}
	
	private function doStep($dir){
		switch($dir){
			case 'U':
				$this->head['x']--;
				break;
			case 'D':
				$this->head['x']++;
				break;
			case 'L':
				$this->head['y']--;
				break;
			case 'R':
				$this->head['y']++;
				break;
		}
	}
	private function follow($em, $target){
		$dx = $target['x'] - $em['x'];
		$dy = $target['y'] - $em['y'];
		if(abs($dx) + abs($dy) > 2){
			$em['x'] += ($dx > 0) ? 1 : -1;
			$em['y'] += ($dy > 0) ? 1 : -1;
		} elseif (abs($dx) > 1){
			$em['x'] += ($dx > 0) ? 1 : -1;
		} elseif (abs($dy) > 1){
			$em['y'] += ($dy > 0) ? 1 : -1;
		}
		return $em;
		$key = implode('|', $this->tail);
		if(array_key_exists($key, $this->locs)){
			$this->locs[$key]++;
		} else {
			$this->locs[$key] = 1;
		}
	}
	
	private function tailFollow(){
		$this->tail = $this->follow($this->tail, $this->head);
		$key = implode('|', $this->tail);
		if(array_key_exists($key, $this->locs)){
			$this->locs[$key]++;
		} else {
			$this->locs[$key] = 1;
		}
	}
	
	private function longTailFollow(){
		$this->tail2[0] = $this->head;
		for($i = 1;$i<=9;$i++){
			$this->tail2[$i] = $this->follow($this->tail2[$i], $this->tail2[$i-1]);
		}
		$key = implode('|', $this->tail2[9]);
		if(array_key_exists($key, $this->locs2)){
			$this->locs2[$key]++;
		} else {
			$this->locs2[$key] = 1;
		}
	}
	public function run(){
		$f = fopen($this->dataFile, 'r');
		while($line = fgets($f)){
			list($dir, $steps) = explode(' ', trim($line));
			for($i = 1;$i<=$steps;$i++){
				$this->doStep($dir);
				$this->tailFollow();
				$this->longTailFollow();
			}
		}
		$this->solution_1 = count($this->locs);
		$this->solution_2 = count($this->locs2);
	}
}