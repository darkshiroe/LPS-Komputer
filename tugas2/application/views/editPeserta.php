<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('basic/head');
?>
<link rel="stylesheet" href="<?php echo base_url('assets/');?>sweetalert2/dist/sweetalert2.min.css">
<style>
.error {
    color: red;
}
</style>
</head>
<body>
<?php
$this->load->view('basic/navlink');
?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Ubah Data Peserta</h1>
  </div>

  <form method="POST" id="tambahPeserta">
  <div class="form-group">
    <label for="namapeserta">Nama Peserta</label>
    <input type="hidden" name="idx" value="<?php echo $this->input->get('id', true);?>" >
    <input type="text" class="form-control" id="namapeserta" name="namapeserta" placeholder="Nama Peserta">
  </div>
  <div class="form-group">
    <label for="nik">Nomor Induk Kependudukan (NIK)</label>
    <input type="text" class="form-control" id="nik" name="nik" placeholder="Nomor Induk Kependudukan">
  </div>
  <div class="form-group">
    <label for="notelphp">Nomor HP</label>
    <input type="text" class="form-control" id="notelphp" name="notelphp" placeholder="Nomor HP">
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="text" class="form-control" id="email" name="email" placeholder="Email Peserta">
  </div>
  <div class="form-group">
    <label for="skema">Skema Sertifikasi</label>
    <select id="skema" name="skema" class="form-control">
      <option value="">Pilih Skeme Sertifikat</option>
      <option value="Programmer Madya">Programmer Madya</option>
      <option value="Networking">Networking</option>
      <option value="Multimedia">Multimedia</option>
    </select>
  </div>
  <div class="form-group">
    <label for="tempatuji">Tempat Uji Kompetensi</label>
    <input type="text" class="form-control" id="tempatuji" name="tempatuji" placeholder="Tempat Uji Kompetensi">
  </div>
  <div class="form-group">
    <label for="rekomendasi">Rekomendasi</label>
    <input type="text" class="form-control" id="rekomendasi" name="rekomendasi" placeholder="Rekomendasi">
  </div>
  <div class="form-group">
    <label for="tanggalterbit">Tanggal Terbit Sertifikat</label>
    <input type="text" class="form-control" id="tanggalterbit" name="tanggalterbit" placeholder="Tanggal Terbit Sertifikat">
  </div>
  <div class="form-group">
    <label for="tanggallahir">Tanggal Lahir</label>
    <input type="text" class="form-control" id="tanggallahir" name="tanggallahir" placeholder="Tanggal Lahir">
  </div>
  <div class="form-group">
    <label for="organisasi">Organisasi</label>
    <input type="text" class="form-control" id="organisasi" name="organisasi" placeholder="Organisasi">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

</main>
</div>
</div>

<?php
$this->load->view('basic/java');
?>
<!-- JS Validators -->
<script src="<?php echo base_url('assets/');?>validation/dist/jquery.validate.min.js"></script>
<!-- sweetalert2 -->
<script src="<?php echo base_url('assets/');?>sweetalert2/dist/sweetalert2.min.js"></script>
<script>
$(document).ready(function(){
  //First Load
  $.ajax({
    url : '<?php echo base_url('peserta/ambildata?id='.$this->input->get('id', true));?>',
    success : function(result){
      $('#namapeserta').val(result.namapeserta);
      $('#nik').val(result.nik);
      $('#notelphp').val(result.notelphp);
      $('#email').val(result.email);
      $('#skema').val(result.skema);
      $('#tempatuji').val(result.tempatuji);
      $('#rekomendasi').val(result.rekomendasi);
      $('#tanggalterbit').val(result.tanggalterbit);
      $('#tanggallahir').val(result.tanggallahir);
      $('#organisasi').val(result.organisasi);
    }
  });

  //Fungsi validasi dan submitHandler
  $("#tambahPeserta").validate({
    rules: {
      namapeserta : {
        required : true
        //remote : '<?php echo base_url('peserta/checknama');?>'
      },
      nik : {
        number: true,
        required : true,
        remote : '<?php echo base_url('peserta/checknik');?>'
      },
      notelphp : {
        number: true,
        required : true,
        remote : '<?php echo base_url('peserta/checknomortelp');?>'
      },
      email : {
        required : true,
        email: true
      },
      skema : "required",
      tempatuji : "required",
      rekomendasi : "required",
      tanggalterbit : {
        required: true,
        date: true
      },
      tanggallahir : {
        required: true,
        date: true
      },
      organisasi : "required"
    },
    messages: {
      namapeserta : {
        required : 'Nama peserta harus disi',
        remote : 'Nama Peserta sudah terdaftar'
      },
      nik : {
        number: 'Input harus berformat angka',
        required : 'NIK tidak boleh kosong',
        remote : 'Nomor NIK telah terdaftar'
      },
      notelphp : {
        number: 'Input harus berformat angka',
        required : 'Nomor HP tidak boleh kosong',
        remote : 'Nomor HP sudah terdaftar'
      },
      email : {
        required : "Email tidak boleh kosong",
        email : "Format email tidak benar"
      },
      skema : "Skema Sertifikasi tidak boleh kosong",
      tempatuji : "Tempat Uji Kompentensi tidak boleh kosong",
      rekomendasi : "Rekomendasi tidak boleh kosong",
      tanggalterbit : {
        required: 'Tanggal terbit sertifikat tidak boleh kosong',
        date: 'Format input harus berformat waktu tanggal'
      },
      tanggallahir : {
        required: 'Tanggal Lahir tidak boleh kosong',
        date: 'Input harus berformat waktu tanggal'
      },
      organisasi : "Organisasi tidak boleh kosong"
    },
    submitHandler : function(){
      $.ajax({
        url : '<?php echo base_url();?>peserta/editsubmit',
        type : 'POST',
        data : $('#tambahPeserta').serialize(),
        success : function(success){
          if(success.status == 'success'){
            swal("Berhasil", "Berhasil mengubah data peserta", "success");
            location.replace('<?php echo base_url('peserta/manage');?>');
          }else{
            swal("Gagal", success.message, "error");
          }
        },
        timeout: 3000,
        error: function(){
          swal("Gagal", 'Server tidak menangapi mohon cek koneksi anda', "error");
        }
      });
    }
  });

});
</script>
</body>
</html>
