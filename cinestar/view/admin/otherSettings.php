
<?php include __DIR__ . '/../_header.php'; ?>


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php?rt=ucenik">Home page</a></li>
        <li class="breadcrumb-item active">Info</li>
    </ol>
</nav>
<h1 class="h2">Cinema info</h1>
<p>Change info about Throwback Cinema.</p>


<div class="col-12 col-xl-4 mb-4 mb-lg-0">
<form action="index.php?rt=admin/otherSettingsCheck" method="post">
			
    <div class="form-group">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon3">Adress</span>
            </div>
            <input type="text" name="adress" class="form-control" id="basic-url" placeholder="Adress" aria-describedby="basic-addon3">
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon3">Email</span>
            </div>
            <input type="text" name="email" class="form-control" id="basic-url" placeholder="Email" aria-describedby="basic-addon3">
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon3">Telephone number</span>
            </div>
            <input type="text" name="tel" class="form-control" id="basic-url" placeholder="Telephone number" aria-describedby="basic-addon3">
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon3">Working hours</span>
            </div>
            <input type="text" name="open" class="form-control" id="basic-url" placeholder="Working hours" aria-describedby="basic-addon3">
        </div>

       
        
    
        <button type="submit" class="btn btn-primary btn-block"> Change  </button>
        
        
    </div> <!-- form-group// -->  
					
			                                                            
</form>
</div>

<?php include __DIR__ . '/../_footer.php'; ?>