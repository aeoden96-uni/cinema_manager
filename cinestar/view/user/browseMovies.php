
<?php include __DIR__ . '/../_header.php'; 




?>


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?rt=user">Dashboard</a></li>
        <li class="breadcrumb-item active">Movies</li>
    </ol>
</nav>
<h1 class="h2">Movies <span class="text"></span></h1>
<p>Choose which movie you want to see</p>




<div class="card">
    <h5 class="card-header">Movies<span class="text"></span></h5>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Movies</th>
                    <!--<th scope="col">Faculty name</th>-->

                    </tr>
                </thead>
                <tbody>
                <?php
                    foreach( $movieList as $movie){
                        $img = $movie['movie']-> name . '.jpg';
                        echo '<tr>';
                        $str = '<h4><a href="index.php?rt=user/movie/'. $movie['movie']-> id .'">' . $movie['movie']-> name. '</a></h4> ';
                        echo '<td>' .$str . '<img src="img/'. $img .'"></td>';
                       // echo '<td>' . $str . '</td>';
                        echo '</tr>';
                    }
                ?>
                </script>    
                   
                </tbody>
                </table>
        </div>
        
        
    </div>
</div>





<?php include __DIR__ . '/../_footer.php'; ?>