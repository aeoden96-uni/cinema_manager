<?php

class Employee
{
    protected $id, $ime, $username;

    function __construct( $id, $ime, $username )
	{
		$this->id = $id;
		$this->ime = $ime;
		$this->username = $username;
	}

	function __get( $prop ) { return $this->$prop; }
	function __set( $prop, $val ) { $this->$prop = $val; return $this; }
}



?>