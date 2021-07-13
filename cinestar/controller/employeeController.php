<?php

require_once __DIR__ . '/../model/cinemaservice.class.php';

function datum ($date)
{
    return date_format(date_create($date), 'd.m.');
}

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
        $naziv=$_SESSION["naziv"];
        $ime=$_SESSION["username"];
        $id = $_SESSION['user_id'];

        $cs = new CinemaService();

        if( isset($_POST['password']) && $_POST['password'] !== '')
            $cs -> changePassByEmployeeId( $id, $_POST['password']);
        if( isset($_POST['email'] ) ){
            if( filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ){
                $cs -> changeEmailByEmployeeId( $id, $_POST['email']);
        }
        else{
            $_SESSION['error'] = 'Wrong email adress! Try again';
            header( 'Location: index.php?rt=user/otherSettings');
            exit();
        }
            
    }

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
        if( isset($_POST['name']) && isset($_POST['desc']) && isset($_POST['year']) && isset($_POST['dur']) ){
            if( !isset($_FILES['img'])){
                $_SESSION['error'] = 'Wrong file! Try again';
                header('Location: index.php?rt=employee/addMovie');
                exit();
            }
            if( preg_match("/^([1-2][0-9][0-9][0-9])$/", $_POST['year']) && preg_match("/^(([0-1][0-9])|([2][0-3])):[0-5][0-9]$/" , $_POST['dur'])){

                $cs -> addNewMovie( $_POST['name'], $_POST['desc'], $_POST['year'], $_POST['dur']);
                header('Location: index.php?rt=employee/browseMovies');
                exit();
            }
            else{ 
                $_SESSION['error'] = 'Wrong input! Try again';
                header('Location: index.php?rt=employee/addMovie');
                exit();
            }
        }
        else{ 
            $_SESSION['error'] = 'Wrong input! Try again';
            header('Location: index.php?rt=employee/addMovie');
            exit();
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
        if( isset( $_SESSION['error']))
        $error = $_SESSION['error'];
        else $error = '';
        $_SESSION['error'] = '';

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
            if( preg_match("/^(([0-1][0-9])|([2][0-3])):([0-5][0-9])$/" , $_POST['time'])){
                $hall = $_POST['hall'];
                $date = date('Y-m-d', strtotime($_POST['date']));
                $time = $_POST['time'];
                if( $cs -> checkIfTheNewProjectionIsOk($movie_id, $hall, $date, $time) ){
                    $cs -> addNewProjection( $movie_id, $hall, $date, $time );
                    header('Location: index.php?rt=employee/movie/' . $movie_id);
                }
                else{
                    $_SESSION['error'] = 'There already is another projection at this time!';
                    header('Location: index.php?rt=employee/addProjection/' . $movie_id);
                    exit();
                }
            }
            else{ 
                $_SESSION['error'] = 'Wrong input preg! Try again';
                header('Location: index.php?rt=employee/addProjection/' . $movie_id);
                exit();
            }
            
        }
        else{ 
            $_SESSION['error'] = 'Wrong input post! Try again';
            header('Location: index.php?rt=employee/addProjection/' . $movie_id);
            exit();
        }

        
    }

    public function removeProjection ($id )
    {
        session_start();
        $this->checkPrivilege();
        $naziv=$_SESSION["naziv"];
        $ime=$_SESSION["username"];

        $USERTYPE=$this->USERTYPE;

        $cs = new CinemaService();

        $cs->removeProjectionById( $id );

        $movie_id = $cs ->getMovieIdByProjectionId( $id );

        
        header( 'Location: index.php?rt=employee');
		exit();
    }

    public function viewProjection( $id ) // ID PROJEKCIJE
    {
        session_start();
        $this->checkPrivilege();
        $naziv=$_SESSION["naziv"];
        $ime=$_SESSION["username"];

        $USERTYPE=$this->USERTYPE;

        $cs = new CinemaService();

        $reservations = $cs -> getREservationsByProjectionId( $id );
    
        $proj_id=$id;
        $projection = $cs -> getProjectionById( $id );
        $movie = $cs -> getMovieByProjectionId( $id );

        $hall_id = $cs -> getHallIdByProjectionId( $id );

        if($proj_id == null) {
            header( 'Location: index.php?rt=$USERTYPE');
			exit();
        }
        

        $size=$cs->getSizeOfHallByProjectionId( $proj_id);

        require_once __DIR__ . '/../view/'.$USERTYPE.'/viewProjection.php'; 
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
    public function deleteProjection($proj_id)
    {
        $cs = new CinemaService();
        echo "delete projection " .$proj_id." and all reservations with it...";


        $rezervacije=$cs->getReservationsByProjectionId( $proj_id );


        foreach ($rezervacije as $key => $rezervacija) {
            $cs->removeSeatsByReservationId($rezervacija->id);
        }

        $cs->removeProjectionById($proj_id);
    }
    public function sell()
    {
        $cs = new CinemaService();

        //AKCIJA ==sell -> prodaj
        //AKCIJA == delete -> obrisi rez
        $action = $_POST['action'];
        $seats = $_POST['seats'];
        $rez_id = $_POST['rez'];

        if ($action == 'delete'){
            $cs->removeSeatsByReservationId($rez_id);
            $cs->removeReservationByReservationId($rez_id);
        }
        else if ($action== 'sell')
        {
            $cs->sellSeatsByReservationId($rez_id);
        }







        $vrati=[];
        $vrati['uspjeh']=True;

        header( 'Content-type:application/json;charset=utf-8' );
        echo json_encode($vrati);
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