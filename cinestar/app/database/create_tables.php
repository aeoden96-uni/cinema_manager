<?php


require_once __DIR__ . '/db.class.php';

create_table_korisnik();
create_table_radnik();

//exit( 0 );

// --------------------------
function has_table( $tblname )
{
	$db = DB::getConnection();
	
	try
	{
		$st = $db->query( 'SELECT DATABASE()' );
		$dbname = $st->fetch()[0];

		$st = $db->prepare( 
			'SELECT * FROM information_schema.tables WHERE table_schema = :dbname AND table_name = :tblname LIMIT 1' );
		$st->execute( ['dbname' => $dbname, 'tblname' => $tblname] );
		if( $st->rowCount() > 0 )
			return true;
	}
	catch( PDOException $e ) { exit( "PDO error [show tables]: " . $e->getMessage() ); }

	return false;
}


function create_table_korisnik()
{
	$db = DB::getConnection();

	if( has_table( 'korisnik' ) )
		exit( 'Tablica dz2_users vec postoji. Obrisite ju pa probajte ponovno.' );

	try
	{
		$st = $db->prepare( 
			'CREATE TABLE IF NOT EXISTS korisnik (' .
			'id int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
			'username varchar(50) NOT NULL,' .
			'password_hash varchar(255) NOT NULL,'.
			'email varchar(50) NOT NULL,' .
			'registration_sequence varchar(20) NOT NULL,' .
			'has_registered int)'
		);

		$st->execute();
	}
	catch( PDOException $e ) { exit( "PDO error [create korisnik]: " . $e->getMessage() ); }

	echo "Napravio tablicu korisnik.<br />";
}


function create_table_radnik()
{
	$db = DB::getConnection();

	if( has_table( 'radnik' ) )
		exit( 'Tablica radnik vec postoji. Obrisite ju pa probajte ponovno.' );

	try
	{
		$st = $db->prepare( 
			'CREATE TABLE IF NOT EXISTS radnik (' .
			'id int NOT NULL PRIMARY KEY AUTO_INCREMENT,' .
            'ime varchar(100) NOT NULL,'.
			'password_hash varchar(255) NOT NULL,'.
			'email varchar(50) NOT NULL )'
		);

		$st->execute();
	}
	catch( PDOException $e ) { exit( "PDO error [create dz2_products]: " . $e->getMessage() ); }

	echo "Napravio tablicu radnik.<br />";
}
