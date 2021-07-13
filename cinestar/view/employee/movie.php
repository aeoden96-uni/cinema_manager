<?php include __DIR__ . '/../_header.php';

$newProjLink="index.php?rt=employee/addProjection/".$movie -> id;

?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?rt=user/browseMovies">Movie browser</a></li>
        <li class="breadcrumb-item active"><?php echo $movie -> name; ?></li>
    </ol>
</nav>


<div class="card">
    <h5 class="card-header"><?php echo $movie -> name; ?> &nbsp;<button onclick="location.href='<?php echo $newProjLink;?>'"  class="btn btn-info">Add projection</button></h5>
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
                        
                        <table class="projections">
                            <tr>
                             <?php 
                             foreach ( $dates as $date){                             
                                echo '<th>' . datum($date) . '</th>';
                             }
                             ?>
                            </tr>
                            <tr>
                        <?php 
                            foreach ($dates as $date ){
                                echo '<td>';
                                foreach( $projections as $projection ){
                                    if( $projection-> date === $date){

                                        
                                        echo '<button class="btn btn-warning"><a class="time" ><a href="index.php?rt=employee/viewProjection/'.$projection->id.'">'. substr($projection-> time, 0, -3) . '</a></button><br class="button">';
                                    }
                                }
                                echo '</td>';
                            }
                            
                        ?>
                        </tr>
                       
                        </table>
                        
                    </td>
                    </tr>
                   
                </tbody>
                </table>
               
        </div>
        
    </div>
</div>


<script>

function deleteIt(id){
    if(confirm("Are you sure you want to delete projection: " + id+ "?")){
        window.location.href = "index.php?rt=employee/deleteProjection/"+ id;
    }
}
</script>


<style>
.collapse-row.collapsed + tr {
  display: none;
}

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

button.time{
    display: table;
    margin: 0 auto;
}

button.time:hover{
    background-color:lightgray;
}

table.projections{
    border-collapse: separate;
    text-align: center;
}

th{
    text-align: center;
}

br.button{
    display: block;
    content: ""; 
    margin-top: 0.5em; 
}
</style>

<?php

/*$data_array = iterator_to_array($result);
echo("<br>");
echo("<br>");
print_r($data_array[0]);*/




include __DIR__ . '/../_footer.php'; ?>