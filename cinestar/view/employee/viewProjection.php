<?php include __DIR__ . '/../_header.php'; ?>


<!--USED FOR SEAT SELECTION -->
<script src="js/seat_selection/main_employee.js"></script>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?rt=employee/movie/<?php echo $movie->id;?>"><?php echo $movie->name ?></a></li>
        <li class="breadcrumb-item active">View projection</li>
    </ol>
</nav>
<h1 class="h2"><?php echo $movie -> name; ?></h1>



<div class="row">
    <div class="col-12 col-xl-8 mb-4 mb-lg-0">
        <div style="margin-bottom: 10px;" class="card">
        <h5 class="card-header"><?php echo datum($projection->date) . ' at ' . substr($projection -> time, 0, -3) . 'h';?></h5> 
            <h5 class="card-header"></h5> 
            <div class="card-body">
                <canvas 
                    id="myBoard" 
                    width="600" 
                    height="500" 
                    prikaz_id =<?php echo $proj_id;?> 
                    br_redova=<?php echo $size[0]; ?> 
                    velicina_reda=<?php echo $size[1]; ?> 
                    rezerv_id=<?php echo $reservation_id; ?> 
                       >
                </canvas>
            </div>
        </div>    
    </div>
    <div class="col-12 col-xl-4">
    <div class="card">
                <button id="odaberi" class="btn btn-warning" onClick="deleteIt('<?php echo $proj_id;?>')">
                    <span class="sr-only">Remove projection</span>
                </button>
    </div>
<br>
    <div class="card">
    <h5 class="card-header">Reservations</h5>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">User ID</th>
                    <th scope="col">#tickets</th>
                    <th scope="col">Seats</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    foreach( $reservations as $reservation ){
                        echo '<tr>';
                        echo '<td>' . $reservation['reservation']->id .'</td>';
                        echo '<td>' . count( $reservation['seats']) .'</td>';
                        echo '<td>';
                        foreach( $reservation['seats'] as $seat){

                            echo 'Row: ' . $seat->red . ', seat: '. $seat->broj_u_redu . '<br>';
                        }
                        echo '</td>';
                        echo '</tr>';
                    }
                ?>
                   
                </tbody>
                </table>
        </div>
        
    </div>
</div>
    </div>
</div>


</div>
<br>


<style>
a{
    text-decoration: none;
    color:black;
}

a:link {
   color:inherit;
}

a:hover{
    color:black;
}
</style>


<script>

function deleteIt(proj_id){
    window.location.href = "index.php?rt=employee/"+'deleteProjection/' +proj_id ;

}
</script>


<?php include __DIR__ . '/../_footer.php'; ?>