
<?php include __DIR__ . '/../_header.php'; ?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?rt=ucenik">Home page</a></li>
        <li class="breadcrumb-item active">My Info</li>
    </ol>
</nav>
<h1 class="h2">Employee information</h1>
<p>These are your information.</p>


<!-- DEFINES ELEMENTS ON SAME HORIZONTAL LEVEL --->
<div class="row">
    <div class="col-12 col-xl-8 mb-4 mb-lg-0">
        <div class="card">
            <h5 class="card-header">Details</h5>
            <div class="card-body">
                                 
                
                <h5 class="card-title">Title</h5>
                <p class="card-text">text </p>
            

            </div>
        </div> 
    </div>


    <div class="col-12 col-xl-4">
        <div class="card">
            <h5 class="card-header">Personal information :<h5>
            <div class="card-body">
              <h5 class="card-title">Username</h5>
              <p ></p>
              <h5 class="card-title">OIB</h5>
              <p ></p>
              <h5 class="card-title">Faculty name</h5>
              <p ></p>

            </div>
        </div>
    </div>
</div>


<?php include __DIR__ . '/../_footer.php'; ?>