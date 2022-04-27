<?php
include("koneksi.php");

$ktp_nomor = $_GET['ktp_nomor'];

$query_ktp = mysql_query("SELECT * FROM biodata_ktp WHERE ktp_nomor='$ktp_nomor' ");
$hasil_ktp = mysql_fetch_array($query_ktp);
$ktp_nama = $hasil_ktp['ktp_nama'];

$query_darurat = mysql_query("SELECT * FROM biodata_darurat WHERE darurat_ktp='$ktp_nomor' ORDER BY darurat_id ASC ");

//tombol next
$tombol_darurat = mysql_query("SELECT * FROM biodata_darurat WHERE darurat_ktp='$ktp_nomor' ");
$v_tombol_darurat = mysql_fetch_array($tombol_darurat);
if (empty($v_tombol_darurat)) {
    $tombol_next = "Disabled";
} else {
    $tombol_next = "";
}


?>


<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Emergency Edit</h3>
    </div>
    <form class="form-horizontal" action="home_admin.php?page=emergency_edit_process" method="post">

        <div class=" card-body">

            <div class="form-group row">
                <label class="control-label col-sm-2" for="darurat_ktp">ID card number </label>
                <div class="col-sm-4">
                    <input type="hidden" name="darurat_ktp" value="<?php echo $ktp_nomor; ?>" required>

                    <input type="text" class="form-control" id="darurat_ktp" maxlength="16" minlength="16"
                        onkeypress="return hanyaAngka(event)" placeholder="Enter ID card number"
                        value="<?php echo $ktp_nomor; ?>" name="darurat_ktp" disabled>
                </div>
                <label class="control-label col-sm-2" for="ktp_nama">Full Name </label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="ktp_nama" placeholder="Enter Fullname"
                        value="<?php echo $ktp_nama; ?>" name="ktp_nama" disabled>
                </div>
            </div>

            <div class="form-group row">
                <label class="control-label col-sm-2" for="darurat_hubungan">Emergency Relationship </label>
                <div class="col-sm-4">
                    <select class="form-control" name="darurat_hubungan" required>
                        <option value="">Select Relationship</option>
                        <option value=""></option>
                        <option value="Ayah Kandung">Ayah Kandung</option>
                        <option value="Ayah Tiri">Ayah Tiri</option>
                        <option value="Ibu Kandung">Ibu Kandung</option>
                        <option value="Ibu Tiri">Ibu Tiri</option>
                        <option value="Paman">Paman</option>
                        <option value="Tante">Tante</option>
                        <option value="Saudara Kandung">Saudara Kandung</option>
                        <option value="Saudara">Saudara</option>
                        <option value="Teman">Teman</option>
                        <option value="lainnya">lainnya</option>
                    </select>
                </div>
                <label class="control-label col-sm-2" for="darurat_nama">Full Name </label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="darurat_nama" placeholder="Enter Fullname"
                        name="darurat_nama" required>
                </div>
            </div>

            <div class="form-group row">
                <label class="control-label col-sm-2" for="darurat_alamat">Address</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="darurat_alamat" placeholder="Enter Address"
                        name="darurat_alamat" required>
                </div>
            </div>

            <div class="form-group row">
                <label class="control-label col-sm-2" for="darurat_hp">Phone Number</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="darurat_hp" placeholder="Enter +628xxxxx"
                        name="darurat_hp" required>
                </div>
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-info btn-sm">Submit</button>
            <a href="home_admin.php?page=family_edit&ktp_nomor=<?php echo $ktp_nomor; ?>"><button type="button"
                    class="btn btn-secondary btn-sm">Previous</button></a>
            <a href="home_admin.php?page=experience_edit&ktp_nomor=<?php echo $ktp_nomor; ?>"><button type="button"
                    class="btn btn-secondary btn-sm" <?php echo $tombol_next; ?>>Next</button></a>
        </div>

    </form>

</div>




<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Relationship</th>
                <th>Fullname</th>
                <th>Address</th>
                <th>Contact</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $nomor_darurat = 1;
            while ($hasil_darurat = mysql_fetch_array($query_darurat)) {
            ?> <tr>
                <td><?php echo $nomor_darurat; ?></td>
                <td><?php echo $hasil_darurat['darurat_hubungan']; ?></td>
                <td><?php echo $hasil_darurat['darurat_nama']; ?></td>
                <td><?php echo $hasil_darurat['darurat_alamat']; ?></td>
                <td><?php echo $hasil_darurat['darurat_hp']; ?></td>
            </tr>
            <?php
                $nomor_darurat++;
            }
            ?>
        </tbody>
    </table>
</div>

</body>

</html>