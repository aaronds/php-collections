<?php

/**
 * A simple wrapper arround arrays to provide a more expressive syntax.
 */

class Collection {

	public static function fromArray($array){
		$collection = new Collection($array);
		return $collection;
	}

	private function __construct($value){
		$this->value = $value;
	}

	public function map(){
		$args = func_get_args();

		foreach($args as &$fn){
			$this->value = array_map($fn,$this->value);
		} 
		
		return $this;
	}

	public function filter($fn){
		$this->value = array_filter($this->value,$fn);
		return $this;
	}

	public function reduce($fn,$mem = null){
		return array_reduce($this->value,$fn,$mem);
	}

	public function withEach($fn){
		array_walk($this->value,$fn);
		return $this;
	}

	public function start($fn){
		if(count($this->value) > 0){
			$this->value[0] = $fn($this->value[0]);
		}

		return $this;
	}

	public function end($fn){
		$length = count($this->value);
		if($length){
			$this->value[$length - 1] = $fn($this->value[$length - 1]);
		}

		return $this;
	}	

	public function sort($fn){
		usort($this->value,$fn);

		return $this;
	}

	public function count(){
		return count($this->value);
	}

	public function value(){
		return $this->value;
	}

	public function isEmpty(){
		return count($this->value) == 0;
	}
}
