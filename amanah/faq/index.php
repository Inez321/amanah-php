<?php
require_once '../helper/auth.php';
require_once '../layout/top.php';
require_once '../helper/connection.php';
?>

<section class="section">
    <div class="section-header d-flex justify-content-between">
        <h1>FAQ - Pertanyaan yang Sering Diajukan</h1>
        <div class="section-header-breadcrumb">
            <p>
                <a href="../layout/index.php">Home</a> / FAQ
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="accordion" id="faqAccordion">
                        <!-- FAQ Item 1 -->
                        <div class="card mb-2">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <button class="btn btn-link text-dark" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <i class="fas fa-question-circle mr-2"></i> Produk Air Amanah Apa Saja yang Tersedia?
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#faqAccordion">
                                <div class="card-body">
                                    <p>Air Amanah menghadirkan rangkaian produk air minum berkualitas tinggi untuk memenuhi berbagai kebutuhan Anda. Kami menyediakan:</p>
                                    <ul class="list-group list-group-flush mb-3">
                                        <li class="list-group-item"><strong>Air Galon 19 liter</strong>: Rp20.000 per galon</li>
                                        <li class="list-group-item"><strong>Air Botol 500ml</strong>: Dus berisi 28 botol (Rp70.000/dus)</li>
                                        <li class="list-group-item"><strong>Air Botol 330ml</strong>: Dus berisi 32 botol (Rp60.000/dus)</li>
                                        <li class="list-group-item"><strong>Air Botol 200ml</strong>: Dus berisi 24 botol (Rp35.000/dus)</li>
                                    </ul>
                                    <p>Setiap produk melalui proses sterilisasi lengkap untuk menjamin kualitas terbaik.</p>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 2 -->
                        <div class="card mb-2">
                            <div class="card-header" id="headingTwo">
                                <h5 class="mb-0">
                                    <button class="btn btn-link text-dark collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        <i class="fas fa-shopping-cart mr-2"></i> Bagaimana Cara Memesan Air Amanah?
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#faqAccordion">
                                <div class="card-body">
                                    <p>Proses pemesanan kami dirancang untuk kemudahan Anda:</p>
                                    <ol>
                                        <li>Kunjungi website kami dan jelajahi produk-produk unggulan</li>
                                        <li>Pilih varian dan jumlah yang diinginkan</li>
                                        <li>Lakukan Pemesanan</li>
                                        <li>Konfirmasi pesanan Anda</li>
                                    </ol>
                                    <p>Tim kami akan segera memproses pesanan Anda maksimal 1x24 jam setelah pembayaran diterima.</p>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 3 -->
                        <div class="card mb-2">
                            <div class="card-header" id="headingThree">
                                <h5 class="mb-0">
                                    <button class="btn btn-link text-dark collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        <i class="fas fa-box-open mr-2"></i> Apakah Ada Minimal Pemesanan?
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#faqAccordion">
                                <div class="card-body">
                                    <p>Kami menerima pemesanan dengan ketentuan:</p>
                                    <ul class="list-group list-group-flush mb-3">
                                        <li class="list-group-item">Minimal 1 galon untuk air kemasan galon</li>
                                        <li class="list-group-item">Minimal 1 dus untuk air kemasan botol</li>
                                    </ul>
                                    <p>Untuk kebutuhan bisnis atau acara khusus dengan pembelian dalam jumlah besar, kami menyediakan penawaran spesial.</p>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 4 -->
                        <div class="card mb-2">
                            <div class="card-header" id="headingFour">
                                <h5 class="mb-0">
                                    <button class="btn btn-link text-dark collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        <i class="fas fa-truck mr-2"></i> Berapa Lama Waktu Pengiriman?
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#faqAccordion">
                                <div class="card-body">
                                    <p>Pengiriman dilakukan dalam 1–3 hari kerja (tergantung lokasi dan ketersediaan stok). Untuk wilayah tertentu, kami akan konfirmasi estimasi waktu pengiriman.</p>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 5 -->
                        <div class="card mb-2">
                            <div class="card-header" id="headingFive">
                                <h5 class="mb-0">
                                    <button class="btn btn-link text-dark collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                        <i class="fas fa-shipping-fast mr-2"></i> Bagaimana Kebijakan Biaya Pengiriman?
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#faqAccordion">
                                <div class="card-body">
                                    <p>Gratis ongkir untuk wilayah tertentu (sesuai ketentuan kami). Untuk daerah lain, biaya pengiriman akan disesuaikan dengan jarak dan dikonfirmasi sebelum pemrosesan pesanan.</p>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 6 -->
                        <div class="card mb-2">
                            <div class="card-header" id="headingSix">
                                <h5 class="mb-0">
                                    <button class="btn btn-link text-dark collapsed" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                        <i class="fas fa-money-bill-wave mr-2"></i> Metode Pembayaran Apa Saja yang Tersedia?
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#faqAccordion">
                                <div class="card-body">
                                    <p>Kami menyediakan berbagai opsi pembayaran yang aman dan nyaman:</p>
                                    <ul class="list-group list-group-flush mb-3">
                                        <li class="list-group-item"><strong>Transfer Bank</strong>: BNI (virtual account atau transfer manual) dan QRIS</li>
                                        <li class="list-group-item"><strong>Cash / Tunai (COD)</strong>: Bayar tunai saat barang diterima</li>
                                    </ul>
                                    <p>Semua transaksi dilindungi sistem keamanan berlapis untuk proteksi data pelanggan.</p>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 7 -->
                        <div class="card mb-2">
                            <div class="card-header" id="headingSeven">
                                <h5 class="mb-0">
                                    <button class="btn btn-link text-dark collapsed" type="button" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                        <i class="fas fa-check-circle mr-2"></i> Bagaimana Kualitas dan Keamanan Air Amanah?
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#faqAccordion">
                                <div class="card-body">
                                    <p>Air Amanah diproduksi dengan standar tertinggi:</p>
                                    <ul class="list-group list-group-flush mb-3">
                                        <li class="list-group-item">Memiliki sertifikasi resmi BPOM dan MUI</li>
                                        <li class="list-group-item">Diproses dengan teknologi Reverse Osmosis 5 tahap</li>
                                        <li class="list-group-item">Melalui sterilisasi UV dan ozonisasi</li>
                                        <li class="list-group-item">Uji mikrobiologi rutin oleh laboratorium independen</li>
                                        <li class="list-group-item">Kemasan food grade yang higienis</li>
                                    </ul>
                                    <p>Kami menjamin setiap tetes Air Amanah yang Anda konsumsi memenuhi standar air minum premium.</p>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 8 -->
                        <div class="card mb-2">
                            <div class="card-header" id="headingEight">
                                <h5 class="mb-0">
                                    <button class="btn btn-link text-dark collapsed" type="button" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                        <i class="fas fa-exclamation-triangle mr-2"></i> Prosedur Klaim untuk Pesanan Bermasalah
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#faqAccordion">
                                <div class="card-body">
                                    <p>Kepuasan pelanggan adalah prioritas kami. Jika terdapat ketidaksesuaian pesanan:</p>
                                    <ol>
                                        <li>Laporkan maksimal 2x24 jam setelah penerimaan</li>
                                        <li>Sertakan foto bukti yang jelas</li>
                                        <li>Hubungi CS kami via WhatsApp di 08157617119</li>
                                    </ol>
                                    <p>Kami akan memverifikasi dan memberikan solusi dalam 1x24 jam, baik berupa penggantian produk atau pengembalian dana.</p>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 9 -->
                        <div class="card mb-2">
                            <div class="card-header" id="headingNine">
                                <h5 class="mb-0">
                                    <button class="btn btn-link text-dark collapsed" type="button" data-toggle="collapse" data-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                                        <i class="fas fa-star mr-2"></i> Keunggulan Air Amanah Dibanding Produk Sejenis
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseNine" class="collapse" aria-labelledby="headingNine" data-parent="#faqAccordion">
                                <div class="card-body">
                                    <p>Air Amanah berdiri di atas diferensiasi unik:</p>
                                    <ul class="list-group list-group-flush mb-3">
                                        <li class="list-group-item"><strong>Sumber Air Terproteksi</strong>: Diambil dari mata air pegunungan terpilih</li>
                                        <li class="list-group-item"><strong>Proses Produksi Modern</strong>: Menggunakan teknologi Jerman terbaru</li>
                                        <li class="list-group-item"><strong>Rasa Alami</strong>: Mempertahankan mineral esensial dengan TDS optimal</li>
                                        <li class="list-group-item"><strong>Eco-Friendly</strong>: Kemasan ramah lingkungan dan program daur ulang</li>
                                        <li class="list-group-item"><strong>Layanan Premium</strong>: Dukungan pelanggan 24/7 dan pengiriman tepat waktu</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ... (previous FAQ items remain the same) ... -->

<div class="card mt-4">
    <div class="card-header" style="background-color:rgb(120, 207, 120); color: white;">
        <h5><i class="fas fa-map-marker-alt mr-2"></i> Lokasi Kami</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3960.347540580886!2d110.277722!3d-7.1058899999999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zN8KwMDYnMjEuMiJTIDExMMKwMTYnNDAuOSJF!5e0!3m2!1sen!2sid!4v1718024000000!5m2!1sen!2sid" 
                        width="100%" 
                        height="300" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="col-md-6">
                <h5><i class="fas fa-exclamation-circle"></i> Butuh Bantuan Lebih Lanjut?</h5>
                <p><i class="fas fa-phone mr-2"></i> Hotline: 08157617119</p>
                <p><i class="fab fa-whatsapp mr-2"></i> WhatsApp: 08157617119</p>
                <p><i class="fas fa-clock mr-2"></i> Jam Operasional: Senin-Minggu, 08.00-17.00 WIB</p>
                <p>Kami siap melayani anda dengan solusi hidrasi terbaik!</p>
            </div>
        </div>
    </div>
</div>

<!-- ... (rest of the file remains the same) ... -->
                </div>
            </div>
        </div>
    </div>
</section>

<?php
require_once '../layout/bottom.php';
?>