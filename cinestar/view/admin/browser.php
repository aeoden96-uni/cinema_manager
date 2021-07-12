
<?php include __DIR__ . '/../_header.php';


?>


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?rt=ucenik">Main Page</a></li>
        <li class="breadcrumb-item active">Employees</li>
    </ol>
</nav>
<h1 class="h2">Employees</h1>
<p>List of all employees</p>



<div class="card">
    <h5 class="card-header">Employees</h5>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    foreach( $employees as $employee ){
                        echo '<tr>';
                        echo '<td>' . $employee->id .'</td>';
                        echo '<td>' . $employee->name .'</td>';
                        echo '<td>' . $employee->email .'</td>';
                        echo '<td><button class="btn btn-warning"><a href="index.php?rt=admin/removeEmpl/' .$employee->id.'"> Remove</a> </button></td>';
                        echo '</tr>';
                    }
                ?>
                   
                </tbody>
                </table>
        </div>
        
    </div>
</div>
<br>
<div class="card">
    <h5 class="card-header">Add new employee</h5>
    <div class="card-body">
<div class="table-responsive">
<form action = "index.php?rt=admin/addEmpl" method="POST">
Name: <input type="text" name="name"> <br> <br>
Email: <input type="text" name="email"> <br> <br>
Password <input type="password" name="pass"> <br><br>
<button type="submit">Add</button>
</form>
</div>
</div>
</div>

<style>

    
a{
    text-decoration: none;
    color:black;
}
</style>


<?php



include __DIR__ . '/../_footer.php'; ?>