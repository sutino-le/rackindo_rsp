<?php
include("koneksi.php");

$ktp_nomor = $_GET['ktp_nomor'];

$query_ktp = mysql_query("SELECT * FROM biodata_ktp WHERE ktp_nomor='$ktp_nomor' ");
$hasil_ktp = mysql_fetch_array($query_ktp);
$ktp_nama = $hasil_ktp['ktp_nama'];

//user
$user = mysql_query("SELECT * FROM user WHERE user_ktp='$ktp_nomor'  ");
$v_user = mysql_fetch_array($user);
$user_hp = $v_user['user_hp'];
$user_email = $v_user['user_email'];
$user_password = $v_user['user_password'];

$query_user = mysql_query("SELECT * FROM user WHERE user_ktp='$ktp_nomor'  ");


?>


<div class="card card-info">
    <div class="card-header">
        <h4 class="card-title">Data Akun</h4>
        <p>
            <font color="red">* Lengkapi data Akun sesuai dengan nomor Hp dan email yang masih aktif. Jika foto tidak
                tampil, kirimkan foto terbaru ke bagian HRD.</font>
        </p>
    </div>
    <form class="form-horizontal" action="home_admin.php?page=user_edit_process" method="post">

        <div class=" card-body">

            <div class="form-group row m-2">
                <label class="control-label col-sm-2" for="user_ktp">Nomor KTP</label>
                <div class="col-sm-4">
                    <input type="hidden" name="user_ktp" value="<?php echo $ktp_nomor; ?>" required>

                    <input type="text" class="form-control" id="user_ktp" maxlength="16" minlength="16"
                        onkeypress="return hanyaAngka(event)" placeholder="Masukan Nomor KTP"
                        value="<?php echo $ktp_nomor; ?>" name="user_ktp" disabled>
                </div>
                <label class="control-label col-sm-2" for="ktp_nama">Nama Lengkap</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="ktp_nama" placeholder="Masukan Nama Lengkap"
                        value="<?php echo $ktp_nama; ?>" name="ktp_nama" disabled>
                </div>
            </div>

            <div class="form-group row m-2">
                <label class="control-label col-sm-2" for="user_hp">Nomor HP</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="user_hp" placeholder="Masukan Nomor HP +628xxx"
                        name="user_hp" value="<?php echo $user_hp; ?>" required>
                </div>
                <label class="control-label col-sm-2" for="user_email">Email </label>
                <div class="col-sm-4">
                    <input type="email" class="form-control" id="user_email" placeholder="Masukan Email"
                        name="user_email" value="<?php echo $user_email; ?>" required>
                </div>
            </div>

            <div class="form-group row m-2">
                <label class="control-label col-sm-2" for="user_password">Kata Sandi</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="user_password" placeholder="Masukan Kata Sandi"
                        value="<?php echo $user_password; ?>" name="user_password" required>
                </div>
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-info btn-sm">Simpan</button>
            <a href="home_admin.php?page=npwp_edit&ktp_nomor=<?php echo $ktp_nomor; ?>"><button type="button"
                    class="btn btn-secondary btn-sm"><i class="fas fa-backward"></i>
                    Sebelumnya</button></a>
            <a href="home_admin.php"><button type="button" class="btn btn-primary btn-sm">Selesai <i
                        class="far fa-check-circle"></i></button></a>
        </div>

    </form>

</div>




<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nomor KTP</th>
                <th>Nama Lengkap</th>
                <th>Nomor HP</th>
                <th>Email</th>
                <th>Kata Sandi</th>
                <th>Foto</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $nomor_user = 1;
            while ($hasil_user = mysql_fetch_array($query_user)) {
            ?> <tr>
                <td><?php echo $nomor_user; ?></td>
                <td><?php echo $ktp_nomor; ?></td>
                <td><?php echo $ktp_nama; ?></td>
                <td><?php echo $hasil_user['user_hp']; ?></td>
                <td><?php echo $hasil_user['user_email']; ?></td>
                <td><?php echo $hasil_user['user_password']; ?></td>
                <td><?php echo $hasil_user['user_foto']; ?></td>
            </tr>
            <?php
                $nomor_user++;
            }
            ?>
        </tbody>
    </table>
</div>

</body>

</html>