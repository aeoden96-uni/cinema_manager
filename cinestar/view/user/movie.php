<?php include __DIR__ . '/../_header.php'; ?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?rt=user/browseMovies">Movie browser</a></li>
        <li class="breadcrumb-item active"><?php echo $movie -> name; ?></li>
    </ol>
</nav>
<h1 class="h2"><?php echo $movie -> name; ?></h1>

<div class="card">
    <h5 class="card-header"><?php echo $movie -> name; ?></h5>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                   
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><img src="img/<?php echo $movie -> name . '.jpg' ?>"></td>
                        <td><b>Description:</b> <?php echo $movie -> description; ?><br><br>
                        <b>Year:</b> <?php echo $movie -> year; ?> <br><br>
                        <b>Duration:</b> <?php echo substr($movie -> duration, 0, -3); ?> <br><br>
                        <h4><b>Projections:</b></h4>
                        <table>
                            <tr>
                             <?php 
                             foreach ( $dates as $date){
                                 $new_date = date_create($date);
                                 echo '<th>' . date_format($new_date, 'd.m.') . '</th>';
                             }
                             ?>
                            </tr>
                            <tr>
                        <?php 
                            foreach ($dates as $date ){
                                echo '<td>';
                                foreach( $projections as $projection ){
                                    if( $projection-> date === $date){
                                        echo '<button class="time"><a class="time" href="index.php?rt=user/projection/'.$projection->id.'">'. substr($projection-> time, 0, -3) . '</a></button><br><br>';
                                    }
                                }
                                echo '</td>';
                            }
                            
                        ?>
                        <tr>
                        </table>
                    </td>
                    </tr>
                   <?php
                   
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

a.time{
    text-decoration: none;
    color:black;
}

button.time{
    display: table;
    margin: 0 auto;
}

button.time:hover{
    background-color:lightgray;
}
</style>

<?php

/*$data_array = iterator_to_array($result);
echo("<br>");
echo("<br>");
print_r($data_array[0]);*/




include __DIR__ . '/../_footer.php'; ?>