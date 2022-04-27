<?php
include("koneksi.php");

$ktp_nomor = $_GET['ktp_nomor'];

$query_ktp = mysql_query("SELECT * FROM biodata_ktp WHERE ktp_nomor='$ktp_nomor' ");
$hasil_ktp = mysql_fetch_array($query_ktp);
$ktp_nama = $hasil_ktp['ktp_nama'];

$query_pendidikan = mysql_query("SELECT * FROM pendidikan WHERE pendidikan_ktp='$ktp_nomor' ORDER BY pendidikan_awal DESC ");

//tombol next
$tombol_pendidikan = mysql_query("SELECT * FROM pendidikan WHERE pendidikan_ktp='$ktp_nomor' ");
$v_tombol_pendidikan = mysql_fetch_array($tombol_pendidikan);
if (empty($v_tombol_pendidikan)) {
    $tombol_next = "Disabled";
} else {
    $tombol_next = "";
}
?>


<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Education Edit</h3>
    </div>
    <form class="form-horizontal" action="home_admin.php?page=education_edit_process" method="post">

        <div class=" card-body">

            <div class="form-group row">
                <label class="control-label col-sm-2" for="pendidikan_ktp">ID card number </label>
                <div class="col-sm-4">
                    <input type="hidden" name="pendidikan_ktp" value="<?php echo $ktp_nomor; ?>" required>

                    <input type="text" class="form-control" id="pendidikan_ktp" maxlength="16" minlength="16"
                        onkeypress="return hanyaAngka(event)" placeholder="Enter ID card number"
                        value="<?php echo $ktp_nomor; ?>" name="pendidikan_ktp" disabled>
                </div>
                <label class="control-label col-sm-2" for="ktp_nama">Full Name </label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="ktp_nama" placeholder="Enter Fullname"
                        value="<?php echo $ktp_nama; ?>" name="ktp_nama" disabled>
                </div>
            </div>

            <div class="form-group row">
                <label class="control-label col-sm-2" for="pendidikan_awal">Education Start </label>
                <div class="col-sm-4">
                    <select class="form-control" name="pendidikan_awal" required>
                        <option value="">Select Year</option>
                        <option value=""></option>
                        <?php
                        for ($start = date('Y'); $start >= date('Y') - 70; $start -= 1) {
                            echo "<option value='$start'> $start </option>";
                        }
                        ?>
                    </select>
                </div>
                <label class="control-label col-sm-2" for="pendidikan_akhir">Education End </label>
                <div class="col-sm-4">
                    <select class="form-control" name="pendidikan_akhir" required>
                        <option value="">Select Year</option>
                        <option value=""></option>
                        <?php
                        for ($end = date('Y'); $end >= date('Y') - 70; $end -= 1) {
                            echo "<option value='$end'> $end </option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="control-label col-sm-2" for="pendidikan_tingkatan">Education Level </label>
                <div class="col-sm-4">
                    <select class="form-control" name="pendidikan_tingkatan" required>
                        <option value="">Select Level</option>
                        <option value=""></option>
                        <option value="SD">SD</option>
                        <option value="SMP">SMP</option>
                        <option value="MTS">MTS</option>
                        <option value="SMA">SMA</option>
                        <option value="SMK">SMK</option>
                        <option value="MA">MA</option>
                        <option value="D1">D1</option>
                        <option value="D2">D2</option>
                        <option value="D3">D3</option>
                        <option value="D4">D4</option>
                        <option value="S1">S1</option>
                        <option value="S2">S2</option>
                        <option value="S3">S3</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="control-label col-sm-2" for="pendidikan_nama">Education Name </label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="pendidikan_nama" placeholder="Enter Education name"
                        name="pendidikan_nama" required>
                </div>
                <label class="control-label col-sm-2" for="pendidikan_jurusan">Major </label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="pendidikan_jurusan" placeholder="Enter Major"
                        name="pendidikan_jurusan" required>
                </div>
            </div>

            <div class="form-group row">
                <label class="control-label col-sm-2" for="pendidikan_nilai">IPK / Value </label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="pendidikan_nilai" placeholder="Enter IPK / Value"
                        value="0.00" name="pendidikan_nilai" required>
                </div>
                <label class="control-label col-sm-2" for="pendidikan_kota">City </label>
                <div class="col-sm-4">
                    <select name="pendidikan_kota" class="form-control" required>
                        <option value="">Select City</option>
                        <option value=""></option>
                        <?php
                        $kota = mysql_query("SELECT *  FROM data_wilayah GROUP BY kota_kabupaten ASC");
                        while ($v_kota = mysql_fetch_array($kota)) {
                        ?>
                        <option value="<?php echo $v_kota['kota_kabupaten']; ?>">
                            <?php echo $v_kota['kota_kabupaten']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-info btn-sm">Submit</button>
            <a href="home_admin.php?page=residence_address_edit&ktp_nomor=<?php echo $ktp_nomor; ?>"><button
                    type="button" class="btn btn-secondary btn-sm">Previous</button></a>
            <a href="home_admin.php?page=family_edit&ktp_nomor=<?php echo $ktp_nomor; ?>"><button type="button"
                    class="btn btn-secondary btn-sm" <?php echo $tombol_next; ?>>Next</button></a>
        </div>

    </form>

</div>




<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>ID card</th>
                <th>Name</th>
                <th>Duration</th>
                <th>Level</th>
                <th>Education Name</th>
                <th>Major</th>
                <th>City</th>
                <th>IPK / Value</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $nomor_pendidikan = 1;
            while ($hasil_pendidikan = mysql_fetch_array($query_pendidikan)) {
            ?>
            <tr>
                <td><?php echo $ktp_nomor; ?></td>
                <td><?php echo $ktp_nama; ?></td>
                <td><?php echo $hasil_pendidikan['pendidikan_awal'] . " - " . $hasil_pendidikan['pendidikan_akhir']; ?>
                </td>
                <td><?php echo $hasil_pendidikan['pendidikan_tingkatan']; ?></td>
                <td><?php echo $hasil_pendidikan['pendidikan_nama']; ?></td>
                <td><?php echo $hasil_pendidikan['pendidikan_jurusan']; ?></td>
                <td><?php echo $hasil_pendidikan['pendidikan_kota']; ?></td>
                <td><?php echo $hasil_pendidikan['pendidikan_nilai']; ?></td>
            </tr>
            <?php
                $nomor_pendidikan++;
            }
            ?>
        </tbody>
    </table>
</div>

</body>

</html>