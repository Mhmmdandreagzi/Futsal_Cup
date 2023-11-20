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
    <!-- Template Main CSS File -->
    <link href="static/css/style.css" rel="stylesheet">
    <style>
        /* width */
        ::-webkit-scrollbar {
            width: 10px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #888;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>

    
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
        <div class="hero-container" data-aos="fade-up">
            <h2 style="margin-bottom: 10px;">Selamat Datang Di Turnamen Futsal</h2>
            <h1 style="font-family: 'Bebas Neue', sans-serif; letter-spacing : 10px;">RSUDMA CUP 2023</h1>
            <h2></h2>
            <a href="javascript:void(0)" onclick="getPage('scan-page.php')" class="btn-get-started"><i class="bx bx-qr-scan"></i></a>
            <h2>Scan Qr</h2>
        </div>
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
        function getPage(url) {
            $('#hero').html('');

            $.ajax({
                type: 'POST',
                url: url,
                data: '1',
                success: function(data) {
                    $('#hero').html(data)
                },
                error: function(ts) {
                    alert(ts.responseText)
                }
            })
        }
    </script>

</body>

</html>