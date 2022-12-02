<?php

namespace Eupeodes\AdventOfCode;

class App {
	private $start = null;
	private $year;
	private $day;
	public function __construct(){
		$this->start = microtime(true);
	}
	
	public function run($argv){
		helpers::printMsg('Started');
		$this->year = $argv[2];
		$this->day = $argv[3];
		switch($argv[1]){
			case 'init':
				$this->init();
				break;
			case 'solve':
			case 'run':
				$this->solve();
				break;
			default:
				helpers::printMsg('No valid action found');
		}
		helpers::printMsg('Finished in '.(microtime(true) - $this->start));
	}
	
	private function solve(){
		$class = sprintf("Eupeodes\\AdventOfCode\\Y%d\\D%s", $this->year, $this->day);
		if(class_exists($class)){
			$solver = new $class;
			$solver->run();
			helpers::printMsg('1: ' . $solver->solution_1);
			helpers::printMsg('2: ' . $solver->solution_2);
		} else {
			helpers::printMsg('No solver available');
		}
	}
	
	private function init(){
		if(!is_dir(__DIR__ . '/Y' . $this->year)){
			mkdir(__DIR__ . '/Y' . $this->year);
		}
		$this->initSolution();
		$this->initData();
	}
	
	private function initSolution(){
		$file = __DIR__ . '/Y' . $this->year . '/D' . $this->day . '.php';
		if(file_exists($file)){
			helpers::printMsg('Solution file already exists');
			return false;
		}
		$tpl = file_get_contents(__DIR__.'/day.tpl');
		$tpl = str_replace('{year}', $this->year, $tpl);
		$tpl = str_replace('{day}', $this->day, $tpl);
		file_put_contents($file, $tpl);
		helpers::printMsg('Solution file initialized');
		return true;
	}
	
	private function initData(){
		$file = __DIR__ . '/Y' . $this->year . '/D' . $this->day . '.txt';
		if(file_exists($file)){
			helpers::printMsg('Data file already exists');
			return false;
		}
		$url = sprintf('https://adventofcode.com/%d/day/%d/input', $this->year, $this->day);
		$c = new Curl($url);

		$res = $c->get();
		if ($c->responseCode == 200){
			file_put_contents($file, $res);
			helpers::printMsg('Input data saved');
			return true;
		} else {
			helpers::printMsg('Input data not available');
			return false;
		}
	}
}