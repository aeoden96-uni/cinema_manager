<?php

//require_once __DIR__ . '/../model/globalservice.class.php';

//require_once __DIR__ . '/../model/mongoservice.class.php';




class userController
{
    function __construct() {
        $this->USERTYPE="user";
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
        //$m= new MongoService();
        $activeInd=0;


        $ime=$_SESSION["user_name"];
        $naziv=$ime;
        $activeInd=0;
        $student="";
        $new_list="";

        ////////////////GLOBAL SETTINGS
        //$g= new GlobalService();
    
        $lockDate= "";
        $lockDateString="";

        $resultDate= "";
        $resultDateString="";

        $resultBool= "";
        $lockBool= "";
        
        ////////////////GLOBAL SETTINGS


        $USERTYPE=$this->USERTYPE;
        require_once __DIR__ . '/../view/'.$USERTYPE.'/index.php';    

	}

    
	public function myInfo() {
		session_start();





        
        

        $ime=$_SESSION["user_name"];
        $naziv=$ime;
        $activeInd=1;
        
        $USERTYPE=$this->USERTYPE;
        require_once __DIR__ . '/../view/'.$USERTYPE.'/myInfo.php'; 

	}



    public function myListPushUp($index){
        session_start();
        $this->checkPrivilege();
        $m= new MongoService();

        $student=$m->returnuserWithId($_SESSION["user_id"]);

        $lista= $student->lista_fakulteta;


        $m->pushNewListToStudentWithId($_SESSION["user_id"],$lista,$index,"UP");

        //echo "<script>console.log(".$lista.");</script>";
        header( 'Location: index.php?rt=user/myList');
		exit();
    }
    public function myListPushDown($index){
        session_start();
        $this->checkPrivilege();
        $m= new MongoService();

        $student=$m->returnuserWithId($_SESSION["user_id"]);

        $lista= $student->lista_fakulteta;

        $m->pushNewListToStudentWithId($_SESSION["user_id"],$lista,$index,"DOWN");

        header( 'Location: index.php?rt=user/myList');
		exit();
    }

    public function myListInsert($faksOib){
        session_start();
        $this->checkPrivilege();
        $m= new MongoService();

        $student=$m->returnuserWithId($_SESSION["user_id"]);

        $lista= $student->lista_fakulteta;

        echo ($faksOib);
        echo gettype($faksOib);

        $m->pushNewListToStudentWithId($_SESSION["user_id"],$lista,-1,"INS",(string)$faksOib);

        header( 'Location: index.php?rt=user/browser');
		exit();
    }

    public function myListDelete($index){
        session_start();
        $this->checkPrivilege();
        $m= new MongoService();

        $student=$m->returnuserWithId($_SESSION["user_id"]);

        $lista= $student->lista_fakulteta;

        $m->pushNewListToStudentWithId($_SESSION["user_id"],$lista,$index,"DEL");

        header( 'Location: index.php?rt=user/myList');
		exit();
    }


    public function myList() {  //LISTA user -> FAKULTETI
		session_start();
        $this->checkPrivilege();
       
       


        $ime=$_SESSION["user_name"];
        $naziv=$ime;
        $activeInd=2;

        $USERTYPE=$this->USERTYPE;

        require_once __DIR__ . '/../view/'.$USERTYPE.'/myList.php';    

	}

    public function browser() { //LISTA FAKULTETA
		session_start();
        $this->checkPrivilege();
        
       

       
        ////////
        $ime=$_SESSION["user_name"];
        $naziv=$ime;
        $activeInd=3;
        
        $USERTYPE=$this->USERTYPE;
        require_once __DIR__ . '/../view/'.$USERTYPE.'/browser.php';    

	}

  
    public function otherSettings() {
		session_start();
        $this->checkPrivilege();
        

        $ime=$_SESSION["user_name"];
        $naziv=$ime;
        $activeInd=5;
        
        $USERTYPE=$this->USERTYPE;

        require_once __DIR__ . '/../view/'.$USERTYPE.'/otherSettings.php';   

	}

    public function otherSettingsCheck() {
		session_start();
        $this->checkPrivilege();
        $m= new MongoService();
        $ime=$_SESSION["user_name"];
        $naziv=$ime;
        $activeInd=5;
        
        $USERTYPE=$this->USERTYPE;

        $student=$m->returnuserWithId($_SESSION["user_id"]);


        if($_POST["username"] != null)
            $m->changeuserWithId($_SESSION["user_id"],"username",$_POST["username"]);
        
        if($_POST["email"] != null)
            $m->changeuserWithId($_SESSION["user_id"],"email",$_POST["email"]);
        
        if($_POST["password"] != null)
            $m->changeuserWithId($_SESSION["user_id"],"password",$_POST["password"]);


        header( 'Location: index.php?rt=user/otherSettings');
        exit(); 

	}



};
?>