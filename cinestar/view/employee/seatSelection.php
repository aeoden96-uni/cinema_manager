<?php include __DIR__ . '/../_header.php'; ?>


<!--USED FOR SEAT SELECTION -->
<script src="js/seat_selection/main.js"></script>


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?rt=user/movie/<?php echo $movie->id;?>"><?php echo $movie->name ?></a></li>
        <li class="breadcrumb-item active">Reservations</li>
    </ol>
</nav>
<h1 class="h2"><?php echo $movie -> name; ?></h1>


<div class="row">
    <div class="col-12 col-xl-8 mb-4 mb-lg-0">
        <div style="margin-bottom: 10px;" class="card">
            <h5 class="card-header"><?php echo $date . ' u ' . substr($projection -> time, 0, -3) . 'h';?></h5> 
            <div class="card-body">
                <canvas 
                    id="myBoard" 
                    width="600" 
                    height="500" 
                    br_redova=<?php echo $br_redova; ?> 
                    velicina_reda=<?php echo $velicina_reda; ?> 
                    prikaz_id = <?php echo $prikaz_id?>>
                </canvas>
            </div>
        </div>    
    </div>

    <div class="col-12 col-xl-4">
            <div class="card-body">
                <button id="odaberi" class="btn btn-warning">
                    <a href= ""><span class="sr-only">Remove projection</a></span>
                </button>
            </div>
    </div>
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
                    <th scope="col">Number of tickets</th>
                    <th scope="col">Seats</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    foreach( $reservations as $reservation ){
                        echo '<tr>';
                        echo '<td>' . $reservation['reservation']->id .'</td>';
                        echo '<td>' . $reservation['reservation']->num_of_tics .'</td>';
                        echo '<td>' . $reservation['seats'] .'</td>';
                        echo '</tr>';
                    }
                ?>
                   
                </tbody>
                </table>
        </div>
        
    </div>
</div>

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


<?php include __DIR__ . '/../_footer.php'; ?>