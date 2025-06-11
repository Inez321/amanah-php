<?php
require_once '../_layout/_top.php';
require_once '../helper/connection.php';

$id_pesanan = $_GET['id_pesanan'];
$query =mysqli_query($connection, "SELECT
    p.id_pesanan,
    p.metode_pembayaran,
    p.tgl_kirim,
    p.tgl_pesan,
    u.nama_user,
    u.no_telepon,
    u.alamat,
    pr.nama_produk
FROM
    pesanan AS p,
    users AS u,
    keranjang AS k,
    produk AS pr
WHERE
    p.id_user = u.id_user AND
    p.id_pesanan = k.id_pesanan AND
    k.kode_produk = pr.kode_produk AND
    p.id_pesanan = '$id_pesanan'");


$jumlah_produk= mysqli_query($connection, "SELECT
    p.nama_produk,
    COUNT(k.kode_item) AS jumlah_terbeli
FROM
    keranjang k,
    produk p
WHERE
    k.kode_produk = p.kode_produk AND
    k.id_pesanan = '$id_pesanan'
GROUP BY
    p.nama_produk;");
$data = mysqli_fetch_array($query);
?>

<section class="section">
    <div class="section-header d-flex justify-content-between">
        <h1>Detail Pengiriman</h1>
        <p>
        <a href="../_layout/index.php">Home </a>
        <a href="../_pengiriman/riwayat.php">/ Jadwal Pengiriman </a>/ Detail Pengiriman
        </p>    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form>
                            <input type="hidden" name="id_pesanan" value="<?= $data['id_pesanan'] ?>">
                        <table cellpadding="8" class="w-100">
                            <tr>
                                <td>ID Pengiriman</td>
                                <td>
                                    <input class="form-control" type="text" name="id_pesanan" size="20" required value="<?=  $data['id_pesanan'] ?>" disabled>
                                </td>
                            </tr>
                            <tr>
                                <td>Nama Pelanggan</td>
                                <td>
                                    <input class="form-control" type="text" name="nama_pelanggan" size="20" required value="<?=  $data['nama_user'] ?>" disabled>
                                </td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>
                                    <input class="form-control" type="text" name="alamat_pelanggan" size="20" required value="<?=  $data['alamat'] ?>" disabled>
                                </td>
                            </tr>
                            <tr>
                                <td>No Telepon</td>
                                <td>
                                    <input class="form-control" type="text" name="no_telepon_pelanggan" size="20" required value="<?=  $data['no_telepon'] ?>" disabled>
                                </td>
                            </tr>
                            <tr>
                                <td>Tanggal Antar</td>
                                <td>
                                    <input class="form-control" type="text" name="tanggal_antar" size="20" required value="<?=  $data['tgl_kirim'] ?>" disabled>
                                </td>
                            </tr>
                            <tr>
                                <td>Tanggal Pesan</td>
                                <td>
                                    <input class="form-control" type="text" name="tanggal_pesan" size="20" required value="<?=  $data['tgl_pesan'] ?>" disabled>
                                </td>
                            </tr>
                            <tr>
                                <td>Metode Pembayaran</td>
                                <td>
                                    <input class="form-control" type="text" name="metode_pembayaran_display" size="20" required value="<?=  $data['metode_pembayaran'] ?>" disabled>
                                </td>
                            </tr>                          
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>  
</section>

<section class="section">
    <div class="section-header d-flex justify-content-between">
        <h1>Produk yang Dibeli</h1>
    </div>                      
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">                   
                    <div class="table-responsive">                    
                        <table class="table table-hover table-striped w-100" id="table-1">
                            <thead>
                                <tr>
                                    <th>Nama Produk</th>
                                    <th>Jumlah Produk</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($jumlah_produk)): ?>
                                    <tr>
                                        <td><?= $row['nama_produk'] ?></td>
                                        <td><?= $row['jumlah_terbeli'] ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table> 
                    </div>  
                </div>
            </div>
        </div>
    </div>
</section>

<?php
require_once '../_layout/_bottom.php';
?>
<script src="../amanah_assets/js/page/modules-datatables.js"></script>