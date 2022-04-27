<?php
$query = mysql_query("SELECT * FROM memo JOIN karyawan ON memo.memo_ktp=karyawan.karyawan_ktp JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor JOIN bagian ON karyawan.karyawan_bagian=bagian.bagian_id WHERE karyawan.karyawan_ktp='$user_ktp'");
?>

<div class="card">

    <div class="card-header">


        <div class="row">
            <div class="col-sm-6">
                <h5>Data Memo</h5>
            </div>
            <div class="col-sm-6 text-right">
                <a class="dropdown-item" href="memo_input.php?karyawan_ktp=<?php echo $user_ktp; ?>"
                    title="Input Data"><button type="button" class="btn btn-primary btn-sm" title="To Add Data">
                        Ajukan Memo <i class="fa fa-plus"></i></button>
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
                    <th>Nama</th>
                    <th>Nomor</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $nomor_memo = 1;
                while ($hasil_query = mysql_fetch_array($query)) {
                ?>
                <tr>
                    <td><?php echo $nomor_memo; ?></td>
                    <td><?php echo $hasil_query['karyawan_npk']; ?></td>
                    <td><?php echo $hasil_query['ktp_nama']; ?></td>
                    <td><?php echo $hasil_query['memo_no']; ?></td>
                    <td><?php echo date("d M Y", strtotime($hasil_query['memo_tanggal'])); ?></td>
                    <td>
                        <a href="memo_print.php?memo_id=<?php echo $hasil_query['memo_id']; ?>" target="_blank"><button
                                type="button" class="btn btn-primary btn-sm" title="Print dengan Lanskap"><i
                                    class="fa fa-print"></i></button></a>
                    </td>
                </tr>
                <?php
                    $nomor_memo++;
                }
                ?>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>