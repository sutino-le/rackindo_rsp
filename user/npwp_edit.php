<?php
include("koneksi.php");

$ktp_nomor = $_GET['ktp_nomor'];

$query_ktp = mysql_query("SELECT * FROM biodata_ktp WHERE ktp_nomor='$ktp_nomor' ");
$hasil_ktp = mysql_fetch_array($query_ktp);
$ktp_nama = $hasil_ktp['ktp_nama'];


//npwp
$npwp_cek = mysql_query("SELECT * FROM biodata_npwp WHERE npwp_ktp='$ktp_nomor'  ");
$v_npwp = mysql_fetch_array($npwp_cek);
$npwp_nomor = $v_npwp['npwp_nomor'];
$npwp_alamat = $v_npwp['npwp_alamat'];

$query_npwp = mysql_query("SELECT * FROM biodata_npwp WHERE npwp_ktp='$ktp_nomor' ");


?>


<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Edit NPWP</h3>
    </div>
    <form class="form-horizontal" action="home_admin.php?page=npwp_edit_process" method="post">

        <div class=" card-body">

            <div class="form-group row m-2">
                <label class="control-label col-sm-2" for="npwp_ktp">Nomor KTP </label>
                <div class="col-sm-4">
                    <input type="hidden" name="npwp_ktp" value="<?php echo $ktp_nomor; ?>" required>

                    <input type="text" class="form-control" id="npwp_ktp" maxlength="16" minlength="16"
                        onkeypress="return hanyaAngka(event)" placeholder="Masukan ID card number"
                        value="<?php echo $ktp_nomor; ?>" name="npwp_ktp" disabled>
                </div>
                <label class="control-label col-sm-2" for="ktp_nama">Nama Lengkap </label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="ktp_nama" placeholder="Masukan Fullname"
                        value="<?php echo $ktp_nama; ?>" name="ktp_nama" disabled>
                </div>
            </div>

            <div class="form-group row m-2">
                <label class="control-label col-sm-2" for="npwp_nomor">Nomor NPWP </label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="npwp_nomor" maxlength="15" minlength="15"
                        onkeypress="return hanyaAngka(event)" placeholder="Masukan Nomor NPWP" name="npwp_nomor"
                        value="<?php echo $npwp_nomor; ?>" required>
                </div>
            </div>

            <div class="form-group row m-2">
                <label class="control-label col-sm-2" for="npwp_alamat">Alamat NPWP </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="npwp_alamat" placeholder="Masukan Alamat NPWP"
                        name="npwp_alamat" value="<?php echo $npwp_alamat; ?>" required>
                </div>
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-info btn-sm">Simpan</button>
            <a href="home_admin.php?page=experience_edit&ktp_nomor=<?php echo $ktp_nomor; ?>"><button type="button"
                    class="btn btn-secondary btn-sm">Sebelumnya</button></a>
            <a href="home_admin.php?page=user_edit&ktp_nomor=<?php echo $ktp_nomor; ?>"><button type="button"
                    class="btn btn-secondary btn-sm">Selanjutnya</button></a>
        </div>

    </form>

</div>




<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Nomor KTP</th>
                <th>Nama Lengkap</th>
                <th>NPWP</th>
                <th>Alamat NPWP</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $nomor_npwp = 1;
            while ($hasil_npwp = mysql_fetch_array($query_npwp)) {
                $npwp = $hasil_npwp['npwp_nomor'];
            ?>
            <tr>
                <td><?php echo $ktp_nomor; ?></td>
                <td><?php echo $ktp_nama; ?></td>
                <td>
                    <?php echo substr($npwp, 0, 2) . "." . substr($npwp, 2, 3) . "." . substr($npwp, 5, 3) . "." . substr($npwp, 8, 1) . "-" . substr($npwp, 9, 3) . "." . substr($npwp, 12, 3); ?>
                </td>
                <td><?php echo $hasil_npwp['npwp_alamat']; ?></td>
            </tr>
            <?php
                $nomor_npwp++;
            }
            ?>
        </tbody>
    </table>
</div>

</body>

</html>