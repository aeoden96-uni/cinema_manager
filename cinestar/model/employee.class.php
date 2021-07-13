<?php

class Employee
{
    protected $id, $ime, $email;

    function __construct( $id, $username, $email )
	{
		$this->id = $id;
		$this->ime = $username;
		$this->email = $email;
	}

	function __get( $prop ) { return $this->$prop; }
	function __set( $prop, $val ) { $this->$prop = $val; return $this; }
}



?>