<?php

class Projection
{
    protected $id, $hall_id, $movie_id, $time;

    function __construct( $id, $hall_id, $movie_id, $time )
	{
		$this->id = $id;
        $this->hall_id = $hall_id;
        $this->movie_id = $movie_id;
        $this->time = $time;
        
	}

	function __get( $prop ) { return $this->$prop; }
	function __set( $prop, $val ) { $this->$prop = $val; return $this; }
}


?>