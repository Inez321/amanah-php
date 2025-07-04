<?php
require_once 'helper/connection.php';
session_start();

if (isset($_SESSION['login'])) {
    header('Location: index.php');
    exit;
}
$error = false; 

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $sandi = $_POST['sandi'];
    
  $sql = "SELECT * FROM users WHERE email='$email'";

  $result = mysqli_query($connection, $sql);
  $row = mysqli_fetch_assoc($result);

  if ((mysqli_num_rows($result) === 1) && ($sandi==$row['sandi'])) {
    $_SESSION['login'] = $row;
    header('Location: index.php');
    exit;
  } else {
    $error = true;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Air Amanah Boja</title>
  <link rel="shortcut icon" href="../amanah_assets/img/logo amanah 2.png">

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="amanah_assets/modules/bootstrap-social/bootstrap-social.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="amanah_assets/css/custom.css"> 
</head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <img src="amanah_assets/img/logo amanah.jpg" alt="logo" width="300">
            </div>

            <div class="card card-primary">
              <div class="card-header">
                <h4>Welcome Back!</h4>
              </div>

              <div class="card-body">
                <form method="POST" action="" class="needs-validation" novalidate="">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="text" class="form-control" name="email" placeholder="Masukkan email" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      Mohon isi email
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="d-lock">
                      <label for="sandi" class="control-label">Sandi</label>
                    </div>
                    <input id="sandi" type="sandi" class="form-control" name="sandi" placeholder="Masukkan sandi" tabindex="2" required>
                    <div class="invalid-feedback">
                      Mohon isi kata sandi
                    </div>
                  </div>

                  <div class="form-group">
                    <button name="submit" type="submit" class="btn btn-primary btn-lg btn-block" tabindex="3">
                      Login
                    </button>
                  </div>
                </form>  

                <?php if (isset($error) && $error !== false) : ?>
                  <p class="alert alert-danger mt-4">Email/Sandi Salah</p>
                <?php endif; ?>
                <?php if (isset($success) && $success !== false) : ?>
                  <p class="alert alert-success mt-4">Login Berhasil</p>
                <?php endif; ?> 
                
								<div class="mt-4 text-center">
									<p class="mb-0">Not Have Account? <a href="register.php" class="fw-medium text-primary"> Register Now </a> </p>
								</div>                              
              </div>
            </div>
            <div class="simple-footer">
              <p>©
                <script>
                document.write(new Date().getFullYear())
                </script>
                Kelompok B5 | TI UIN WS
              </p>  
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="amanah_assets/js/stisla.js"></script>

  <!-- JS Libraies -->

  <!-- Template JS File -->
  <script src="amanah_assets/js/scripts.js"></script>
  <script src="amanah_assets/js/custom.js"></script>

  <!-- Page Specific JS File -->
</body>

</html>