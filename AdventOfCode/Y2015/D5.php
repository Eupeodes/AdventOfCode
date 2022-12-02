<?php

namespace Eupeodes\AdventOfCode\Y2015;

use Eupeodes\AdventOfCode\Day;

class D5 extends Day{
	private $strings;
	public function __construct(){
		$this->strings = file(__DIR__.'/D5.txt');
	}

	public function run(){
		$res1 = [
			'nice' => 0,
			'naughty' => 0
		];
		$res2 = [
			'nice' => 0,
			'naughty' => 0
		];
		foreach($this->strings as $str){
			$res1[$this->isNice($str) ? 'nice' : 'naughty']++;
			$res2[$this->isNice2($str) ? 'nice' : 'naughty']++;
		}
		$this->solution_1 = $res1['nice'];
		$this->solution_2 = $res2['nice'];
	}
	
	private function isNice ($str){
		preg_match_all('/[aeiuo]/', $str, $matches);
		if(count($matches[0]) < 3){
			return false;
		}
		preg_match_all('/(ab|cd|pq|xy)/', $str, $matches);
		if(count($matches[0]) > 0){
			return false;
		}
		$chars = str_split($str);
		$prev = '';
		foreach($chars as $char){
			if($char == $prev){
				return true;
			}
			$prev = $char;
		}
		return false;
	}
	
	private function isNice2($str){
		$chars = str_split($str);
		$prev = '';
		$pprev = '';
		$chunks = [];
		$repeat = false;
		$duo = false;
		foreach($chars as $char){
			$str = $prev.$char;
			$p = array_search($str, $chunks);
			if($p && $p < count($chunks)-1){
				$duo = true;
			}
			$chunks[] = $str;
			if($char == $pprev){
				$repeat = true;
			}
			$pprev = $prev;
			$prev = $char;
		}
		return ($repeat && $duo);
	}
}