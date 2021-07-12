<?php

// Popunjavamo tablice u bazi "probnim" podacima.
require_once __DIR__ . '/db.class.php';

seed_table_korisnik();
seed_table_radnik();

exit( 0 );

// ------------------------------------------
function seed_table_korisnik()
{
	$db = DB::getConnection();

	// Ubaci neke korisnike unutra
	try
	{
		$st = $db->prepare( 'INSERT INTO korisnik(ime, password_hash, email, registration_sequence, has_registered) VALUES (:username, :password, \'a@b.com\', \'abc\', \'1\')' );

		$st->execute( array( 'username' => 'mirko', 'password' => password_hash( 'mirkovasifra', PASSWORD_DEFAULT ) ) );
		$st->execute( array( 'username' => 'slavko', 'password' => password_hash( 'slavkovasifra', PASSWORD_DEFAULT ) ) );
		$st->execute( array( 'username' => 'ana', 'password' => password_hash( 'aninasifra', PASSWORD_DEFAULT ) ) );
		$st->execute( array( 'username' => 'maja', 'password' => password_hash( 'majinasifra', PASSWORD_DEFAULT ) ) );
		$st->execute( array( 'username' => 'pero', 'password' => password_hash( 'perinasifra', PASSWORD_DEFAULT ) ) );
	}
	catch( PDOException $e ) { exit( "PDO error [insert korisnik]: " . $e->getMessage() ); }

	echo "Ubacio u tablicu korisnik.<br />";
}


// ------------------------------------------
function seed_table_radnik()
{
	$db = DB::getConnection();

	// Ubaci neke korisnike unutra
	try
	{
		$st = $db->prepare( 'INSERT INTO radnik(ime, password_hash, email) VALUES (:username, :password, \'a@b.com\')' );

		$st->execute( array( 'username' => 'ela', 'password' => password_hash( 'elinasifra', PASSWORD_DEFAULT ) ) );
		$st->execute( array( 'username' => 'miran', 'password' => password_hash( 'miranovasifra', PASSWORD_DEFAULT ) ) );
		$st->execute( array( 'username' => 'danijel', 'password' => password_hash( 'danijelovasifra', PASSWORD_DEFAULT ) ) );
		$st->execute( array( 'username' => 'luka', 'password' => password_hash( 'lukinasifra', PASSWORD_DEFAULT ) ) );
		$st->execute( array( 'username' => 'marta', 'password' => password_hash( 'martinasifra', PASSWORD_DEFAULT ) ) );
	}
	catch( PDOException $e ) { exit( "PDO error [insert korisnik]: " . $e->getMessage() ); }

	echo "Ubacio u tablicu radnik.<br />";
}


// ------------------------------------------

?> 
 
 
