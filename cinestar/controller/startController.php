<?php




require_once __DIR__ . '/../model/userservice.class.php';

class StartController
{

	private function checkPrivilege(){
		if (isset($_SESSION["account_type"])){
			header("Location: index.php?rt=" . $_SESSION["account_type"]);
			exit();			
		}
	}

	public function index() {

		session_start();

		if(isset($_SESSION["error"])){
		    echo $_SESSION["error"];

		    unset($_SESSION["error"]);
        }

		$this->checkPrivilege();

		//ako je ulogiran, nema šta radit na login screenu
		if( isset( $_SESSION['user'] )) 
		{
			header( 'Location: index.php?rt=main');
			exit();
		}

        $title = 'Community Store - Welcome';

		require_once __DIR__ . '/../view/start_index.php';
		require_once __DIR__ . '/../view/_footer.php';
	}

	

	public function signupResult(){
	    session_start();
	    $us= new UserService();

		if( !isset( $_POST['username'] ) || !isset( $_POST['password'] ) || !isset( $_POST['name'] ) )
		{
			$title="Error";
			$succesVar="unsuccessful. :(";
		    $response ="Nisi unio sve potrebne podatke.";	
			
		}

		if(! filter_var( $_POST['username'],FILTER_VALIDATE_EMAIL))
        { 
			$title="Error";
			$succesVar="unsuccessful. :(";
            $response = 'Email nije unesen u korektnom formatu.';   
			     
		}
		else {
            if ($us->checkUsername($_POST['username'])) {
				echo $_POST['username'];
				echo $us->checkUsername($_POST['username']);
				$title="Error";
				$succesVar="unsuccessful. :(";
                $response = 'Korisnik s tim korisničkim imenom već postoji u bazi.';   
				
				//header("Refresh:2; url=index.php?rt=user");
				//exit();      
            }
			else {
				$succesVar="successful.";
				$us->registerUser($_POST['username'], $_POST['name'], $_POST['password']);
				header("Refresh:2; url=index.php?rt=start");
				exit();   
			}
		}
		echo $response ;
		//require_once __DIR__ . '/../view/start_login.php';
	}

/******************************************************************** */

	public function loginCheckUser(){
		/**
		 * KREIRA TEMP STRANICU login successfull ako SET=true
		 * REDIRECT NA user DASHBOARD
		 * 
		 * REDIRECT NA registeruser ako SET=true
		 */
		session_start();
		$us = new UserService();
		

		$user = $us->loginUser($_POST["username"], $_POST["password"]);
		
	
		
		if($user == 'notFound'){
			echo $_POST["username"];
			
			$succesVar="unsuccessful.User doesn't exist. :(";
			session_destroy();
			header("Refresh:2; url=index.php?rt=start");
		}
		elseif($user == 'incorrect'){
			//echo $user->ime;
			$succesVar="unsuccessful. Password incorrect. :(";
			session_destroy();
			header("Refresh:2; url=index.php?rt=start");
		}
		else{
			
			$succesVar="successful.";
			$_SESSION["account_type"] = "user";
			$_SESSION["user_id"]= $user->id;
			$_SESSION["user_name"]= $user->ime;
			$_SESSION["username"]= (string)$user->username;
			$_SESSION["naziv"]= (string)$user->username;				

			header("Refresh:2; url=index.php?rt=user");
		}

		require_once __DIR__ . '/../view/start_login.php';	
	}
	
	public function loginCheckAdmin(){

		session_start();
		$us = new UserService();		

		$user = $us->loginAdmin($_POST["username"], $_POST["password"]);
		$check = true;
		
		if($user == 'notFound'){
			echo $_POST["username"];
			echo " tog admina nema";
			$succesVar="unsuccessful. :(";
			session_destroy();
			header("Refresh:2; url=index.php?rt=start");
		}
		elseif($user == 'incorrect'){
			echo $user->ime;
			$succesVar="unsuccessful. :(";
			session_destroy();
			header("Refresh:2; url=index.php?rt=start");
		}
		else{
			$succesVar="successful.";
			$_SESSION["account_type"] = "admin";
			$_SESSION["user_id"]= $user->id;
			$_SESSION["user_name"]= $user->ime;
			$_SESSION["username"]= (string)$user->username;	
			$_SESSION["naziv"]= (string)$user->username;	

			header("Refresh:2; url=index.php?rt=admin");
		}

		require_once __DIR__ . '/../view/start_login.php';	
	}

	public function loginCheckEmployee(){
		session_start();
		$us = new UserService();	

		$user = $us->loginEmployee($_POST["username"], $_POST["password"]);
		$check = true;

		if($user == 'notFound'){
			echo $_POST["username"];
			echo " tog zaposlenika nema";
			$succesVar="unsuccessful. :(";
			session_destroy();
			header("Refresh:2; url=index.php?rt=start");
		}
		elseif($user == 'incorrect'){
			echo $user->ime;
			$succesVar="unsuccessful. :(";
			session_destroy();
			header("Refresh:2; url=index.php?rt=start");
		}
		else{
			$succesVar="successful.";
			$_SESSION["account_type"] = "employee";
			$_SESSION["user_id"]= $user->id;
			$_SESSION["user_name"]= $user->ime;
			$_SESSION["username"]= (string)$user->ime;	
			$_SESSION["naziv"]= (string)$user->ime;	

			header("Refresh:2; url=index.php?rt=employee");
		}

		require_once __DIR__ . '/../view/start_login.php';
	}

	public function logout() {
		session_start();
        session_unset();
		session_destroy();

		header("Refresh:1; url=index.php?rt=start");

		require_once __DIR__ . '/../view/start_logout.php';
		require_once __DIR__ . '/../view/_footer.php';
		
	}

}; 

?>