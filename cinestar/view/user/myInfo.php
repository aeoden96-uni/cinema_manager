
<?php include __DIR__ . '/../_header.php'; ?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?rt=user">Home page</a></li>
        <li class="breadcrumb-item active">My Info</li>
    </ol>
</nav>
<h1 class="h2">User info</h1>
<p>This is your personal info.</p>


<!-- DEFINES ELEMENTS ON SAME HORIZONTAL LEVEL --->
<div class="row">
    <div class="col-12 col-xl-8 mb-4 mb-lg-0">

        <div style="margin-bottom: 10px;" class="card">
            <h5 class="card-header">State exams</h5>
            <div class="card-body">

                
            </div>
        </div>
        <!--<div style="margin-bottom: 10px;" class="card">
            <h5 class="card-header">Test scores compared to peers</h5>
            <div class="card-body">
                <div id="traffic-chart"></div>
            </div>
        </div>--> 
        <div style="margin-bottom: 10px;"  class="card">
            <h5 class="card-header">Best place at state comeptitions</h5>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item list-group-item-success">
                     <span class="badge bg-dark"></span></li>
                   
                </ul>
            </div>
        </div>
        
    </div>





    <div class="col-12 col-xl-4">
        <div class="card">
            <h5 class="card-header">Info for user : </h5>
            <div class="card-body">
              <h5 class="card-title">Username</h5>
              <p class="card-text"></p>
              <!--<p class="card-text text-success">2.5% increase since last month</p>-->
              <h5 class="card-title">Name</h5>
              <p class="card-text"></p>
              <h5 class="card-title">Surname</h5>
              <p class="card-text"></p>
              <h5 class="card-title">Birth date</h5>
              <p class="card-text"></p>

               
            </div>
        </div>
    </div>
</div>


<?php include __DIR__ . '/../_footer.php'; ?>