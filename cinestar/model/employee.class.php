<?php

class Employee
{
    protected $id, $name, $email;

    function __construct( $id, $name, $email )
	{
		$this->id = $id;
		$this->name = $name;
		$this->email = $email;
	}

	function __get( $prop ) { return $this->$prop; }
	function __set( $prop, $val ) { $this->$prop = $val; return $this; }
}



?>