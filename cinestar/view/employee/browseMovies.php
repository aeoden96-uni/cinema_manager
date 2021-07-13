
<?php include __DIR__ . '/../_header.php'; ?>

<script src="js/search/search.js"></script>



<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?rt=employee">Home page</a></li>
        <li class="breadcrumb-item active">Movies</li>
    </ol>
</nav>
<h1 class="h2">Movies <span class="text"></span></h1>


<h5 class="card-header">Search <input type="text" id="search" onkeyup="search()" placeholder="Search for movies"><span class="text"></span></h5>
<?php
$filmovaURedu=3;
$i=0;
foreach( $movieList as $movie){
    
    if($i % $filmovaURedu == 0){
        echo '<div class="row">';
    }


        echo '<div style="margin-top: 50px;" class="col">';
            $img = $movie['movie']-> name . '.jpg';
            $str = '<h4><a class="title" href="index.php?rt=employee/movie/'. $movie['movie']-> id .'">' . $movie['movie']-> name. '</a></h4> ';
            echo $str . '<img src="img/'. $img .'">';
        echo '</div>';


    if($i % $filmovaURedu == $filmovaURedu-1){
        echo ' </div>';
        
    }

    $i +=1;
}


while($i %$filmovaURedu !=0){
    echo '<div style="margin-top: 50px;" class="col">';
    echo ' </div>';
    
    $i +=1;
}


    
    
?>

<style>
a.title{
    text-decoration: none;
    color:black;
}
a.title:hover{
    background-color:lightgray;
}

img{
    width:300px;
    
}
</style>



<?php include __DIR__ . '/../_footer.php'; ?>