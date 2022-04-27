<?php
include("koneksi.php");

$ktp_nomor = $_GET['ktp_nomor'];

$query_ktp = mysql_query("SELECT * FROM biodata_ktp WHERE ktp_nomor='$ktp_nomor' ");
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
            <h3 class="card-title">ID card edit</h3>
        </div>
        <form class="form-horizontal" action="home_admin.php?page=id_card_edit_process" method="post">

            <div class=" card-body">

                <div class="form-group row">
                    <label class="control-label col-sm-2" for="ktp_nomor">ID card number </label>
                    <div class="col-sm-4">
                        <input type="hidden" class="form-control" id="ktp_nomor" maxlength="16" minlength="16"
                            onkeypress="return hanyaAngka(event)" placeholder="Enter ID card number"
                            value="<?php echo $hasil['ktp_nomor']; ?>" name="ktp_nomor" required>
                        <input type="text" class="form-control" id="ktp_nomor" maxlength="16" minlength="16"
                            onkeypress="return hanyaAngka(event)" placeholder="Enter ID card number"
                            value="<?php echo $hasil['ktp_nomor']; ?>" name="ktp_nomor" disabled>
                    </div>
                    <label class="control-label col-sm-2" for="ktp_nama">Full Name </label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="ktp_nama" placeholder="Enter Full Name"
                            value="<?php echo $hasil['ktp_nama']; ?>" name="ktp_nama" required>
                    </div>
                </div>


                <div class="form-group row">
                    <label class="control-label col-sm-2" for="ktp_tempat_lahir">Place of birth </label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="ktp_tempat_lahir" placeholder="Enter Place of birth"
                            value="<?php echo $hasil['ktp_tempat_lahir']; ?>" name="ktp_tempat_lahir" required>
                    </div>
                    <label class="control-label col-sm-2" for="ktp_tanggal_lahir">Date of birth </label>
                    <div class="col-sm-4">
                        <input type="date" class="form-control" id="ktp_tanggal_lahir" name="ktp_tanggal_lahir"
                            value="<?php echo $hasil['ktp_tanggal_lahir']; ?>" required>
                    </div>
                </div>


                <div class="form-group row">
                    <label class="control-label col-sm-2" for="ktp_kelamin">Gender </label>
                    <div class="col-sm-4">
                        <select class="form-control" name="ktp_kelamin" id="ktp_kelamin" required>
                            <option value="<?php echo $hasil['ktp_kelamin']; ?>" selected>
                                <?php echo $hasil['ktp_kelamin']; ?></option>
                            <option></option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <label class="control-label col-sm-2" for="ktp_gol_darah">Blood group </label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="ktp_gol_darah" name="ktp_gol_darah"
                            value="<?php echo $hasil['ktp_gol_darah']; ?>" required>
                    </div>
                </div>


                <div class="form-group row">
                    <label class="control-label col-sm-2" for="ktp_alamat">ID card address </label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="ktp_alamat" placeholder="Enter ID card address"
                            value="<?php echo $hasil['ktp_alamat']; ?>" name="ktp_alamat" required>
                    </div>
                    <label class="control-label col-sm-2" for="ktp_rt">RT / RW </label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="ktp_rt" maxlength="3"
                            onkeypress="return hanyaAngka(event)" placeholder="Enter RT"
                            value="<?php echo $hasil['ktp_rt']; ?>" name="ktp_rt" required>
                    </div>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="ktp_rw" maxlength="3"
                            onkeypress="return hanyaAngka(event)" placeholder="Enter RW"
                            value="<?php echo $hasil['ktp_rw']; ?>" name="ktp_rw" required>
                    </div>
                </div>


                <div class="form-group row">
                    <label class="control-label col-sm-2"
                        for="biodata_propinsi">Province-<?php echo $hasil['ktp_propinsi']; ?> </label>
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
                        for="biodata_kabupaten">City-<?php echo $hasil['ktp_kabupaten']; ?> </label>
                    <div class="col-sm-4">
                        <div class="biodata_kabupaten"></div>
                    </div>
                </div>


                <div class="form-group row">
                    <label class="control-label col-sm-2"
                        for="biodata_kecamatan">Districts-<?php echo $hasil['ktp_kecamatan']; ?></label>
                    <div class="col-sm-4">
                        <div class="biodata_kecamatan"></div>
                    </div>
                    <label class="control-label col-sm-2"
                        for="biodata_kelurahan">Village-<?php echo $hasil['ktp_kelurahan']; ?> </label>
                    <div class="col-sm-4">
                        <div class="biodata_kelurahan"></div>
                    </div>
                </div>


                <div class="form-group row">
                    <label class="control-label col-sm-2" for="biodata_kodepos">Portal
                        code-<?php echo $hasil['ktp_kodepos']; ?> </label>
                    <div class="col-sm-4">
                        <div class="biodata_kodepos"></div>
                    </div>
                </div>


                <div class="form-group row">
                    <label class="control-label col-sm-2" for="ktp_agama">Religion </label>
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
                    <label class="control-label col-sm-2" for="ktp_status">Marital status </label>
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


                <div class="form-group row">
                    <label class="control-label col-sm-2" for="ktp_kewarganegaraan">Citizenship </label>
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
                <button type="submit" class="btn btn-info btn-sm">Submit</button>
                <a href="home_admin.php?page=residence_address_edit&ktp_nomor=<?php echo $ktp_nomor; ?>"><button
                        type="button" class="btn btn-secondary btn-sm">Next</button></a>
            </div>

        </form>

    </div>


    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>ID card</th>
                    <th>Name</th>
                    <th>Place / Date of birth</th>
                    <th>Gender</th>
                    <th>Blood</th>
                    <th>Religion</th>
                    <th>Marital status</th>
                    <th>Address</th>
                    <th>Citizenship</th>
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

</body>

</html>