<div id="content-wrapper">

    <div class="container-fluid">

        <!-- DataTables Example -->
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                PKWT Data
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
                            $query = mysql_query("SELECT * FROM biodata_ktp");
                            while ($biodata_ktp = mysql_fetch_array($query)) {
                                $nik = $biodata_ktp['ktp_nomor'];
                                $nama = $biodata_ktp['ktp_nama']; {

                                    $query_karyawan = mysql_query("SELECT * FROM karyawan WHERE karyawan_ktp='$nik' ORDER BY karyawan_join DESC");;
                                    $data_karyawan = mysql_fetch_array($query_karyawan);

                                    $query_pkwt = mysql_query("SELECT * FROM pkwt WHERE pkwt_ktp='$nik' ORDER BY pkwt_id DESC ");
                                    $data_pkwt = mysql_fetch_array($query_pkwt);

                                    $karyawan_status = $data_karyawan['karyawan_status'];
                                    $pkwt_status = $data_pkwt['pkwt_status'];

                                    if (empty($pkwt_status)) {
                                        $tombol = "";
                                    } else if ($pkwt_status == "Progres") {
                                        $tombol = "Disabled";
                                    }

                                    if (empty($karyawan_status)) {

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
                                        type="button" title="Add Career" class="btn btn-info btn-sm"
                                        <?php echo $tombol; ?>><i class='fas fa-clone'></i></button>

                                    <div id="<?php echo $nik; ?>" class="w3-modal small">
                                        <div class="w3-modal-content w3-animate-top w3-card-4">
                                            <header class="w3-container w3-teal">
                                                <span
                                                    onclick="document.getElementById('<?php echo $nik; ?>').style.display='none'"
                                                    class="w3-button w3-display-topright">&times;</span>
                                                <h3>Add Agreement <br>
                                                    <?php echo $nama . " ( " . $nik . " )"; ?>
                                                </h3>
                                            </header>
                                            <form action="home_admin.php?page=pkwt_list_process" method="POST">
                                                <input type="hidden" name="pkwt_ktp" value="<?php echo $nik; ?>">

                                                <div class="w3-container">
                                                    <br>
                                                    <div class="form-group">
                                                        Agreement Category
                                                        <select class="form-control" name="pkwt_kategori"
                                                            id="pkwt_kategori" required>
                                                            <option value="New Hire" selected>New Hire</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        Sign Date
                                                        <input type="date" name="pkwt_tanggal" class="form-control"
                                                            required>
                                                    </div>
                                                    <div class="form-group">
                                                        Agreement Type
                                                        <select class="form-control" name="pkwt_jenis" id="pkwt_jenis"
                                                            required>
                                                            <option value="" selected>Select Agreement Type</option>
                                                            <option value=""></option>
                                                            <option value="Permanent">Permanent</option>
                                                            <option value="Contract">Contract</option>
                                                            <option value="Daily">Daily</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        Start Date
                                                        <input type="date" name="pkwt_awal" class="form-control"
                                                            required>
                                                    </div>
                                                    <div class="form-group">
                                                        End Date
                                                        <input type="date" name="pkwt_akhir" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        Job Title
                                                        <select class="form-control" name="pkwt_bagian" id="pkwt_bagian"
                                                            required>
                                                            <option value="">Select Job Title</option>
                                                            <option></option>
                                                            <?php
                                                                        $query_add_bagian = mysql_query("SELECT * FROM bagian ORDER BY bagian_nama ASC");
                                                                        while ($v_add_bagian = mysql_fetch_array($query_add_bagian)) {
                                                                        ?>
                                                            <option value="<?php echo $v_add_bagian['bagian_id'] ?>">
                                                                <?php echo $v_add_bagian['bagian_nama'] ?></option>
                                                            <?php
                                                                        }
                                                                        ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        Position
                                                        <select class="form-control" name="pkwt_jabatan"
                                                            id="pkwt_jabatan" required>
                                                            <option value="">Select Position</option>
                                                            <option></option>
                                                            <?php
                                                                        $query_add_jabatan = mysql_query("SELECT * FROM jabatan ORDER BY jabatan_id ASC");
                                                                        while ($v_add_jabatan = mysql_fetch_array($query_add_jabatan)) {
                                                                        ?>
                                                            <option value="<?php echo $v_add_jabatan['jabatan_id'] ?>">
                                                                <?php echo $v_add_jabatan['jabatan_nama'] ?></option>
                                                            <?php
                                                                        }
                                                                        ?>
                                                        </select>
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