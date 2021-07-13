<nav class="navbar navbar-light bg-light p-3">
        <div class="d-flex col-12 col-md-3 col-lg-2 mb-2 mb-lg-0 flex-wrap flex-md-nowrap justify-content-between">
            <a class="navbar-brand" href="#">
                Throwback Cinema
            </a>
            <button class="navbar-toggler d-md-none collapsed mb-3" type="button" data-toggle="collapse" data-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <!--<div class="col-12 col-md-4 col-lg-2">
            <input class="form-control form-control-dark" type="text" placeholder="Search" aria-label="Search">
        </div>-->
        <div class="col-12 col-md-4 col-lg-2">
            <nav aria-label="breadcrumb">
                <ol style="margin-bottom:0;" class="breadcrumb">
                    <li class="breadcrumb-item active"> <?php echo $this->USERTYPE." ". $naziv; ?></li>
                </ol>
            </nav>
        </div>
        <div class="col-12 col-md-5 col-lg-8 d-flex align-items-center justify-content-md-end mt-3 mt-md-0">
            

			  
			 <div class="btn-group" role="group" aria-label="Basic example">
			  <button type="button" class="btn btn-secondary">Hello, <?php echo $ime; ?></button>
			  <a type="button" href="index.php?rt=start/logout" class="btn btn-secondary">Sign out</a>
			</div>
        </div>
    </nav>