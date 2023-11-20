<?php
include '../util/connect.php';
$nama_tim = $_POST['namaSelectedTim'];
$selectedTim = $_POST['selectedTim'];


?>

<div class="card">
    <h5 class="card-header" style="padding: 15px;">Form Pemain</h5>
    <div class="card-body">
        <input type="hidden" id="selectedTim" value="<?= $selectedTim ?>">
        <input type="hidden" id="idmstpemain">
        <input type="hidden" id="namaSelectedTim" value="<?= $nama_tim ?>">
        <div class="row">
            <div class="form-group col-md-12">
                <label for="namaPemain" class="control-label"><b>Nama Pemain <span class="text-danger">*</span></b></label>

                <input type="text" class="form-control" id="namaPemain" placeholder="Masukkan Nama Pemain">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="form-group col-md-12">
                <label for="tipePemain" class="control-label"><b>Tipe Pemain <span class="text-danger">*</span></b></label>
                <select id="tipePemain" class="form-control">
                    <option value=""></option>
                    <option value="ASN">ASN / Pegawai Tetap</option>
                    <option value="NON ASN">Non ASN / Kontrak / Honorer</option>
                </select>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="namaPemain" class="control-label"><b>Foto Pemain</b></label>
                <div class="form-group foto-container">
                    <label for="image-upload" id="profile-img-label">
                        <img src="static/img/users.jpg" class="profile-img-dtl" id="profile-img">
                        &nbsp;&nbsp;<input id="image-upload" name="foto" class="upload-button uploadedFoto" type="file" accept="">
                    </label>
                </div>
            </div>
            <div class="form-group col-md-6">
                <label class="control-label" for="uploadFile"><b>SK</b></label>
                <div class="file-container">
                    <input type="file" class="form-control" id="uploadFilePemain" accept="">
                </div>
                <br>
                <div id="form_ktp">
                    <label class="control-label" for="uploadFile"><b>KTP</b></label>
                    <div class="ktp-container">
                        <input type="file" class="form-control" id="uploadKtpPemain" accept="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div style="float: right;"><button class="btn btn-secondary btnResetForm">Reset</button> &nbsp; <button class="btn btn-success btnSimpanPemain">Simpan</button></div>
    </div>
</div>
<br>
<hr>
<br>
<div class="card">
    <h5 class="card-header" style="padding: 15px;">List Pemain</h5>
    <div class="card-body">
        <table class="table table-striped table_list_pemain">
            <thead>
                <tr>
                    <th style="text-align: center; vertical-align: middle;">#</th>
                    <th style="text-align: center; vertical-align: middle;">Nama Pemain</th>
                    <th style="text-align: center; vertical-align: middle;">Status Pemain</th>
                    <th style="text-align: center; vertical-align: middle;">Dokumen</th>
                    <th style="text-align: center; vertical-align: middle;">Hapus</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM mstpemain WHERE idmsttim =$selectedTim ORDER BY status_pemain";
                $getData = mysqli_query($connect, $query) or die(mysqli_error($connect));
                while ($rs = mysqli_fetch_array($getData)) {
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
                        <td style="text-align: center; vertical-align: middle;">
                            <button type="button" class="btn btn-danger btnHapusPemain" data-idpemain="<?= $rs['idpemain'] ?>"><i class="bi bi-trash text-white"></i>&nbsp;<span class="text-white">Hapus</span></button>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<div class="modal fade" id="modalDokumen" tabindex="-1">
    <div class="modal-dialog modal-xl modal-x-circle-filll">
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

<script src="static/js/jquery-3.7.1/jquery-3.7.1.min.js"></script>

<!-- Vendor JS Files -->
<script src="static/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="static/vendor/aos/aos.js"></script>
<script src="static/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="static/vendor/glightbox/js/glightbox.min.js"></script>
<script src="static/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="static/vendor/swiper/swiper-bundle.min.js"></script>
<script src="static/vendor/php-email-form/validate.js"></script>
<script src="static/vendor/datatable/js/dataTables.min.js"></script>

<!-- Template Main JS File -->
<script src="static/js/main.js"></script>
<script src="static/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- canvas2html -->
<script src="static/js/html2canvas/html2canvas.js"></script>
<script src="static/js/html2canvas/html2canvas.min.js"></script>

<script>
    function initUploadButton() {
        var profileImg = $('#profile-img');
        var imageUpload = $('#image-upload');
        var profileImgLabel = $('#profile-img-label');
        var uploadButtonLabel = $('.upload-button-label');
        imageUpload.on('change', function(e) {
            var file = e.target.files[0];
            // Check if a file is selected
            if (file) {
                // Read the file as a data URL
                var reader = new FileReader();
                reader.onload = function(event) {
                    // Update the image source with the data URL
                    profileImg.attr('src', event.target.result);
                };
                reader.readAsDataURL(file);
            }
        });
    }

    function resetFormPemain() {
        $('#namaPemain').val('');
        $('#tipePemain').val('');
        $('#idmstpemain').val('');

        $('.file-container').html('');
        $('.file-container').html(' \
            <input type="file" class="form-control" id="uploadFilePemain"> \
            ');


        $('.ktp-container').html('');
        $('.ktp-container').html(' \
            <input type="file" class="form-control" id="uploadKtpPemain" accept=""> \
            ');

        $('.foto-container').html('');
        $('.foto-container').html(' \
            <label for="image-upload" id="profile-img-label"> \
                <img src="static/img/users.jpg" class="profile-img-dtl" id="profile-img"> \
                &nbsp;&nbsp;<input id="image-upload" name="foto" class="upload-button uploadedFoto" type="file" accept=""> \
            </label>\
            ');

        initUploadButton();
    }

    $(document).ready(function() {
        let table = $('.table_list_pemain').DataTable({
            "lengthMenu": [30,50,100],
        });
        initUploadButton()
        $('.btnResetForm').on('click', function() {
            resetFormPemain()
        });
        $('.btnLihatFile').on('click', function() {
            let uri = $(this).data('url')
            $('#file_sk').attr('src', uri);
            $('#modalDokumen').modal('show');
        })

        $('.btnHapusPemain').on('click', function() {
            let idpemain = $(this).data('idpemain');
            let namaTim = $('#namaSelectedTim').val();
            let idmsttim = $('#selectedTim').val();
            $.ajax({
                type: "POST",
                url: "controller/control.php",
                dataType: "text",
                data: {
                    action: 'hapusDataPemain',
                    idpemain: idpemain
                },
                success: function(data) {
                    if (data === 'Berhasil') {
                        showModalPemain(idmsttim, namaTim);
                    } else {
                        alert('Gagal Menghapus Tim')
                    }
                },
                error: function(ts) {
                    alert(ts.responseText);
                }
            });
        });

        $('.btnSimpanPemain').on('click', function() {
            let idmstpemain = $('#idmstpemain').val();
            let namaPemain = $('#namaPemain').val();
            let tipePemain = $('#tipePemain').val();
            let namaTim = $('#namaSelectedTim').val();
            let idmsttim = $('#selectedTim').val();
            let action = 'simpanPemain';
            if (idmstpemain) {
                action = 'updatePemain'
            }
            var is_lengkap = false;
            if (namaPemain, tipePemain) {
                is_lengkap = true;
            } else {
                is_lengkap = false;
            }
            if (is_lengkap) {
                var fd = new FormData;
                fd.append('action', action);
                fd.append('idmstpemain', idmstpemain);
                fd.append('namaPemain', namaPemain);
                fd.append('tipePemain', tipePemain);

                if ($('#image-upload').val()) {
                    let fotoPemain = $('#image-upload')[0].files[0];
                    fd.append('fotoPemain', fotoPemain);
                } else {
                    fd.append('fotoPemain', null);
                }

                if ($('#uploadFilePemain').val()) {
                    let filePemain = $('#uploadFilePemain')[0].files[0];
                    fd.append('filePemain', filePemain);
                } else {
                    fd.append('filePemain', null);

                }

                if ($('#uploadKtpPemain').val()) {
                    let ktpPemain = $('#uploadKtpPemain')[0].files[0];
                    fd.append('ktpPemain', ktpPemain);
                } else {
                    fd.append('ktpPemain', null);
                }

                fd.append('namaTim', namaTim);
                fd.append('idmsttim', idmsttim);


                $.ajax({
                    type: "POST",
                    url: "controller/control.php",
                    dataType: "text",
                    data: fd,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        if (data === 'Berhasil') {
                            showModalPemain(idmsttim, namaTim);
                        } else {
                            alert('Gagal Menambahkan Tim')
                        }
                    },
                    error: function(ts) {
                        alert(ts.responseText);
                    }
                });
            } else {
                alert('Lengkapi Form Terlebih Dahulu!')
            }

        });
    });
</script>