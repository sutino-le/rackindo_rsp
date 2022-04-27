<div id="content-wrapper">

    <div class="container-fluid">

        <!-- DataTables Example -->
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-hand-holding-usd"></i>
                Employee Salary
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NPK</th>
                                <th>Full Name</th>
                                <th>Status</th>
                                <th>Position</th>
                                <th>Basic Salary</th>
                                <th>Compensation</th>
                                <th>Incentive</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = mysql_query("SELECT * FROM biodata_ktp JOIN karyawan ON biodata_ktp.ktp_nomor=karyawan.karyawan_ktp JOIN bagian ON karyawan.karyawan_bagian=bagian.bagian_id JOIN jabatan ON karyawan.karyawan_jabatan=jabatan.jabatan_id ORDER BY karyawan.karyawan_jenis, karyawan.karyawan_jabatan, karyawan.karyawan_finger ASC ");
                            while ($biodata_ktp = mysql_fetch_array($query)) {
                                $karyawan_npk = $biodata_ktp['karyawan_npk'];
                                $karyawan_ktp = $biodata_ktp['karyawan_ktp'];
                                $ktp_nama = $biodata_ktp['ktp_nama'];
                                $karyawan_jenis = $biodata_ktp['karyawan_jenis'];
                                $bagian_nama = $biodata_ktp['bagian_nama'];
                                $jabatan_nama = $biodata_ktp['jabatan_nama']; {
                                    $nomer++;

                                    $upah_karyawan = mysql_query("SELECT * FROM upah_karyawan JOIN upah ON upah_karyawan.upah_kar_upah=upah.upah_tahun WHERE upah_karyawan.upah_kar_ktp='$karyawan_ktp' ");
                                    $v_upah_karyawan = mysql_fetch_array($upah_karyawan);
                                    $upah_jumlah = $v_upah_karyawan['upah_jumlah'];
                                    $upah_kar_kompensasi = $v_upah_karyawan['upah_kar_kompensasi'];
                                    $upah_kar_insentif = $v_upah_karyawan['upah_kar_insentif'];


                            ?>
                            <tr>
                                <td><?php echo $nomer; ?></td>
                                <td><?php echo $karyawan_npk; ?></td>
                                <td><?php echo $ktp_nama; ?></td>
                                <td><?php echo $karyawan_jenis; ?></td>
                                <td><?php echo $jabatan_nama . "-" . $bagian_nama; ?></td>
                                <td><?php echo number_format($upah_jumlah); ?></td>
                                <td><?php echo $upah_kar_kompensasi; ?> %</td>
                                <td><?php echo number_format($upah_kar_insentif); ?></td>
                                <td>
                                    <button
                                        onclick="document.getElementById('<?php echo $karyawan_ktp; ?>').style.display='block'"
                                        type="button" title="Add Career" class="btn btn-info btn-sm"><i
                                            class='fas fa-plus'></i></button>




                                    <div id="<?php echo $karyawan_ktp; ?>" class="w3-modal small">
                                        <div class="w3-modal-content w3-animate-top w3-card-4">
                                            <header class="w3-container w3-teal">
                                                <span
                                                    onclick="document.getElementById('<?php echo $karyawan_ktp; ?>').style.display='none'"
                                                    class="w3-button w3-display-topright">&times;</span>
                                                <h3>Add Salary <br><?php echo $karyawan_ktp . " - " . $ktp_nama; ?></h3>
                                            </header>
                                            <form action="home_admin.php?page=setting_ump_input" method="POST">
                                                <input type="hidden" name="upah_kar_ktp"
                                                    value="<?php echo $karyawan_ktp; ?>">

                                                <div class="w3-container">
                                                    <br>
                                                    <div class="form-group">
                                                        Basic Salary
                                                        <select class="form-control" name="upah_kar_upah"
                                                            id="upah_kar_upah" required>
                                                            <option value="" selected>Select Salary</option>
                                                            <option value=""></option>
                                                            <?php
                                                                    $ump = mysql_query("SELECT * FROM upah ORDER BY upah_tahun DESC ");
                                                                    while ($v_ump = mysql_fetch_array($ump)) {
                                                                    ?>
                                                            <option value="<?php echo $v_ump['upah_tahun']; ?>">
                                                                <?php echo number_format($v_ump['upah_jumlah']) . " [ UMP Tahun " . $v_ump['upah_tahun'] . " ]"; ?>
                                                            </option>
                                                            <?php
                                                                    }
                                                                    ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        Job Compensation (%)
                                                        <input type="text" name="upah_kar_kompensasi"
                                                            id="upah_kar_kompensasi" class="form-control" value="0"
                                                            onkeypress="return hanyaAngka(event)" required>
                                                    </div>
                                                    <div class="form-group">
                                                        Incentive
                                                        <input type="text" name="upah_kar_insentif"
                                                            id="upah_kar_insentif" class="form-control" value="0"
                                                            onkeypress="return hanyaAngka(event)" required>
                                                    </div>
                                                </div>
                                                <footer class="w3-container w3-teal">
                                                    <button type="submit" class="btn btn-info btn-sm">Submit</button>
                                                    <span
                                                        onclick="document.getElementById('<?php echo $karyawan_ktp; ?>').style.display='none'"
                                                        class="w3-button"><button type="button"
                                                            class="btn btn-secondary btn-sm">Close</button></span>
                                                </footer>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>