<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('basic/head');
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
<link rel="stylesheet" href="<?php echo base_url('assets/');?>sweetalert2/dist/sweetalert2.min.css">
</head>
<body>
<?php
$this->load->view('basic/navlink');
?>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manage Peserta</h1>
      </div>
      <div class="row">
        <div class="col-md-12">
          <table id="table_id" class="table table-striped">
            <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Peserta</th>
                  <th>NIK</th>
                  <th>Tempat Uji Sertifikasi</th>
                  <th>Tanggal Lahir</th>
                  <th>Organisasi</th>
                  <th></th>
                </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
      <br>
      <br>
      <br>
      <div class="row">
        <div class="col-md-12">
          <table id="mytable2" class="table table-striped">
            <thead>
                <tr>
                  <th>No</th>
                  <th>Tanggal Lahir</th>
                  <th>Jumlah Peserta</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
    </main>

    <!-- Modal Section -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Lihat Data Peserta</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <table class="table table-striped">
              <tbody>
                <tr>
                  <th scope="row">1</th>
                  <td>Nama Peserta</td>
                  <td id="viewRow1"></td>
                </tr>
                <tr>
                  <th scope="row">2</th>
                  <td>NIK</td>
                  <td id="viewRow2"></td>
                </tr>
                <tr>
                  <th scope="row">3</th>
                  <td>Nomor HP</td>
                  <td id="viewRow3"></td>
                </tr>
                <tr>
                  <th scope="row">4</th>
                  <td>Email</td>
                  <td id="viewRow4"></td>
                </tr>
                <tr>
                  <th scope="row">5</th>
                  <td>Skema Sertifikasi</td>
                  <td id="viewRow5"></td>
                </tr>
                <tr>
                  <th scope="row">6</th>
                  <td>Tempat Uji Kompetensi</td>
                  <td id="viewRow6"></td>
                </tr>
                <tr>
                  <th scope="row">7</th>
                  <td>Rekomendasi</td>
                  <td id="viewRow7"></td>
                </tr>
                <tr>
                  <th scope="row">8</th>
                  <td>Tanggal Terbit Sertifikat</td>
                  <td id="viewRow8"></td>
                </tr>
                <tr>
                  <th scope="row">9</th>
                  <td>Tanggal Lahir</td>
                  <td id="viewRow9"></td>
                </tr>
                <tr>
                  <th scope="row">10</th>
                  <td>Organisasi</td>
                  <td id="viewRow10"></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
      </div>
    <!-- END Modal Section -->

  </div>
</div>

<?php
$this->load->view('basic/java');
?>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<!-- sweetalert2 -->
<script src="<?php echo base_url('assets/');?>sweetalert2/dist/sweetalert2.all.min.js"></script>
<script>
$(document).ready( function () {

    //function load data tabel json dari link mengunakan ajax
    $('#table_id').DataTable({
      ajax : {
        url : '<?php echo base_url('peserta/tabelpeserta');?>?tipe=umum'
      }
    });

    $('#mytable2').DataTable({
      ajax : {
        url : '<?php echo base_url('peserta/tabelpeserta');?>?tipe=grouptanggallahir'
      }
    });

    //handler button click untuk lihat button
    $(document).on('click', 'button.btn-success', function(){
      $('#exampleModal').modal('show');
      $.ajax({
        url : '<?php echo base_url('peserta/ambildata');?>?id='+$(this).data('value'),
        success : function(result){
          $('#viewRow1').html(result.namapeserta);
          $('#viewRow2').html(result.nik);
          $('#viewRow3').html(result.notelphp);
          $('#viewRow4').html(result.email);
          $('#viewRow5').html(result.skema);
          $('#viewRow6').html(result.tempatuji);
          $('#viewRow7').html(result.rekomendasi);
          $('#viewRow8').html(result.tanggalterbit);
          $('#viewRow9').html(result.tanggallahir);
          $('#viewRow10').html(result.organisasi);
        }
      })
    });

    $(document).on('click', 'button.btn-danger', function(){
      var idx = $(this).data('value');
          $.ajax({
            url : '<?php echo base_url('peserta/hapusdata');?>?id='+idx,
            success : function(result){
              if(result.status == 'success'){
                swal("Berhasil", "Berhasil menghapus Peserta", "success");
                location.reload();
              }else{
                swal("Gagal", 'Tidak dapat menghapus file peserta', "error");
              }
            },
            timeout: 3000,
            error: function(){
              swal("Gagal", 'Server tidak menangapi mohon cek koneksi anda', "error");
            }
          });
    });
});
</script>
</body>
</html>
