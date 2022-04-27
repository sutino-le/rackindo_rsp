<?php
include("koneksi.php");

$absen_izin_id = $_GET['absen_izin_id'];

$query_ktp = mysql_query("SELECT * FROM absen_izin JOIN karyawan ON absen_izin.absen_izin_pin=karyawan.karyawan_finger JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor JOIN bagian ON karyawan.karyawan_bagian=bagian.bagian_id JOIN jabatan ON karyawan.karyawan_jabatan=jabatan.jabatan_id WHERE absen_izin.absen_izin_id='$absen_izin_id' ");
$hasil = mysql_fetch_array($query_ktp);
?>


<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Permohonan Absen Edit</h3>
    </div>
    <form class="form-horizontal" action="home_admin.php?page=absensi_permohonan_edit_simpan" method="post">
        <input type="hidden" class="form-control" id="absen_izin_id" value="<?php echo $hasil['absen_izin_id']; ?>"
            name="absen_izin_id" required>

        <div class=" card-body">

            <div class="form-group row m-2">
                <label class=" control-label col-sm-2" for="karyawan_finger">ID Finger :</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="karyawan_finger"
                        value="<?php echo $hasil['karyawan_finger']; ?>" name="karyawan_finger" disabled>
                </div>
                <label class="control-label col-sm-2" for="ktp_nama">Nama Lengkap :</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="ktp_nama" placeholder="Enter Nama Lengkap"
                        value="<?php echo $hasil['ktp_nama']; ?>" name="ktp_nama" disabled>
                </div>
            </div>

            <div class="form-group row m-2">
                <label class=" control-label col-sm-2" for="bagian_nama">Bagian :</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="bagian_nama"
                        value="<?php echo $hasil['bagian_nama']; ?>" name="bagian_nama" disabled>
                </div>
                <label class="control-label col-sm-2" for="jabatan_nama">Jabatan :</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="jabatan_nama" placeholder="Enter Full Name"
                        value="<?php echo $hasil['jabatan_nama']; ?>" name="jabatan_nama" disabled>
                </div>
            </div>

            <div class="form-group row m-2">
                <label class=" control-label col-sm-2" for="absen_izin_tanggal">Tanggal :</label>
                <div class="col-sm-4">
                    <input type="date" class="form-control" id="absen_izin_tanggal" name="absen_izin_tanggal"
                        value="<?php echo $hasil['absen_izin_tanggal']; ?>" required>
                </div>
                <label class="control-label col-sm-2" for="absen_izin_nomor">Nomor Permohonan :</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="absen_izin_nomor" placeholder="Enter Number Request"
                        value="<?php echo $hasil['absen_izin_nomor']; ?>" name="absen_izin_nomor" required>
                </div>
            </div>


            <div class="form-group row m-2">
                <label class=" control-label col-sm-2" for="absen_izin_jenis">Jenis Permohonan :</label>
                <div class="col-sm-4">
                    <select class="form-control" name="absen_izin_jenis" id="absen_izin_jenis" required>
                        <option value="<?php echo $hasil['absen_izin_jenis']; ?>" selected>
                            <?php echo $hasil['absen_izin_jenis']; ?></option>
                        <option></option>
                        <option value="Vaks">Vaksin (Vaks)</option>
                        <option value="I">Izin (I)</option>
                        <option value="1/2">1/2 Hari</option>
                        <option value="ITD">Izin Tidak Dibayar (ITD)</option>
                        <option value="S">Sakit</option>
                        <option value="STK">Surat Tanpa Keterangan (STK)</option>
                        <option value="A">Alpa</option>
                    </select>
                </div>
                <label class="control-label col-sm-2" for="absen_izin_keterangan">Keterangan :</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="absen_izin_keterangan" placeholder="Enter Keterangan"
                        name="absen_izin_keterangan" value="<?php echo $hasil['absen_izin_keterangan']; ?>" required>
                </div>
            </div>


            <div class="form-group row m-2">
                <label class=" control-label col-sm-2" for="absen_izin_tahun">Tahun :</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="absen_izin_tahun" onkeypress="return hanyaAngka(event)"
                        maxlength="4" minlength="4" value="<?php echo $hasil['absen_izin_tahun']; ?>"
                        name="absen_izin_tahun" required>
                </div>
                <label class="control-label col-sm-2" for="absen_izin_spv">Supervisor :</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="absen_izin_spv" placeholder="Enter Supervisor"
                        name="absen_izin_spv" value="<?php echo $hasil['absen_izin_spv']; ?>" required>
                </div>
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-info btn-sm">Simpan</button>
            <a href="home_admin.php?page=absensi_permohonan"><button type="button"
                    class="btn btn-secondary btn-sm">Kembali</button></a>
        </div>

    </form>

</div>