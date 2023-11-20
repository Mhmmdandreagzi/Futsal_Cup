<?php
include '../util/connect.php';
$dataTim = $_POST['dataTim'];
?>
<!-- Modal -->
<div class="modal fade" tabindex="-1">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Dokumen Pemain</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div style="width: 100%; height: 700px;">
          <iframe src="" style="width: inherit; height: inherit;" id="file_sk" frameborder="0"></iframe>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Selesai</button>
      </div>
    </div>
  </div>
</div>
<div class="hero-container">
  <br>
  <br>
  <h2 style="margin-bottom: 10px;">List Pemain <?= $dataTim['nama_tim'] ?></h2>
  <div style="width: 70%; height:65%; overflow-y: scroll; border-radius: 25px;">
    <table class="table table-striped">
      <thead>
        <tr>
          <th style="text-align: center; vertical-align: middle;">#</th>
          <th style="text-align: center; vertical-align: middle;">Nama Pemain</th>
          <th style="text-align: center; vertical-align: middle;">Status Pemain</th>
          <th style="text-align: center; vertical-align: middle;">Dokumen</th>
        </tr>
      </thead>
      <tbody>

        <?php
        $q = "SELECT * FROM mstpemain WHERE idmsttim = " . $dataTim['idmsttim'];
        $query = mysqli_query($connect, $q) or die($connect);
        while ($rs = mysqli_fetch_array($query)) {
        ?>
          <tr>
            <td><a href="javascript:void(0)"><img src="<?= $rs['path_foto'] != '' ? $rs['path_foto']  : "static/img/users.jpg" ?>" class="btnLihatFile" data-url="<?= $rs['path_foto'] != '' ? $rs['path_foto']  : "static/img/users.jpg" ?>" style="object-fit: cover; width:150px; height:200px; border-radius:20px" /></a></td>
            <td style="text-align: center; vertical-align: middle;"><?= $rs['nama_pemain'] ?></td>
            <td style="text-align: center; vertical-align: middle;"><?= $rs['status_pemain'] ?></td>
            <td style="vertical-align: middle;">
                            <?php
                            if ($rs['path_sk'] != '') { ?>
                                <button type="button" class="btn btn-warning btnLihatFile" data-url="<?= $rs['path_sk'] ?>"><i class="bi bi-file-earmark-break text-white"></i>&nbsp;<span class="text-white">SK</span></button>
                            <?php } else { ?>
                                <span> <i class="bi bi-x-circle-fill text-danger"></i>&nbsp; SK </span>
                            <?php } ?>
                            &nbsp;&nbsp;
                            <?php
                            if ($rs['path_ktp'] != '') { ?>
                                <button type="button" class="btn btn-info btnLihatFile" data-url="<?= $rs['path_ktp'] ?>"><i class="bi bi-card-heading text-white"></i>&nbsp;<span class="text-white">KTP</span></button>
                            <?php } else { ?>
                                <span> <i class="bi bi-x-circle-fill text-danger"></i>&nbsp; KTP </span>
                            <?php } ?>

                        </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
<script src="static/js/jquery-3.7.1/jquery-3.7.1.min.js"></script>
<script src="static/vendor/bootstrap/js/bootstrap.bundle.js"></script>
<script src="static/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="static/vendor/bootstrap/js/bootstrap.min.js"></script>
<script>
  $(document).ready(function() {
    $('.btnLihatFile').on('click', function() {
      let uri = $(this).data('url')
      $('#file_sk').attr('src', uri);
      $('.modal').modal('show');
    })
  });
</script>