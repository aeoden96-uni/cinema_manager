<?php

//require_once __DIR__ . '/../model/globalservice.class.php';

//require_once __DIR__ . '/../model/mongoservice.class.php';

require_once __DIR__ . '/../model/cinemaservice.class.php';



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


	public function index($danOdDanas = -1) {
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
        
        
        $movieList = $cs -> getAllProjectionsForDate($date);
        
        



       
        $USERTYPE=$this->USERTYPE;
        require_once __DIR__ . '/../view/'.$USERTYPE.'/index.php';   

	}

    public function myInfo() {
		session_start();
        $this->checkPrivilege();

        //$m= new MongoService();
        $naziv=$_SESSION["naziv"];
        $ime=$_SESSION["username"];
        //$list=$m->returnUcenikWithId("60b6d0a2b000b1fc8a909a6f");
        //$employee=$m->returnemployeeWithUsername($ime);

       


        $ucenikName=$_SESSION["username"];
        $activeInd=1;
        
        $USERTYPE=$this->USERTYPE;

       
        require_once __DIR__ . '/../view/'.$USERTYPE.'/myInfo.php'; 

	}


    public function movie( $id )
    {
        session_start();
        $this->checkPrivilege();

        $ime=$_SESSION["username"];
        $naziv=$_SESSION["naziv"];

        $naziv=$ime;

        $cs = new CinemaService();
        
        $USERTYPE=$this->USERTYPE;
        $movie = $cs -> getMovieById( $id );
        $projections = $cs -> getProjectionsByMovieId( $id );
        $dates = $cs -> getDatesByMovieId( $id );

        require_once __DIR__ . '/../view/'.$USERTYPE.'/movie.php';  
    }

    public function browseMovies() {  //popis filmova
		session_start();
        $this->checkPrivilege();
        
        $ime=$_SESSION["username"];
        $naziv=$ime;
        $activeInd=3;
        $cs = new CinemaService();

        $cs -> erasePastProjections();

        $USERTYPE=$this->USERTYPE;

        $movieList = $cs -> getAllMovies();

        require_once __DIR__ . '/../view/'.$USERTYPE.'/browseMovies.php';    

	}

    public function addMovie()
    {
        session_start();
        $this->checkPrivilege();
        $naziv=$_SESSION["naziv"];
        $ime=$_SESSION["username"];
        $activeInd=2;
        $USERTYPE=$this->USERTYPE;
        if( isset( $_SESSION['error']))
            $error = $_SESSION['error'];
        else $error = '';
        $_SESSION['error'] = '';
        require_once __DIR__ . '/../view/'.$USERTYPE.'/addMovie.php'; 


    }

    public function newMovie() //dobiva preko POST
    {
        session_start();
        $this->checkPrivilege();
        $naziv=$_SESSION["naziv"];
        $ime=$_SESSION["username"];
        $USERTYPE=$this->USERTYPE;
        $cs = new CinemaService();
        if( isset($_POST['name']) && isset($_POST['desc']) && isset($_POST['year']) && isset($_POST['dur']) && isset($_POST['img']) ){
            //provjera je li dobar oblik
            $cs -> addNewMovie( $_POST['name'], $_POST['desc'], $_POST['year'], $_POST['dur']);
            header('Location: index.php?rt=employee/browseMovies');
        }
        else{ 
            $_SESSION['error'] = 'Wrong input! Try again';
            header('Location: index.php?rt=employee/addMovie');
        }
        
    }

    public function addProjection( $movie_id )
    {
        session_start();
        $this->checkPrivilege();
        $naziv=$_SESSION["naziv"];
        $ime=$_SESSION["username"];

        $USERTYPE=$this->USERTYPE;

        $cs = new CinemaService();

        $movie = $cs->getMovieById( $movie_id);

        require_once __DIR__ . '/../view/'.$USERTYPE.'/addProjection.php'; 
    }

    public function newProjection( $movie_id ) //dobiva preko POST
    {
        session_start();
        $this->checkPrivilege();
        $naziv=$_SESSION["naziv"];
        $ime=$_SESSION["username"];

        $USERTYPE=$this->USERTYPE;

        $cs = new CinemaService();

        if( isset($_POST['hall']) && isset($_POST['date']) && isset($_POST['time']) ){
            //provjera je li dobar oblik
            if( $cs -> checkIfTheNewProjectionIsOk($movie_id, (int)$_POST['hall'], $_POST['date'], $_POST['time']) ){
                $cs -> addNewProjection( $movie_id, (int)$_POST['hall'], $_POST['date'], $_POST['time'] );
                header('Location: index.php?rt=employee/movie/' . $movie_id);
            }
            else{
                $_SESSION['error'] = 'There already is another projection at this time!';
                header('Location: index.php?rt=employee/addProjection/' . $movie_id);
            }
            
        }
        else{ 
            $_SESSION['error'] = 'Wrong input! Try again';
            header('Location: index.php?rt=employee/addProjection/' . $movie_id);
        }

        
    }
    public function vratiRezervMjesta()
    {
        $cs = new CinemaService();
        $reservation_id = $_POST['id'];
        $reservedSeats= $cs->getReservedSeatsByReservationId(  $reservation_id);

        header( 'Content-type:application/json;charset=utf-8' );
        echo json_encode($reservedSeats);
        flush();
    }

    public function sell()
    {
        $cs = new CinemaService();
        $action = $_POST['action'];
        $seats = $_POST['seats'];
        $rez_id = $_POST['rez'];

        

        header( 'Content-type:application/json;charset=utf-8' );
        echo json_encode($rez_id);
        flush();
    }

    public function seatSelection()
    {
       
        session_start();
        $this->checkPrivilege();
        $naziv=$_SESSION["naziv"];
        $ime=$_SESSION["username"];

        $USERTYPE=$this->USERTYPE;

        $cs = new CinemaService();

        $reservation_id = $_POST['id'];

        $seats;

        $proj_id= $cs->getProjectionIdByReservationId( $reservation_id);

        if($proj_id == null) {
            header( 'Location: index.php?rt=$USERTYPE');
			exit();
        }

        $size=$cs->getSizeOfHallByProjectionId( $proj_id);
    
        require_once __DIR__ . '/../view/'.$USERTYPE.'/seatSelection.php'; 
        
    }
}


?>