
<?php include __DIR__ . '/../_header.php';

function checkList($oib,$listaFaksevausera){
    

    foreach($listaFaksevausera as $faksOIB){
        if ($faksOIB == $oib){
            
            return true;
        }
            
    }
    return false;

}
?>


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?rt=user">Dashboard</a></li>
        <li class="breadcrumb-item active">Reservations</li>
    </ol>
</nav>
<h1 class="h2">My reservations</h1>
<p>My reservations</p>



<div class="card">
    <h5 class="card-header">My reservations</h5>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Movie</th>
                    <th scope="col">Dvorana</th>
                    <th scope="col">Date and Time</th>
                    <th scope="col">Number of Tickets</th>
                   
                    </tr>
                </thead>
                <tbody>
                   <?php
                    foreach( $reservationList as $reservation){
                        echo '<tr>';
                        $str = '<h6>' . $reservation['movie']-> name. ' </h6>';
                        echo '<td>' . $str . '</td>';
                        $hall = $reservation['projection'] -> hall_id;
                        echo '<td>' . $hall . '</td>';
                        $time = $reservation['projection'] -> time;
                        echo '<td>' . $time . '</td>';
                        $num_of_tics = $reservation['tics'];
                        echo '<td>' . $num_of_tics . '</td>';
                        echo '</tr>';
                    }
                   ?>
                   
                </tbody>
                </table>
        </div>
        
    </div>
</div>



<style>
.collapse-row.collapsed + tr {
  display: none;
}
</style>

<?php

/*$data_array = iterator_to_array($result);
echo("<br>");
echo("<br>");
print_r($data_array[0]);*/




include __DIR__ . '/../_footer.php'; ?>