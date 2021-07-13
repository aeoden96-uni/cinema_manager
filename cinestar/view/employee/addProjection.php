<?php include __DIR__ . '/../_header.php'; ?>


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?rt=user"><?php echo $movie -> name;?></a></li>
        <li class="breadcrumb-item active">New projection</li>
    </ol>
</nav>
<h1 class="h2">Add new projection</h1>

<div class="card">
    <h5 class="card-header"><?php echo $movie->name; ?></h5>
    <div class="card-body">
    <?php if( $error !== '') echo $error . '<br><br>';?>
        <form action="index.php?rt=employee/newProjection/<?php echo $movie->id; ?>" method="POST">
            <div class="form-group">
            <label for="hall">Hall</label>
            <select name="hall"> 
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            </select>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Date</label>
                <input type="date" class="form-control"name="date" placeholder="Date">
               
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Time</label>
                <input type="text" name="time" class="form-control" placeholder="hh:mm">
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Add</button>
            </form>
        
    </div>
</div>
