<?php

//require_once __DIR__ . '/../model/globalservice.class.php';

//require_once __DIR__ . '/../model/mongoservice.class.php';

require_once __DIR__ . '/../model/cinemaservice.class.php';


function datum ($date)
{
    return date_format(date_create($date), 'd.m.');
}


class MySeat {
    public $x;
    public $y;
  
    public function  __construct($x,$y) {
      $this->x = $x;
      $this->y = $y;

    }

    
}


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

        $cs = new CinemaService();
        $cs -> erasePastProjections();

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

    public function seatSelectionConfirm() {
		session_start();

        //POSTAVI $_POST["seats"] za $_POST["prikaz"] U BAZU,VRATI BROJ REZERVACIJE
       
        $message = [];
        $message[ 'uspjeh' ] = True;
        $message[ 'rezervacija' ] = 1234;
        header( 'Content-type:application/json;charset=utf-8' );
        echo json_encode( $message );
        flush();
   
    }
    public function reservationSuccess() {
		session_start();

        

        $ime=$_SESSION["user_name"];
        $naziv=$ime;
        $activeInd=0;


        $USERTYPE=$this->USERTYPE;
        require_once __DIR__ . '/../view/'.$USERTYPE.'/reservationSuccess.php';    
   
    }

    public function vratiZauzetaMjesta($prikazId){
        
        $zauzeta=[];
        $cs = new CinemaService();
        $reserved = $cs -> getReservedSeatsByProjectionId( $prikazId );
        foreach ( $reserved as $seat)
        {
            $zauzeta[] = new MySeat( (int)$seat[1], (int)$seat[0]); //seat[0] je sjedalo, seat[1] je red
        }
        /*$zauzeta[]= new MySeat(1,1);
        $zauzeta[]= new MySeat(2,3);
        $zauzeta[]= new MySeat(2,4);*/

        header( 'Content-type:application/json;charset=utf-8' );
        echo json_encode( $zauzeta );
        flush();

    }

    public function seatSelection($prikaz_id) {//DOBIJE POMOCU GETa: PRIKAZ_id 
		session_start();

        $ime=$_SESSION["user_name"];
        $naziv=$ime;
        $activeInd=0;


        //U BAZU prikaz_id ------> VELICINA DVORANE I ZAUZETA MJESTA
        $cs = new CinemaService();
        $size = $cs -> getSizeOfHallByProjectionId( $prikaz_id );
        $br_redova = $size[0];
        $velicina_reda = $size[1];
        $movie = $cs -> getMovieByProjectionId( $prikaz_id );
        $projection = $cs -> getProjectionById( $prikaz_id);
        $date = datum( $projection->date);

        $USERTYPE=$this->USERTYPE;
        require_once __DIR__ . '/../view/'.$USERTYPE.'/seatSelection.php';    

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

        $student=$m->returnserWithId($_SESSION["user_id"]);

        $lista= $student->lista_fakulteta;

        $m->pushNewListToStudentWithId($_SESSION["user_id"],$lista,$index,"DEL");

        header( 'Location: index.php?rt=user/myList');
		exit();
    }


    public function browseMovies() {  //popis filmova
		session_start();
        $this->checkPrivilege();
        
        $ime=$_SESSION["user_name"];
        $naziv=$ime;
        $activeInd=2;
        $cs = new CinemaService();

        $cs -> erasePastProjections();

        $USERTYPE=$this->USERTYPE;

        $movieList = $cs -> getAllMovies();

        require_once __DIR__ . '/../view/'.$USERTYPE.'/browseMovies.php';    

	}

    public function myReservations() { //rezervacije
		session_start();
        $this->checkPrivilege();

        $ime=$_SESSION["user_name"];
        $naziv=$ime;
        $activeInd=3;
        $cs = new CinemaService();
        
        $USERTYPE=$this->USERTYPE;

        $cs -> erasePastProjections();

        $reservationList = $cs -> getMoviesByUserName($ime);

        require_once __DIR__ . '/../view/'.$USERTYPE.'/myReservations.php';    

	}

    public function movie( $id )
    {
        session_start();
        $this->checkPrivilege();

        $ime=$_SESSION["user_name"];

        $naziv=$ime;

        $cs = new CinemaService();
        
        $USERTYPE=$this->USERTYPE;
        $movie = $cs -> getMovieById( $id );
        $projections = $cs -> getProjectionsByMovieId( $id );
        $dates = $cs -> getDatesByMovieId( $id );

        require_once __DIR__ . '/../view/'.$USERTYPE.'/movie.php';  
    }

    public function projection( $id ) //tu se odabiru sjedala
    {
        session_start();
        $this->checkPrivilege();

        $ime=$_SESSION["user_name"];

        $naziv=$ime;

        $cs = new CinemaService();
        
        $USERTYPE=$this->USERTYPE;

        $movie = $cs -> getMovieByProjectionId( $id );

        $hall_id = $cs -> getHallIdByProjectionId( $id );
        

        require_once __DIR__ . '/../view/'.$USERTYPE.'/projection.php';
    }

    public function cancel( $id ) //otkaži rezervaciju
    {
        session_start();
        $this->checkPrivilege();

        $ime=$_SESSION["user_name"];

        $naziv=$ime;

        $cs = new CinemaService();
        
        $USERTYPE=$this->USERTYPE;

        $cs -> cancelReservationById( $id );
        header('Location: index.php?rt=user/myReservations');
    }

    public function reservation()
    {
        session_start();
        $this->checkPrivilege();

        $ime=$_SESSION["user_name"];

        $naziv=$ime;


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