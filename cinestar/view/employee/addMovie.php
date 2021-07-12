<?php include __DIR__ . '/../_header.php'; ?>


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?rt=ucenik">Main Page</a></li>
        <li class="breadcrumb-item active">New movie</li>
    </ol>
</nav>
<h1 class="h2">New movie</h1>

<div class="row">
<div class="col">
<div class="card">
    <h5 class="card-header">New movie form</h5>
    <div class="card-body">
         <?php if( $error !== '') echo $error . '<br>';?>
        <form action="index.php?rt=employee/newMovie" method="POST">
            <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input type="text" class="form-control"name="name" placeholder="Name">
               
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Description</label>
                <textarea  type="textarea" class="form-control" placeholder="Description" rows="3"></textarea>
                <small class="form-text text-muted">Keep it short.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Year</label>
                <input type="text" class="form-control"  name="year" placeholder="Year">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Duration</label>
                <input type="text" class="form-control"  name="dur" placeholder="Duration">
            </div>
            <br>
            <div class="form-group">
                <label for="exampleFormControlFile1">Image</label>
                <input type="file" class="form-control-file"  name="img" >
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Add</button>
            </form>

        <!--<div class="table-responsive">
        <? /*php if( $error !== '') echo $error . '<br>'; */?>
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
<div class="col" style="width:50%;">
</div> 
</div>
  
</div>
