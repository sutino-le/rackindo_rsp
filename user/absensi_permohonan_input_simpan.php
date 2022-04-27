<?php
include("koneksi.php");

$jumlah_izin = addslashes($_POST['jumlah_izin']);
$absen_izin_nomor = addslashes($_POST['absen_izin_nomor']);
$absen_izin_tanggal_buat = addslashes($_POST['absen_izin_tanggal_buat']);
$absen_izin_pin = addslashes($_POST['absen_izin_pin']);
$absen_izin_keterangan = addslashes($_POST['absen_izin_keterangan']);
$absen_izin_spv = addslashes($_POST['absen_izin_spv']);

$absen_izin_tahun = date("Y", strtotime($absen_izin_tanggal_buat));

if ($jumlah_izin == 1) {
    $absen_izin_tanggal1a = $_POST['absen_izin_tanggal1a'];
    $absen_izin_jenis1a = $_POST['absen_izin_jenis1a'];

    $input1 = mysql_query("INSERT INTO absen_izin VALUES('', '$absen_izin_nomor', '$absen_izin_tanggal_buat', '$absen_izin_pin', '$absen_izin_tanggal1a', '$absen_izin_jenis1a', '$absen_izin_keterangan', '$absen_izin_tahun', '$absen_izin_spv' )");

    if ($input1) {
?>
<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Permohonan berhasil diinput...!!!',
        type: 'success',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=absensi_permohonan_input';
}, 1000);
</script>
<?php
    } else {
    ?>
<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Oooopppsssss......!!!! Permohonan gagal diinput..!!!',
        type: 'error',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=absensi_permohonan_input';
}, 1000);
</script>
<?php
    }
} else if ($jumlah_izin == 2) {
    $absen_izin_tanggal1a = $_POST['absen_izin_tanggal1a'];
    $absen_izin_tanggal2a = $_POST['absen_izin_tanggal2a'];

    $absen_izin_jenis1a = $_POST['absen_izin_jenis1a'];
    $absen_izin_jenis2a = $_POST['absen_izin_jenis2a'];

    $input1 = mysql_query("INSERT INTO absen_izin VALUES('', '$absen_izin_nomor', '$absen_izin_tanggal_buat', '$absen_izin_pin', '$absen_izin_tanggal1a', '$absen_izin_jenis1a', '$absen_izin_keterangan', '$absen_izin_tahun', '$absen_izin_spv' )");
    $input2 = mysql_query("INSERT INTO absen_izin VALUES('', '$absen_izin_nomor', '$absen_izin_tanggal_buat', '$absen_izin_pin', '$absen_izin_tanggal2a', '$absen_izin_jenis2a', '$absen_izin_keterangan', '$absen_izin_tahun', '$absen_izin_spv' )");

    if ($input1) {
    ?>
<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Permohonan berhasil diinput...!!!',
        type: 'success',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=absensi_permohonan_input';
}, 1000);
</script>
<?php
    } else {
    ?>
<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Oooopppsssss......!!!! Permohonan gagal diinput..!!!',
        type: 'error',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=absensi_permohonan_input';
}, 1000);
</script>
<?php
    }
} else if ($jumlah_izin == 3) {
    $absen_izin_tanggal1a = $_POST['absen_izin_tanggal1a'];
    $absen_izin_tanggal2a = $_POST['absen_izin_tanggal2a'];
    $absen_izin_tanggal3a = $_POST['absen_izin_tanggal3a'];

    $absen_izin_jenis1a = $_POST['absen_izin_jenis1a'];
    $absen_izin_jenis2a = $_POST['absen_izin_jenis2a'];
    $absen_izin_jenis3a = $_POST['absen_izin_jenis3a'];

    $input1 = mysql_query("INSERT INTO absen_izin VALUES('', '$absen_izin_nomor', '$absen_izin_tanggal_buat', '$absen_izin_pin', '$absen_izin_tanggal1a', '$absen_izin_jenis1a', '$absen_izin_keterangan', '$absen_izin_tahun', '$absen_izin_spv' )");
    $input2 = mysql_query("INSERT INTO absen_izin VALUES('', '$absen_izin_nomor', '$absen_izin_tanggal_buat', '$absen_izin_pin', '$absen_izin_tanggal2a', '$absen_izin_jenis2a', '$absen_izin_keterangan', '$absen_izin_tahun', '$absen_izin_spv' )");
    $input3 = mysql_query("INSERT INTO absen_izin VALUES('', '$absen_izin_nomor', '$absen_izin_tanggal_buat', '$absen_izin_pin', '$absen_izin_tanggal3a', '$absen_izin_jenis3a', '$absen_izin_keterangan', '$absen_izin_tahun', '$absen_izin_spv' )");

    if ($input1) {
    ?>
<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Permohonan berhasil diinput...!!!',
        type: 'success',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=absensi_permohonan_input';
}, 1000);
</script>
<?php
    } else {
    ?>
<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Oooopppsssss......!!!! Permohonan gagal diinput..!!!',
        type: 'error',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=absensi_permohonan_input';
}, 1000);
</script>
<?php
    }
} else if ($jumlah_izin == 4) {
    $absen_izin_tanggal1a = $_POST['absen_izin_tanggal1a'];
    $absen_izin_tanggal2a = $_POST['absen_izin_tanggal2a'];
    $absen_izin_tanggal3a = $_POST['absen_izin_tanggal3a'];
    $absen_izin_tanggal4a = $_POST['absen_izin_tanggal4a'];

    $absen_izin_jenis1a = $_POST['absen_izin_jenis1a'];
    $absen_izin_jenis2a = $_POST['absen_izin_jenis2a'];
    $absen_izin_jenis3a = $_POST['absen_izin_jenis3a'];
    $absen_izin_jenis4a = $_POST['absen_izin_jenis4a'];

    $input1 = mysql_query("INSERT INTO absen_izin VALUES('', '$absen_izin_nomor', '$absen_izin_tanggal_buat', '$absen_izin_pin', '$absen_izin_tanggal1a', '$absen_izin_jenis1a', '$absen_izin_keterangan', '$absen_izin_tahun', '$absen_izin_spv' )");
    $input2 = mysql_query("INSERT INTO absen_izin VALUES('', '$absen_izin_nomor', '$absen_izin_tanggal_buat', '$absen_izin_pin', '$absen_izin_tanggal2a', '$absen_izin_jenis2a', '$absen_izin_keterangan', '$absen_izin_tahun', '$absen_izin_spv' )");
    $input3 = mysql_query("INSERT INTO absen_izin VALUES('', '$absen_izin_nomor', '$absen_izin_tanggal_buat', '$absen_izin_pin', '$absen_izin_tanggal3a', '$absen_izin_jenis3a', '$absen_izin_keterangan', '$absen_izin_tahun', '$absen_izin_spv' )");
    $input4 = mysql_query("INSERT INTO absen_izin VALUES('', '$absen_izin_nomor', '$absen_izin_tanggal_buat', '$absen_izin_pin', '$absen_izin_tanggal4a', '$absen_izin_jenis4a',  '$absen_izin_keterangan', '$absen_izin_tahun', '$absen_izin_spv' )");

    if ($input1) {
    ?>
<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Permohonan berhasil diinput...!!!',
        type: 'success',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=absensi_permohonan_input';
}, 1000);
</script>
<?php
    } else {
    ?>
<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Oooopppsssss......!!!! Permohonan gagal diinput..!!!',
        type: 'error',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=absensi_permohonan_input';
}, 1000);
</script>
<?php
    }
} else if ($jumlah_izin == 5) {
    $absen_izin_tanggal1a = $_POST['absen_izin_tanggal1a'];
    $absen_izin_tanggal2a = $_POST['absen_izin_tanggal2a'];
    $absen_izin_tanggal3a = $_POST['absen_izin_tanggal3a'];
    $absen_izin_tanggal4a = $_POST['absen_izin_tanggal4a'];
    $absen_izin_tanggal5a = $_POST['absen_izin_tanggal5a'];

    $absen_izin_jenis1a = $_POST['absen_izin_jenis1a'];
    $absen_izin_jenis2a = $_POST['absen_izin_jenis2a'];
    $absen_izin_jenis3a = $_POST['absen_izin_jenis3a'];
    $absen_izin_jenis4a = $_POST['absen_izin_jenis4a'];
    $absen_izin_jenis5a = $_POST['absen_izin_jenis5a'];

    $input1 = mysql_query("INSERT INTO absen_izin VALUES('', '$absen_izin_nomor', '$absen_izin_tanggal_buat', '$absen_izin_pin', '$absen_izin_tanggal1a', '$absen_izin_jenis1a', '$absen_izin_keterangan', '$absen_izin_tahun', '$absen_izin_spv' )");
    $input2 = mysql_query("INSERT INTO absen_izin VALUES('', '$absen_izin_nomor', '$absen_izin_tanggal_buat', '$absen_izin_pin', '$absen_izin_tanggal2a', '$absen_izin_jenis2a', '$absen_izin_keterangan', '$absen_izin_tahun', '$absen_izin_spv' )");
    $input3 = mysql_query("INSERT INTO absen_izin VALUES('', '$absen_izin_nomor', '$absen_izin_tanggal_buat', '$absen_izin_pin', '$absen_izin_tanggal3a', '$absen_izin_jenis3a', '$absen_izin_keterangan', '$absen_izin_tahun', '$absen_izin_spv' )");
    $input4 = mysql_query("INSERT INTO absen_izin VALUES('', '$absen_izin_nomor', '$absen_izin_tanggal_buat', '$absen_izin_pin', '$absen_izin_tanggal4a', '$absen_izin_jenis4a',  '$absen_izin_keterangan', '$absen_izin_tahun', '$absen_izin_spv' )");
    $input5 = mysql_query("INSERT INTO absen_izin VALUES('', '$absen_izin_nomor', '$absen_izin_tanggal_buat', '$absen_izin_pin', '$absen_izin_tanggal5a', '$absen_izin_jenis5a',  '$absen_izin_keterangan', '$absen_izin_tahun', '$absen_izin_spv' )");

    if ($input1) {
    ?>
<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Permohonan berhasil diinput...!!!',
        type: 'success',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=absensi_permohonan_input';
}, 1000);
</script>
<?php
    } else {
    ?>
<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Oooopppsssss......!!!! Permohonan gagal diinput..!!!',
        type: 'error',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=absensi_permohonan_input';
}, 1000);
</script>
<?php
    }
} else if ($jumlah_izin == 6) {
    $absen_izin_tanggal1a = $_POST['absen_izin_tanggal1a'];
    $absen_izin_tanggal2a = $_POST['absen_izin_tanggal2a'];
    $absen_izin_tanggal3a = $_POST['absen_izin_tanggal3a'];
    $absen_izin_tanggal4a = $_POST['absen_izin_tanggal4a'];
    $absen_izin_tanggal5a = $_POST['absen_izin_tanggal5a'];
    $absen_izin_tanggal6a = $_POST['absen_izin_tanggal6a'];

    $absen_izin_jenis1a = $_POST['absen_izin_jenis1a'];
    $absen_izin_jenis2a = $_POST['absen_izin_jenis2a'];
    $absen_izin_jenis3a = $_POST['absen_izin_jenis3a'];
    $absen_izin_jenis4a = $_POST['absen_izin_jenis4a'];
    $absen_izin_jenis5a = $_POST['absen_izin_jenis5a'];
    $absen_izin_jenis6a = $_POST['absen_izin_jenis6a'];

    $input1 = mysql_query("INSERT INTO absen_izin VALUES('', '$absen_izin_nomor', '$absen_izin_tanggal_buat', '$absen_izin_pin', '$absen_izin_tanggal1a', '$absen_izin_jenis1a', '$absen_izin_keterangan', '$absen_izin_tahun', '$absen_izin_spv' )");
    $input2 = mysql_query("INSERT INTO absen_izin VALUES('', '$absen_izin_nomor', '$absen_izin_tanggal_buat', '$absen_izin_pin', '$absen_izin_tanggal2a', '$absen_izin_jenis2a', '$absen_izin_keterangan', '$absen_izin_tahun', '$absen_izin_spv' )");
    $input3 = mysql_query("INSERT INTO absen_izin VALUES('', '$absen_izin_nomor', '$absen_izin_tanggal_buat', '$absen_izin_pin', '$absen_izin_tanggal3a', '$absen_izin_jenis3a', '$absen_izin_keterangan', '$absen_izin_tahun', '$absen_izin_spv' )");
    $input4 = mysql_query("INSERT INTO absen_izin VALUES('', '$absen_izin_nomor', '$absen_izin_tanggal_buat', '$absen_izin_pin', '$absen_izin_tanggal4a', '$absen_izin_jenis4a',  '$absen_izin_keterangan', '$absen_izin_tahun', '$absen_izin_spv' )");
    $input5 = mysql_query("INSERT INTO absen_izin VALUES('', '$absen_izin_nomor', '$absen_izin_tanggal_buat', '$absen_izin_pin', '$absen_izin_tanggal5a', '$absen_izin_jenis5a',  '$absen_izin_keterangan', '$absen_izin_tahun', '$absen_izin_spv' )");
    $input6 = mysql_query("INSERT INTO absen_izin VALUES('', '$absen_izin_nomor', '$absen_izin_tanggal_buat', '$absen_izin_pin', '$absen_izin_tanggal6a', '$absen_izin_jenis6a',  '$absen_izin_keterangan', '$absen_izin_tahun', '$absen_izin_spv' )");

    if ($input1) {
    ?>
<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Permohonan berhasil diinput...!!!',
        type: 'success',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=absensi_permohonan_input';
}, 1000);
</script>
<?php
    } else {
    ?>
<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Oooopppsssss......!!!! Permohonan gagal diinput..!!!',
        type: 'error',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=absensi_permohonan_input';
}, 1000);
</script>
<?php
    }
} else if ($jumlah_izin == 7) {
    $absen_izin_tanggal1a = $_POST['absen_izin_tanggal1a'];
    $absen_izin_tanggal2a = $_POST['absen_izin_tanggal2a'];
    $absen_izin_tanggal3a = $_POST['absen_izin_tanggal3a'];
    $absen_izin_tanggal4a = $_POST['absen_izin_tanggal4a'];
    $absen_izin_tanggal5a = $_POST['absen_izin_tanggal5a'];
    $absen_izin_tanggal6a = $_POST['absen_izin_tanggal6a'];
    $absen_izin_tanggal7a = $_POST['absen_izin_tanggal7a'];

    $absen_izin_jenis1a = $_POST['absen_izin_jenis1a'];
    $absen_izin_jenis2a = $_POST['absen_izin_jenis2a'];
    $absen_izin_jenis3a = $_POST['absen_izin_jenis3a'];
    $absen_izin_jenis4a = $_POST['absen_izin_jenis4a'];
    $absen_izin_jenis5a = $_POST['absen_izin_jenis5a'];
    $absen_izin_jenis6a = $_POST['absen_izin_jenis6a'];
    $absen_izin_jenis7a = $_POST['absen_izin_jenis7a'];

    $input1 = mysql_query("INSERT INTO absen_izin VALUES('', '$absen_izin_nomor', '$absen_izin_tanggal_buat', '$absen_izin_pin', '$absen_izin_tanggal1a', '$absen_izin_jenis1a', '$absen_izin_keterangan', '$absen_izin_tahun', '$absen_izin_spv' )");
    $input2 = mysql_query("INSERT INTO absen_izin VALUES('', '$absen_izin_nomor', '$absen_izin_tanggal_buat', '$absen_izin_pin', '$absen_izin_tanggal2a', '$absen_izin_jenis2a', '$absen_izin_keterangan', '$absen_izin_tahun', '$absen_izin_spv' )");
    $input3 = mysql_query("INSERT INTO absen_izin VALUES('', '$absen_izin_nomor', '$absen_izin_tanggal_buat', '$absen_izin_pin', '$absen_izin_tanggal3a', '$absen_izin_jenis3a', '$absen_izin_keterangan', '$absen_izin_tahun', '$absen_izin_spv' )");
    $input4 = mysql_query("INSERT INTO absen_izin VALUES('', '$absen_izin_nomor', '$absen_izin_tanggal_buat', '$absen_izin_pin', '$absen_izin_tanggal4a', '$absen_izin_jenis4a',  '$absen_izin_keterangan', '$absen_izin_tahun', '$absen_izin_spv' )");
    $input5 = mysql_query("INSERT INTO absen_izin VALUES('', '$absen_izin_nomor', '$absen_izin_tanggal_buat', '$absen_izin_pin', '$absen_izin_tanggal5a', '$absen_izin_jenis5a',  '$absen_izin_keterangan', '$absen_izin_tahun', '$absen_izin_spv' )");
    $input6 = mysql_query("INSERT INTO absen_izin VALUES('', '$absen_izin_nomor', '$absen_izin_tanggal_buat', '$absen_izin_pin', '$absen_izin_tanggal6a', '$absen_izin_jenis6a',  '$absen_izin_keterangan', '$absen_izin_tahun', '$absen_izin_spv' )");
    $input7 = mysql_query("INSERT INTO absen_izin VALUES('', '$absen_izin_nomor', '$absen_izin_tanggal_buat', '$absen_izin_pin', '$absen_izin_tanggal7a', '$absen_izin_jenis7a',  '$absen_izin_keterangan', '$absen_izin_tahun', '$absen_izin_spv' )");

    if ($input1) {
    ?>
<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Permohonan berhasil diinput...!!!',
        type: 'success',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=absensi_permohonan_input';
}, 1000);
</script>
<?php
    } else {
    ?>
<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Oooopppsssss......!!!! Permohonan gagal diinput..!!!',
        type: 'error',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=absensi_permohonan_input';
}, 1000);
</script>
<?php
    }
} else if ($jumlah_izin == 8) {
    $absen_izin_tanggal1a = $_POST['absen_izin_tanggal1a'];
    $absen_izin_tanggal2a = $_POST['absen_izin_tanggal2a'];
    $absen_izin_tanggal3a = $_POST['absen_izin_tanggal3a'];
    $absen_izin_tanggal4a = $_POST['absen_izin_tanggal4a'];
    $absen_izin_tanggal5a = $_POST['absen_izin_tanggal5a'];
    $absen_izin_tanggal6a = $_POST['absen_izin_tanggal6a'];
    $absen_izin_tanggal7a = $_POST['absen_izin_tanggal7a'];
    $absen_izin_tanggal8a = $_POST['absen_izin_tanggal8a'];

    $absen_izin_jenis1a = $_POST['absen_izin_jenis1a'];
    $absen_izin_jenis2a = $_POST['absen_izin_jenis2a'];
    $absen_izin_jenis3a = $_POST['absen_izin_jenis3a'];
    $absen_izin_jenis4a = $_POST['absen_izin_jenis4a'];
    $absen_izin_jenis5a = $_POST['absen_izin_jenis5a'];
    $absen_izin_jenis6a = $_POST['absen_izin_jenis6a'];
    $absen_izin_jenis7a = $_POST['absen_izin_jenis7a'];
    $absen_izin_jenis8a = $_POST['absen_izin_jenis8a'];

    $input1 = mysql_query("INSERT INTO absen_izin VALUES('', '$absen_izin_nomor', '$absen_izin_tanggal_buat', '$absen_izin_pin', '$absen_izin_tanggal1a', '$absen_izin_jenis1a', '$absen_izin_keterangan', '$absen_izin_tahun', '$absen_izin_spv' )");
    $input2 = mysql_query("INSERT INTO absen_izin VALUES('', '$absen_izin_nomor', '$absen_izin_tanggal_buat', '$absen_izin_pin', '$absen_izin_tanggal2a', '$absen_izin_jenis2a', '$absen_izin_keterangan', '$absen_izin_tahun', '$absen_izin_spv' )");
    $input3 = mysql_query("INSERT INTO absen_izin VALUES('', '$absen_izin_nomor', '$absen_izin_tanggal_buat', '$absen_izin_pin', '$absen_izin_tanggal3a', '$absen_izin_jenis3a', '$absen_izin_keterangan', '$absen_izin_tahun', '$absen_izin_spv' )");
    $input4 = mysql_query("INSERT INTO absen_izin VALUES('', '$absen_izin_nomor', '$absen_izin_tanggal_buat', '$absen_izin_pin', '$absen_izin_tanggal4a', '$absen_izin_jenis4a',  '$absen_izin_keterangan', '$absen_izin_tahun', '$absen_izin_spv' )");
    $input5 = mysql_query("INSERT INTO absen_izin VALUES('', '$absen_izin_nomor', '$absen_izin_tanggal_buat', '$absen_izin_pin', '$absen_izin_tanggal5a', '$absen_izin_jenis5a',  '$absen_izin_keterangan', '$absen_izin_tahun', '$absen_izin_spv' )");
    $input6 = mysql_query("INSERT INTO absen_izin VALUES('', '$absen_izin_nomor', '$absen_izin_tanggal_buat', '$absen_izin_pin', '$absen_izin_tanggal6a', '$absen_izin_jenis6a',  '$absen_izin_keterangan', '$absen_izin_tahun', '$absen_izin_spv' )");
    $input7 = mysql_query("INSERT INTO absen_izin VALUES('', '$absen_izin_nomor', '$absen_izin_tanggal_buat', '$absen_izin_pin', '$absen_izin_tanggal7a', '$absen_izin_jenis7a',  '$absen_izin_keterangan', '$absen_izin_tahun', '$absen_izin_spv' )");
    $input8 = mysql_query("INSERT INTO absen_izin VALUES('', '$absen_izin_nomor', '$absen_izin_tanggal_buat', '$absen_izin_pin', '$absen_izin_tanggal8a', '$absen_izin_jenis8a',  '$absen_izin_keterangan', '$absen_izin_tahun', '$absen_izin_spv' )");

    if ($input1) {
    ?>
<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Permohonan berhasil diinput...!!!',
        type: 'success',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=absensi_permohonan_input';
}, 1000);
</script>
<?php
    } else {
    ?>
<script type='text/javascript'>
setTimeout(function() {
    swal({
        title: 'Oooopppsssss......!!!! Permohonan gagal diinput..!!!',
        type: 'error',
        timer: 1000,
        showConfirmButton: true
    });
}, 10);
window.setTimeout(function() {
    document.location = 'home_admin.php?page=absensi_permohonan_input';
}, 1000);
</script>
<?php
    }
}
?>