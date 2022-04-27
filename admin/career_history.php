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
                                $query = mysql_query("SELECT * FROM karyawan JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor JOIN bagian ON karyawan.karyawan_bagian=bagian.bagian_id JOIN jabatan ON karyawan.karyawan_jabatan=jabatan.jabatan_id JOIN pkwt ON biodata_ktp.ktp_nomor=pkwt.pkwt_ktp GROUP BY pkwt.pkwt_ktp  ASC ");
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
                                        <a
                                            href="home_admin.php?page=career_history_view&karyawan_ktp=<?php echo $karyawan_ktp; ?>"><button
                                                type="button" class="btn btn-success btn-sm" title="Detail"><i
                                                    class="fa fa-search"></i></button></a>
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