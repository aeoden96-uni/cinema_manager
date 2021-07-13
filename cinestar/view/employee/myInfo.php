
<?php include __DIR__ . '/../_header.php'; ?>


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?rt=employee">Home page</a></li>
        <li class="breadcrumb-item active">Your info</li>
    </ol>
</nav>
<h1 class="h2">Your info</h1>
<p>Here you can change some of your information.</p>


<div class="col-12 col-xl-4 mb-4 mb-lg-0">
<form action="index.php?rt=employee/myInfo" method="post">
			
    <div class="form-group">

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon3">Email</span>
            </div>
            <input type="text" name="email" class="form-control" id="basic-url" placeholder="" aria-describedby="basic-addon3">
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon3">Password</span>
            </div>
            <input type="text" name="password"  class="form-control" id="basic-url" placeholder="******" aria-describedby="basic-addon3">
        </div>
        
    
        <button type="submit" class="btn btn-primary btn-block"> Change  </button>
        
        
    </div> <!-- form-group// -->  
					
			                                                            
</form>
</div>

<?php include __DIR__ . '/../_footer.php'; ?>