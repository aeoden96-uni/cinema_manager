<?php include __DIR__ . '/../_header.php'; ?>


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?rt=ucenik"><?php echo $movie -> name;?></a></li>
        <li class="breadcrumb-item active">New projection</li>
    </ol>
</nav>
<h1 class="h2">Add new projection</h1>

<div class="card">
    <h5 class="card-header"><?php echo $movie->name; ?></h5>
    <div class="card-body">
        <div class="table-responsive">

        <form action="index.php?rt=employee/newProjection/<?php $movie->id?>" method="POST">

        <b>Hall:</b> <select name="hall"> 
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
        </select><br>
        <b>Date:</b> <input type="textarea" name="date"> <br>
        <b>Time: </b> <input type="text" name="time"><br>
        <button type="submit">Add</button>
        </form>

        </div>
        
    </div>
</div>
