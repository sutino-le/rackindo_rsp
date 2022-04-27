<?php
$periode_awal = date("1990-01-01");

$karyawan_ktp = $_GET['karyawan_ktp'];

$kontrak = mysql_query("SELECT * FROM karyawan JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor JOIN pkwt ON biodata_ktp.ktp_nomor=pkwt.pkwt_ktp JOIN bagian ON pkwt.pkwt_bagian=bagian.bagian_id JOIN jabatan ON pkwt.pkwt_jabatan=jabatan.jabatan_id  WHERE  pkwt.pkwt_ktp='$karyawan_ktp' ORDER BY pkwt.pkwt_id  DESC ");


$query_bagian = mysql_query("SELECT * FROM bagian ORDER BY bagian_nama ASC");
$query_jabatan = mysql_query("SELECT * FROM jabatan ORDER BY jabatan_id ASC");

$query_add_bagian = mysql_query("SELECT * FROM bagian ORDER BY bagian_nama ASC");
$query_add_jabatan = mysql_query("SELECT * FROM jabatan ORDER BY jabatan_id ASC");


$query_terminate = mysql_query("SELECT * FROM terminate JOIN karyawan ON terminate.terminate_npk=karyawan.karyawan_npk WHERE karyawan.karyawan_ktp='$karyawan_ktp' ORDER BY terminate.terminate_tanggal DESC");
$v_query_terminate = mysql_fetch_array($query_terminate);

?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header full-width-chart">
                        <a href="home_admin.php?page=career_history" class="nav-link"><button type="button"
                                class="btn btn-success btn-sm" title="Career History"><i class="fa fa-home"></i>
                                Career History</button></a>
                        <h3 class="card-title">
                            <button onclick="document.getElementById('id01').style.display='block'" type="button"
                                title="Add Career" class="btn btn-info btn-sm"><i class='fas fa-plus'></i></button>
                            Career History
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>NPK</th>
                                    <th>Full Name</th>
                                    <th>Job Title</th>
                                    <th>Position</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($data_kontrak = mysql_fetch_array($kontrak)) {
                                    $karyawan_kategori = $data_kontrak['karyawan_kategori'];
                                    $ktp_nama = $data_kontrak['ktp_nama'];
                                    $bagian_id = $data_kontrak['bagian_id'];
                                    $bagian_nama = $data_kontrak['bagian_nama'];
                                    $jabatan_id = $data_kontrak['jabatan_id'];
                                    $jabatan_nama = $data_kontrak['jabatan_nama'];
                                    $pkwt_id = $data_kontrak['pkwt_id'];
                                    $pkwt_jenis = $data_kontrak['pkwt_jenis'];
                                    $pkwt_nomor = $data_kontrak['pkwt_nomor'];
                                    $pkwt_tanggal = $data_kontrak['pkwt_tanggal'];
                                    $pkwt_kategori = $data_kontrak['pkwt_kategori'];
                                    $pkwt_npk = $data_kontrak['pkwt_npk'];
                                    $pkwt_awal = $data_kontrak['pkwt_awal'];
                                    $pkwt_akhir = $data_kontrak['pkwt_akhir'];
                                    $pkwt_ktp = $data_kontrak['pkwt_ktp'];
                                    $karyawan_status = $data_kontrak['karyawan_status']; {

                                        $pkwt = mysql_query("SELECT * FROM pkwt WHERE pkwt_npk='$pkwt_npk' AND pkwt_kategori='New Hire' ");
                                        $v_pkwt = mysql_fetch_array($pkwt);

                                        //Cek tanggal terkahir PKWT
                                        $tgl_pkwt = mysql_query("SELECT * FROM pkwt WHERE pkwt_ktp='$karyawan_ktp' ORDER BY pkwt_id DESC ");
                                        $v_tgl_pkwt = mysql_fetch_array($tgl_pkwt);

                                        //Cek terminate
                                        $data_terminate = mysql_query("SELECT * FROM terminate WHERE terminate_npk='$pkwt_npk' ");
                                        $v_data_terminate = mysql_fetch_array($data_terminate);
                                        if ($pkwt_kategori == "Terminate") {
                                            $terminate_hasil = $pkwt_kategori . "<br>" . $v_data_terminate['terminate_jenis'];
                                            $color = "red";
                                        } else {
                                            $terminate_hasil = $pkwt_kategori;
                                            $color = "";
                                        }


                                ?>
                                <tr>
                                    <td>
                                        <font color="<?php echo $color; ?>"><?php echo $pkwt_npk; ?></font>
                                    </td>
                                    <td>
                                        <font color="<?php echo $color; ?>"><?php echo $ktp_nama; ?></font>
                                    </td>
                                    <td>
                                        <font color="<?php echo $color; ?>"><?php echo $bagian_nama; ?></font>
                                    </td>
                                    <td>
                                        <font color="<?php echo $color; ?>"><?php echo $jabatan_nama; ?></font>
                                    </td>
                                    <td>
                                        <font color="<?php echo $color; ?>"><?php echo $terminate_hasil; ?></font>
                                    </td>
                                    <td>
                                        <font color="<?php echo $color; ?>"><?php echo $pkwt_jenis; ?></font>
                                    </td>
                                    <td>
                                        <font color="<?php echo $color; ?>"><?php echo $pkwt_awal; ?></font>
                                    </td>
                                    <td>
                                        <font color="<?php echo $color; ?>"><?php echo $pkwt_akhir; ?></font>
                                    </td>
                                    <td>
                                        <?php
                                                if ($pkwt_kategori == "Terminate") {
                                                } else {
                                                    if ($pkwt_jenis == "Daily" and $karyawan_kategori == "Karyawan") {
                                                ?>
                                        <a href="career_history_print_daily.php?pkwt_id=<?php echo $pkwt_id; ?>"
                                            target="_blank"><button type="button" class="btn btn-success btn-sm"
                                                title="print" target="_blank"><i
                                                    class="fa fa-file-pdf"></i></button></a>
                                        <?php
                                                    } elseif ($pkwt_jenis == "Daily" and $karyawan_kategori == "Staff") {
                                                    ?>
                                        <a href="career_history_print_daily_staff.php?pkwt_id=<?php echo $pkwt_id; ?>"
                                            target="_blank"><button type="button" class="btn btn-success btn-sm"
                                                title="print" target="_blank"><i
                                                    class="fa fa-file-pdf"></i></button></a>

                                        <?php
                                                    } else if ($pkwt_jenis == "Contract" and $karyawan_kategori == "Karyawan") {
                                                    ?>
                                        <a href="career_history_print_contract.php?pkwt_id=<?php echo $pkwt_id; ?>"
                                            target="_blank"><button type="button" class="btn btn-success btn-sm"
                                                title="print" target="_blank"><i
                                                    class="fa fa-file-pdf"></i></button></a>
                                        <?php
                                                    } elseif ($pkwt_jenis == "Contract" and $karyawan_kategori == "Staff") {
                                                    ?>
                                        <a href="career_history_print_contract_staff.php?pkwt_id=<?php echo $pkwt_id; ?>"
                                            target="_blank"><button type="button" class="btn btn-success btn-sm"
                                                title="print" target="_blank"><i
                                                    class="fa fa-file-pdf"></i></button></a>
                                        <?php
                                                    } else if ($pkwt_jenis == "Permanent") {
                                                    ?>
                                        <a href="career_history_print_permanent.php?pkwt_id=<?php echo $pkwt_id; ?>"
                                            target="_blank"><button type="button" class="btn btn-success btn-sm"
                                                title="print" target="_blank"><i
                                                    class="fa fa-file-pdf"></i></button></a>
                                        <?php
                                                    }
                                                }
                                                if ($pkwt_kategori == "Terminate" and $pkwt_jenis == "Contract") {
                                                    ?>
                                        <a href="career_history_paklaring.php?karyawan_npk=<?php echo $pkwt_npk; ?>"
                                            target="_blank"><button type="button" class="btn btn-primary btn-sm"
                                                title="print" target="_blank"><i class="fa fa-print"></i></button></a>
                                        <?php
                                                } else if ($pkwt_kategori == "Terminate" and $pkwt_jenis == "Permanent") {
                                                ?>
                                        <a href="career_history_paklaring.php?karyawan_npk=<?php echo $pkwt_npk; ?>"
                                            target="_blank"><button type="button" class="btn btn-primary btn-sm"
                                                title="Print" target="_blank"><i class="fa fa-print"></i></button></a>
                                        <?php
                                                } else if ($pkwt_id == $v_tgl_pkwt['pkwt_id'] and $pkwt_kategori != "Terminate") {
                                                ?>

                                        <button onclick="document.getElementById('id02').style.display='block'"
                                            type="button" title="Edit" class="btn btn-info btn-sm"><i
                                                class='fas fa-edit'></i></button>

                                        <button onclick="document.getElementById('id03').style.display='block'"
                                            type="button" title="Add Terminate" class="btn btn-danger btn-sm"><i
                                                class='fas fa-window-close'></i></button>
                                        <?php
                                                }
                                                ?>
                                    </td>
                                </tr>


                                <div id="id02" class="w3-modal small">
                                    <div class="w3-modal-content w3-animate-top w3-card-4">
                                        <header class="w3-container w3-teal">
                                            <span onclick="document.getElementById('id02').style.display='none'"
                                                class="w3-button w3-display-topright">&times;</span>
                                            <h4>Update Agreement [ <?php echo $ktp_nama . "-" . $pkwt_npk; ?> ]</h4>
                                        </header>
                                        <form action="home_admin.php?page=career_history_edit" method="POST">
                                            <div class="w3-container">
                                                <br>
                                                <div class="form-group">
                                                    <input type="hidden" name="pkwt_id" value="<?php echo $pkwt_id; ?>">
                                                    <input type="hidden" name="pkwt_npk_lama"
                                                        value="<?php echo $pkwt_npk; ?>">
                                                    NPK
                                                    <input type="pkwt_npk" name="pkwt_npk"
                                                        value="<?php echo $pkwt_npk; ?>" class="form-control"
                                                        placeholder="Enter NPK" required>
                                                </div>
                                                <div class="form-group">
                                                    <input type="hidden" name="pkwt_id" value="<?php echo $pkwt_id; ?>">
                                                    Number
                                                    <input type="pkwt_nomor" name="pkwt_nomor"
                                                        value="<?php echo $pkwt_nomor; ?>" class="form-control"
                                                        placeholder="Enter PKWT Number" required>
                                                </div>
                                                <div class="form-group">
                                                    Date
                                                    <input type="date" name="pkwt_tanggal"
                                                        value="<?php echo $pkwt_tanggal; ?>" class="form-control"
                                                        required>
                                                </div>
                                                <div class="form-group">
                                                    Type Agreement
                                                    <select class="form-control" name="pkwt_jenis" id="pkwt_jenis"
                                                        required>
                                                        <option value="<?php echo $pkwt_jenis; ?>">
                                                            <?php echo $pkwt_jenis; ?></option>
                                                        <option value=""></option>
                                                        <option value="Permanent">Permanent</option>
                                                        <option value="Contract">Contract</option>
                                                        <option value="Daily">Daily</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    Start Date
                                                    <input type="date" name="pkwt_awal"
                                                        value="<?php echo $pkwt_awal; ?>" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    End Date
                                                    <input type="date" name="pkwt_akhir"
                                                        value="<?php echo $pkwt_akhir; ?>" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    Job Title
                                                    <select class="form-control" name="pkwt_bagian" id="pkwt_bagian"
                                                        required>
                                                        <option value="<?php echo $bagian_id; ?>">
                                                            <?php echo $bagian_nama; ?></option>
                                                        <option></option>
                                                        <?php
                                                                while ($v_pkwt_bagian = mysql_fetch_array($query_bagian)) {
                                                                ?>
                                                        <option value="<?php echo $v_pkwt_bagian['bagian_id']; ?>">
                                                            <?php echo $v_pkwt_bagian['bagian_nama']; ?></option>
                                                        <?php
                                                                }
                                                                ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    Position
                                                    <select class="form-control" name="pkwt_jabatan" id="pkwt_jabatan"
                                                        required>
                                                        <option value="<?php echo $jabatan_id; ?>">
                                                            <?php echo $jabatan_nama; ?></option>
                                                        <option></option>
                                                        <?php
                                                                while ($v_pkwt_jabatan = mysql_fetch_array($query_jabatan)) {
                                                                ?>
                                                        <option value="<?php echo $v_pkwt_jabatan['jabatan_id']; ?>">
                                                            <?php echo $v_pkwt_jabatan['jabatan_nama']; ?></option>
                                                        <?php
                                                                }
                                                                ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <footer class="w3-container w3-teal">
                                                <button type="submit" class="btn btn-info btn-sm">Submit</button>
                                                <span onclick="document.getElementById('id02').style.display='none'"
                                                    class="w3-button"><button type="button"
                                                        class="btn btn-secondary btn-sm">Kembali</button></span>
                                            </footer>
                                        </form>
                                    </div>
                                </div>

                                <div id="id03" class="w3-modal small">
                                    <div class="w3-modal-content w3-animate-top w3-card-4">
                                        <header class="w3-container w3-teal">
                                            <span onclick="document.getElementById('id03').style.display='none'"
                                                class="w3-button w3-display-topright">&times;</span>
                                            <h4>Add Terminate [ <?php echo $ktp_nama . "-" . $pkwt_npk; ?> ]</h4>
                                        </header>
                                        <form action="home_admin.php?page=career_history_terminate" method="POST">
                                            <input type="hidden" name="pkwt_npk" value="<?php echo $pkwt_npk; ?>">
                                            <input type="hidden" name="pkwt_ktp" value="<?php echo $pkwt_ktp; ?>">
                                            <input type="hidden" name="pkwt_jenis" value="<?php echo $pkwt_jenis; ?>">
                                            <input type="hidden" name="pkwt_bagian" value="<?php echo $bagian_id; ?>">
                                            <input type="hidden" name="pkwt_jabatan" value="<?php echo $jabatan_id; ?>">
                                            <input type="hidden" name="pkwt_awal"
                                                value="<?php echo $v_pkwt['pkwt_awal']; ?>">

                                            <div class="w3-container">
                                                <br>
                                                <div class="form-group">
                                                    NPK
                                                    <input type="terminate_npk" name="terminate_npk"
                                                        value="<?php echo $pkwt_npk; ?>" class="form-control" disabled>
                                                </div>
                                                <div class="form-group">
                                                    Type Terminate
                                                    <select class="form-control" name="terminate_jenis"
                                                        id="terminate_jenis" required>
                                                        <option value="">Type Terminate</option>
                                                        <option value=""></option>
                                                        <option value="Prosedur" selected>Prosedur</option>
                                                        <option value="Non Prosedur">Non Prosedur</option>
                                                    </select>
                                                </div>

                                                <?php
                                                if($pkwt_akhir=="0000-00-00"){
                                                    $batas_akhir=date("Y-m-d");
                                                } else {
                                                    $batas_akhir=$pkwt_akhir;
                                                }
                                                ?>
                                                <div class="form-group">
                                                    Date
                                                    <input type="date" name="terminate_tanggal"
                                                        value="<?php echo $pkwt_akhir; ?>"
                                                        min="<?php echo date('Y-m-d', strtotime($pkwt_awal)); ?>"
                                                        max="<?php echo date('Y-m-d', strtotime($batas_akhir)); ?>"
                                                        class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    Information
                                                    <input type="text" name="terminate_keterangan" class="form-control"
                                                        value="Habis Kontrak" required>
                                                </div>
                                                <div class="form-group">
                                                    Approve By
                                                    <input type="text" name="pkwt_pihak_satu" class="form-control"
                                                        value="Puji Astuti" placeholder="Enter Approved" required>
                                                </div>
                                                <div class="form-group">
                                                    Position
                                                    <input type="text" name="pkwt_pihak_satu_jabatan" value="HR"
                                                        class="form-control" placeholder="Enter Position Approve"
                                                        required>
                                                </div>
                                            </div>
                                            <footer class="w3-container w3-teal">
                                                <button type="submit" class="btn btn-info btn-sm">Submit</button>
                                                <span onclick="document.getElementById('id03').style.display='none'"
                                                    class="w3-button"><button type="button"
                                                        class="btn btn-secondary btn-sm">Kembali</button></span>
                                            </footer>
                                        </form>
                                    </div>
                                </div>



                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

<div id="id01" class="w3-modal small">
    <div class="w3-modal-content w3-animate-top w3-card-4">
        <header class="w3-container w3-teal">
            <span onclick="document.getElementById('id01').style.display='none'"
                class="w3-button w3-display-topright">&times;</span>
            <h3>Add Agreement <br> <?php echo $ktp_nama . " ( " . $jabatan_nama . " - " . $bagian_nama . " )"; ?></h3>
        </header>
        <form action="home_admin.php?page=career_history_input" method="POST">
            <input type="hidden" name="pkwt_ktp" value="<?php echo $karyawan_ktp; ?>">

            <div class="w3-container">
                <br>
                <div class="form-group">
                    Agreement Category
                    <select class="form-control" name="pkwt_kategori" id="pkwt_kategori" required>
                        <option value="New Hire" selected>New Hire</option>
                    </select>
                </div>
                <div class="form-group">
                    Employee Category
                    <select class="form-control" name="karyawan_kategori" id="karyawan_kategori" required>
                        <option value="">Select Employee Category</option>
                        <option value=""></option>
                        <option value="Staff">Staff</option>
                        <option value="Karyawan">Karyawan</option>
                    </select>
                </div>
                <div class="form-group">
                    Sign Date
                    <input type="date" name="pkwt_tanggal" value="<?php echo date("Y-m-d"); ?>" class="form-control"
                        required>
                </div>
                <div class="form-group">
                    Agreement Type
                    <select class="form-control" name="pkwt_jenis" id="pkwt_jenis" required>
                        <option value="" selected>Select Agreement Type</option>
                        <option value=""></option>
                        <option value="Permanent">Permanent</option>
                        <option value="Contract" selected>Contract</option>
                        <option value="Daily">Daily</option>
                    </select>
                </div>
                <div class="form-group">
                    Start Date
                    <input type="date" name="pkwt_awal"
                        min="<?php echo date('Y-m-d', strtotime($v_query_terminate['terminate_tanggal'])); ?>"
                        value="<?php echo date("Y-02-02"); ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    End Date
                    <input type="date" name="pkwt_akhir"
                        min="<?php echo date('Y-m-d', strtotime($v_query_terminate['terminate_tanggal'])); ?>"
                        value="<?php echo date("2022-04-27"); ?>" class="form-control">
                </div>
                <div class="form-group">
                    Job Title
                    <select class="form-control" name="pkwt_bagian" id="pkwt_bagian" required>
                        <option value="<?php echo $bagian_id; ?>" selected><?php echo $bagian_nama; ?></option>
                        <option></option>
                        <?php
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
                    <select class="form-control" name="pkwt_jabatan" id="pkwt_jabatan" required>
                        <option value="<?php echo $jabatan_id; ?>" selected><?php echo $jabatan_nama; ?></option>
                        <option></option>
                        <?php
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
                <span onclick="document.getElementById('id01').style.display='none'" class="w3-button"><button
                        type="button" class="btn btn-secondary btn-sm">Kembali</button></span>
            </footer>
        </form>
    </div>
</div>