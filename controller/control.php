<?php
include '../util/connect.php';
include '../util/helper.php';

if (isset($_POST['action']) && !empty($_POST['action'])) {
    $action = $_POST['action'];
    switch ($action) {
        case 'checkQr':
            checkQr($_POST['code']);
            break;
        case 'simpanTim':
            simpanTim($_POST['namaTim'], $_POST['namaOfficial_1'], $_POST['noOfficial_1'], $_POST['namaOfficial_2'], $_POST['noOfficial_2'], $_POST['tipeTim']);
            break;
        case 'updateTim':
            updateTim($_POST['idmsttim'], $_POST['namaTim'], $_POST['namaOfficial_1'], $_POST['noOfficial_1'], $_POST['namaOfficial_2'], $_POST['noOfficial_2'], $_POST['tipeTim']);
            break;
        case 'getDataTim':
            getDataTim($_POST['idmsttim']);
            break;
        case 'simpanPemain':
            simpanPemain($_POST['namaPemain'], $_POST['tipePemain'], (isset($_FILES['fotoPemain'])) ? $_FILES['fotoPemain'] : null, (isset($_FILES['filePemain'])) ? $_FILES['filePemain'] : null, (isset($_FILES['ktpPemain'])) ? $_FILES['ktpPemain'] : null, (isset($_FILES['rekomPemain'])) ? $_FILES['rekomPemain'] : null, $_POST['namaTim'], $_POST['idmsttim']);
            break;
        case 'hapusDataPemain':
            hapusDataPemain($_POST['idpemain']);
            break;    
    }
};

function hapusDataPemain($idpemain){
    global $connect;

    $queryGet = "SELECT * FROM mstpemain WHERE idpemain = $idpemain";
    $getDataPemain = mysqli_query($connect,$queryGet) or die(mysqli_error($connect));
    $rs = mysqli_fetch_array($getDataPemain);
    if($rs['path_foto'] != ''){
        unlink('../' . $rs['path_foto']);
    }
    if($rs['path_sk'] != ''){
        unlink('../' . $rs['path_sk']);
    }
    if($rs['path_ktp'] != ''){
        unlink('../' . $rs['path_ktp']);
    }
        // $nonQuery = true;
    $delete = "DELETE from mstpemain WHERE idpemain =$idpemain";
    $nonQuery =mysqli_query($connect,$delete) or die(mysqli_error($connect));
    if($nonQuery){
        echo 'Berhasil';
    } else{
        echo 'Gagal';
    }

}

function simpanPemain($nama, $tipe, $foto, $file, $ktp,$rekom ,$namaTim, $idmsttim)
{
    global $connect;
    // echo $namaTim;
    $new_folder = "../upload/" . $namaTim;
    if (is_dir($new_folder) === false) {
        mkdir($new_folder);
    }
    if ($foto) {
        $newFolderFoto = "../upload/$namaTim/foto";
        if (is_dir($newFolderFoto) === false) {
            mkdir($newFolderFoto);
        }
        $tempFoto = explode(".", $foto['name']);
        $newFotoName = "FOTO_" . $nama . "_" . round(microtime(true)) . '.' . end($tempFoto);
        $urlFoto = "upload/$namaTim/foto/" . $newFotoName;
        $pathFoto = "../" . $urlFoto;
        move_uploaded_file($foto['tmp_name'], $pathFoto);
    }else {
        $urlFoto = "";
    }

    if ($file) {
        $newFolderFile = "../upload/$namaTim/file";
        if (is_dir($newFolderFile) === false) {
            mkdir($newFolderFile);
        }
        $tempFile = explode(".", $file['name']);
        $newfilename = "SK_" . $nama . "_" . round(microtime(true)) . '.' . end($tempFile);
        $urlFile = "upload/$namaTim/file/" . $newfilename;
        $pathFile = "../" . $urlFile;
        move_uploaded_file($file['tmp_name'], $pathFile);
    }else {
        $urlFile = "";
    }

    if ($ktp) {
        $newFolderKtp = "../upload/$namaTim/ktp";
        if (is_dir($newFolderKtp) === false) {
            mkdir($newFolderKtp);
        }
        $tempKtp = explode(".", $ktp['name']);
        $newKtpName = "KTP_" . $nama . "_" . round(microtime(true)) . '.' . end($tempKtp);
        $urlKtp = "upload/$namaTim/ktp/" . $newKtpName;
        $pathKtp = "../" . $urlKtp;
        move_uploaded_file($ktp['tmp_name'], $pathKtp);
    } else {
        $urlKtp = "";
    }

    if ($rekom) {
        $newFolderRekom = "../upload/$namaTim/rekom";
        if (is_dir($newFolderRekom) === false) {
            mkdir($newFolderRekom);
        }
        $tempRekom = explode(".", $rekom['name']);
        $newRekomName = "KTP_" . $nama . "_" . round(microtime(true)) . '.' . end($tempRekom);
        $urlRekom = "upload/$namaTim/rekom/" . $newRekomName;
        $pathRekom = "../" . $urlRekom;
        move_uploaded_file($rekom['tmp_name'], $pathRekom);
    } else {
        $urlRekom = "";
    }

    $insert = "INSERT INTO mstpemain (idmsttim,nama_pemain,status_pemain,path_foto,path_sk,path_ktp,path_rekom) VALUE($idmsttim,'$nama','$tipe','$urlFoto','$urlFile','$urlKtp','$urlRekom')";
    $nonQuery = mysqli_query($connect, $insert) or die(mysqli_error($connect));
    if ($nonQuery) {
        echo 'Berhasil';
    } else {
        echo 'Gagal';
    }
}

function checkQr($code)
{
    global $connect;
    $data = array(0);
    $query = "SELECT * FROM msttim WHERE code_tim = 'RSMACUP-".$code."' AND periode = '2024'";
    $q = mysqli_query($connect, $query) or die(mysqli_error($connect));
    echo json_encode(mysqli_fetch_assoc($q));
}

function simpanTim($nama, $ofc1, $noofc1, $ofc2, $noofc2, $tipeTim)
{
    global $connect;
    do {
        $code = generateCode();
        $chekData = mysqli_query($connect, "SELECT * FROM msttim WHERE code_tim ='$code'") or die(mysqli_error($connect));
        $row = mysqli_num_rows($chekData);
    } while ($row != 0);

    $insert = "INSERT INTO msttim(code_tim,nama_tim,nama_official_1,no_official_1,nama_official_2,no_official_2,tipe_tim,periode,is_menang) VALUE('$code','$nama','$ofc1','$noofc1','$ofc2','$noofc2','$tipeTim','2024',0)";
    $nonQuery = mysqli_query($connect, $insert) or die(mysqli_error($connect));
    if ($nonQuery) {
        echo 'Berhasil';
    } else {
        echo 'Gagal';
    }
}

function updateTim($id, $nama, $ofc1, $noofc1, $ofc2, $noofc2, $tipeTim)
{
    global $connect;
    $queryUpdate = "UPDATE msttim set nama_tim='$nama', nama_official_1 = '$ofc1',no_official_1='$noofc1',nama_official_2 = '$ofc2',no_official_2='$noofc2', tipe_tim = '$tipeTim' WHERE idmsttim = $id";
    $nonQuery = mysqli_query($connect, $queryUpdate) or die(mysqli_error($connect));
    if ($nonQuery) {
        echo 'Berhasil';
    } else {
        echo 'Gagal';
    }
}
function getDataTim($idmsttim)
{
    global $connect;
    $query = "SELECT * FROM msttim WHERE idmsttim = $idmsttim";
    $getResult = mysqli_query($connect, $query) or die(mysqli_error($connect));
    $result = mysqli_fetch_assoc($getResult);
    echo json_encode($result);
}
