<div id="content-wrapper">

    <div class="container-fluid">

        <!-- DataTables Example -->
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                BPJS Health Data
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIK</th>
                                <th>Full name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $nomer = 0;
                            $query = mysql_query("SELECT * FROM karyawan JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor WHERE karyawan.karyawan_status='Aktif' ");
                            while ($biodata_ktp = mysql_fetch_array($query)) {
                                $nik = $biodata_ktp['ktp_nomor'];
                                $nama = $biodata_ktp['ktp_nama'];
                                $karyawan_status = $biodata_ktp['karyawan_status']; {

                                    $query_bpjskes = mysql_query("SELECT * FROM bpjs_kes WHERE bpjskes_ktp='$nik' ORDER BY bpjskes_masuk ASC ");
                                    $data_bpjskes = mysql_fetch_array($query_bpjskes);

                                    $bpjskes_status = $data_bpjskes['bpjskes_status'];

                                    if (empty($karyawan_status)) {
                                        $tombol = "";
                                    } else if ($bpjskes_status == "Progres") {
                                        $tombol = "Disabled";
                                    }

                                    if (empty($bpjskes_status)) {

                                        $nomer++;
                                        $Status = "Belum Aktif";
                            ?>
                            <tr>
                                <td><?php echo $nomer; ?></td>
                                <td><?php echo $nik; ?></td>
                                <td><?php echo $nama; ?></td>
                                <?php
                                            ?>

                                <td><?php echo $Status; ?></td>
                                <td>
                                    <button
                                        onclick="document.getElementById('<?php echo $nik; ?>').style.display='block'"
                                        type="button" title="Register" class="btn btn-info btn-sm"
                                        <?php echo $tombol; ?>><i class='fas fa-clone'></i></button>

                                    <div id="<?php echo $nik; ?>" class="w3-modal small">
                                        <div class="w3-modal-content w3-animate-top w3-card-4">
                                            <header class="w3-container w3-teal">
                                                <span
                                                    onclick="document.getElementById('<?php echo $nik; ?>').style.display='none'"
                                                    class="w3-button w3-display-topright">&times;</span>
                                                <h3>Register <br>
                                                    <?php echo $nama . " ( " . $nik . " )"; ?>
                                                </h3>
                                            </header>
                                            <form action="home_admin.php?page=bpjskes_register_process" method="POST">
                                                <input type="hidden" name="bpjskes_ktp" value="<?php echo $nik; ?>">

                                                <div class="w3-container">
                                                    <br>
                                                    <div class="form-group">
                                                        Register Date
                                                        <input type="date" name="bpjskes_masuk" class="form-control"
                                                            required>
                                                    </div>

                                                </div>
                                                <footer class="w3-container w3-teal">
                                                    <button type="submit" class="btn btn-info btn-sm">Submit</button>
                                                    <span
                                                        onclick="document.getElementById('<?php echo $nik; ?>').style.display='none'"
                                                        class="w3-button"><button type="button"
                                                            class="btn btn-secondary btn-sm">Back</button></span>
                                                </footer>
                                            </form>
                                        </div>
                                    </div>


                                </td>
                            </tr>
                            <?php
                                    }
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>