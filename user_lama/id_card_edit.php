<?php
include("koneksi.php");

$ktp_nomor = $_GET['ktp_nomor'];

$query_ktp = mysql_query("SELECT * FROM biodata_ktp  WHERE ktp_nomor='$ktp_nomor' ");
$hasil = mysql_fetch_array($query_ktp);
$ktp_nomor = $hasil['ktp_nomor'];
$ktp_nama = $hasil['ktp_nama'];
$ktp_tempat_lahir = $hasil['ktp_tempat_lahir'];
$ktp_tanggal_lahir = $hasil['ktp_tanggal_lahir'];
$ktp_kelamin = $hasil['ktp_kelamin'];
$ktp_gol_darah = $hasil['ktp_gol_darah'];
$ktp_alamat = $hasil['ktp_alamat'];
$ktp_rt = $hasil['ktp_rt'];
$ktp_rw = $hasil['ktp_rw'];
$ktp_kelurahan = $hasil['ktp_kelurahan'];
$ktp_kecamatan = $hasil['ktp_kecamatan'];
$ktp_kabupaten = $hasil['ktp_kabupaten'];
$ktp_propinsi = $hasil['ktp_propinsi'];
$ktp_kodepos = $hasil['ktp_kodepos'];
$ktp_agama = $hasil['ktp_agama'];
$ktp_status = $hasil['ktp_status'];
$ktp_kewarganegaraan = $hasil['ktp_kewarganegaraan'];



?>



<div class="card card-info">
    <div class="card-header">
        <h5 class="card-title">Data KTP</h5>
    </div>
    <form class="form-horizontal" action="home_admin.php?page=id_card_edit_process" method="post">

        <div class=" card-body">

            <div class="form-group row mb-2">
                <label class="control-label col-sm-2" for="ktp_nomor">Nomor KTP </label>
                <div class="col-sm-4">
                    <input type="hidden" class="form-control" id="ktp_nomor" maxlength="16" minlength="16"
                        onkeypress="return hanyaAngka(event)" placeholder="Masukan Nomor KTP"
                        value="<?php echo $hasil['ktp_nomor']; ?>" name="ktp_nomor" required>
                    <input type="text" class="form-control" id="ktp_nomor" maxlength="16" minlength="16"
                        onkeypress="return hanyaAngka(event)" placeholder="Masukan Nomor KTP"
                        value="<?php echo $hasil['ktp_nomor']; ?>" name="ktp_nomor" disabled>
                </div>
                <label class="control-label col-sm-2" for="ktp_nama">Nama Lenkap</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="ktp_nama" placeholder="Masukan Nama Lengkap"
                        value="<?php echo $hasil['ktp_nama']; ?>" name="ktp_nama" required>
                </div>
            </div>


            <div class="form-group row mb-2">
                <label class="control-label col-sm-2" for="ktp_tempat_lahir">Tempat Lahir </label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="ktp_tempat_lahir" placeholder="Masukan Tempat Lahir"
                        value="<?php echo $hasil['ktp_tempat_lahir']; ?>" name="ktp_tempat_lahir" required>
                </div>
                <label class="control-label col-sm-2" for="ktp_tanggal_lahir">Tanggal Lahir </label>
                <div class="col-sm-4">
                    <input type="date" class="form-control" id="ktp_tanggal_lahir" name="ktp_tanggal_lahir"
                        value="<?php echo $hasil['ktp_tanggal_lahir']; ?>" required>
                </div>
            </div>


            <div class="form-group row mb-2">
                <label class="control-label col-sm-2" for="ktp_kelamin">Jenis Kelamin </label>
                <div class="col-sm-4">
                    <select class="form-control" name="ktp_kelamin" id="ktp_kelamin" required>
                        <option value="<?php echo $hasil['ktp_kelamin']; ?>" selected>
                            <?php echo $hasil['ktp_kelamin']; ?></option>
                        <option></option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <label class="control-label col-sm-2" for="ktp_gol_darah">Gol. Darah </label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="ktp_gol_darah" name="ktp_gol_darah"
                        value="<?php echo $hasil['ktp_gol_darah']; ?>" required>
                </div>
            </div>


            <div class="form-group row mb-2">
                <label class="control-label col-sm-2" for="ktp_alamat">Alamat KTP </label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="ktp_alamat" placeholder="Masukan Alamat KTP"
                        value="<?php echo $hasil['ktp_alamat']; ?>" name="ktp_alamat" required>
                </div>
                <label class="control-label col-sm-2" for="ktp_rt">RT / RW </label>
                <div class="col-sm-2">
                    <input type="text" class="form-control" id="ktp_rt" maxlength="3"
                        onkeypress="return hanyaAngka(event)" placeholder="Masukan RT"
                        value="<?php echo $hasil['ktp_rt']; ?>" name="ktp_rt" required>
                </div>
                <div class="col-sm-2">
                    <input type="text" class="form-control" id="ktp_rw" maxlength="3"
                        onkeypress="return hanyaAngka(event)" placeholder="Masukan RW"
                        value="<?php echo $hasil['ktp_rw']; ?>" name="ktp_rw" required>
                </div>
            </div>


            <div class="form-group row mb-2">
                <label class="control-label col-sm-2" for="ktp_propinsi">Propinsi </label>
                <div class="col-sm-4">
                    <select name="ktp_propinsi" class="form-control" id="form_prov" required>
                        <option value="">Pilih Provinsi</option>
                        <?php
                        $daerah = mysql_query("SELECT kode,nama FROM wilayah WHERE CHAR_LENGTH(kode)=2 ORDER BY nama");
                        while ($d = mysql_fetch_array($daerah)) {
                        ?>
                        <option value="<?php echo $d['kode']; ?>"><?php echo $d['nama']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <label class="control-label col-sm-2" for="ktp_kabupaten">Kota/Kabupaten </label>
                <div class="col-sm-4">
                    <select name="ktp_kabupaten" class="form-control" id="form_kab" required></select>
                </div>
            </div>

            <div class="form-group row mb-2">
                <label class="control-label col-sm-2" for="ktp_kecamatan">Kecamatan </label>
                <div class="col-sm-4">
                    <select name="ktp_kecamatan" class="form-control" id="form_kec" required></select>
                </div>
                <label class="control-label col-sm-2" for="ktp_kelurahan">Kelurahan </label>
                <div class="col-sm-4">
                    <select name="ktp_kelurahan" class="form-control" id="form_des" required></select>
                </div>
            </div>


            <div class="form-group row mb-2">
                <label class="control-label col-sm-2" for="ktp_kodepos">Kodepos </label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="ktp_kodepos" placeholder="Masukan Kodepos "
                        value="<?php echo $hasil['ktp_kodepos']; ?>" name="ktp_kodepos" required>
                </div>
            </div>


            <div class="form-group row mb-2">
                <label class="control-label col-sm-2" for="ktp_agama">Agama </label>
                <div class="col-sm-4">
                    <select class="form-control" name="ktp_agama" id="ktp_agama" required>
                        <option value="<?php echo $hasil['ktp_agama']; ?>" selected>
                            <?php echo $hasil['ktp_agama']; ?></option>
                        <option></option>
                        <option value="Islam">Islam</option>
                        <option value="Kristen Protestan">Kristen Protestan</option>
                        <option value="Katolik">Katolik</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Buddha">Buddha</option>
                        <option value="Kong Hu Cu">Kong Hu Cu</option>
                        <option value="lainnya">lainnya</option>
                    </select>
                </div>
                <label class="control-label col-sm-2" for="ktp_status">Status Perkawinan</label>
                <div class="col-sm-4">
                    <select class="form-control" name="ktp_status" id="ktp_status" required>
                        <option value="<?php echo $hasil['ktp_status']; ?>" selected>
                            <?php echo $hasil['ktp_status']; ?></option>
                        <option></option>
                        <option value="Belum Kawin">Belum Kawin</option>
                        <option value="kawin">kawin</option>
                        <option value="Cerai">Cerai</option>
                    </select>
                </div>
            </div>


            <div class="form-group row mb-2">
                <label class="control-label col-sm-2" for="ktp_kewarganegaraan">Kewarganegaraan </label>
                <div class="col-sm-4">
                    <select class="form-control" name="ktp_kewarganegaraan" id="ktp_kewarganegaraan" required>
                        <option value="<?php echo $hasil['ktp_kewarganegaraan']; ?>" selected>
                            <?php echo $hasil['ktp_kewarganegaraan']; ?></option>
                        <option></option>
                        <option value="WNI">WNI</option>
                        <option value="WNA">WNA</option>
                    </select>
                </div>
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-info btn-sm">Simpan</button>
            <a href="home_admin.php?page=residence_address_edit&ktp_nomor=<?php echo $ktp_nomor; ?>"><button
                    type="button" class="btn btn-secondary btn-sm">Selanjutnya <i
                        class="fas fa-forward"></i></button></a>
        </div>

    </form>

</div>


<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Nomor KTP</th>
                <th>Nama Lengkap</th>
                <th>Tempat/Tgl Lahir</th>
                <th>Jenis<br>Kelamin</th>
                <th>Gol. <br> Darah</th>
                <th>Agama</th>
                <th>Status<br>perkawinan</th>
                <th>Alamat KTP</th>
                <th>Kewarganegaraan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $ktp_nomor; ?></td>
                <td><?php echo $ktp_nama; ?></td>
                <td><?php echo $ktp_tempat_lahir . "<br>" . date("d-m-Y", strtotime($ktp_tanggal_lahir)); ?></td>
                <td><?php echo $ktp_kelamin; ?></td>
                <td><?php echo $ktp_gol_darah; ?></td>
                <td><?php echo $ktp_agama; ?></td>
                <td><?php echo $ktp_status; ?></td>
                <td>
                    <?php echo $ktp_alamat . ", RT/RW " . $ktp_rt . "/" . $ktp_rw . ", Kel. " . $ktp_kelurahan . ", Kec. " . $ktp_kecamatan . ", " . $ktp_kabupaten . "-" . $ktp_propinsi . "-" . $ktp_kodepos; ?>
                </td>
                <td><?php echo $ktp_kewarganegaraan; ?></td>
            </tr>
        </tbody>
    </table>
</div>


<br><br>


<script type="text/javascript">
$(document).ready(function() {

    // sembunyikan form kabupaten, kecamatan dan desa
    $("#form_kab").hide();
    $("#form_kec").hide();
    $("#form_des").hide();

    // ambil data kabupaten ketika data memilih provinsi
    $('body').on("change", "#form_prov", function() {
        var id = $(this).val();
        var data = "id=" + id + "&data=kabupaten";
        $.ajax({
            type: 'POST',
            url: "get_daerah.php",
            data: data,
            success: function(hasil) {
                $("#form_kab").html(hasil);
                $("#form_kab").show();
                $("#form_kec").hide();
                $("#form_des").hide();
            }
        });
    });

    // ambil data kecamatan/kota ketika data memilih kabupaten
    $('body').on("change", "#form_kab", function() {
        var id = $(this).val();
        var data = "id=" + id + "&data=kecamatan";
        $.ajax({
            type: 'POST',
            url: "get_daerah.php",
            data: data,
            success: function(hasil) {
                $("#form_kec").html(hasil);
                $("#form_kec").show();
                $("#form_des").hide();
            }
        });
    });

    // ambil data desa ketika data memilih kecamatan/kota
    $('body').on("change", "#form_kec", function() {
        var id = $(this).val();
        var data = "id=" + id + "&data=desa";
        $.ajax({
            type: 'POST',
            url: "get_daerah.php",
            data: data,
            success: function(hasil) {
                $("#form_des").html(hasil);
                $("#form_des").show();
            }
        });
    });


});
</script>