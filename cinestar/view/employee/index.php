
<?php include __DIR__ . '/../_header.php'; 

if( $danOdDanas == -1){
    $naslov_predstave="Today's projections";

}else{
    $naslov_predstave='Projections on the  '. $danOdDanas . 'th';
}

?>






<!-- DEFINES ELEMENTS ON SAME HORIZONTAL LEVEL --->
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
        </br>
        <div class="card">
            <h5 class="card-header">Confirm reservation</h5>
            <div class="card-body">
                    <form action="index.php?rt=employee/seatSelection" method="POST">
                   
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="id" placeholder="reservation id" >
                            <div class="input-group-append">
                                <button class="btn btn-info" type="submit">View reservation</button>
                            </div>
                        </div> 
                    </form>
            </div>
        </div>
    </div>
    <div class="col-12 col-xl-4">
        <div class="card"  id="myCalendar" for="<?php echo $USERTYPE; ?>">
            <h5 class="card-header">Calendar</h5>
            
                   
                    <div id="divCal"></div>
           
            <script src="js/calendar/index.js"></script>
            <link rel="stylesheet" type="text/css" href="css/calendar/style.css"/>
        </div>
    </div>
</div>

<style >



</style>


<?php include __DIR__ . '/../_footer.php'; ?>