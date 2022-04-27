<?php
include("koneksi.php");

$ktp_nomor = $_GET['ktp_nomor'];

$query_ktp = mysql_query("SELECT * FROM biodata_ktp WHERE ktp_nomor='$ktp_nomor' ");
$hasil_ktp = mysql_fetch_array($query_ktp);
$ktp_nama = $hasil_ktp['ktp_nama'];

$query_pengalaman = mysql_query("SELECT * FROM biodata_pengalaman WHERE pengalaman_ktp='$ktp_nomor' ORDER BY pengalaman_awal DESC ");


?>


<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Experience Edit</h3>
    </div>
    <form class="form-horizontal" action="home_admin.php?page=experience_edit_process" method="post">

        <div class=" card-body">

            <div class="form-group row">
                <label class="control-label col-sm-2" for="pengalaman_ktp">ID card number </label>
                <div class="col-sm-4">
                    <input type="hidden" name="pengalaman_ktp" value="<?php echo $ktp_nomor; ?>" required>

                    <input type="text" class="form-control" id="pengalaman_ktp" maxlength="16" minlength="16"
                        onkeypress="return hanyaAngka(event)" placeholder="Enter ID card number"
                        value="<?php echo $ktp_nomor; ?>" name="pengalaman_ktp" disabled>
                </div>
                <label class="control-label col-sm-2" for="ktp_nama">Full Name </label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="ktp_nama" placeholder="Enter Fullname"
                        value="<?php echo $ktp_nama; ?>" name="ktp_nama" disabled>
                </div>
            </div>

            <div class="form-group row">
                <label class="control-label col-sm-2" for="pengalaman_awal">Experience Start </label>
                <div class="col-sm-4">
                    <input type="date" class="form-control" id="pengalaman_awal" name="pengalaman_awal" required>
                </div>
                <label class="control-label col-sm-2" for="pengalaman_akhir">Experience End </label>
                <div class="col-sm-2">
                    <input type="date" class="form-control" id="pengalaman_akhir" name="pengalaman_akhir" required>
                </div>
                <div class="col-sm-2">
                    <select class="form-control" name="pengalaman_status" id="pengalaman_status" required>
                        <option value="">Status</option>
                        <option value=""></option>
                        <option value="Tidak Aktif">Tidak Aktif</option>
                        <option value="Masih Bekerja">Masih Bekerja</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="control-label col-sm-2" for="pengalaman_perusahaan">Company </label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="pengalaman_perusahaan" placeholder="Enter Company"
                        name="pengalaman_perusahaan" required>
                </div>
                <label class="control-label col-sm-2" for="pengalaman_bagian">Job Title </label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="pengalaman_bagian" placeholder="Enter Job Title"
                        name="pengalaman_bagian" required>
                </div>
            </div>

            <div class="form-group row">
                <label class="control-label col-sm-2" for="pengalaman_deskripsi">Work Deskription </label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="pengalaman_deskripsi" id="pengalaman_deskripsi"></textarea>
                </div>
            </div>

            <div class="form-group row">
                <label class="control-label col-sm-2" for="pengalaman_keluar">Reason to Leave </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="pengalaman_keluar" placeholder="Enter Reason to Leave"
                        name="pengalaman_keluar" required>
                </div>
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-info btn-sm">Submit</button>
            <a href="home_admin.php?page=emergency_edit&ktp_nomor=<?php echo $ktp_nomor; ?>"><button type="button"
                    class="btn btn-secondary btn-sm">Previous</button></a>
            <a href="home_admin.php?page=npwp_edit&ktp_nomor=<?php echo $ktp_nomor; ?>"><button type="button"
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
                <th>Duration</th>
                <th>Company</th>
                <th>Job Title</th>
                <th>Reason to Leave</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $nomor_pengalaman = 1;
            while ($hasil_pengalaman = mysql_fetch_array($query_pengalaman)) {
            ?>
            <tr>
                <td><?php echo $ktp_nomor; ?></td>
                <td><?php echo $ktp_nama; ?></td>
                <td>
                    <?php echo date("d M Y", strtotime($hasil_pengalaman['pengalaman_awal'])) . " - " . date("d M Y", strtotime($hasil_pengalaman['pengalaman_akhir'])); ?>
                </td>
                <td><?php echo $hasil_pengalaman['pengalaman_perusahaan']; ?></td>
                <td><?php echo $hasil_pengalaman['pengalaman_bagian']; ?></td>
                <td><?php echo $hasil_pengalaman['pengalaman_keluar']; ?></td>
            </tr>
            <?php
                $nomor_pengalaman++;
            }
            ?>
        </tbody>
    </table>
</div>

</body>

</html>