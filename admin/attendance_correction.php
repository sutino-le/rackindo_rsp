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
    <!-- Trigger the modal with a button -->
    <button onclick="document.getElementById('id01').style.display='block'" type="button"
        title="Attendance Correction Input" class="btn btn-info">Attendance Correction Input <i
            class='fas fa-plus'></i></button>
</div>




<div class="container-fluid">
    <br>
    <table id="attendance_correction_data" class="table table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>NO.</th>
                <th>NPK</th>
                <th>Name</th>
                <th>Job Title</th>
                <th>Date</th>
                <th>Attendance Type</th>
                <th>Time</th>
                <th>Information</th>
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
        $('#attendance_correction_data').DataTable({
            "order": [1, "asc"],
            "processing": true,
            "serverSide": true,
            "lengthMenu": [
                [10, 25, 50, 100, 200],
                [10, 25, 50, 100, 200]
            ],
            "ajax": {
                url: "attendance_correction_data.php",
                type: "post"
            }

        });
    });
    </script>

</div>


<div id="id01" class="w3-modal small">
    <div class="w3-modal-content w3-animate-top w3-card-4">
        <header class="w3-container w3-teal">
            <span onclick="document.getElementById('id01').style.display='none'"
                class="w3-button w3-display-topright">&times;</span>
            <h2>Input Attendance Correction</h2>
        </header>
        <form action="home_admin.php?page=attendance_correction_input" method="POST">
            <div class="w3-container">
                <br>
                <div class="form-group">
                    <div class="form-row">
                        <label class="control-label col-sm-2" for="karyawan_pin">Employee </label>
                        <div class="col-sm-4">
                            <select class="form-control" name="absen_koreksi_pin" id="absen_koreksi_pin" required>
                                <option value="" selected>Select Employee</option>
                                <option></option>
                                <?php
                                $query_karyawan = mysql_query("SELECT * FROM karyawan JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor JOIN bagian ON karyawan.karyawan_bagian=bagian.bagian_id ORDER BY biodata_ktp.ktp_nama ASC ");
                                while ($data_karyawan = mysql_fetch_array($query_karyawan)) {
                                ?>
                                <option value="<?php echo $data_karyawan['karyawan_finger']; ?>">
                                    <?php echo $data_karyawan['ktp_nama'] . " [" . $data_karyawan['bagian_nama'] . "]"; ?>
                                </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <label class="control-label col-sm-2" for="absen_koreksi_tanggal">Date </label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" id="absen_koreksi_tanggal"
                                name="absen_koreksi_tanggal" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-row">
                        <label class="control-label col-sm-2" for="absen_koreksi_jenis">Attendance Type</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="absen_koreksi_jenis" id="absen_koreksi_jenis" required>
                                <option value="" selected>Select Attendance Type</option>
                                <option></option>
                                <option value="In">In</option>
                                <option value="Out">Out</option>
                            </select>
                        </div>
                        <label class="control-label col-sm-2" for="absen_koreksi_waktu">Time </label>
                        <div class="col-sm-4">
                            <input type="time" class="form-control" id="absen_koreksi_waktu" name="absen_koreksi_waktu"
                                required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-row">
                        <label class="control-label col-sm-2" for="absen_koreksi_keterangan">Information </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="absen_koreksi_keterangan"
                                name="absen_koreksi_keterangan" required>
                        </div>
                    </div>
                </div>

            </div>
            <footer class="w3-container w3-teal">
                <button type="submit" class="btn btn-info btn-sm">Submit</button>
                <span onclick="document.getElementById('id01').style.display='none'" class="w3-button"><button
                        type="button" class="btn btn-secondary btn-sm">Kembali</button></span>
            </footer>
        </form>
    </div>
</div>