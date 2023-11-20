<?php
if (!isset($_SESSION)) {
    session_start();
}

$tipe = $_POST['type'];

if ($tipe == 'login') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if ($username == 'admin' && $password == 'admin') {
        $_SESSION['auth'] = 'admin';
        $resLogin['login'] = 'success';
        echo json_encode($resLogin);
    } else {
        $resLogin['login'] = 'error';
        echo json_encode($resLogin);
    }
} else if ($tipe == 'logout') {
    $_SESSION = array();
    session_destroy();
    $res['logout'] = 'success';
    echo json_encode($res);
} else if ($tipe == 'cek') {
    echo json_encode($_SESSION);
}
