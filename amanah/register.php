<?php
session_start();
require_once 'helper/connection.php';
$error=false;
$success=false;

//ID USER DEFAULT
$query_id_user = mysqli_query($connection, "SELECT MAX(id_user) as id_user_terakhir FROM users");
$data_id_user = mysqli_fetch_assoc($query_id_user);
$pk_id_user = $data_id_user['id_user_terakhir'];
$angka_id_user = (int) substr( $pk_id_user, 4, 6);
$angka_id_user++;
$pk_id_user = 'USR-' . sprintf('%06d', $angka_id_user);

if (isset($_POST['register'])) {
  $id_user = $pk_id_user;
  $email = $_POST['email'];
  $sandi = $_POST['sandi'];
  $nama_user =$_POST['nama_user'];
  $no_telepon =$_POST['no_telepon'];
  $alamat =$_POST['alamat'];
  $level_user = $_POST['level_user'];
  $foto_user= '../amanah_assets/img/avatar/avatar-2.png';

$level = '';
if ($level_user == '1') {
  $level = 'Penjual';
} elseif ($level_user == '2') {
  $level = 'Pembeli';
} else {
        $error = "Level tidak valid.";
    }

$query = mysqli_query ($connection, "INSERT INTO users(id_user, email, sandi,nama_user,no_telepon,alamat, level_user, foto_user) VALUES('$id_user', '$email', '$sandi', '$nama_user','$no_telepon', '$alamat', '$level_user', '$foto_user')");
if ($query) {
  $_SESSION['info'] = [
    'status' => 'success',
    'message' => 'Berhasil menambah data'
  ];
  header('Location: ./index.php');
                                            } else {
                                              $_SESSION['info'] = [
                                                'status' => 'failed',
                                                'message' => mysqli_error($connection)
                                              ];
                                              header('Location: ./register.php');
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
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3">
            <div class="login-brand">
              <img src="amanah_assets/img/logo amanah.jpg" alt="logo" width="300">
            </div>

            <div class="card card-primary">
              <div class="card-header">
                <h4>Welcome!</h4>
              </div>

              <div class="card-body">
                <form method="POST" action="" class="needs-validation" novalidate="">
                  <div class="form-group">
                    <label for="email">Email</label>
                      <input id="email" type="text" class="form-control" name="email" placeholder="Masukkan email" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      Email tidak boleh kosong
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="d-lock">
                      <label for="sandi" class="control-label">Sandi</label>
                    </div>
                      <input id="sandi" type="text" class="form-control" name="sandi" placeholder="Masukkan sandi" tabindex="2" required>
                    <div class="invalid-feedback">
                      Sandi tidak boleh kosong
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="d-lock">
                      <label for="nama_user" class="control-label">Nama</label>
                    </div>
                      <input id="nama_user" type="text" class="form-control" name="nama_user" placeholder="Masukkan nama" tabindex="3" required>
                    <div class="invalid-feedback">
                      Nama tidak boleh kosong
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="d-lock">
                      <label for="no_telepon" class="control-label">No Telepon</label>
                    </div>
                      <input id="no_telepon" type="text" class="form-control" name="no_telepon" placeholder="Masukkan no telepon" tabindex="4" required>
                    <div class="invalid-feedback">
                      No telepon tidak boleh kosong
                    </div>
                  </div>

                  <div class="form-group">
                      <div class="d-lock">
                          <label for="alamat" class="control-label">Alamat</label>
                      </div>
                      <textarea id="alamat" class="form-control" name="alamat" placeholder="Masukkan alamat lengkap" tabindex="5" required></textarea>
                      <div class="invalid-feedback">
                          Alamat tidak boleh kosong
                      </div>
                  </div>

                  <div class="form-group">
                    <div class="d-lock">
                      <label for="level_user"class="control-label">Level User</label>
                    </div>
                      <select id="level_user" class="form-control" name="level_user">
                        <option value="1">Penjual</option>
                        <option value="2">Pembeli</option>
                      </select>                 
                  </div>                 

                  <div class="form-group">
                    <button name="register"class="btn btn-primary btn-lg btn-block" tabindex="6">
                      Register
                    </button>
                  </div>
                </form>

                <?php if (isset($error) && $error !== false) : ?>
                  <p class="alert alert-danger mt-4"><?= $error; ?></p>
                <?php endif; ?>
                <?php if (isset($success) && $success !== false) : ?>
                  <p class="alert alert-success mt-4"><?= $success; ?></p>
                <?php endif; ?>

                <div class="mt-4 text-center">
                  <p class="text-muted mb-0">Have Account? <a href="login.php" class="fw-medium text-primary"> Login</a></p>
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
  <script src="amanah_assets/js/custom.js"></script>

  <!-- Page Specific JS File -->
</body>
</html>