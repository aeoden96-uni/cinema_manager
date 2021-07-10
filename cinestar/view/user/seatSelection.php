<?php include __DIR__ . '/../_header.php'; ?>


<!--USED FOR SEAT SELECTION -->
<script src="view/user/main.js"></script>






<div class="row">
    <div class="col-12 col-xl-8 mb-4 mb-lg-0">
        <div style="margin-bottom: 10px;" class="card">
            <h5 class="card-header">Dvorana</h5>
            <div class="card-body">
                <canvas 
                    id="myBoard" 
                    width="600" 
                    height="500" 
                    br_redova=<?php echo $br_redova; ?> 
                    velicina_reda=<?php echo $velicina_reda; ?> >
                </canvas>
            </div>
        </div>    
    </div>

    <div class="col-12 col-xl-4">
        <div class="card">
            <h5 class="card-header">Odaberi mjesta:  </h5>
            <div class="card-body">
              <!--<h5 class="card-title">Username</h5>-->
              <p class="card-text">
                 <span id="spiner" style="display:none;" class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                <ul class="list-group" id="myList"></ul><br>
                <button id="odaberi" onClick=odaberiMjesta() disabled type="button" class="btn btn-warning">
                   
                    <span class="sr-only">Odaberi</span>
                </button>
               
              </p>
            </div>
        </div>
    </div>
</div>


<?php include __DIR__ . '/../_footer.php'; ?>