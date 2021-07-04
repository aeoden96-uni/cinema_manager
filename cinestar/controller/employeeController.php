<?php

require_once __DIR__ . '/../model/globalservice.class.php';

require_once __DIR__ . '/../model/mongoservice.class.php';



class employeeController
{
    function __construct() {
        $this->USERTYPE="employee";
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
       
        $activeInd=0;

        $naziv=$_SESSION["naziv"];
        $ime=$_SESSION["username"];
        



        ////////////////GLOBAL SETTINGS
        $g= new GlobalService();
    
        $lockDate= $g->getLockDate();
        $lockDateString=$lockDate->toDateTime()->format('d.m.Y');

        $resultDate= $g->getResultsDate();
        $resultDateString=$resultDate->toDateTime()->format('d.m.Y');

        $resultBool= $g->getResultsBool();
        $lockBool= $g->getLockBool();
        
        ////////////////GLOBAL SETTINGS
       
        $USERTYPE=$this->USERTYPE;
        require_once __DIR__ . '/../view/'.$USERTYPE.'/index.php';   

	}

    public function myInfo() {
		session_start();
        $this->checkPrivilege();

        $m= new MongoService();
        $naziv=$_SESSION["naziv"];
        $ime=$_SESSION["username"];
        //$list=$m->returnUcenikWithId("60b6d0a2b000b1fc8a909a6f");
        $employee=$m->returnemployeeWithUsername($ime);

        ////////////////GLOBAL SETTINGS
        $g= new GlobalService();
    
        $lockDate= $g->getLockDate();
        $lockDateString=$lockDate->toDateTime()->format('d.m.Y');

        $resultDate= $g->getResultsDate();
        $resultDateString=$resultDate->toDateTime()->format('d.m.Y');

        $resultBool= $g->getResultsBool();
        $lockBool= $g->getLockBool();
        
        ////////////////GLOBAL SETTINGS


        $ucenikName=$_SESSION["username"];
        $activeInd=1;
        
        $USERTYPE=$this->USERTYPE;

       
        require_once __DIR__ . '/../view/'.$USERTYPE.'/myInfo.php'; 

	}



    public function results() {
		session_start();
        $this->checkPrivilege();
        $naziv=$_SESSION["naziv"];
        $ime=$_SESSION["username"];
        ////////////////GLOBAL SETTINGS
        $g= new GlobalService();
        $m= new MongoService();
        $lockDate= $g->getLockDate();
        $lockDateString=$lockDate->toDateTime()->format('d.m.Y');

        $resultDate= $g->getResultsDate();
        $resultDateString=$resultDate->toDateTime()->format('d.m.Y');

        $resultBool= $g->getResultsBool();
        $lockBool= $g->getLockBool();
        
        ////////////////GLOBAL SETTINGS
        

        if($resultBool){
            $list=$m->getEnrolledStudentsForOIB($_SESSION["employee_oib"]);
        }

        

        

        $ucenikName=$_SESSION["username"];
        $activeInd=4;
        
        $USERTYPE=$this->USERTYPE;
        require_once __DIR__ . '/../view/'.$USERTYPE.'/results.php';    

	}
}


?>