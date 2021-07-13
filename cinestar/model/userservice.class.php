<?php
require_once __DIR__ . '/../app/database/db.class.php';
require_once __DIR__ . '/user.class.php';
require_once __DIR__ . '/employee.class.php';
require_once __DIR__ . '/admin.class.php';


class UserService
{
    function loginUser($username, $password)
    {
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT * FROM korisnik WHERE username:=username');
			$st->execute( array( 'username' => $username ) );			
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

        $row = $st->fetch();

        $user = new User();

        if (isset($row['id']))
        {
            if( password_verify( $password, $row['password_hash'] ) )
                $user = new User($row['id'], $row['ime'], $row['username'], $password);                
            else
                return 'incorrect';
        } else
            return 'notFound';

		return $user;
    }

    function loginEmployee($username, $password)
    {
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT * FROM employee WHERE username:=username');
			$st->execute( array( 'username' => $username ) );			
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

        $row = $st->fetch();

        $employee = new Employee();

        if (isset($row['id']))
        {
            if( password_verify( $password, $row['password_hash'] ) )
                $employee = new Employee($row['id'], $row['ime'], $row['username'], $password);                
            else
                return 'incorrect';
        } else
            return 'notFound';

		return $employee;
    }

    function loginAdmin($username, $password)
    {
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT * FROM admin WHERE username:=username');
			$st->execute( array( 'username' => $username ) );			
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

        $row = $st->fetch();

        $admin = new Admin();

        if (isset($row['id']))
        {
            if( password_verify( $password, $row['password_hash'] ) )
                $admin = new Admin($row['id'], $row['ime'], $row['username'], $password);                
            else
                return 'incorrect';
        } else
            return 'notFound';

		return $admin;
    }

    function checkUsername($username)
    {
        try
		{
			$db = DB::getConnection();
			$st = $db->prepare( 'SELECT * FROM korisnik WHERE username:=username');
			$st->execute( array( 'username' => $username ) );			
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }

        $row = $st->fetch();    

        if (isset($row['id']))
            return True;
        else
            return False;
    }

    function registerUser($username, $user_name, $password)
    {
        try
		{
			$db = DB::getConnection();
            $hash = password_hash( $password, PASSWORD_DEFAULT );
			$st = $db->prepare('INSERT INTO korisnik (id, ime, username, password_hash, register_sequence, has_registered, popust) 
                VALUES(:id, :ime, :username, :password_hash, :register_sequence, :has_registered, :popust)');

			$stt = $db->prepare('SELECT id FROM korisnik');
			$stt->execute();
			$id = $stt -> rowCount() + 1;

			$st->execute( array( 'id' => $id, 'ime' => $user_name, 'username' => $username, 'password_hash' => $hash, 'register_sequence' => '1111', 'has_registered' => '1', 'popust' => '1') );
			
		}
		catch( PDOException $e ) { exit( 'PDO error ' . $e->getMessage() ); }
    }
}


?>