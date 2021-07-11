<?php




//require_once __DIR__ . '/../model/mongoservice.class.php';

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

	public function signup($err=NULL){
		

	    if ( $err != NULL){
	        echo $err;
        }
	    else{
			$title="Register";
            require_once __DIR__ . '/../view/start_signup.php';
        }

	}

	public function signupResult(){
	    session_start();
	    $us= new UserService();

		if( !isset( $_POST['username'] ) || !isset( $_POST['password'] ) || !isset( $_POST['email'] ) )
		{
			$title="Error";
		    $response ="Nisi unio sve potrebne podatke.";
			
		}

		if( !preg_match( '/^[A-Za-z]{3,10}$/', $_POST['username'] ) )
		{
			$title="Error";
            $response = 'Korisničko ime treba imati između 3 i 10 slova.';
           

		}
		else if( !filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL) )
		{
			$title="Error";
            $response ='Email nije ispravan.' ;
            
		}
		else {

            if ($us->checkUsername($_POST['username'])) {
				$title="Error";
                $response = 'Korisnik s tim imenom već postoji u bazi.';
                
            }

			else{
					$newUser=new User(
					null,
					$_POST['username'],
					$_POST['email'],
					$_POST['password'],
					0,
					0,
					0,
					0,
					0
				);

				$response=$us->setRegLink($newUser);
				$title="Registration sequence sent.";

			}

		}

		if($response != NULL){
			
			$response = "Your registration sequence is " .  $response;
			require_once __DIR__ . '/../view/start_regMessage.php';
		}

        
	}

    public function reciveRegSeq(){


	    if(isset($_POST["reqSeq"])){
            $niz=$_POST["reqSeq"];
            session_start();
            $us= new UserService();

            $response= $us->checkRegSeq($niz);

        }
		else{
			$response= "ERROR::reciveRegSeq()::ACCESS";
		}
		header("Refresh:3; url=index.php?rt=start");
		$title="Registration successful.";
		require_once __DIR__ . '/../view/start_regMessage.php';
		exit();




    }


	public function login() {
		session_start();


		$title = '';

		$us= new UserService();

		

		if($us->checkUserLogin()){
			header("Refresh:2; url=index.php?rt=main");
			$succesVar="successful. :)";
            $_SESSION["account_type"] = "user";
		}
		else{
			$succesVar="unsuccessful. :(";
			session_destroy();
			header("Refresh:2; url=index.php?rt=start");
		}

		require_once __DIR__ . '/../view/start_login.php';
		require_once __DIR__ . '/../view/_footer.php';
		
	}

	public function guestLogin() {
		session_start();
		$title = '';


		$_SESSION["account_type"] = "guest"; 

		header("Refresh:2; url=index.php?rt=guest");
		$succesVar="successful. (GUEST)";


		require_once __DIR__ . '/../view/start_login.php';
		require_once __DIR__ . '/../view/_footer.php';
		
	}

	public function logout() {
		session_start();
        session_unset();
		session_destroy();

		header("Refresh:1; url=index.php?rt=start");

		require_once __DIR__ . '/../view/start_logout.php';
		require_once __DIR__ . '/../view/_footer.php';
		
	}

/******************************************************************** */



	public function loginCheckEmployee(){
		session_start();
		//$ms= new MongoService();
		

		//$db=$ms->returnemployeeWithUsername($_POST["username"]);
		//$check=true;
		$succesVar="successful.";
			$_SESSION["account_type"] = "employee";
			$_SESSION["employee_id"]= "1234";
			$_SESSION["employee_oib"]= 123456789;

			$_SESSION["naziv"]= "empoloyee_ime";

			$_SESSION["username"]= (string)"employee_username";
			

			header("Refresh:2; url=index.php?rt=start");

		/*if($db == null){
			echo $_POST["username"];
			echo " tog usera nema";
			$succesVar="unsuccessful. :(";
			session_destroy();
			header("Refresh:2; url=index.php?rt=start");
		}
		elseif($db->admin_password == $_POST["password"]){
			$succesVar="successful.";
			$_SESSION["account_type"] = "employee";
			$_SESSION["employee_id"]= $db->_id;
			$_SESSION["employee_oib"]= $db->oib;

			$_SESSION["naziv"]= $db->naziv;

			$_SESSION["username"]= (string)$db->admin_username;
			

			header("Refresh:2; url=index.php?rt=start");
			
		}
		else{
			echo $db->ime;
			$succesVar="unsuccessful. :(";
			session_destroy();
			header("Refresh:2; url=index.php?rt=start");
		}
		*/

		
		require_once __DIR__ . '/../view/start_login.php';
	}

	public function loginCheckAdmin(){
		session_start();
		
		
		//$ms= new MongoService();
		//$db=$ms->returnAdminWithUsername($_POST["username"]);
		$db=null;
		$succesVar="successful.";
		$_SESSION["account_type"] = "admin";
		$_SESSION["employee_id"]="admin_id1234";

		$_SESSION["naziv"]= "naziv_admin";

		$_SESSION["username"]= "username_admin";
			

			header("Refresh:2; url=index.php?rt=start");

		/*if($db == null){
			echo $_POST["username"];
			echo " tog usera nema";
			$succesVar="unsuccessful. :(";
			session_destroy();
			header("Refresh:2; url=index.php?rt=start");
		}
		elseif($db->admin_password == $_POST["password"]){
			$succesVar="successful.";
			$_SESSION["account_type"] = "admin";
			$_SESSION["employee_id"]= $db->_id;

			$_SESSION["naziv"]= $db->admin_username;

			$_SESSION["username"]= $db->admin_username;
			

			header("Refresh:2; url=index.php?rt=start");
			
		}
		else{
			echo $db->ime;
			$succesVar="unsuccessful. :(";
			session_destroy();
			header("Refresh:2; url=index.php?rt=start");
		}*/


		
		require_once __DIR__ . '/../view/start_login.php';
	}

	public function loginCheckUser(){
		/**
		 * KREIRA TEMP STRANICU login successfull ako SET=true
		 * REDIRECT NA user DASHBOARD
		 * 
		 * REDIRECT NA registeruser ako SET=true
		 */
		session_start();
		//$ms= new MongoService();
		

		//$db=$ms->returnuserWithUsername($_POST["username"]);
		$check=true;
		

		/*if($db == null){
			echo $_POST["username"];
			echo " tog usera nema";
			$succesVar="unsuccessful. :(";
			session_destroy();
			header("Refresh:2; url=index.php?rt=start");
		}
		elseif($db->password == $_POST["password"]){
			$succesVar="successful.";
			$_SESSION["account_type"] = "user";
			$_SESSION["user_id"]= $db->_id;
			$_SESSION["user_name"]= $db->ime;
			$_SESSION["username"]= (string)$db->username;
			$_SESSION["user_list"]=$db->lista_fakulteta;

			header("Refresh:2; url=index.php?rt=start");
			
		}
		else{
			echo $db->ime;
			$succesVar="unsuccessful. :(";
			session_destroy();
			header("Refresh:2; url=index.php?rt=start");
		}*/
		
		$succesVar="successful.";
		$_SESSION["account_type"] = "user";
		$_SESSION["user_id"]= "123456"/*$db->_id*/;
		$_SESSION["user_name"]= "Mirko"/*$db->ime*/;
		$_SESSION["username"]= "mirko96" /*(string)$db->username*/;
		$_SESSION["user_list"]= null/*$db->lista_fakulteta*/;

		header("Refresh:2; url=index.php?rt=start");
		


		
		require_once __DIR__ . '/../view/start_login.php';
		
	}
	

}; 

?>