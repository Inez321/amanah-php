<?php
require_once '../layout/top.php';
require_once '../helper/connection.php';

$id_user = $_GET['id_user'];
$query = mysqli_query($connection, "SELECT * FROM users WHERE id_user='$id_user'");
?>

<section class="section">
    <div class="section-header d-flex justify-content-between">
        <h1>Ubah Profil</h1>
        <a href="./index.php" class="btn btn-light">Kembali</a>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="./update.php" method="post" enctype="multipart/form-data">
                        <?php while ($row = mysqli_fetch_array($query)) { ?>
                            <input type="hidden" name="id_user" value="<?= $row['id_user'] ?>">
                            
                            <div class="form-group text-center mb-4">
                                <img src="<?= !empty($row['foto_user']) ? $row['foto_user'] : '../amanah_assets/img/logo amanah 5.jpg' ?>" 
                                     class="rounded-circle mb-2" 
                                     width="120" 
                                     id="previewFoto">
                                <input type="file" name="foto_user" class="form-control-file" id="inputFoto" accept="image/*">
                            </div>
                            
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control" name="nama_user" value="<?= $row['nama_user'] ?>" required>
                            </div>
                            
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" value="<?= $row['email'] ?>" required>
                            </div>
                            
                            <div class="form-group">
                                <label>Password (Kosongkan jika tidak ingin mengubah)</label>
                                <input type="password" class="form-control" name="sandi">
                            </div>
                            
                            <div class="form-group">
                                <label>No Telepon</label>
                                <input type="text" class="form-control" name="no_telepon" value="<?= $row['no_telepon'] ?>" required>
                            </div>
                            
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                <a href="./index.php" class="btn btn-secondary">Batal</a>
                            </div>
                        <?php } ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
// Preview gambar sebelum upload
document.getElementById('inputFoto').addEventListener('change', function(e) {
    const reader = new FileReader();
    reader.onload = function() {
        document.getElementById('previewFoto').src = reader.result;
    }
    reader.readAsDataURL(e.target.files[0]);
});
</script>

<?php
require_once '../layout/bottom.php';
?>