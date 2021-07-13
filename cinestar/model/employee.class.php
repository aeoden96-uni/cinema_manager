<?php

class Employee
{
    protected $id, $ime, $username;

    function __construct( $id, $username, $email )
	{
		$this->id = $id;
		$this->username = $username;
		$this->email = $email;
	}

	function __get( $prop ) { return $this->$prop; }
	function __set( $prop, $val ) { $this->$prop = $val; return $this; }
}



?>