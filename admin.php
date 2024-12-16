<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['auth'])) {
    header('Location:login.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>RSUDMA Cup 2024</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="static/img/Logo-RSUDMA-CUP-2024.png" rel="icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="static/vendor/aos/aos.css" rel="stylesheet">
    <link href="static/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="static/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="static/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="static/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="static/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="static/vendor/datatable/css/dataTables.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="static/css/style.css" rel="stylesheet">
    <link href="static/css/id_card.css" rel="stylesheet">

    <!-- Font -->
    <link rel="stylesheet" href="static/css/font.css">

    <style>
        .profile-img-dtl {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
        }

        .profile-img-dtl {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
        }

        .profile-img-dtl {
            transition: 0.3s;
            /* Add smooth transition effect */
            cursor: pointer;
            /* Change cursor to pointer */
        }

        /* CSS for profile picture on hover */
        .profile-img-dtl:hover {
            transform: scale(1.1);
            /* Increase the size on hover */
        }

        /* CSS for upload button */
        .upload-button {
            display: none;
        }

        .upload-button-label {
            cursor: pointer;
        }
    </style>

    <script src="static/js/custom-qr-code/custom-qr-code.js"></script>

</head>

<body style="background-color: #f4f9fc;">

    <!-- ======= Header ======= -->
    <header id="header" style="background-color: aliceblue;" class="fixed-top header-transparent">
        <div class="container d-flex align-items-center">
            <div class="col-lg-12 row no-padding">
                <div class="col-lg-4 no-padding">
                    <div class="logo" style="margin-right: 20px;">
                        <a href="index.php"><img src="static/img/LOGO-RSUDMA.png" style="height: 45px;" alt="" class="img-fluid"></a>
                        <a href="index.php"><img src="static/img/Logo-RSUDMA-CUP-2024.png" alt="" class="img-fluid" style="margin-left: 10px; margin-right: 0px; height: 45px;"></a>
                        <a href="index.php"><img src="static/img/logo_hkn_60.png" style="height: 45px;" alt="" class="img-fluid"></a>
                    </div>
                </div>
                <div class="col-lg-4 no-padding">
                    <center>
                        <h1 style="font-family: 'Bebas Neue', sans-serif; letter-spacing : 7px; margin-bottom: 0px;">RSUDMA CUP 2024</h1>
                    </center>
                </div>
                <div class="col-lg-4 no-padding">
                    <div class="float-end">
                        <div class="row d-flex align-items-center">
                            <!-- <div style="width: 45px; height: 45px; border-radius: 22px; background-color:antiquewhite; padding: 5px;">
                                <center>
                                    <img src="static/img/LOGO-RSUDMA.png" width="100%" style="object-fit: cover;" alt="">
                                </center>
                            </div> -->
                            <button type="button" onclick="goLogout()" class="btn btn-danger"><i class="bi bi-box-arrow-right"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header><!-- End Header -->

    <main id="main">
        <section id="about" style="background-image: url('static/img/background_futsal_lagi.jpg');">
            <div class="container position-relative aos-init aos-animate" data-aos="fade-up">
                <div class="row">
                    <div class="col-lg-6">
                        <h2>Daftar Tim Turnamen</h2>
                    </div>
                </div>
            </div>
        </section>
        <section id="contact" class="section-bg">
            <div class="container aos-init aos-animate" data-aos="fade-up">
                <div class="card">
                    <h5 class="card-header" style="padding: 15px;">Tambah Tim <a href="javascript:void(0)" onclick="tambahTim()"><span class="text-success"><i class="bi bi-plus-circle"></i></span></a></h5>
                    <div class="card-body">
                        <table class="table table-striped table_list_tim">
                            <thead>
                                <tr>
                                    <th style="text-align: center; vertical-align: middle;">#</th>
                                    <th style="text-align: center; vertical-align: middle;">Kode</th>
                                    <th style="text-align: center; vertical-align: middle;">Tim Kode</th>
                                    <th style="text-align: center; vertical-align: middle;">Nama</th>
                                    <th style="text-align: center; vertical-align: middle;">Official</th>
                                    <th style="text-align: center; vertical-align: middle;">Detail</th>
                                    <th style="text-align: center; vertical-align: middle;">ID Card</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include 'util/connect.php';
                                $q = "SELECT * FROM msttim WHERE is_menang = 0 and periode = '2024' ORDER BY idmsttim DESC ";
                                $query = mysqli_query($connect, $q) or die($connect);
                                $inc= 1;
                                while ($rs = mysqli_fetch_array($query)) {
                                    $official = $rs['nama_official_1'] . " : " . $rs['no_official_1'];
                                    if ($rs['nama_official_2']) {
                                        $official .= '<br>' . $rs['nama_official_2'] . " : " . $rs['no_official_2'];
                                    }
                                    
                                ?>
                                    <tr>
                                        <!-- <td><img src="upload/foto/profile-1.jpeg" alt=""></td> -->
                                        <td style="text-align: center; vertical-align: middle;"><?= $inc ?></td>
                                        <td style="text-align: center; vertical-align: middle;"><a href="javascript:void(0)" class="btn btn-success" onclick="updateTim(<?= $rs['idmsttim'] ?>)"><?= $rs['code_tim'] ?></a></td>
                                        <td style="text-align: center; vertical-align: middle;"><?= $rs['code_tim'] ?></td>
                                        <td style="text-align: center; vertical-align: middle;"><?= $rs['nama_tim'] ?></td>
                                        <td style="text-align: center; vertical-align: middle;"><?= $official ?></td>
                                        <td style="text-align: center; vertical-align: middle;"><button type="button" class="btn btn-info btnLihatFile" data-idtim="<?= $rs['idmsttim'] ?>" data-nama_tim="<?= $rs['nama_tim'] ?>"><i class="bi bi-file-earmark-break text-white"></i>&nbsp;<span class="text-white">Detail</span></button></td>
                                        <td style="text-align: center; vertical-align: middle;"><button type="button" class="btn btn-warning btnGenerateQR" data-nama="<?= $rs['nama_tim'] ?>" data-code="<?= $rs['code_tim'] ?>"><i class="bi bi-qr-code text-white"></i>&nbsp;<span class="text-white">&nbsp;ID Card</span></button></td>
                                    </tr>
                                <?php $inc++; } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <div class="modal fade" id="modal-tambah" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Tim</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="idmsttim">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="namaTim" class="control-label"><b>Nama Tim <span class="text-danger">*</span></b></label>

                            <input type="text" class="form-control" id="namaTim" placeholder="Masukkan Nama Tim">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="namaTim" class="control-label"><b>Kategori <span class="text-danger">*</span></b></label>
                            <select id="tipeTim" class="form-control">
                                <option value=""></option>
                                <option value="OPD">OPD</option>
                                <option value="Kecamatan">Kecamatan</option>
                                <option value="Puskesmas">Puskesmas</option>
                                <option value="Instansi Vertikal">Instansi Vertikal</option>
                                <option value="Rumah Sakit">Rumah Sakit</option>
                                <option value="Klinik Kesehatan">Klinik Kesehatan</option>
                                
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="control-label" for="namaOfficial"><b>Nama Official 1 <span class="text-danger">*</span></b></label>
                            <input type="text" class="form-control" id="namaOfficial_1" placeholder="Masukkan Nama Official">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label" for="namaOfficial"><b>No. Official 1 <span class="text-danger">*</span> </b></label>
                            <input type="text" class="form-control" id="noOfficial_1" placeholder="Masukkan Nama Official">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="control-label" for="namaOfficial"><b>Nama Official 2</b></label>
                            <input type="text" class="form-control" id="namaOfficial_2" placeholder="Masukkan Nama Official 1">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label" for="namaOfficial"><b>No. Official 2</b></label>
                            <input type="text" class="form-control" id="noOfficial_2" placeholder="Masukkan Nama Official 2">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success" onclick="simpanTimBaru()">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-qr" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ID CARD TIM</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="id_card_container">
                        <div class="content">
                            <div class="nama_tim">
                                <h1 id="nama_tim">NAMA_TIM</h1>
                            </div>
                            <div class="qr-code-container">
                                <qr-code id="qr" contents="_" module-color="#FFFFFF" position-ring-color="#FFFFFF" position-center-color="#FFD500" mask-x-to-y-ratio="1.4"><img src="static/img/logo_white.png" width="100%" slot="icon" /></qr-code>
                            </div>
                            <div class="code_tim">
                                <h1 id="code_tim">CODE</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success" id="downloadIdCard">Download</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-list-pemain" tabindex="-1">
        <div class="modal-dialog modal-xl" style="max-width: 90%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title_modal_pemain">List Pemain</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="body_form_pemain">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info text-white" data-bs-dismiss="modal">Selesai</button>
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
        let table = $('.table_list_tim').DataTable({
            "lengthMenu": [30,50,100],
        });
        var namaFile = '';

        function goLogout() {
            $('#hero').html('');

            $.ajax({
                type: 'POST',
                url: 'util/auth.php',
                dataType: 'json',
                data: {
                    type: 'logout'
                },
                success: function(data) {
                    document.location = 'login.php';
                },
                error: function(ts) {
                    alert(ts.responseText)
                }
            })
        }

        function resetFormTim() {
            $('#idmsttim').val('');
            $('#namaTim').val('');
            $('#namaOfficial_1').val('');
            $('#noOfficial_1').val('');
            $('#namaOfficial_2').val('');
            $('#noOfficial_2').val('');
            $('#tipeTim').val('');
        }





        function tambahTim() {
            $('#modal-tambah').modal('show')
            resetFormTim()
        }

        function simpanTimBaru() {
            let idmsttim = $('#idmsttim').val()
            let namaTim = $('#namaTim').val()
            let namaOfficial_1 = $('#namaOfficial_1').val()
            let noOfficial_1 = $('#noOfficial_1').val()
            let namaOfficial_2 = $('#namaOfficial_2').val()
            let noOfficial_2 = $('#noOfficial_2').val()
            let tipeTim = $('#tipeTim').val()

            if (namaTim != "" && namaOfficial_1 != "" && noOfficial_1 != "" && tipeTim != "") {
                if (noOfficial_2 == "") {
                    noOfficial_2 = 0
                }
                var action = 'simpanTim';
                if (idmsttim) {
                    action = 'updateTim';
                }
                $.ajax({
                    url: 'controller/control.php',
                    data: {
                        action: action,
                        idmsttim: idmsttim,
                        namaTim: namaTim,
                        namaOfficial_1: namaOfficial_1,
                        noOfficial_1: noOfficial_1,
                        namaOfficial_2: namaOfficial_2,
                        noOfficial_2: noOfficial_2,
                        tipeTim: tipeTim
                    },
                    type: "POST",
                    dataType: "text",
                    success: function(data) {
                        if (data === 'Berhasil') {
                            location.reload()
                        } else {
                            alert('Gagal Menambahkan Tim')
                        }
                    },
                    error: function(ts) {
                        alert(ts.responseText)
                    }
                })
            } else {
                alert("Isian dengan tanda (*) harus di isi!")
            }
        }

        function updateTim(id) {
            $.ajax({
                url: 'controller/control.php',
                type: "POST",
                dataType: 'json',
                data: {
                    action: 'getDataTim',
                    idmsttim: id
                },
                success: function(data) {
                    $('#idmsttim').val(data.idmsttim);
                    $('#namaTim').val(data.nama_tim);
                    $('#namaOfficial_1').val(data.nama_official_1);
                    $('#noOfficial_1').val(data.no_official_1);
                    $('#namaOfficial_2').val(data.nama_official_2);
                    $('#noOfficial_2').val(data.no_official_2);
                    $('#tipeTim').val(data.tipe_tim);
                    $('#modal-tambah').modal('show');
                },
                error: function(ts) {
                    alert(ts.responseText);
                }
            })
        }

        function showModalPemain(idTim, namaTim) {
            $('#body_form_pemain').html('<div class=\"container\"><div class=\"row\"><img src=\"static/img/loading-buffering.gif\" style=\"display:block; margin:auto; margin-top: 19%; width: 77px;\"></div></div>')
            return new Promise(function(resolve, reject) {
                $.ajax({
                    type: 'POST',
                    url: "pages/formPemain.php",
                    data: {
                        namaSelectedTim: namaTim,
                        selectedTim: idTim
                    },
                    success: function(data) {
                        resolve()
                        $('#body_form_pemain').html(data)
                    },
                    error: function(ts) {
                        reject()
                        alert(ts.responseText)
                    }
                })
            });
        }




        $(document).ready(function() {
            $('.btnGenerateQR').on('click', function() {
                let nama = $(this).data('nama').toUpperCase();
                let code = $(this).data('code');
                let newCode = code.split('-')
                $('#nama_tim').html(nama);
                $('#qr').attr('contents', code);
                namaFile = 'ID_CARD_' + nama + '.jpg'

                $('#code_tim').html(newCode[0] + '-' + '<span style="color:#FFD500">' + newCode[1] + '</span>');
                $('#modal-qr').modal('show');
            });

            $('.btnLihatFile').on('click', async function() {
                let idtim = $(this).data('idtim')
                let nama_tim = $(this).data('nama_tim')
                await showModalPemain(idtim, nama_tim).then(function(result) {
                    $('#title_modal_pemain').html('List Pemain ' + nama_tim)
                    $('#modal-list-pemain').modal('show');
                });
            });

            $('#downloadIdCard').on('click', function() {
                html2canvas(document.querySelector('.id_card_container')).then(function(canvas) {
                    var a = document.createElement('a');
                    a.href = canvas.toDataURL("image/jpeg").replace("image/jpeg");
                    a.download = namaFile;
                    a.click();
                });
            });
        });
    </script>
</body>

</html>