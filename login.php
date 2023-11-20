<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>RSUDMA Cup 2023</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="static/img/logo.png" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
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

    <style media="screen">
        *,
        *:before,
        *:after {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #080710;
        }

        .background {
            width: 430px;
            height: 520px;
            position: absolute;
            transform: translate(-50%, -50%);
            left: 50%;
            top: 50%;
        }

        .background .shape {
            height: 200px;
            width: 200px;
            position: absolute;
            border-radius: 50%;
        }

        .shape:first-child {
            background: linear-gradient(#1845ad,
                    #23a2f6);
            left: -80px;
            top: -80px;
        }

        .shape:last-child {
            background: linear-gradient(to right,
                    #ff512f,
                    #f09819);
            right: -30px;
            bottom: -80px;
        }

        form {
            width: 400px;
            background-color: rgba(255, 255, 255, 0.13);
            position: absolute;
            transform: translate(-50%, -50%);
            top: 50%;
            left: 50%;
            border-radius: 10px;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 0 40px rgba(8, 7, 16, 0.6);
            padding: 50px 35px;
        }

        form * {
            font-family: 'Poppins', sans-serif;
            color: #ffffff;
            letter-spacing: 0.5px;
            outline: none;
            border: none;
        }

        form h3 {
            font-size: 32px;
            font-weight: 500;
            line-height: 42px;
            text-align: center;
        }

        label {
            display: block;
            margin-top: 30px;
            font-size: 16px;
            font-weight: 500;
        }

        input {
            display: block;
            height: 50px;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.07);
            border-radius: 3px;
            padding: 0 10px;
            margin-top: 8px;
            font-size: 14px;
            font-weight: 300;
        }

        ::placeholder {
            color: #e5e5e5;
        }

        button {
            margin-top: 50px;
            width: 100%;
            background-color: #ffffff;
            color: #080710;
            padding: 15px 0;
            font-size: 18px;
            font-weight: 600;
            border-radius: 5px;
            cursor: pointer;
        }

        .social {
            margin-top: 30px;
            display: flex;
        }

        .social div {
            background: red;
            width: 150px;
            border-radius: 3px;
            padding: 5px 10px 10px 5px;
            background-color: rgba(255, 255, 255, 0.27);
            color: #eaf0fb;
            text-align: center;
        }

        .social div:hover {
            background-color: rgba(255, 255, 255, 0.47);
        }

        .social .fb {
            margin-left: 25px;
        }

        .social i {
            margin-right: 4px;
        }
    </style>

    <!-- Template Main CSS File -->
    <link href="static/css/style.css" rel="stylesheet">
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top header-transparent">
        <div class="container d-flex align-items-center justify-content-center position-relative">
            <?php include 'logo.php' ?>
        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero">
        <form>
            <h3>Login Here</h3>

            <label for="username">Username</label>
            <input type="text" placeholder="Email or Phone" id="username">

            <label for="password">Password</label>
            <input type="password" placeholder="Password" id="password">

            <button type="button" onclick="goLogin()">Log In</button>
        </form>
    </section>

    <main id="main">
    </main>

    <!-- Vendor JS Files -->
    <script src="static/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="static/vendor/aos/aos.js"></script>
    <script src="static/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="static/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="static/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="static/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="static/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="static/js/main.js"></script>
    <script src="static/js/jquery-3.7.1/jquery-3.7.1.min.js"></script>
    <script src="static/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script>
        function goLogin() {
            let username = $('#username').val();
            let password = $('#password').val();

            $.ajax({
                type: 'POST',
                url: 'util/auth.php',
                dataType: 'json',
                data: {
                    type: 'login',
                    username: username,
                    password: password
                },
                success: function(data) {
                    if (data['login'] == 'error') {
                        alert('Username Atau Password Salah!')
                    } else {
                        document.location = 'admin.php';
                    }
                },
                error: function(ts) {
                    alert(ts.responseText)
                }
            })
        }
    </script>

</body>

</html>