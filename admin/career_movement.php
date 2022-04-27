<!DOCTYPE html>
<html>

<head>

    <style style="text/css">
    /* Define the hover highlight color for the table row */
    .hoverTable tr:hover {
        background-color: #20B2AA;
    }
    </style>

</head>

<body>

    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- DataTables Example -->
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-table"></i>
                    Career History
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered hoverTable" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>NO.</th>
                                    <th>NPK</th>
                                    <th>Name</th>
                                    <th>Job Title</th>
                                    <th>Position</th>
                                    <th>Status</th>
                                    <th>Type</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = mysql_query("SELECT * FROM karyawan JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor JOIN bagian ON karyawan.karyawan_bagian=bagian.bagian_id JOIN jabatan ON karyawan.karyawan_jabatan=jabatan.jabatan_id JOIN pkwt ON biodata_ktp.ktp_nomor=pkwt.pkwt_ktp WHERE karyawan.karyawan_status='Aktif' GROUP BY pkwt.pkwt_ktp  ASC ");
                                while ($biodata_ktp = mysql_fetch_array($query)) {
                                    $karyawan_ktp = $biodata_ktp['karyawan_ktp'];
                                    $karyawan_npk = $biodata_ktp['karyawan_npk'];
                                    $karyawan_status = $biodata_ktp['karyawan_status'];
                                    $ktp_nama = $biodata_ktp['ktp_nama'];
                                    $bagian_nama = $biodata_ktp['bagian_nama'];
                                    $jabatan_nama = $biodata_ktp['jabatan_nama'];
                                    $pkwt_jenis = $biodata_ktp['pkwt_jenis'];
                                    $pkwt_awal = $biodata_ktp['pkwt_awal'];
                                    $pkwt_akhir = $biodata_ktp['pkwt_akhir']; {
                                        if ($pkwt_jenis == "Permanent") {
                                            $color = "#AFEEEE";
                                        } else {
                                            $color = "";
                                        }
                                        if ($karyawan_status == "Keluar") {
                                            $font_color = "red";
                                        } else {
                                            $font_color = "";
                                        }
                                        $nomer++;
                                ?>
                                <tr bgcolor="<?php echo $color; ?>">
                                    <td>
                                        <font color="<?php echo $font_color; ?>"><?php echo $nomer; ?></font>
                                    </td>
                                    <td>
                                        <font color="<?php echo $font_color; ?>"><?php echo $karyawan_npk; ?></font>
                                    </td>
                                    <td>
                                        <font color="<?php echo $font_color; ?>"><?php echo $ktp_nama; ?></font>
                                    </td>
                                    <td>
                                        <font color="<?php echo $font_color; ?>"><?php echo $bagian_nama; ?></font>
                                    </td>
                                    <td>
                                        <font color="<?php echo $font_color; ?>"><?php echo $jabatan_nama; ?></font>
                                    </td>
                                    <td>
                                        <font color="<?php echo $font_color; ?>"><?php echo $karyawan_status; ?></font>
                                    </td>
                                    <td>
                                        <font color="<?php echo $font_color; ?>"><?php echo $pkwt_jenis; ?></font>
                                    </td>
                                    <?php
                                            $pkwt = mysql_query("SELECT * FROM pkwt WHERE pkwt_ktp='$karyawan_ktp' ORDER BY pkwt_akhir DESC ");
                                            $v_pkwt = mysql_fetch_array($pkwt);
                                            ?>
                                    <td>
                                        <font color="<?php echo $font_color; ?>"><?php echo $v_pkwt['pkwt_awal']; ?>
                                        </font>
                                    </td>
                                    <td>
                                        <font color="<?php echo $font_color; ?>">
                                            <?php
                                                    if ($pkwt_jenis == "Permanent") {
                                                        $pkwt_akhire = "";
                                                    } else {
                                                        $pkwt_akhire = $v_pkwt['pkwt_akhir'];
                                                    }
                                                    echo $pkwt_akhire;
                                                    ?>
                                        </font>
                                    </td>
                                    <td>
                                        <button
                                            onclick="document.getElementById('<?php echo $karyawan_npk; ?>').style.display='block'"
                                            type="button" title="Add Career" class="btn btn-info btn-sm"><i
                                                class='fas fa-plus'></i></button>

                                        <div id="<?php echo $karyawan_npk; ?>" class="w3-modal small">
                                            <div class="w3-modal-content w3-animate-top w3-card-4">
                                                <header class="w3-container w3-teal">
                                                    <span
                                                        onclick="document.getElementById('<?php echo $karyawan_npk; ?>').style.display='none'"
                                                        class="w3-button w3-display-topright">&times;</span>
                                                    <h3>Add Career Movement <br>
                                                        <?php echo $ktp_nama . " ( " . $jabatan_nama . " - " . $bagian_nama . " )"; ?>
                                                    </h3>
                                                </header>
                                                <form action="home_admin.php?page=career_history_input" method="POST">
                                                    <input type="hidden" name="pkwt_ktp"
                                                        value="<?php echo $karyawan_ktp; ?>">

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
                                                            <input type="date" name="pkwt_tanggal"
                                                                value="<?php echo date("Y-m-30"); ?>"
                                                                class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            Agreement Type
                                                            <select class="form-control" name="pkwt_jenis"
                                                                id="pkwt_jenis" required>
                                                                <option value="" selected>Select Agreement Type</option>
                                                                <option value=""></option>
                                                                <option value="Permanent">Permanent</option>
                                                                <option value="Contract">Contract</option>
                                                                <option value="Daily" selected>Daily</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            Start Date
                                                            <input type="date" name="pkwt_awal"
                                                                min="<?php echo date('Y-m-d', strtotime($v_query_terminate['terminate_tanggal'])); ?>"
                                                                value="<?php echo date("Y-m-30"); ?>"
                                                                class="form-control" required>
                                                        </div>
                                                        <div class="form-group">
                                                            End Date
                                                            <input type="date" name="pkwt_akhir"
                                                                min="<?php echo date('Y-m-d', strtotime($v_query_terminate['terminate_tanggal'])); ?>"
                                                                value="<?php echo date("2022-01-31"); ?>"
                                                                class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            Job Title
                                                            <select class="form-control" name="pkwt_bagian"
                                                                id="pkwt_bagian" required>
                                                                <option value="<?php echo $bagian_id; ?>" selected>
                                                                    <?php echo $bagian_nama; ?></option>
                                                                <option></option>
                                                                <?php
                                                                        while ($v_add_bagian = mysql_fetch_array($query_add_bagian)) {
                                                                        ?>
                                                                <option
                                                                    value="<?php echo $v_add_bagian['bagian_id'] ?>">
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
                                                                <option value="<?php echo $jabatan_id; ?>" selected>
                                                                    <?php echo $jabatan_nama; ?></option>
                                                                <option></option>
                                                                <?php
                                                                        while ($v_add_jabatan = mysql_fetch_array($query_add_jabatan)) {
                                                                        ?>
                                                                <option
                                                                    value="<?php echo $v_add_jabatan['jabatan_id'] ?>">
                                                                    <?php echo $v_add_jabatan['jabatan_nama'] ?>
                                                                </option>
                                                                <?php
                                                                        }
                                                                        ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <footer class="w3-container w3-teal">
                                                        <button type="submit"
                                                            class="btn btn-info btn-sm">Submit</button>
                                                        <span
                                                            onclick="document.getElementById('<?php echo $karyawan_npk; ?>').style.display='none'"
                                                            class="w3-button"><button type="button"
                                                                class="btn btn-secondary btn-sm">Kembali</button></span>
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

    </div>
</body>

</html>