<?php
include("koneksi.php");

$ktp_nomor = $_GET['ktp_nomor'];

$query_ktp = mysql_query("SELECT * FROM biodata_ktp WHERE ktp_nomor='$ktp_nomor' ");
$hasil_ktp = mysql_fetch_array($query_ktp);
$ktp_nama = $hasil_ktp['ktp_nama'];

$query_keluarga = mysql_query("SELECT * FROM biodata_keluarga JOIN keluarga_silsilah ON biodata_keluarga.keluarga_jenis=keluarga_silsilah.silsilah_id WHERE biodata_keluarga.keluarga_ktp='$ktp_nomor' ORDER BY biodata_keluarga.keluarga_jenis, biodata_keluarga.keluarga_lahir ASC ");


//tombol next
$tombol_keluarga = mysql_query("SELECT * FROM biodata_keluarga WHERE keluarga_ktp='$ktp_nomor' ORDER BY keluarga_id DESC ");
$v_tombol_keluarga = mysql_fetch_array($tombol_keluarga);

$keluarga_nomor = $v_tombol_keluarga['keluarga_nomor'];

if (empty($v_tombol_keluarga)) {
    $tombol_next = "Disabled";
} else {
    $tombol_next = "";
}
?>


<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Family Edit</h3>
    </div>
    <form class="form-horizontal" action="home_admin.php?page=family_edit_process" method="post">

        <div class=" card-body">

            <div class="form-group row">
                <label class="control-label col-sm-2" for="keluarga_ktp">ID card number </label>
                <div class="col-sm-4">
                    <input type="hidden" name="keluarga_ktp" value="<?php echo $ktp_nomor; ?>" required>

                    <input type="text" class="form-control" id="keluarga_ktp" maxlength="16" minlength="16"
                        onkeypress="return hanyaAngka(event)" placeholder="Enter ID card number"
                        value="<?php echo $ktp_nomor; ?>" name="keluarga_ktp" disabled>
                </div>
                <label class="control-label col-sm-2" for="ktp_nama">Full Name </label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="ktp_nama" placeholder="Enter Fullname"
                        value="<?php echo $ktp_nama; ?>" name="ktp_nama" disabled>
                </div>
            </div>

            <div class="form-group row">
                <label class="control-label col-sm-2" for="keluarga_jenis">Faamily Type </label>
                <div class="col-sm-4">
                    <select class="form-control" name="keluarga_jenis" required>
                        <option value="">Select Type</option>
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
                <label class="control-label col-sm-2" for="keluarga_nama">Full Name </label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="keluarga_nama" placeholder="Enter Fullname"
                        name="keluarga_nama" required>
                </div>
            </div>

            <div class="form-group row">
                <label class="control-label col-sm-2" for="keluarga_lahir">Date of Birth </label>
                <div class="col-sm-4">
                    <input type="date" class="form-control" id="keluarga_lahir" name="keluarga_lahir" required>
                </div>
                <label class="control-label col-sm-2" for="keluarga_kelamin">Gender </label>
                <div class="col-sm-4">
                    <select class="form-control" name="keluarga_kelamin" id="keluarga_kelamin" required>
                        <option value="" selected>Select Gender</option>
                        <option></option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="control-label col-sm-2" for="keluarga_alamat">Address</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="keluarga_alamat" placeholder="Enter Address"
                        name="keluarga_alamat" required>
                </div>
            </div>

            <div class="form-group row">
                <label class="control-label col-sm-2" for="keluarga_hp">Phone Number</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="keluarga_hp" placeholder="Enter +628xxxxx"
                        name="keluarga_hp" required>
                </div>
                <label class="control-label col-sm-2" for="keluarga_nomor">Family Card Number</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="keluarga_nomor" maxlength="16" minlength="16"
                        onkeypress="return hanyaAngka(event)" placeholder="Enter Family Card Number"
                        value="<?php echo $keluarga_nomor; ?>" name="keluarga_nomor" required>
                </div>
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-info btn-sm">Submit</button>
            <a href="home_admin.php?page=education_edit&ktp_nomor=<?php echo $ktp_nomor; ?>"><button type="button"
                    class="btn btn-secondary btn-sm">Previous</button></a>
            <a href="home_admin.php?page=emergency_edit&ktp_nomor=<?php echo $ktp_nomor; ?>"><button type="button"
                    class="btn btn-secondary btn-sm" <?php echo $tombol_next; ?>>Next</button></a>
        </div>

    </form>

</div>




<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Type</th>
                <th>Name</th>
                <th>Date Of Birth</th>
                <th>Gender</th>
                <th>Address</th>
                <th>Number</th>
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
                <td><?php echo $hasil_keluarga['keluarga_alamat'] . " " . $hasil_keluarga['keluarga_hp']; ?></td>
                <td><?php echo $hasil_keluarga['keluarga_nomor']; ?></td>
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