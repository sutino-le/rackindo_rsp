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
} else {
    $tombol_next = "";
}

?>


<html>

<head>
    <title>Combo Dinamis</title>
    <script language="javascript" src="jquery-1.3.2.js"></script>
    <script type="text/javascript" src="ajax.js"></script>
    <script>
    $(document).ready(function() {

    });

    function biodata_kabupaten(propinsi) {
        $.ajax({
            url: "ajax_kota.php?propinsi=" + propinsi,
            success: function(msg) {
                $('.biodata_kabupaten').html(msg);
            },
            dataType: "html"
        });
    }


    $(document).ready(function() {

    });

    function biodata_kecamatan(kota_kabupaten) {
        $.ajax({
            url: "ajax_kecamatan.php?kota_kabupaten=" + kota_kabupaten,
            success: function(msg) {
                $('.biodata_kecamatan').html(msg);
            },
            dataType: "html"
        });
    }


    $(document).ready(function() {

    });

    function biodata_kelurahan(kecamatan) {
        $.ajax({
            url: "ajax_kelurahan.php?kecamatan=" + kecamatan,
            success: function(msg) {
                $('.biodata_kelurahan').html(msg);
            },
            dataType: "html"
        });
    }


    $(document).ready(function() {

    });

    function biodata_kodepos(kelurahan) {
        $.ajax({
            url: "ajax_kodepos.php?kelurahan=" + kelurahan,
            success: function(msg) {
                $('.biodata_kodepos').html(msg);
            },
            dataType: "html"
        });
    }
    </script>
</head>

<body>

    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Residence Edit</h3>
        </div>
        <form class="form-horizontal" action="home_admin.php?page=residence_address_edit_process" method="post">

            <div class=" card-body">

                <div class="form-group row">
                    <label class="control-label col-sm-2" for="domisili_ktp">ID card number </label>
                    <div class="col-sm-4">
                        <input type="hidden" name="domisili_ktp" value="<?php echo $ktp_nomor; ?>" required>

                        <input type="text" class="form-control" id="domisili_ktp" maxlength="16" minlength="16"
                            onkeypress="return hanyaAngka(event)" placeholder="Enter ID card number"
                            value="<?php echo $ktp_nomor; ?>" name="domisili_ktp" disabled>
                    </div>
                    <label class="control-label col-sm-2" for="pendidikan_ktp">Full Name </label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="ktp_nama" placeholder="Enter Fullname"
                            value="<?php echo $ktp_nama; ?>" name="ktp_nama" disabled>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label col-sm-2" for="domisili_alamat">Residence address </label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="domisili_alamat"
                            placeholder="Enter Residence address" value="<?php echo $hasil['domisili_alamat']; ?>"
                            name="domisili_alamat" required>
                    </div>
                    <label class="control-label col-sm-2" for="domisili_rt">RT / RW </label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="domisili_rt" maxlength="3"
                            onkeypress="return hanyaAngka(event)" placeholder="Enter RT"
                            value="<?php echo $hasil['domisili_rt']; ?>" name="domisili_rt" required>
                    </div>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="domisili_rw" maxlength="3"
                            onkeypress="return hanyaAngka(event)" placeholder="Enter RW"
                            value="<?php echo $hasil['domisili_rw']; ?>" name="domisili_rw" required>
                    </div>
                </div>


                <div class="form-group row">
                    <label class="control-label col-sm-2"
                        for="biodata_propinsi">Province-<?php echo $hasil['domisili_propinsi']; ?> </label>
                    <div class="col-sm-4">
                        <?php
                        include("koneksi.php");
                        $query = mysql_query("SELECT * FROM data_wilayah GROUP BY propinsi ASC ");
                        echo "<select class='form-control' name='ktp_propinsi' onchange='biodata_kabupaten($(this).val())' required >";
                        echo "<option value='' selected>- Select Province -</option>";
                        while ($data = mysql_fetch_array($query)) {
                            echo "<option value='" . $data['propinsi'] . "'>" . $data['propinsi'] . "</option>";
                        }
                        echo "</select>";
                        ?>
                    </div>
                    <label class="control-label col-sm-2"
                        for="biodata_kabupaten">City-<?php echo $hasil['domisili_kabupaten']; ?> </label>
                    <div class="col-sm-4">
                        <div class="biodata_kabupaten"></div>
                    </div>
                </div>


                <div class="form-group row">
                    <label class="control-label col-sm-2"
                        for="biodata_kecamatan">Districts-<?php echo $hasil['domisili_kecamatan']; ?></label>
                    <div class="col-sm-4">
                        <div class="biodata_kecamatan"></div>
                    </div>
                    <label class="control-label col-sm-2"
                        for="biodata_kelurahan">Village-<?php echo $hasil['domisili_kelurahan']; ?> </label>
                    <div class="col-sm-4">
                        <div class="biodata_kelurahan"></div>
                    </div>
                </div>


                <div class="form-group row">
                    <label class="control-label col-sm-2" for="biodata_kodepos">Portal
                        code-<?php echo $hasil['domisili_kodepos']; ?> </label>
                    <div class="col-sm-4">
                        <div class="biodata_kodepos"></div>
                    </div>
                </div>

            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-info btn-sm">Submit</button>
                <a href="home_admin.php?page=id_card_edit&ktp_nomor=<?php echo $ktp_nomor; ?>"><button type="button"
                        class="btn btn-secondary btn-sm">Previous</button></a>
                <a href="home_admin.php?page=education_edit&ktp_nomor=<?php echo $ktp_nomor; ?>"><button type="button"
                        class="btn btn-secondary btn-sm" <?php echo $tombol_next; ?>>Next</button></a>
            </div>

        </form>

    </div>




    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>ID card</th>
                    <th>Name</th>
                    <th>Residence</th>
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

</body>

</html>