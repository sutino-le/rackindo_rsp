<div class="page-title">
    <div class="title_left">
        <h5>Page : <?php echo $page; ?></h5>
    </div>

    <div class="title_right">
        <div class="col-md-5 col-sm-5  form-group pull-right top_search">
            <form class="form" action="home_admin.php?page=item_view" method="POST">
                <div class="input-group">
                    <input type="text" name="barang_nama" class="form-control" placeholder="Cari nama Barang">
                    <span class="input-group-btn">
                        <button class="btn btn-secondary" type="submit">Go!</button>
                    </span>
                </div>
            </form>
        </div>
    </div>

</div>

<div class="clearfix"></div>

<?php
if ($_POST['barang_nama']) {
    $barang_nama = $_POST['barang_nama'];
} else {
    $barang_nama = "";
}




$barang = mysql_query("SELECT * FROM tb_barang WHERE barang_nama LIKE '%$barang_nama%' OR  barang_detail LIKE '%$barang_nama%' ORDER BY barang_nama ASC");
while ($hasil_barang = mysql_fetch_array($barang)) {
    $barang_id = $hasil_barang['barang_id'];
    $barang_nama = $hasil_barang['barang_nama'];
    $barang_barcode = $hasil_barang['barang_barcode'];
    $barang_harga = $hasil_barang['barang_harga'];
    $barang_satuan = $hasil_barang['barang_satuan'];
    $barang_detail = $hasil_barang['barang_detail'];
    $barang_foto = $hasil_barang['barang_foto']; {

        $barang_masuk = mysql_query("SELECT SUM(masuk_jumlah) AS jumlah_masuk FROM tb_masuk WHERE masuk_idbarang='$barang_id' ");
        $data_masuk = mysql_fetch_array($barang_masuk);
        $masuk = $data_masuk['jumlah_masuk'];

        $barang_keluar = mysql_query("SELECT SUM(keluar_jumlah) AS jumlah_keluar FROM tb_keluar WHERE keluar_idbarang='$barang_id' AND keluar_status='Selesai' ");
        $data_keluar = mysql_fetch_array($barang_keluar);
        $keluar = $data_keluar['jumlah_keluar'];

        $stok = $masuk - $keluar;

?>



<div class="col-xl-3 col-md-4 mt-4">
    <div class="card mb-3">
        <div class="card-body text-center">
            <img src="../admin/gambar/<?php echo $barang_foto; ?>" width="80" height="200" class="card-img-top"
                alt="<?php echo $barang_foto; ?>">
        </div>
        <div class="card-footer align-items-center">
            <p>
                <?php echo $barang_nama; ?><br>
                Stock : <?php echo $stok; ?>
                <?php
                        if ($stok <= 0) {
                            $tombol = "";
                        } else {
                        ?>
                <a href="home_admin.php?page=item_use_input&id=<?php echo $barang_id; ?>"><button type="button"
                        class="btn btn-danger" title="Pemakaian"><i class="fas fa-sign-in-alt"></i></button></a>
                <?php
                        }
                        ?>

            </p>

        </div>
    </div>
</div>
<?php
    }
}
?>