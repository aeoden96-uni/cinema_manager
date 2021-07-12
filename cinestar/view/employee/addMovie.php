<?php include __DIR__ . '/../_header.php'; ?>


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?rt=ucenik">Main Page</a></li>
        <li class="breadcrumb-item active">New movie</li>
    </ol>
</nav>
<h1 class="h2">New movie</h1>
<p>Add new movie</p>

<div class="card">
    <h5 class="card-header">Add new movie</h5>
    <div class="card-body">
        <div class="table-responsive">
        <?php if( $error !== '') echo $error . '<br>';?>
        <form action="index.php?rt=employee/newMovie" method="POST">
        <b>Name:</b> <input type="text" name="name"> <br> <br> <br>
        <b>Year: </b> <input type="text" name="year"><br> <br>
        <b>Duration: </b> <input type="text" name="dur"></br> <br>
        <b>Image:</b><input type="file" name="img"><br> <br>
        <button type="submit">Add</button>
        </form>
        </div>
        
    </div>
</div>
