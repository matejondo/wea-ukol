<?php
class Point {
	public $id;
	public $x;
	public $y;
	public function __construct($id, $x, $y) {
	  $this->id = $id;	
	  $this->x = $x;
	  $this->y = $y;
	}
	public function distanceOrigin() {
	  return sqrt($this->x * $this->x + $this->y * $this->y);
	}
	public function __toString() {
	  return "[$this->x , $this->y]";
	}
  
} 
?>