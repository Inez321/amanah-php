<?php
require_once '../helper/auth.php';
require_once '../_layout/_top.php';
require_once '../helper/connection.php';

$id_user = $_SESSION['login']['id_user'];
$query = mysqli_query($connection, "SELECT * FROM users WHERE id_user='$id_user'");
?>

<section class="section">
    <div class="section-header d-flex justify-content-between">
        <h1>Profil</h1>
        <div class="section-header-breadcrumb">
            <p>
                <a href="../_layout/index.php">Home</a> / Profil
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form>
                        <?php while ($row = mysqli_fetch_array($query)) { ?>
                            <input type="hidden" name="id_user" value="<?= $row['id_user'] ?>">
                            <div class="col-md-4 d-flex align-items-start justify-content-center mb-3"> 
                                <img src="<?= !empty($row['foto_user']) ? $row['foto_user'] : '../amanah_assets/img/logo amanah 5.jpg' ?>" 
                                     alt="Foto Profil" 
                                     class="rounded-circle mr-1" 
                                     width="100">
                            </div>
                            <table cellpadding="8" class="w-100">
                                <tr>
                                    <td>Nama</td>
                                    <td><input class="form-control" type="text" name="nama_user" value="<?= $row['nama_user'] ?>" disabled></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><input class="form-control" type="text" name="email" value="<?= $row['email'] ?>" disabled></td>
                                </tr>
                                <tr>
                                    <td>Sandi</td>
                                    <td><input class="form-control" type="password" value="********" disabled></td>
                                </tr>
                                <tr>
                                    <td>No Telepon</td>
                                    <td><input class="form-control" type="text" name="no_telepon" value="<?= $row['no_telepon'] ?>" disabled></td>
                                </tr>
                                <tr>
                                    <td>
                                        <a class="btn btn-sm btn-info" href="edit.php?id_user=<?= $row['id_user'] ?>">
                                            <i class="fas fa-edit fa-fw"></i> Ubah
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        <?php } ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
require_once '../_layout/_bottom.php';
?>