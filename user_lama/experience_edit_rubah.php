<?php
include("koneksi.php");

$pengalaman_id = $_GET['pengalaman_id'];

$query_pengalaman = mysql_query("SELECT * FROM biodata_pengalaman WHERE pengalaman_id='$pengalaman_id' ");
$v_query_pengalaman = mysql_fetch_array($query_pengalaman);
$pengalaman_ktp = $v_query_pengalaman['pengalaman_ktp'];
$pengalaman_awal = $v_query_pengalaman['pengalaman_awal'];
$pengalaman_akhir = $v_query_pengalaman['pengalaman_akhir'];
$pengalaman_status = $v_query_pengalaman['pengalaman_status'];
$pengalaman_bagian = $v_query_pengalaman['pengalaman_bagian'];
$pengalaman_perusahaan = $v_query_pengalaman['pengalaman_perusahaan'];
$pengalaman_deskripsi = $v_query_pengalaman['pengalaman_deskripsi'];
$pengalaman_keluar = $v_query_pengalaman['pengalaman_keluar'];

$query_ktp = mysql_query("SELECT * FROM biodata_ktp WHERE ktp_nomor='$ktp_nomor' ");
$hasil_ktp = mysql_fetch_array($query_ktp);
$ktp_nama = $hasil_ktp['ktp_nama'];


?>


<div class="card card-info">
    <div class="card-header">
        <h4 class="card-title">Pengalaman Kerja</h4>
        <p>
            <font color="red">* Lengkapi data Pengalaman Kerja sesuai dengan riwayat pekerjaan termasuk pekerjaan
                sekarang.</font>
        </p>
    </div>
    <form class="form-horizontal" action="home_admin.php?page=experience_edit_rubah_process" method="post">

        <div class=" card-body">

            <div class="form-group row m-2">
                <label class="control-label col-sm-2" for="pengalaman_ktp">Nomor KTP</label>
                <div class="col-sm-4">
                    <input type="hidden" name="pengalaman_id" value="<?php echo $pengalaman_id; ?>" required>
                    <input type="hidden" name="pengalaman_ktp" value="<?php echo $pengalaman_ktp; ?>" required>

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
                    <input type="date" class="form-control" id="pengalaman_awal" name="pengalaman_awal"
                        value="<?php echo $pengalaman_awal; ?>" required>
                </div>
                <label class="control-label col-sm-2" for="pengalaman_akhir">Tanggal Berakhir</label>
                <div class="col-sm-2">
                    <input type="date" class="form-control" id="pengalaman_akhir" name="pengalaman_akhir"
                        value="<?php echo $pengalaman_akhir; ?>" required>
                </div>
                <div class="col-sm-2">
                    <select class="form-control" name="pengalaman_status" id="pengalaman_status" required>
                        <option value="<?php echo $pengalaman_status; ?>"><?php echo $pengalaman_status; ?></option>
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
                        placeholder="Masukan Nama Perusahaan" name="pengalaman_perusahaan"
                        value="<?php echo $pengalaman_perusahaan; ?>" required>
                </div>
                <label class="control-label col-sm-2" for="pengalaman_bagian">Bagian</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="pengalaman_bagian" placeholder="Masukan Bagian"
                        name="pengalaman_bagian" value="<?php echo $pengalaman_bagian; ?>" required>
                </div>
            </div>

            <div class="form-group row m-2">
                <label class="control-label col-sm-2" for="pengalaman_deskripsi">Deskripsi Pekerjaan</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="pengalaman_deskripsi"
                        id="pengalaman_deskripsi"><?php echo $pengalaman_deskripsi; ?></textarea>
                </div>
            </div>

            <div class="form-group row m-2">
                <label class="control-label col-sm-2" for="pengalaman_keluar">Alasan Keluar</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="pengalaman_keluar" placeholder="Masukan Alasan Keluar"
                        name="pengalaman_keluar" value="<?php echo $pengalaman_keluar; ?>" required>
                </div>
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-info btn-sm">Simpan</button>
            <a href="home_admin.php?page=emergency_edit&ktp_nomor=<?php echo $ktp_nomor; ?>"><button type="button"
                    class="btn btn-secondary btn-sm"><i class="fas fa-backward"></i>
                    Sebelumnya</button></a>
            <a href="home_admin.php?page=user_edit&ktp_nomor=<?php echo $ktp_nomor; ?>"><button type="button"
                    class="btn btn-secondary btn-sm">Selanjutnya <i class="fas fa-forward"></i></button></a>
        </div>

    </form>

</div>