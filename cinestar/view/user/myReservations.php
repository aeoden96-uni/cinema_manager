
<?php include __DIR__ . '/../_header.php';

function datum ($date)
{
    return date_format(date_create($date), 'd.m.');
}

?>


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?rt=user">Dashboard</a></li>
        <li class="breadcrumb-item active">My reservations</li>
    </ol>
</nav>
<h1 class="h2">My reservations</h1>



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
                        $date = datum($reservation['projection']->date);
                        $time = $reservation['projection'] -> time;
                        echo '<td>'. $date .', ' . substr($time, 0, -3) . 'h </td>';
                        $num_of_tics = $reservation['tics'];
                        echo '<td>' . $num_of_tics . '</td>';
                        echo '<td><button class="cancel"><a class="cancel" href="index.php?rt=user/cancel/'.$reservation['id']. '">Cancel reservation</a></button></td>';
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

a.cancel{
    text-decoration: none;
    color:black;
}

button.cancel{
    display: table;
    margin: 0 auto;
}

button.cancel:hover{
    background-color:lightgray;
}
</style>

<?php

/*$data_array = iterator_to_array($result);
echo("<br>");
echo("<br>");
print_r($data_array[0]);*/




include __DIR__ . '/../_footer.php'; ?>