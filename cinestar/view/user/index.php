<?php include __DIR__ . '/../_header.php'; 

if( $danOdDanas == -1){
    $naslov_predstave="Today's projections";

}else{
    $naslov_predstave='Projections on the '. $danOdDanas . 'th';
}
?>










<div class="row">
    <div class="col-12 col-xl-8 mb-4 mb-lg-0">
        <div class="card">
            <h5 class="card-header"><?php echo $naslov_predstave; ?></h5>
            <div class="card-body">
                <ul class="list-group">

                    <?php
                    if(count($movieList)<=0){
                        echo '<li class="list-group-item">There are no projections today.</li>';
                    }   
                    else{
                        foreach ($movieList as $key => $movie) {
                            echo '<li class="list-group-item">'. $movie-> movie_id.  ' at ' .substr($movie-> time,0,-3) .'</li>';
                        }
                    }      
                    ?>   
                </ul>
            </div>
        </div>
        <br>
        <div class="card">
            <h5 class="card-header">Filmovi -- moze bilosta tu biti?</h5>
            <div class="card-body">
                <ul class="list-group">

                    <?php
                    if(count($movieList)<=0){
                        echo '<li class="list-group-item">Danas nema zakazanih predstava.</li>';
                    }   
                    else{
                        foreach ($movieList as $key => $movie) {
                            echo '<li class="list-group-item">'. $movie-> movie_id.  ' u ' .$movie-> time .'</li>';
                        }
                    }      
                    ?>   
                </ul>
            </div>
        </div>
    </div>
    <div class="col-12 col-xl-4">
        <div class="card" id="myCalendar" for="<?php echo $USERTYPE; ?>" >
            <h5 class="card-header">Kalendar predstava</h5>
            
                   
                    <div id="divCal"></div>
          
            <script src="js/calendar/index.js"></script>
            <link rel="stylesheet" type="text/css" href="css/calendar/style.css"/>
        </div>
    </div>
</div>


      


<?php include __DIR__ . '/../_footer.php'; ?>