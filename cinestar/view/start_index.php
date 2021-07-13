<!DOCTYPE html>
<html>
<head>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

	<!------ Include the above in your HEAD tag ---------->
</head>
<body>
<script>

function yesno(thecheckbox, thelabel,checkbox_conditions) {

	console.log(thecheckbox);
	console.log(thelabel);
	
    
    var checkboxvar = document.getElementById(thecheckbox);
    var labelvar = document.getElementById(thelabel);
	var condvar = document.getElementById(checkbox_conditions);
	
    if (!checkboxvar.checked) {
        labelvar.innerHTML = "Već imam račun";
		condvar.style.display = "none";
		document.getElementById("korisnik_uvjeti_label").innerHTML = "";

		
    }
    else {
        labelvar.innerHTML = "Nemam račun, izradi ga sad";
		document.getElementById("korisnik_uvjeti_label").innerHTML = " Prihvaćam uvjete i politiku privatnosti";
		condvar.style.display = "block";
		
		
    }
}
</script>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">


<div class="container">
	<br>  <h3 class="text-center">Throwback Cinema</h3>
	<hr>

	<div class="row">
	<aside class="col-sm-4">
	<p>Login as user</p>

	<div class="card">
	<article class="card-body">

		<h4 class="card-title mb-4 mt-1">Korisnik</h4>
		<hr>
		<form action="index.php?rt=start/loginCheckUser" method="post">
			<!--<div class="form-check form-switch">
			  <input onclick="yesno('korisnik_checkbox','korisnik_checkbox_label','korisnik_uvjeti');" class="form-check-input" type="checkbox" name="korisnik_checkbox"  id="korisnik_checkbox">
			  <label name="korisnik_checkbox_label" style="margin-bottom:10px;" class="form-check-label" id="korisnik_checkbox_label" for="korisnik_checkbox">Već imam račun</label>
			</div>-->
			<div class="form-group">
				<input style="margin-bottom:10px;" name="username" class="form-control" value="mirko@b.com" type="email">
				
				<input style="margin-bottom:10px;"  name="password" class="form-control" value="mirkovasifra" placeholder="******" type="password">
			
				<button type="submit" class="btn btn-primary btn-block"> Sign in  </button>
				
				
			</div> <!-- form-group// -->  
			<br>                                                          
		</form>
		<h4 class="card-title mb-4 mt-1">Register</h4>
		<hr>
		<div class="form_container">
				<form  method="post" action="index.php?rt=start/signupResult">
				<br>
				
				<div class="form-group">
					<input style="margin-bottom:10px;" name="username"    class="form-control"   type="email"    placeholder="Email" required>
					
					<input style="margin-bottom:10px;" name="password" class="form-control"   type="password" placeholder="******" required>
			
					<input style="margin-bottom:10px;" name="name"     class="form-control"    type="text"    placeholder="Name" required>

					<button type="submit" class="btn btn-info btn-block"> Sign up  </button>
					
					
				</div> <!-- form-group// -->  
					
				
				
				<br><br>
			</form>
			</div>
	</article>
	</div> <!-- card.// -->

	</aside> <!-- col.// -->
	<aside class="col-sm-4">
	<p>Login as employee</p>

	<div class="card">
	<article class="card-body">
		<!--<a href="" class="float-right btn btn-outline-primary">Sign up</a>-->
		<h4 class="card-title mb-4 mt-1">Employee</h4>

		<hr>
		<form action="index.php?rt=start/loginCheckEmployee" method="post">
			
			<div class="form-group">
				<input style="margin-bottom:10px;" name="username" class="form-control" value="luka@b.com" placeholder="Admin username" >
				
				<input style="margin-bottom:10px;" name="password" class="form-control" value="lukinasifra" placeholder="******" type="password">
				
				<button type="submit" class="btn btn-primary btn-block"> Sign in  </button>
				                                
			</div> <!-- form-group// -->  
					
			                                                            
		</form>
	</article>
	</div> <!-- card.// -->

	</aside> <!-- col.// -->
	<aside class="col-sm-4">
	<p>Login as admin</p>

	<div class="card">
	<article class="card-body">
		<!--<a href="" class="float-right btn btn-outline-primary">Sign up</a>-->
		<h4 class="card-title mb-4 mt-1">Admin</h4>

		<hr>
		<form action="index.php?rt=start/loginCheckAdmin" method="post">
			
			<div class="form-group">
				<input style="margin-bottom:10px;" name="username" class="form-control" value="helena@b.com" placeholder="Admin username" >
				
				<input style="margin-bottom:10px;" name="password" class="form-control" value="heleninasifra" placeholder="******" type="password">
				
				<button type="submit" class="btn btn-primary btn-block"> Sign in  </button>
				                                   
			</div> <!-- form-group// -->  
					
			                                                            
		</form>
	</article>
	</div> <!-- card.// -->

	</aside> <!-- col.// -->
	</div> <!-- row.// -->

</div> 
<!--container end.//-->

<br><br><br>

</body>
</html>