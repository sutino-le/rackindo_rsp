<?php
include("koneksi.php");

$ktp_nomor = $_GET['ktp_nomor'];

$query_ktp = mysql_query("SELECT * FROM biodata_ktp WHERE ktp_nomor='$ktp_nomor' ");
$hasil_ktp = mysql_fetch_array($query_ktp);
$ktp_nama = $hasil_ktp['ktp_nama'];

$query_domisili = mysql_query("SELECT * FROM biodata_domisili WHERE domisili_ktp='$ktp_nomor' ");
$hasil = mysql_fetch_array($query_domisili);
$domisili_alamat = $hasil['domisili_alamat'];
$domisili_rt = $hasil['domisili_rt'];
$domisili_rw = $hasil['domisili_rw'];
$domisili_kelurahan = $hasil['domisili_kelurahan'];
$domisili_kecamatan = $hasil['domisili_kecamatan'];
$domisili_kabupaten = $hasil['domisili_kabupaten'];
$domisili_propinsi = $hasil['domisili_propinsi'];
$domisili_kodepos = $hasil['domisili_kodepos'];


//tombol next
$tombol_domisili = mysql_query("SELECT * FROM biodata_domisili WHERE domisili_ktp='$ktp_nomor' ");
$v_tombol_domisili = mysql_fetch_array($tombol_domisili);
if (empty($v_tombol_domisili)) {
    $tombol_next = "Disabled";
    $link_next = "disabled-link";
} else {
    $tombol_next = "";
    $link_next = "";
}

?>


<html>

<head>
    <title>Combo Dinamis</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>

    <div class="card card-info">
        <div class="card-header">
            <h4 class="card-title">Alamat Domisli</h4>
            <p>
                <font color="red">* Lengkapi data Domisili sesuai dengan alamat tempat tinggal sekarang.</font>
            </p>
        </div>
        <form class="form-horizontal" action="home_admin.php?page=residence_address_edit_process" method="post">

            <div class=" card-body">

                <div class="form-group row m-2">
                    <label class="control-label col-sm-2" for="domisili_ktp">Nomor KTP </label>
                    <div class="col-sm-4">
                        <input type="hidden" name="domisili_ktp" value="<?php echo $ktp_nomor; ?>" required>

                        <input type="text" class="form-control" id="domisili_ktp" maxlength="16" minlength="16"
                            onkeypress="return hanyaAngka(event)" placeholder="Masukan Nomor KTP"
                            value="<?php echo $ktp_nomor; ?>" name="domisili_ktp" disabled>
                    </div>
                    <label class="control-label col-sm-2" for="pendidikan_ktp">Nama Lengkap </label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="ktp_nama" placeholder="Masukan Nama Lengkap"
                            value="<?php echo $ktp_nama; ?>" name="ktp_nama" disabled>
                    </div>
                </div>

                <div class="form-group row m-2">
                    <label class="control-label col-sm-2" for="domisili_alamat">Alamat Domisili </label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="domisili_alamat"
                            placeholder="Masukan Alamat Domisili" value="<?php echo $hasil['domisili_alamat']; ?>"
                            name="domisili_alamat" required>
                    </div>
                    <label class="control-label col-sm-2" for="domisili_rt">RT / RW </label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="domisili_rt" maxlength="3"
                            onkeypress="return hanyaAngka(event)" placeholder="Masukan RT"
                            value="<?php echo $hasil['domisili_rt']; ?>" name="domisili_rt" required>
                    </div>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="domisili_rw" maxlength="3"
                            onkeypress="return hanyaAngka(event)" placeholder="Masukan RW"
                            value="<?php echo $hasil['domisili_rw']; ?>" name="domisili_rw" required>
                    </div>
                </div>


                <div class="form-group row mb-2">
                    <label class="control-label col-sm-2" for="domisili_propinsi">Propinsi </label>
                    <div class="col-sm-4">
                        <select name="domisili_propinsi" class="form-control" id="form_prov">
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
                    <label class="control-label col-sm-2" for="domisili_kabupaten">Kota/Kabupaten </label>
                    <div class="col-sm-4">
                        <select name="domisili_kabupaten" class="form-control" id="form_kab"></select>
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label class="control-label col-sm-2" for="domisili_kecamatan">Kecamatan </label>
                    <div class="col-sm-4">
                        <select name="domisili_kecamatan" class="form-control" id="form_kec"></select>
                    </div>
                    <label class="control-label col-sm-2" for="domisili_kelurahan">Kelurahan </label>
                    <div class="col-sm-4">
                        <select name="domisili_kelurahan" class="form-control" id="form_des"></select>
                    </div>
                </div>


                <div class="form-group row m-2">
                    <label class="control-label col-sm-2" for="domisili_kodepos">Kodepos </label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="domisili_kodepos" placeholder="Masukan Kodepos"
                            value="<?php echo $hasil['domisili_kodepos']; ?>" name="domisili_kodepos" required>
                    </div>
                </div>

            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-info btn-sm">Simpan</button>
                <a href="home_admin.php?page=id_card_edit&ktp_nomor=<?php echo $ktp_nomor; ?>"><button type="button"
                        class="btn btn-secondary btn-sm"><i class="fas fa-backward"></i> Sebelumnya</button></a>
                <a href="home_admin.php?page=education_edit&ktp_nomor=<?php echo $ktp_nomor; ?>"
                    class="<?php echo $link_next; ?>"><button type="button" class="btn btn-secondary btn-sm"
                        <?php echo $tombol_next; ?>>Selanjutnya <i class="fas fa-forward"></i></button></a>
            </div>

        </form>

    </div>




    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Nomor KTP</th>
                    <th>Nama Lengkap</th>
                    <th>Alamat Domisili</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $ktp_nomor; ?></td>
                    <td><?php echo $ktp_nama; ?></td>
                    <td>
                        <?php echo $domisili_alamat . ", RT/RW " . $domisili_rt . "/" . $domisili_rw . ", Kel. " . $domisili_kelurahan . ", Kec. " . $domisili_kecamatan . ", " . $domisili_kabupaten . "-" . $domisili_propinsi . "-" . $domisili_kodepos; ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>


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

</body>

</html>