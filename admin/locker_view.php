<style>
.myDiv {
    margin: auto;
    height: 80px;
    border: 5px outset #F0FFFF;
    background-color: #66CDAA;
    text-align: center;
    padding: 10px;
}

.myDiva {
    margin: auto;
    height: 80px;
    border: 5px outset #F0FFFF;
    background-color: #FF8C00;
    text-align: center;
    font-weight: bold;
}

.myDivatas {
    margin: auto;
    border: 5px outset #F0FFFF;
    background-color: #20B2AA;
    text-align: center;
    font-weight: bold;
}
</style>

<?php

if (isset($_POST)) {
    $loker_lemari = $_POST['loker_lemari'];
} else {
    $loker_lemari = "";
}

$locker = mysql_query("SELECT * FROM loker GROUP BY loker_lemari ASC ");
?>
<div class="div-container">

    <div class="div-container-fluid">
        <form class="form-horizontal" action="" method="post">

            <div class="form-group">
                <div class="form-row">
                    <label class="control-label col-sm-2" for="keluar_barang">Select Locker</label>
                    <div class="col-sm-4">
                        <select class="form-control" name="loker_lemari" id="loker_lemari">
                            <option value="">Select Locker</option>
                            <option value=""></option>
                            <?php
                            while ($v_loker = mysql_fetch_array($locker)) {
                            ?>
                            <option value="<?php echo $v_loker['loker_lemari']; ?>">
                                <?php echo $v_loker['loker_lemari']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <button type="submit" class="btn btn-primary btn-sm-2"><i class='fas fa-search'></i></button>
                    </div>
                </div>
            </div>

        </form>
    </div>

    <div class="row col-12">
        <div class="myDivatas div-col col-12 text-center">
            Locker : <?php echo $loker_lemari; ?>
        </div>
    </div>
    <div class="row col-12">
        <?php
        $tampilkan_locker = mysql_query("SELECT * FROM loker WHERE loker_lemari='$loker_lemari' ORDER BY loker_lemari, loker_id ASC ");
        while ($v_tampilkan_locker = mysql_fetch_array($tampilkan_locker)) {
            $loker_id = $v_tampilkan_locker['loker_id'];
            $loker_karyawan = mysql_query("SELECT * FROM karyawan JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor JOIN bagian ON karyawan.karyawan_bagian=bagian.bagian_id JOIN jabatan ON karyawan.karyawan_jabatan=jabatan.jabatan_id WHERE karyawan_loker='$loker_id' ");
            $v_loker_karyawan = mysql_fetch_array($loker_karyawan);
            if (empty($v_loker_karyawan)) {
                $status = sprintf("%03d", $v_tampilkan_locker['loker_nomor']) . "<br>" . "Free";

        ?>
        <div class="myDiv col col-4">
            <?php echo $status; ?>
        </div>
        <?php
            } else {
                $status = sprintf("%03d", $v_tampilkan_locker['loker_nomor']) . "<br>" . $v_loker_karyawan['ktp_nama'] . "<br>" . $v_loker_karyawan['jabatan_nama'] . " - " . $v_loker_karyawan['bagian_nama'];

            ?>
        <div class="myDiva col col-4">
            <?php echo $status; ?>
        </div>
        <?php
            }
        }
        ?>
    </div>

</div>