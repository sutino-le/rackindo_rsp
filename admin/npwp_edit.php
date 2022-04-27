<?php
include("koneksi.php");

$ktp_nomor = $_GET['ktp_nomor'];

$query_ktp = mysql_query("SELECT * FROM biodata_ktp WHERE ktp_nomor='$ktp_nomor' ");
$hasil_ktp = mysql_fetch_array($query_ktp);
$ktp_nama = $hasil_ktp['ktp_nama'];

$query_npwp = mysql_query("SELECT * FROM biodata_npwp WHERE npwp_ktp='$ktp_nomor' ");


?>


<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">NPWP Edit</h3>
    </div>
    <form class="form-horizontal" action="home_admin.php?page=npwp_edit_process" method="post">

        <div class=" card-body">

            <div class="form-group row">
                <label class="control-label col-sm-2" for="npwp_ktp">ID card number </label>
                <div class="col-sm-4">
                    <input type="hidden" name="npwp_ktp" value="<?php echo $ktp_nomor; ?>" required>

                    <input type="text" class="form-control" id="npwp_ktp" maxlength="16" minlength="16"
                        onkeypress="return hanyaAngka(event)" placeholder="Enter ID card number"
                        value="<?php echo $ktp_nomor; ?>" name="npwp_ktp" disabled>
                </div>
                <label class="control-label col-sm-2" for="ktp_nama">Full Name </label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="ktp_nama" placeholder="Enter Fullname"
                        value="<?php echo $ktp_nama; ?>" name="ktp_nama" disabled>
                </div>
            </div>

            <div class="form-group row">
                <label class="control-label col-sm-2" for="npwp_nomor">NPWP Number </label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="npwp_nomor" maxlength="15" minlength="15"
                        onkeypress="return hanyaAngka(event)" placeholder="Enter NPWP Number" name="npwp_nomor"
                        required>
                </div>
            </div>

            <div class="form-group row">
                <label class="control-label col-sm-2" for="npwp_alamat">Address </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="npwp_alamat" placeholder="Enter Address"
                        name="npwp_alamat" required>
                </div>
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-info btn-sm">Submit</button>
            <a href="home_admin.php?page=experience_edit&ktp_nomor=<?php echo $ktp_nomor; ?>"><button type="button"
                    class="btn btn-secondary btn-sm">Previous</button></a>
            <a href="home_admin.php?page=user_edit&ktp_nomor=<?php echo $ktp_nomor; ?>"><button type="button"
                    class="btn btn-secondary btn-sm">Next</button></a>
        </div>

    </form>

</div>




<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>ID card</th>
                <th>Name</th>
                <th>NPWP</th>
                <th>Address</th>
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