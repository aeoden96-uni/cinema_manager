<?php

//require_once __DIR__ . '/../model/globalservice.class.php';
//require_once __DIR__ . '/../model/mongoservice.class.php';
require_once __DIR__ . '/../model/cinemaservice.class.php';



class AdminController
{
	function __construct() {
        $this->USERTYPE="admin";
    }

	private function checkPrivilege(){
		if (!isset($_SESSION["account_type"])){
			header( 'Location: index.php?rt=start/logout');
			exit();
		}
        if ( $_SESSION["account_type"] != $this->USERTYPE){
            header( 'Location: index.php?rt=start/logout');
			exit();
        }
	}



	public function index() {
		session_start();
        $this->checkPrivilege();

        $ucenikName=$_SESSION["username"];
        $activeInd=0;
        
        $ime=$_SESSION["username"];
        $naziv=$ime;

        
        $USERTYPE=$this->USERTYPE;
        require_once __DIR__ . '/../view/'.$USERTYPE.'/index.php';   

	}

    function lockSwitch(){
        session_start();
        $this->checkPrivilege();
        $g= new GlobalService();
        $g->switchLockBool(!$g->getLockBool());
        header( 'Location: index.php?rt=admin');
		exit();
   
    }

    function resultsSwitch(){
        session_start();
        $this->checkPrivilege();
        $g= new GlobalService();

        $g->switchResultsBool(!$g->getResultsBool());

        header( 'Location: index.php?rt=admin');
		exit();
   
    }

    
	public function start() {
		session_start();
        $this->checkPrivilege();
        
        $ucenikName=$_SESSION["username"];
        $USERTYPE=$this->USERTYPE;
        $g= new GlobalService();
        $m= new MongoService();

        $m->startAggreagtion();

        $g->switchAgregBool(true);

        //header( 'Location: index.php?rt=admin');
		//exit();  

	}
	public function reset() {
		session_start();
        $this->checkPrivilege();
        
        $ucenikName=$_SESSION["username"];
        $USERTYPE=$this->USERTYPE;
        $g= new GlobalService();
        $m= new MongoService();

        $m->resetAggreagtion();

        $g->switchAgregBool(false);

        header( 'Location: index.php?rt=admin');
		exit();

	}

    public function browser(){

        session_start();
        $this->checkPrivilege();
        

        $activeInd=1;
        $ime=$_SESSION["username"];
        $naziv=$ime;
        $cs = new CinemaService();
        $employees = $cs -> getEmployees();
        
        $USERTYPE=$this->USERTYPE;

        require_once __DIR__ . '/../view/'.$USERTYPE.'/browser.php';    

    }

    public function removeEmpl($id)
    {
        session_start();
        $this->checkPrivilege();

        $ime=$_SESSION["username"];
        $naziv=$ime;
        $cs = new CinemaService();
        $employees = $cs -> removeEmployeeById( $id );
        if( isset( $_SESSION['error'])){
            $error = $_SESSION['error'];
            $_SESSION['error'] = '';
        }
        else $error = '';
        
        $USERTYPE=$this->USERTYPE;
        header( 'Location: index.php?rt=browser');
    }
    
    public function addEmpl() //dobiva preko posta
    {
        session_start();
        $this->checkPrivilege();

        $ime=$_SESSION["username"];
        $naziv=$ime;
        $cs = new CinemaService();

        if( isset( $_POST['name']) && isset( $_POST['email']) && isset( $_POST['pass'])){
            if( filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                $cs->addEmployee( $_POST['name'], $_POST['pass'], $_POST['email']);
            }
            else{
                $_SESSION['error'] = 'Wrong input! Try again';
                header( 'Location: index.php?rt=browser');
            }
        }
        else{
            $_SESSION['error'] = 'Wrong input! Try again';
            header( 'Location: index.php?rt=browser');
        }


    }

    public function globalSettings(){
        session_start();
        $this->checkPrivilege();
        
        $cs = new CinemaService();
        $activeInd=2;
        
        //$user=$m->returnAdminWithUsername($_SESSION["username"]);
        

        $ime=$_SESSION["username"];
        $naziv=$ime;
       
        
        $USERTYPE=$this->USERTYPE;
        require_once __DIR__ . '/../view/'.$USERTYPE.'/otherSettings.php';    
    }

    public function otherSettingsCheck(){
        session_start();
        $this->checkPrivilege();
        $g= new GlobalService();
        $ime=$_SESSION["username"];
        $naziv=$ime;
        $activeInd=5;
        
        $USERTYPE=$this->USERTYPE;

        //$student=$m->returnUcenikWithId($_SESSION["user_id"]);


        if($_POST["lockDate"] != null) 
            $m->changeLockDate(strtotime( $_POST["lockDate"]));
        
        if($_POST["resultDate"] != null) 
            $m->changeResultDate(strtotime( $_POST["resultDate"]));
        
        
        //$newformat = date('d/m/Y',$time);
            
       


        //header( 'Location: index.php?rt=admin/otherSettings');
       // exit(); 
    }

}


?>