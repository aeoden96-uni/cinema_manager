<?php


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



	public function index($danOdDanas = -1) {
		session_start();
        $this->checkPrivilege();

        $status = session_status();
        if($status == PHP_SESSION_NONE){
            //There is no active session
            session_start();
        }
        $this->checkPrivilege();
       
        $activeInd=0;

        $naziv=$_SESSION["naziv"];
        $ime=$_SESSION["username"];
        $movieList=null;
        
        $cs = new CinemaService();

        $date='';
        if($danOdDanas == -1)
            $date= date("Y-m-d");
        else
            $date= date("Y-m-").$danOdDanas ;
        
        $cinema = $cs -> getCinemaInfo();
        $movieList = $cs -> getAllProjectionsForDate($date);
        $USERTYPE=$this->USERTYPE;
        require_once __DIR__ . '/../view/'.$USERTYPE.'/index.php';   

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