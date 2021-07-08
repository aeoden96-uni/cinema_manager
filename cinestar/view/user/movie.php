<?php include __DIR__ . '/../_header.php'; ?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?rt=user">Dashboard</a></li>
        <li class="breadcrumb-item active"><?php echo $movie -> name; ?></li>
    </ol>
</nav>
<h1 class="h2"><?php echo $movie -> name; ?></h1>
<p><?php echo $movie -> name; ?></p>

<div class="card">
    <h5 class="card-header"><?php echo $movie -> name; ?></h5>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Movie</th>
                    <th scope="col">Dvorana</th>
                    <th scope="col">Date and Time</th>
                   
                    
                    
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><img src="img/ <?php echo $movie -> name . 'jpg' ?>"></td>
                        <td>Description: <?php echo $movie -> description; ?></td>
                        <td>Year:<?php echo $movie -> year; ?>  </td>
                        <td>Duration:<?php echo $movie -> duration; ?>  </td>
                    </tr>
                   <?php
                   //ispisati projekcije (kad, gdje)
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