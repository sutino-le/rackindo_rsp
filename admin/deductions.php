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
        class="btn btn-info btn-sm"><i class='fas fa-plus'></i></button>Add Hours Reduction
</div>




<div class="container-fluid">
    <br>
    <table id="deductions_data" class="table table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>NO.</th>
                <th>Pin</th>
                <th>Full Name</th>
                <th>Departement</th>
                <th>Date</th>
                <th>Hours Reduction</th>
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
        $('#deductions_data').DataTable({
            "order": [1, "asc"],
            "processing": true,
            "serverSide": true,
            "lengthMenu": [
                [10, 25, 50, 100, 200],
                [10, 25, 50, 100, 200]
            ],
            "ajax": {
                url: "deductions_data.php",
                type: "post"
            }

        });
    });
    </script>

</div>
<?php
$query_karyawan = mysql_query("SELECT * FROM karyawan JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor JOIN bagian ON karyawan.karyawan_bagian=bagian.bagian_id ORDER BY biodata_ktp.ktp_nama ASC ");
?>


<div id="001" class="w3-modal small">
    <div class="w3-modal-content w3-animate-top w3-card-4">
        <header class="w3-container w3-teal">
            <span onclick="document.getElementById('001').style.display='none'"
                class="w3-button w3-display-topright">&times;</span>
            <h3>Add Hours Reduction</h3>
        </header>
        <form action="home_admin.php?page=deductions_input" method="POST">

            <div class="w3-container">
                <br>
                <div class="form-group">
                    Select Employee
                    <select class="form-control" name="upah_pot_ktp" id="upah_pot_ktp" required>
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
                    Date
                    <input type="date" name="upah_pot_tanggal" id="upah_pot_tanggal" class="form-control" required>
                </div>
                <div class="form-group">
                    Number of Hours
                    <input type="text" name="upah_pot_jumlah" id="upah_pot_jumlah" class="form-control" required>
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