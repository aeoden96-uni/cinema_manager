<?php
require_once __DIR__ . '/../app/database/db.class.php';
require_once __DIR__ . '/user.class.php';
require_once __DIR__ . '/movie.class.php';
require_once __DIR__ . '/projection.class.php';



class CinemaService
{
    function getAllMovies()
    {
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT * FROM film');
			$st->execute( );
			
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		
		$arr = array();
		while( $row = $st->fetch() )
		{
			$name = $row['ime'];
			$id = $row['id'];
            $projections = $this -> getProjectionsByMovieId( $id );
			$arr[] = ['movie' => new Movie( $row['id'], $row['ime'], $row['opis'], $row['godina'], $row['trajanje'] ),
                        'projections' => $projections]; //dodaj projekcije
		}

		return $arr;
    
    }

    function getMoviesBySearch( $name )
    {
        $regexp = '/' . $name . '/i';
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT * FROM film' );
			$st->execute( );
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		$arr = array();
		while( $row = $st->fetch() )
		{
			if( preg_match( $regexp, $row['ime'] ) ){
                $projections = $this -> getProjectionsByMovieId( $row['id'] );
				$arr[] = ['movie' => new Movie( $row['id'], $row['ime'], $row['opis'], $row['godina'], $row['trajanje'] ),
                            'projections' => $projections];
			}
		}

		return $arr;
    }

    function getMoviesByUserName( $name ) //koje filmove je user rezervirao
    {
		$id = $this->getUserIdByUserName( $name );
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT * FROM rezervacija WHERE user_id=:id_user' );
			$st->execute( array( 'id_user' => $id ) );
			
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		
		$arr = array();
		while( $row = $st->fetch() )
		{
			$movie_id = $this->getMovieIdByProjectionId( $row['prikaz_id'] );
			$movie = $this->getMovieById( $movie_id );
            $projection = $this->getProjectionById( $row['prikaz_id']);
			$arr[] = ['movie' => $movie,
                        'projection' => $projection,
						'tics' => $row['broj_karata'],
						'id' => $row['id']];
                       // 'price' => $row['price']];
		}

		return $arr;
    }

	function getUserIdByUserName( $name ) //vraća id
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT id FROM korisnik WHERE ime=:ime' );
			$st->execute( array( 'ime' => $name ) );
			
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
		$user = $st -> fetch();
		return $user['id'];

	}

    function getMovieIdByProjectionId( $id ) //vraća id filma
    {
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT film_id FROM prikaz WHERE id=:id ' );
			$st->execute( array( 'id' => $id ) );
			
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

        $movie = $st->fetch();
        return $movie['film_id'];
    }

    function getMovieById( $id ) //vraća film (class Movie )
    {
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT * FROM film WHERE id=:id' );
			$st->execute( array( 'id' => $id ) );
			
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

        $movie = $st->fetch();
        return new Movie( $id, $movie['ime'], $movie['opis'], $movie['godina'], $movie['trajanje'] );
    }

    function getProjectionsByMovieId( $id ) //vraća array of class Projection
    {
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT * FROM prikaz WHERE film_id=:id ' );
			$st->execute( array( 'id' => $id ) );
			
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

        $arr = array();
		while( $row = $st->fetch() ){
            $arr[] = new Projection( $row['id'], $row['dvorana_id'], $row['film_id'], $row['vrijeme']);
        }
        return $arr;

    }

    function getProjectionById( $id ) //vraća class Projection
    {
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT * FROM prikaz WHERE id=:id ' );
			$st->execute( array( 'id' => $id ) );
			
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

        $row =$st->fetch();
        return new Projection( $row['id'], $row['dvorana_id'], $row['film_id'], $row['datum'], $row['vrijeme']);
    }

	function makeReservation( $user_name, $projectionId)
	{

	}

	function getDatesByMovieId( $id )
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT DISTINCT datum FROM prikaz WHERE film_id=:id ' );
			$st->execute( array( 'id' => $id ) );
			
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		$arr = array();
		while( $row = $st->fetch() ){
            $arr[] = $row['datum'];
        }
        return $arr;
	}

	function getMovieByProjectionId( $id )
	{
		$movie_id = $this->getMovieIdByProjectionId( $id );
		$movie = $this -> getMovieById( $movie_id );
		return $movie;
	}

	function getHallIdByProjectionId( $id )
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT dvorana_id FROM prikaz WHERE id=:id ' );
			$st->execute( array( 'id' => $id ) );
			
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

		$row = $st->fetch();
		return $row['dvorana_id'];
	}

	function cancelReservationById( $id )
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'DELETE FROM rezervacija WHERE id=:id' );
			$st->execute( array( 'id' => $id ) );
			
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
		
		//updejtaj slobodna sjedala
	}

	function erasePastProjections()
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'DELETE * FROM prikaz WHERE  ' );
			$st->execute( array(  ) );
			
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
	}

	function erasePastReservations()
	{
		try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'DELETE * FROM rezervacija WHERE  ' );
			$st->execute( array(  ) );
			
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
	}
}


?>