
<?php include __DIR__ . '/../_header.php'; ?>



<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
</nav>
<h1 class="h2">Dashboard</h1>
<p>This is your faculty admin dashboard.</p>

<div class="row my-4">

    <!--ONE LITTLE MODAL----->
    <div class="col-12 col-md-6 col-lg-3 mb-4 mb-lg-0">
        <div class="card">
            <h5 class="card-header">Lock status <span class="text"></span></h5>
            <div class="card-body">
              <h5 class="card-title">Planned lock date: </h5>
              <p class="card-text">Here you can see how much time is there until your faculty list is locked.</p>
              
            </div>
          </div>
    </div>
    <div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3">
        <div class="card">
            <h5 class="card-header">Results status <span class="text"></span></h5>
            <div class="card-body">
              <h5 class="card-title">Planned results date: </h5>
              <p class="card-text">Here you can see when results will be shown.</p>
              
            </div>
          </div>
    </div>


    <!--ONE LITTLE MODAL----->
    <div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3">
        <div class="card">
            <h5 class="card-header">Issues?</h5>
            <div class="card-body">
              <h5 class="card-title">Send mail</h5>
              <p class="card-text">Send mail to ***@gmail.com</p>
              
            </div>
        </div>
    </div>

</div>

<!-- DEFINES ELEMENTS ON SAME HORIZONTAL LEVEL --->
<div class="row">
    <div class="col-12 col-xl-8 mb-4 mb-lg-0">
        <div class="card">
            <h5 class="card-header">Student competition chart</h5>
            <div class="card-body">
             </div>
        </div>
    </div>
    <div class="col-12 col-xl-4">
        <div class="card">
            <h5 class="card-header">Faculty popularity</h5>
            <div class="card-body">
            
            </div>
        </div>
    </div>
</div>

      


<?php include __DIR__ . '/../_footer.php'; ?>