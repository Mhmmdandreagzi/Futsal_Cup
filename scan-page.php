<div class="hero-container">
  <br>
  <h2>Sesuaikan Pada Posisi yang telah ditentukan</h2>

  <div style="width: 600px; background-color: aliceblue;" id="reader"></div>

  <div>
    <br>
    <h2 style="margin-bottom: 0px;">Atau Masukan Code Dibawah Ini</h2>
    <br>
    <input type="text" style="width: 600px;" id="input-code" class="form-control" placeholder="Masukan Code">
  </div>
</div>


<!-- Vendor JS Files -->
<script src="static/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="static/vendor/aos/aos.js"></script>
<script src="static/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="static/vendor/glightbox/js/glightbox.min.js"></script>
<script src="static/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="static/vendor/swiper/swiper-bundle.min.js"></script>
<script src="static/vendor/php-email-form/validate.js"></script>

<!-- Plug-in -->
<script src="static/js/qr-code/html5-qrcode.min.js"></script>
<script src="static/js/jquery-3.7.1/jquery-3.7.1.min.js"></script>

<script>
  var html5QrcodeScanner = new Html5QrcodeScanner(
    "reader", {
      fps: 9,
      qrbox: {
        width: 600,
        height: 600
      }
    });
  html5QrcodeScanner.render(onScanSuccess, onScanError);
  $('#input-code').keyup(function(event) {
    if (event.keyCode === 13) {
      // html5QrcodeScanner.pause();
      // console.log(html5QrcodeScanner)
      let val = $(this).val();
      if (val != '') {
        $.ajax({
          type: "POST",
          url: 'controller/control.php',
          dataType: 'json',
          data: {
            action: 'checkQr',
            code: val,
          },
          success: function(res) {
            if (res) {
              getPagePemain(res)
            } else {
              alert('QR Code tidak valid');
              // html5QrcodeScanner.resume()
            }
          },
          error: function(ts) {
            alert(ts.responseText);
          }
        });
      } else {
        alert('Kode tidak boleh kosong');
      }

    }
  })

  function onScanSuccess(decodedText, decodedResult) {
    html5QrcodeScanner.pause();
    $.ajax({
      type: "POST",
      url: 'controller/control.php',
      dataType: 'json',
      data: {
        action: 'checkQr',
        code: decodedText,
      },
      success: function(res) {
        if (res) {
          getPagePemain(res)
        } else {
          alert('QR Code tidak valid');
          html5QrcodeScanner.resume()
        }
      },
      error: function(ts) {
        alert(ts.responseText);
      }
    });
  }

  function onScanError(err) {
    console.log(err);
  }

  function getPagePemain(data) {
    $('#hero').html('');

    $.ajax({
      type: 'POST',
      url: "pages/dataPemain.php",
      data: {
        dataTim: data
      },
      success: function(data) {
        $('#hero').html(data)
        html5QrcodeScanner.clear()
      },
      error: function(ts) {
        alert(ts.responseText)
      }
    })
  }
</script>