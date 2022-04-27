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
    <button onclick="document.getElementById('id01').style.display='block'" type="button" title="Add Career"
        class="btn btn-info btn-sm"><i class='fas fa-plus'></i></button>&nbsp;Input UMP</button>
</div>



<div class="container-fluid">
    <br>
    <table id="ump_view_data" class="table table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>NO.</th>
                <th>Tahun</th>
                <th>Jumlah</th>
                <th>Wilayah</th>
                <th>Aksi</th>
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
        $('#ump_view_data').DataTable({
            "order": [1, "desc"],
            "processing": true,
            "serverSide": true,
            "lengthMenu": [
                [10, 25, 50, 100, 200],
                [10, 25, 50, 100, 200]
            ],
            "ajax": {
                url: "ump_view_data.php",
                type: "post"
            }

        });
        a
    });
    </script>

</div>

<div id="id01" class="w3-modal small">
    <div class="w3-modal-content w3-animate-top w3-card-4">
        <header class="w3-container w3-teal">
            <span onclick="document.getElementById('id01').style.display='none'"
                class="w3-button w3-display-topright">&times;</span>
            <h3>Input Data Upah</h3>
        </header>
        <form action="home_admin.php?page=ump_input" method="POST">

            <div class="w3-container">
                <br>
                <div class="form-group">
                    Tahun
                    <select class="form-control" name="upah_tahun" required>
                        <option value="">Pilih Tahun</option>
                        <option value=""></option>
                        <?php
                        for ($end = date('Y'); $end >= date('Y') - 70; $end -= 1) {
                            echo "<option value='$end'> $end </option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    Jumlah
                    <input type="text" class="form-control" name="upah_jumlah" id="upah_jumlah"
                        onkeypress="return hanyaAngka(event)" placeholder="Jumlah Upah" required>
                </div>
                <div class="form-group">
                    Wilayah
                    <select name="upah_wilayah" class="form-control" required>
                        <option value="">Pilih Wilayah</option>
                        <option value=""></option>
                        <?php
                        $kota = mysql_query("SELECT *  FROM data_wilayah GROUP BY propinsi ASC");
                        while ($v_kota = mysql_fetch_array($kota)) {
                        ?>
                        <option value="<?php echo $v_kota['propinsi']; ?>">
                            <?php echo $v_kota['propinsi']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <footer class="w3-container w3-teal">
                <button type="submit" class="btn btn-info btn-sm">Simpan</button>
                <span onclick="document.getElementById('id01').style.display='none'" class="w3-button"><button
                        type="button" class="btn btn-secondary btn-sm">Kembali</button></span>
            </footer>
        </form>
    </div>
</div>