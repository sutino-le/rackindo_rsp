<?php
include("koneksi.php");

$ktp_nomor = $_GET['ktp_nomor'];

$query_ktp = mysql_query("SELECT * FROM biodata_ktp WHERE ktp_nomor='$ktp_nomor' ");
$hasil_ktp = mysql_fetch_array($query_ktp);
$ktp_nama = $hasil_ktp['ktp_nama'];

$query_pengalaman = mysql_query("SELECT * FROM biodata_pengalaman WHERE pengalaman_ktp='$ktp_nomor' ORDER BY pengalaman_awal DESC ");


?>


<div class="card card-info">
    <div class="card-header">
        <h4 class="card-title">Pengalaman Kerja</h4>
        <p>
            <font color="red">* Lengkapi data Pengalaman Kerja sesuai dengan riwayat pekerjaan termasuk pekerjaan
                sekarang.</font>
        </p>
    </div>
    <form class="form-horizontal" action="home_admin.php?page=experience_edit_process" method="post">

        <div class=" card-body">

            <div class="form-group row m-2">
                <label class="control-label col-sm-2" for="pengalaman_ktp">Nomor KTP</label>
                <div class="col-sm-4">
                    <input type="hidden" name="pengalaman_ktp" value="<?php echo $ktp_nomor; ?>" required>

                    <input type="text" class="form-control" id="pengalaman_ktp" maxlength="16" minlength="16"
                        onkeypress="return hanyaAngka(event)" placeholder="Masukan Nomor KTP"
                        value="<?php echo $ktp_nomor; ?>" name="pengalaman_ktp" disabled>
                </div>
                <label class="control-label col-sm-2" for="ktp_nama">Nama Lengkap</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="ktp_nama" placeholder="Masukan Nama Lengkap"
                        value="<?php echo $ktp_nama; ?>" name="ktp_nama" disabled>
                </div>
            </div>

            <div class="form-group row m-2">
                <label class="control-label col-sm-2" for="pengalaman_awal">Tanggal Mulai</label>
                <div class="col-sm-4">
                    <input type="date" class="form-control" id="pengalaman_awal" name="pengalaman_awal" required>
                </div>
                <label class="control-label col-sm-2" for="pengalaman_akhir">Tanggal Berakhir</label>
                <div class="col-sm-2">
                    <input type="date" class="form-control" id="pengalaman_akhir" name="pengalaman_akhir" required>
                </div>
                <div class="col-sm-2">
                    <select class="form-control" name="pengalaman_status" id="pengalaman_status" required>
                        <option value="">Status</option>
                        <option value=""></option>
                        <option value="Tidak Aktif">Tidak Aktif</option>
                        <option value="Masih Bekerja">Masih Bekerja</option>
                    </select>
                </div>
            </div>

            <div class="form-group row m-2">
                <label class="control-label col-sm-2" for="pengalaman_perusahaan">Nama Perusahaan </label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="pengalaman_perusahaan"
                        placeholder="Masukan Nama Perusahaan" name="pengalaman_perusahaan" required>
                </div>
                <label class="control-label col-sm-2" for="pengalaman_bagian">Bagian</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="pengalaman_bagian" placeholder="Masukan Bagian"
                        name="pengalaman_bagian" required>
                </div>
            </div>

            <div class="form-group row m-2">
                <label class="control-label col-sm-2" for="pengalaman_deskripsi">Deskripsi Pekerjaan</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="pengalaman_deskripsi" id="pengalaman_deskripsi"></textarea>
                </div>
            </div>

            <div class="form-group row m-2">
                <label class="control-label col-sm-2" for="pengalaman_keluar">Alasan Keluar</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="pengalaman_keluar" placeholder="Masukan Alasan Keluar"
                        name="pengalaman_keluar" required>
                </div>
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-info btn-sm">Simpan</button>
            <a href="home_admin.php?page=emergency_edit&ktp_nomor=<?php echo $ktp_nomor; ?>"><button type="button"
                    class="btn btn-secondary btn-sm"><i class="fas fa-backward"></i>
                    Sebelumnya</button></a>
            <a href="home_admin.php?page=npwp_edit&ktp_nomor=<?php echo $ktp_nomor; ?>"><button type="button"
                    class="btn btn-secondary btn-sm">Selanjutnya <i class="fas fa-forward"></i></button></a>
        </div>

    </form>

</div>




<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Durasi</th>
                <th>Perusahaan</th>
                <th>Bagian</th>
                <th>Deskripsi</th>
                <th>Alasan Keluar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $nomor_pengalaman = 1;
            while ($hasil_pengalaman = mysql_fetch_array($query_pengalaman)) {
            ?>
            <tr>
                <td><?php echo $nomor_pengalaman; ?></td>
                <td>
                    <?php echo date("d M Y", strtotime($hasil_pengalaman['pengalaman_awal'])) . " - " . date("d M Y", strtotime($hasil_pengalaman['pengalaman_akhir'])); ?>
                </td>
                <td><?php echo $hasil_pengalaman['pengalaman_perusahaan']; ?></td>
                <td><?php echo $hasil_pengalaman['pengalaman_bagian']; ?></td>
                <td><?php echo $hasil_pengalaman['pengalaman_deskripsi']; ?></td>
                <td><?php echo $hasil_pengalaman['pengalaman_keluar']; ?></td>
                <td>
                    <a
                        href="home_admin.php?page=experience_edit_rubah&pengalaman_id=<?php echo $hasil_pengalaman['pengalaman_id']; ?>"><button
                            type="button" class="btn btn-success btn-sm"><i class="far fa-edit"></i></button></a>
                    <a
                        href="home_admin.php?page=experience_edit_delete&pengalaman_id=<?php echo $hasil_pengalaman['pengalaman_id']; ?>"><button
                            type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button></a>
                </td>
            </tr>
            <?php
                $nomor_pengalaman++;
            }
            ?>
        </tbody>
    </table>
</div>

</body>

</html>