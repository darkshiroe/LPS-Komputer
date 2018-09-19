<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('basic/head');
?>
</head>
<body>
<?php
$this->load->view('basic/navlink');
?>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
      </div>
      <div class="row">
        <div class="col-md-3">
          <div class="card text-white bg-primary">
            <div class="card-body">
              <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-10">
                  <h5 class="card-title ctotal">0</h5>
                  <p class="card-text">Jumlah Peserta</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card text-white bg-success">
            <div class="card-body">
              <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-10">
                  <h5 class="card-title cprogram">0</h5>
                  <p class="card-text">Jumlah Programming</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card text-white bg-danger">
            <div class="card-body">
              <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-10">
                  <h5 class="card-title cnetwork">0</h5>
                  <p class="card-text">Jumlah Networking</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card text-white bg-warning">
            <div class="card-body">
              <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-10">
                  <h5 class="card-title cmultimedia">0</h5>
                  <p class="card-text">Jumlah Multimedia</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
</div>

<?php
$this->load->view('basic/java');
?>
<script>
$(document).ready(function(){
  $.ajax({
    url : '<?php echo base_url('peserta/badge');?>',
    success : function(result){
      console.log(result);
      $('.ctotal').html(result.total);
      $('.cprogram').html(result.program);
      $('.cnetwork').html(result.network);
      $('.cmultimedia').html(result.multimedia);
    }
  });
});
</script>
</body>
</html>
