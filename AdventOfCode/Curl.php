<?php

namespace Eupeodes\AdventOfCode;

class Curl {
	private $c;
	public $responseCode = 0;
	function __construct($url){
		$this->c = curl_init($url);
		$this->setOption(
			CURLOPT_COOKIE,
			'session='.file_get_contents('cookie.txt')
		);
		$this->setOption(
			CURLOPT_USERAGENT,
			'github.com/eupeodes/AdventOfCode by aoc@eupeodes.nl'
		);
	}
	
	private function setOption($option, $value){
		curl_setopt($this->c, $option, $value);
	}
	public function get(){
		$this->setOption(
			CURLOPT_RETURNTRANSFER,
			1
		);
		$res = curl_exec($this->c);
		$this->responseCode = curl_getinfo($this->c)['http_code'];
		return $res;
	}
}