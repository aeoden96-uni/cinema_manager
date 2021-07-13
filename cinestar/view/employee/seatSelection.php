<?php include __DIR__ . '/../_header.php'; ?>


<!--USED FOR SEAT SELECTION -->
<script src="js/seat_selection/main_employee.js"></script>



<h1 class="h2"></h1>


<div class="row">
    <div class="col-12 col-xl-8 mb-4 mb-lg-0">
        <div style="margin-bottom: 10px;" class="card">
            <h5 class="card-header"></h5> 
            <div class="card-body">
                <canvas 
                    id="myBoard" 
                    width="600" 
                    height="500" 
                    br_redova=<?php echo $size[0]; ?> 
                    velicina_reda=<?php echo $size[1]; ?> 
                    rezerv_id=<?php echo $reservation_id; ?> 
                    prikaz_id = <?php echo $proj_id;?>>
                </canvas>
            </div>
        </div>    
    </div>

    <div class="col-12 col-xl-4">
        <div class="card">
            <h5 class="card-header">Order details:  </h5>
            <div class="card-body">
              <!--<h5 class="card-title">Username</h5>-->
              <p class="card-text">
                 <span id="spiner" style="display:none;" class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                <ul class="list-group" id="myList"></ul><br>
                <button id="odaberi" onClick=sellSeats()  type="button" class="btn btn-warning">
               
                    <span class="sr-only">Sell seats</span>
                </button>
                <button id="remove" onClick=removeSeats()  type="button" class="btn btn-danger">Delete reservation</button>
               
              </p>
            </div>
        </div>
    </div>
</div>


<?php include __DIR__ . '/../_footer.php'; ?>