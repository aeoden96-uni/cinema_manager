
<?php include __DIR__ . '/../_header.php'; ?>



<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
</nav>
<h1 class="h2">Dashboard</h1>
<p>This is the main dashboard for admin.</p>

<!--HORIZ CONTAINER
my-4 = MARGIN top bottom
-->
<div class="row my-4">

    <!--ONE LITTLE MODAL----->
    <div class="col-12 col-md-6 col-lg-3 mb-4 mb-lg-0">
        <div class="card">
            <h5 class="card-header">Planned lock date</h5>
            <div class="card-body">
              <h5 class="card-title">
                Lock date is scheduled:
              </h5>
              <p class="card-text">Status <a class="btn btn-sm ml-3 mt-2" href="index.php?rt=admin/lockSwitch">
            
                </a></p>

              <p class="card-text">Lock student's ability to edit their faculty list.</p>
              
            </div>
          </div>
    </div>
    <div class="col-12 col-md-6 col-lg-3 mb-4 mb-lg-0">
        <div class="card">
            <h5 class="card-header">Planned results date</h5>
            <div class="card-body">
              <h5 class="card-title">
                <span class="text-danger"></span>
                Results date is scheduled: 
              </h5>
              <p class="card-text">Status <a class="btn btn-sm  ml-3 mt-2" href="index.php?rt=admin/resultsSwitch">
              <?php echo $resultBool? "SHOWN":"NOT SHOWN"; ?>
                </a></p>

              <p class="card-text">Planned date for students to see their results.</p>
              
            </div>
          </div>
    </div>
    <div class="col-12 col-md-6 col-lg-3 mb-4 mb-lg-0">
        <div class="card">
            <h5 class="card-header">Start aggregation</h5>
            <div class="card-body">
              <h5 class="card-title">
              <span class="text-danger"></span>
              <span class="text-danger"></span>
              </h5>
              <p class="card-text"> <a class="btn btn-sm btn-info ml-3 mt-2" href="index.php?rt=admin/start">
                    ⚡︎ START
                </a></p>
              <p class="card-text">Start sorting students to faculties.</p>
              
            </div>
          </div>
    </div>
    <div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3">
    <div class="card">
            <h5 class="card-header">Reset aggregation</h5>
            <div class="card-body">
              <h5 class="card-title">
                <span class="text-danger"></span>
                
              </h5>
              <p class="card-text">
                <a class="btn btn-sm btn-danger ml-3 mt-2" href="index.php?rt=admin/reset">
                    ⚡︎ RESET
                </a></p>
              <p class="card-text">Something went wrong? Undo everything.</p>
              
            </div>
          </div>
    </div>
   

</div>




<?php include __DIR__ . '/../_footer.php'; ?>