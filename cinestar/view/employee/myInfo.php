
<?php include __DIR__ . '/../_header.php'; ?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?rt=ucenik">Dashboard</a></li>
        <li class="breadcrumb-item active">My Info</li>
    </ol>
</nav>
<h1 class="h2">Faculty admin info</h1>
<p>This is your admin information.</p>


<!-- DEFINES ELEMENTS ON SAME HORIZONTAL LEVEL --->
<div class="row">
    <div class="col-12 col-xl-8 mb-4 mb-lg-0">
        <div class="card">
            <h5 class="card-header">Faculty details</h5>
            <div class="card-body">
                                 
                
                <h5 class="card-title">Factors</h5>
                <p class="card-text">Croatian -  <?php echo $employee->uvjeti->hrvatski;?>x</p>
                <p class="card-text">English -  <?php echo $employee->uvjeti->engleski;?>x</p>
                <p class="card-text">Mathematics -  <?php echo $employee->uvjeti->matematika;?>x</p>

                <h5 class="card-title">Additional required subjects</h5>
                <p class="card-text">Subject -  <?php echo $employee->uvjeti->izborni;?></p>

                <h5 class="card-title">Additional points for competitions</h5>
                <p class="card-text">Subject -  <?php echo $employee->uvjeti->natjecanje;?></p>

                <h5 class="card-title">Quota</h5>
                <p class="card-text">Quota -  <?php echo $employee->kvota;?></p>

               


            </div>
        </div> 
    </div>


    <div class="col-12 col-xl-4">
        <div class="card">
            <h5 class="card-header">Info for admin : <?php echo $employee->admin_username;?><h5>
            <div class="card-body">
              <h5 class="card-title">Username</h5>
              <p ><?php echo $employee->admin_username;?></p>
              <h5 class="card-title">OIB</h5>
              <p ><?php echo $employee->oib;?></p>
              <h5 class="card-title">Faculty name</h5>
              <p ><?php echo $employee->naziv;?></p>

            </div>
        </div>
    </div>
</div>


<?php include __DIR__ . '/../_footer.php'; ?>