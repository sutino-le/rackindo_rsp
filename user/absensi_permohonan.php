<div class="card">

    <div class="card-header">


        <div class="row">
            <div class="col-sm-6">
                <h3 class="card-title">Data Permohonan Absen</h3>
            </div>
            <div class="col-sm-6 text-right">
                <a class="dropdown-item" href="home_admin.php?page=absensi_permohonan_input" title="Input Data"><button
                        type="button" class="btn btn-primary btn-sm" title="To Add Data">
                        Ajukan Permohonan <i class="fa fa-plus"></i></button>
                </a>
            </div>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>NO.</th>
                    <th>NPK</th>
                    <th>Name</th>
                    <th>Job Title</th>
                    <th>Date</th>
                    <th>Attendance Type</th>
                    <th>Information</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $nomer = 0;
                $query = mysql_query("SELECT * FROM absen_izin JOIN karyawan ON absen_izin.absen_izin_pin=karyawan.karyawan_finger JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor JOIN bagian ON karyawan.karyawan_bagian=bagian.bagian_id WHERE karyawan.karyawan_ktp='$user_ktp'");
                while ($biodata_ktp = mysql_fetch_array($query)) {
                    $absen_izin_id = $biodata_ktp['absen_izin_id'];
                    $ktp_nomor = $biodata_ktp['ktp_nomor'];
                    $ktp_nama = $biodata_ktp['ktp_nama'];
                    $karyawan_npk = $biodata_ktp['karyawan_npk'];
                    $bagian_nama = $biodata_ktp['bagian_nama'];
                    $absen_izin_tanggal = $biodata_ktp['absen_izin_tanggal'];
                    $absen_izin_jenis = $biodata_ktp['absen_izin_jenis'];
                    $absen_izin_keterangan = $biodata_ktp['absen_izin_keterangan']; {
                        $nomer++;
                        if ($absen_izin_jenis == "Vaks" or $absen_izin_jenis == "LN") {
                            $edit = '';
                        } else {
                            $edit = '<a href="home_admin.php?page=absensi_permohonan_edit&absen_izin_id=' . $absen_izin_id . '"><button type="button" class="btn btn-success btn-sm" title="Edit" ><i class="fa fa-edit"></i></button></a>';
                        }
                ?>
                <tr>
                    <td><?php echo $nomer; ?></td>
                    <td><?php echo $karyawan_npk; ?></td>
                    <td><?php echo $ktp_nama; ?></td>
                    <td><?php echo $bagian_nama; ?></td>
                    <td><?php echo $absen_izin_tanggal; ?></td>
                    <td><?php echo $absen_izin_jenis; ?></td>
                    <td><?php echo $absen_izin_keterangan; ?></td>
                    <td>
                        <?php
                                echo $edit;
                                ?>
                    </td>
                </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>