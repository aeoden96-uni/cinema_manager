<?php include __DIR__ . '/../_header.php'; ?>


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?rt=ucenik">Home page</a></li>
        <li class="breadcrumb-item active">New movie</li>
    </ol>
</nav>
<h1 class="h2">New movie</h1>

<div class="row">
<div class="col">
<div class="card">
    <h5 class="card-header">Add new movie</h5>
    <div class="card-body">
         <?php if( $error !== '') echo $error . '<br>';?>
        <form action="index.php?rt=employee/newMovie" method="POST"  enctype="multipart/form-data">
            <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input type="text" class="form-control"name="name" placeholder="Name">
               
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Description</label>
                <textarea  type="textarea" class="form-control" placeholder="Description" rows="3" name="desc"></textarea>
                <small class="form-text text-muted">Keep it short.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Year</label>
                <input type="text" class="form-control"  name="year" placeholder="Year">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Duration</label>
                <input type="text" class="form-control"  name="dur" placeholder="hh:mm">
            </div>
            <br>
            After you add the movie, add the movie poster.
            <br>
            <button type="submit" class="btn btn-primary">Add</button>
            </form>
        
    </div>
</div>
</div>  
</div>

<?php include __DIR__ . '/../_footer.php'; ?>
