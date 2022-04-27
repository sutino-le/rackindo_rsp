<?php
$upah_tahun = $_GET['upah_tahun'];
$ump = mysql_query("SELECT * FROM upah WHERE upah_tahun='$upah_tahun' ");
$v_ump = mysql_fetch_array($ump);
?>
<div class="w3-modal-content w3-animate-top w3-card-4">
    <header class="w3-container w3-teal">
        <span onclick="document.getElementById('id01').style.display='none'"
            class="w3-button w3-display-topright">&times;</span>
        <h3>Edit Data Upah</h3>
    </header>
    <form action="home_admin.php?page=ump_edit_process" method="POST">
        <input type="hidden" name="upah_tahun_lama" id="upah_tahun_lama" value="<?php echo $upah_tahun; ?>">

        <div class="w3-container">
            <br>
            <div class="form-group">
                Tahun
                <select class="form-control" name="upah_tahun" required>
                    <option value="<?php echo $v_ump['upah_tahun']; ?>" selected><?php echo $v_ump['upah_tahun']; ?>
                    </option>
                    <option value=""></option>
                    <?php
                    for ($end = date('Y'); $end >= date('Y') - 70; $end -= 1) {
                        echo "<option value='$end'> $end </option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                Jumlah
                <input type="text" class="form-control" name="upah_jumlah" id="upah_jumlah"
                    onkeypress="return hanyaAngka(event)" placeholder="Jumlah Upah"
                    value="<?php echo $v_ump['upah_jumlah']; ?>" required>
            </div>
            <div class="form-group">
                Wilayah
                <select name="upah_wilayah" class="form-control" required>
                    <option value="<?php echo $v_ump['upah_wilayah']; ?>" selected><?php echo $v_ump['upah_wilayah']; ?>
                    </option>
                    <option value=""></option>
                    <?php
                    $kota = mysql_query("SELECT *  FROM data_wilayah GROUP BY propinsi ASC");
                    while ($v_kota = mysql_fetch_array($kota)) {
                    ?>
                    <option value="<?php echo $v_kota['propinsi']; ?>">
                        <?php echo $v_kota['propinsi']; ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <footer class="w3-container w3-teal">
            <br>
            <button type="submit" class="btn btn-info btn-sm">Simpan</button>
            <a href="home_admin.php?page=ump_view"><button type="button"
                    class="btn btn-secondary btn-sm">Kembali</button></a>
            <br>
            <br>
        </footer>
    </form>
</div>