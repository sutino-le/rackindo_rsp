<?php
include("koneksi.php");

$ktp_nomor = $_GET['ktp_nomor'];

$query_ktp = mysql_query("SELECT * FROM biodata_ktp WHERE ktp_nomor='$ktp_nomor' ");
$hasil_ktp = mysql_fetch_array($query_ktp);
$ktp_nama = $hasil_ktp['ktp_nama'];

$query_keluarga = mysql_query("SELECT * FROM biodata_keluarga JOIN keluarga_silsilah ON biodata_keluarga.keluarga_jenis=keluarga_silsilah.silsilah_id WHERE biodata_keluarga.keluarga_ktp='$ktp_nomor' ORDER BY biodata_keluarga.keluarga_jenis, biodata_keluarga.keluarga_lahir ASC ");


//tombol next
$tombol_keluarga = mysql_query("SELECT * FROM biodata_keluarga WHERE keluarga_ktp='$ktp_nomor' ");
$v_tombol_keluarga = mysql_fetch_array($tombol_keluarga);

$keluarga_nomor = $v_tombol_keluarga['keluarga_nomor'];

if (empty($v_tombol_keluarga)) {
    $tombol_next = "Disabled";
    $link_next = "disabled-link";
} else {
    $tombol_next = "";
    $link_next = "";
}
?>


<div class="card card-info">
    <div class="card-header">
        <h4 class="card-title">Data Kartu Keluarga</h4>
        <p>
            <font color="red">* Lengkapi data Keluarga sesuai dengan Kartu Keluarga yang sudah update di Dukcapil. <br>
                Termasuk Ayah & Ibu kandung/yang dianggap sebagai orang tua.
            </font>
        </p>
    </div>
    <form class="form-horizontal" action="home_admin.php?page=family_edit_process" method="post">

        <div class=" card-body">

            <div class="form-group row m-2">
                <label class="control-label col-sm-2" for="keluarga_ktp">Nomor KTP </label>
                <div class="col-sm-4">
                    <input type="hidden" name="keluarga_ktp" value="<?php echo $ktp_nomor; ?>" required>

                    <input type="text" class="form-control" id="keluarga_ktp" maxlength="16" minlength="16"
                        onkeypress="return hanyaAngka(event)" placeholder="Masukan Nomor KTP"
                        value="<?php echo $ktp_nomor; ?>" name="keluarga_ktp" disabled>
                </div>
                <label class="control-label col-sm-2" for="ktp_nama">Nama Lengkap </label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="ktp_nama" placeholder="Masukan Nama Lengkap"
                        value="<?php echo $ktp_nama; ?>" name="ktp_nama" disabled>
                </div>
            </div>

            <div class="form-group row m-2">
                <label class="control-label col-sm-2" for="keluarga_jenis">Hubungan</label>
                <div class="col-sm-4">
                    <select class="form-control" name="keluarga_jenis" required>
                        <option value="">Pilih Hubungan</option>
                        <option value=""></option>
                        <?php
                        $keluarga_silsilah = mysql_query("SELECT * FROM keluarga_silsilah ORDER BY silsilah_id ASC");
                        while ($v_keluarga_silsilah = mysql_fetch_array($keluarga_silsilah)) {
                        ?>
                        <option value="<?php echo $v_keluarga_silsilah['silsilah_id']; ?>">
                            <?php echo $v_keluarga_silsilah['silsilah_nama']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <label class="control-label col-sm-2" for="keluarga_nama">Nama Lengkap</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="keluarga_nama" placeholder="Masukan Nama Lengkap"
                        name="keluarga_nama" required>
                </div>
            </div>

            <div class="form-group row m-2">
                <label class="control-label col-sm-2" for="keluarga_lahir">Tanggal Lahir</label>
                <div class="col-sm-4">
                    <input type="date" class="form-control" id="keluarga_lahir" name="keluarga_lahir" required>
                </div>
                <label class="control-label col-sm-2" for="keluarga_kelamin">Jenis Kelamin </label>
                <div class="col-sm-4">
                    <select class="form-control" name="keluarga_kelamin" id="keluarga_kelamin" required>
                        <option value="" selected>Pilih Jenis Kelamin</option>
                        <option></option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
            </div>

            <div class="form-group row m-2">
                <label class="control-label col-sm-2" for="keluarga_alamat">Alamat Lengkap</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="keluarga_alamat" placeholder="Masukan Alamat Lengkap"
                        name="keluarga_alamat" required>
                </div>
            </div>

            <div class="form-group row m-2">
                <label class="control-label col-sm-2" for="keluarga_hp">Nomor HP</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="keluarga_hp" placeholder="Masukan +628xxxxx"
                        name="keluarga_hp" required>
                </div>
                <label class="control-label col-sm-2" for="keluarga_nomor">Nomor KK</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="keluarga_nomor" maxlength="16" minlength="16"
                        onkeypress="return hanyaAngka(event)" placeholder="Masukan Nomor Kartu Keluarga"
                        value="<?php echo $keluarga_nomor; ?>" name="keluarga_nomor" required>
                </div>
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-info btn-sm">Simpan</button>
            <a href="home_admin.php?page=education_edit&ktp_nomor=<?php echo $ktp_nomor; ?>"><button type="button"
                    class="btn btn-secondary btn-sm"><i class="fas fa-backward"></i>
                    Sebelumnya</button></a>
            <a href="home_admin.php?page=emergency_edit&ktp_nomor=<?php echo $ktp_nomor; ?>"
                class="<?php echo $link_next; ?>"><button type="button" class="btn btn-secondary btn-sm"
                    <?php echo $tombol_next; ?>>Selanjutnya <i class="fas fa-forward"></i></button></a>
        </div>

    </form>

</div>




<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Hubungan</th>
                <th>Nama Lengkap</th>
                <th>Tanggal Lahir</th>
                <th>Jenis<br>Kelamin</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $nomor_keluarga = 1;
            while ($hasil_keluarga = mysql_fetch_array($query_keluarga)) {
            ?>
            <tr>
                <td><?php echo $nomor_keluarga; ?></td>
                <td><?php echo $hasil_keluarga['silsilah_nama']; ?></td>
                <td><?php echo $hasil_keluarga['keluarga_nama']; ?></td>
                <td><?php echo $hasil_keluarga['keluarga_lahir']; ?></td>
                <td><?php echo $hasil_keluarga['keluarga_kelamin']; ?></td>
                <td><?php echo $hasil_keluarga['keluarga_alamat']; ?>. <?php echo $hasil_keluarga['keluarga_hp']; ?>
                </td>
                <td>
                    <a
                        href="home_admin.php?page=family_edit_rubah&keluarga_id=<?php echo $hasil_keluarga['keluarga_id']; ?>"><button
                            type="button" class="btn btn-success btn-sm"><i class="far fa-edit"></i></button></a>
                    <a
                        href="home_admin.php?page=family_edit_delete&keluarga_id=<?php echo $hasil_keluarga['keluarga_id']; ?>"><button
                            type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button></a>
                </td>
            </tr>
            <?php
                $nomor_keluarga++;
            }
            ?>
        </tbody>
    </table>
</div>

</body>

</html>