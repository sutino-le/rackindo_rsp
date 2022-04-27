<style>
.modal-content {
    position: relative;
    background-image: url("images/as.JPG");
    -webkit-box-shadow: 0 3px 9px rgba(0, 0, 0, .5);
    box-shadow: 0 3px 9px rgba(0, 0, 0, .5);

}

.modal-header {
    background: rgba(2, 2, 2, 0.5);
}

.modal-title {
    color: white;
}

.modal-footer {
    background: rgba(2, 2, 2, 0.5);
}

.table-striped>tbody>tr:nth-of-type(odd) {
    background-color: #9BDDD7;
}

.table-hover>tbody>tr:hover {
    background-color: #9BDDD7;
}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="container-fluid">
    <button onclick="document.getElementById('001').style.display='block'" type="button" title="Add Career"
        class="btn btn-info btn-sm"><i class='fas fa-plus'></i></button>Add Overtime
</div>




<div class="container-fluid">
    <br>
    <table id="overtime_data" class="table table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>NO.</th>
                <th>Pin</th>
                <th>Full Name</th>
                <th>Departement</th>
                <th>Date</th>
                <th>Over Type</th>
                <th>Number of Hours</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>

    <div class="modal fade" id="info" role="dialog">
        <div class="modal-dialog modal-lg">
            <div id="content-data-info"></div>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        $('#overtime_data').DataTable({
            "order": [1, "asc"],
            "processing": true,
            "serverSide": true,
            "lengthMenu": [
                [10, 25, 50, 100, 200],
                [10, 25, 50, 100, 200]
            ],
            "ajax": {
                url: "overtime_data.php",
                type: "post"
            }

        });
    });
    </script>

</div>
<?php
$cek_lembur = mysql_query("SELECT * FROM upah_lembur ORDER BY lembur_id DESC");
$v_lembur = mysql_fetch_array($cek_lembur);
$tahun_sekarang = date("Y");
$terakhir_lembur = $v_lembur['lembur_tanggal'];
if ($tahun_sekarang == date("Y", strtotime($terakhir_lembur))) {
    $nomor_lembur = $v_lembur['lembur_nomor'] + 1;
} else {
    $nomor_lembur = 1;
}



$query_karyawan = mysql_query("SELECT * FROM karyawan JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor JOIN bagian ON karyawan.karyawan_bagian=bagian.bagian_id ORDER BY biodata_ktp.ktp_nama ASC ");
?>


<div id="001" class="w3-modal small">
    <div class="w3-modal-content w3-animate-top w3-card-4">
        <header class="w3-container w3-teal">
            <span onclick="document.getElementById('001').style.display='none'"
                class="w3-button w3-display-topright">&times;</span>
            <h3>Add Overtime - <?php echo $nomor_lembur; ?></h3>
        </header>
        <form action="home_admin.php?page=overtime_input" method="POST">
            <input type="hidden" name="lembur_nomor" id="lembur_nomor" value="<?php echo $nomor_lembur; ?>">

            <div class="w3-container">
                <br>
                <div class="form-group">
                    Select Employee
                    <select class="form-control" name="lembur_ktp" id="lembur_ktp" required>
                        <option value="" selected>Select Employee</option>
                        <option></option>
                        <?php
                        while ($data_karyawan = mysql_fetch_array($query_karyawan)) {
                        ?>
                        <option value="<?php echo $data_karyawan['karyawan_ktp']; ?>">
                            <?php echo $data_karyawan['ktp_nama'] . " [" . $data_karyawan['bagian_nama'] . "]"; ?>
                        </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    Select Overtime Type
                    <select name="lembur_jenis" id="lembur_jenis" class="form-control" required>
                        <option value="">Select Type</option>
                        <option value=""></option>
                        <option value="Hari Biasa">Hari Biasa</option>
                        <option value="Hari Libur">Hari Libur</option>
                        <option value="Buang Abu">Buang Abu</option>
                    </select>
                </div>
                <div class="form-group">
                    Date
                    <input type="date" name="lembur_tanggal" id="lembur_tanggal" class="form-control" required>
                </div>
                <div class="form-group">
                    Number of Hours
                    <input type="text" name="lembur_jam" id="lembur_jam" class="form-control" required>
                </div>
            </div>
            <footer class="w3-container w3-teal">
                <button type="submit" class="btn btn-info btn-sm">Submit</button>
                <span onclick="document.getElementById('001').style.display='none'" class="w3-button"><button
                        type="button" class="btn btn-secondary btn-sm">Close</button></span>
            </footer>
        </form>
    </div>
</div>