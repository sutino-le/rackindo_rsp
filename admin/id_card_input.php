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

    <!-- /.card -->
    <!-- Horizontal Form -->
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Input ID Card</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form class="form-horizontal" action="home_admin.php?page=id_card_input_process" method="post">
            <div class="card-body">

                <div class="form-group row">
                    <label for="ktp_nomor" class="col-sm-2 col-form-label">ID card number</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="ktp_nomor" id="ktp_nomor" maxlength="16" minlength="16" onkeypress="return hanyaAngka(event)" placeholder="ID card number" required>
                    </div>
                    <label for="ktp_nama" class="col-sm-2 col-form-label">Full name</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="ktp_nama" id="ktp_nama" placeholder="Full name" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="ktp_tempat_lahir" class="col-sm-2 col-form-label">Place of birth</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="ktp_tempat_lahir" id="ktp_tempat_lahir" placeholder="Place of birth" required>
                    </div>
                    <label for="ktp_tanggal_lahir" class="col-sm-2 col-form-label">Date of birth</label>
                    <div class="col-sm-4">
                        <input type="date" class="form-control" name="ktp_tanggal_lahir" id="ktp_tanggal_lahir" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="ktp_jenis_kelamin" class="col-sm-2 col-form-label">Gender</label>
                    <div class="col-sm-4">
                        <select class="form-control" name="ktp_kelamin" id="ktp_kelamin" required>
                            <option value="" selected>Select Gender</option>
                            <option></option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <label for="ktp_gol_darah" class="col-sm-2 col-form-label">Blood group</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="ktp_gol_darah" id="ktp_gol_darah" placeholder="Blood group">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="ktp_alamat" class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="ktp_alamat" id="ktp_alamat" placeholder="Address" required>
                    </div>
                    <label for="RT/RW" class="col-sm-2 col-form-label">RT/RW</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="ktp_rt" id="ktp_rt" maxlength="3" onkeypress="return hanyaAngka(event)" placeholder="RT" required>
                    </div>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="ktp_rw" id="ktp_rw" maxlength="3" onkeypress="return hanyaAngka(event)" placeholder="RW" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label col-sm-2" for="biodata_propinsi">Province :</label>
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
                    <label class="control-label col-sm-2" for="biodata_kabupaten">City :</label>
                    <div class="col-sm-4">
                        <div class="biodata_kabupaten"></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label col-sm-2" for="biodata_kecamatan">District :</label>
                    <div class="col-sm-4">
                        <div class="biodata_kecamatan"></div>
                    </div>
                    <label class="control-label col-sm-2" for="biodata_kelurahan">Village :</label>
                    <div class="col-sm-4">
                        <div class="biodata_kelurahan"></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label col-sm-2" for="biodata_kodepos">Postal code :</label>
                    <div class="col-sm-4">
                        <div class="biodata_kodepos"></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label col-sm-2" for="ktp_agama">Religion :</label>
                    <div class="col-sm-4">
                        <select class="form-control" name="ktp_agama" id="ktp_agama" required>
                            <option value="" selected>Choose Religion</option>
                            <option></option>
                            <option value="Islam">Islam</option>
                            <option value="Kristen Protestan">Kristen Protestan</option>
                            <option value="Katolik">Katolik</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Buddha">Buddha</option>
                            <option value="Kong Hu Cu">Kong Hu Cu</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    <label class="control-label col-sm-2" for="ktp_status">Marital status :</label>
                    <div class="col-sm-4">
                        <select class="form-control" name="ktp_status" id="ktp_status" required>
                            <option value="" selected>Choose Marital Status</option>
                            <option></option>
                            <option value="Belum Kawin">Belum Kawin</option>
                            <option value="Kawin">Kawin</option>
                            <option value="Cerai">Cerai</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label col-sm-2" for="ktp_kewarganegaraan">Citizenship :</label>
                    <div class="col-sm-4">
                        <select class="form-control" name="ktp_kewarganegaraan" id="ktp_kewarganegaraan" required>
                            <option value="" selected>Choose Nationality</option>
                            <option></option>
                            <option value="WNI" selected>WNI</option>
                            <option value="WNA">WNA</option>
                        </select>
                    </div>
                </div>


            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-info btn-sm">Submit</button>
                <a href="home_admin.php?page=id_card_information"><button type="button" class="btn btn-secondary btn-sm">Back</button></a>
            </div>
            <!-- /.card-footer -->
        </form>
    </div>
    <!-- /.card -->