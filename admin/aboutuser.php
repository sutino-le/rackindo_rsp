 <?php
    $periode_akhir = date("Y-m-25");
    $tambah1 = date("Y-m-d", strtotime("+1 day", strtotime($periode_akhir)));
    $periode_awal = date("Y-m-d", strtotime("-1 month", strtotime($tambah1)));

    //Karyawan Aktif
    $karyawan_aktif = mysql_query("SELECT * FROM karyawan WHERE karyawan_status='Aktif' AND karyawan_kategori='Karyawan' ");
    $v_karyawan_aktif = mysql_num_rows($karyawan_aktif);

    //Karyawan Aktif Staff
    $karyawan_aktif_staff = mysql_query("SELECT * FROM karyawan WHERE karyawan_status='Aktif' AND karyawan_kategori='Staff' ");
    $v_karyawan_aktif_staff = mysql_num_rows($karyawan_aktif_staff);

    //Karyawan Baru
    $karyawan_join = mysql_query("SELECT * FROM karyawan WHERE karyawan_join BETWEEN '$periode_awal' AND '$periode_akhir' ");
    $v_karyawan_join = mysql_num_rows($karyawan_join);

    //Karyawan Keluar
    $karyawan_Keluar = mysql_query("SELECT * FROM karyawan WHERE karyawan_status='Keluar' AND karyawan_terminate BETWEEN '$periode_awal' AND '$periode_akhir' ");
    $v_karyawan_Keluar = mysql_num_rows($karyawan_Keluar);
    ?>

 <!-- Main content -->
 <section class="content">
     <div class="container-fluid">

         <?php
            $tanggal_sekarang = date("m-d");
            $cek_ultah = mysql_query("SELECT * FROM biodata_ktp JOIN karyawan ON biodata_ktp.ktp_nomor=karyawan.karyawan_ktp JOIN bagian ON karyawan.karyawan_bagian=bagian.bagian_id JOIN jabatan ON karyawan.karyawan_jabatan=jabatan.jabatan_id JOIN user ON karyawan.karyawan_ktp=user.user_ktp WHERE karyawan.karyawan_status='Aktif' AND biodata_ktp.ktp_tanggal_lahir like '%$tanggal_sekarang%' ");
            $v_cek_ultah = mysql_num_rows($cek_ultah);
            if (empty($v_cek_ultah)) {
            } else {

            ?>
         <!-- Small boxes (Stat box) -->
         <div class="row">
             <div class="col-lg-12">
                 <!-- small box -->
                 <div class="small-box bg-LightSeaGreen">
                     <div class="inner text-center">
                         <img src="img/ultah3.gif" alt="Selamat Ulang Tahun" width="150" height="150">
                         <h1 style="font-family:Brush Script MT;">Happy Birthday to</h1>
                         <?php
                                while ($hasil = mysql_fetch_array($cek_ultah)) {
                                ?>
                         <font size="5" style="font-family: Brush Script MT;"> - <?php echo $hasil['ktp_nama']; ?>
                             [ <?php echo $hasil['jabatan_nama']  . "-" . $hasil['bagian_nama']; ?> ]
                             <a href="https://api.whatsapp.com/send?phone=<?php echo $hasil['user_hp']; ?>&text=Selamat%20Ulang%20Tahun%20<?php echo $hasil['ktp_nama']; ?>%20(%20<?php echo $hasil['jabatan_nama']  . "-" . $hasil['bagian_nama']; ?>%20),%20Semoga%20panjang%20umur%20dan%20sehat%20selalu.%20PT%20Rackindo%20Setara%20Perkasa."
                                 target="_blank"><i class="fab fa-whatsapp"></i> Upcapkan</a><br>
                         </font>
                         <?php
                                }
                                ?>
                     </div>
                 </div>
             </div>
         </div>
         <?php
            }
            ?>

         <!-- Small boxes (Stat box) -->
         <div class="row">
             <div class="col-lg-12">
                 <!-- small box -->
                 <div class="small-box bg-LightSeaGreen">
                     <div class="inner">
                         <h4><u>Periode :
                                 <?php echo date("d F Y", strtotime($periode_awal)) . " s/d " . date("d F Y", strtotime($periode_akhir)); ?></u>
                         </h4>
                     </div>
                 </div>
             </div>
         </div>

         <!-- Small boxes (Stat box) -->
         <div class="row">

             <!-- Karyawan aktif -->
             <div class="col-lg-3 col-6">
                 <div class="small-box bg-honeydew">
                     <div class="inner">
                         <h3><?php echo $v_karyawan_aktif; ?></h3>
                         <a href="#" onclick="document.getElementById('id01').style.display='block'"
                             class="small-box-footer">Employee Active (Karyawan)</a>
                     </div>
                     <div class="icon">
                         <i class="ion ion-bag"></i>
                     </div>
                 </div>
             </div>

             <!-- Karyawan aktif staff -->
             <div class="col-lg-3 col-6">
                 <div class="small-box bg-honeydew">
                     <div class="inner">
                         <h3><?php echo $v_karyawan_aktif_staff; ?></h3>
                         <a href="#" onclick="document.getElementById('id06').style.display='block'"
                             class="small-box-footer">Employee Active (Staff)</a>
                     </div>
                     <div class="icon">
                         <i class="ion ion-bag"></i>
                     </div>
                 </div>
             </div>

             <!-- Karyawan baru -->
             <div class="col-lg-3 col-6">
                 <div class="small-box bg-honeydew">
                     <div class="inner">
                         <h3><?php echo $v_karyawan_join; ?></h3>
                         <a href="#" onclick="document.getElementById('id02').style.display='block'"
                             class="small-box-footer">New Employee</a>
                     </div>
                     <div class="icon">
                         <i class="ion ion-person-add"></i>
                     </div>
                 </div>
             </div>

             <!-- Karyawan Keluar -->
             <div class="col-lg-3 col-6">
                 <div class="small-box bg-honeydew">
                     <div class="inner">
                         <h3><?php echo $v_karyawan_Keluar; ?></h3>
                         <a href="#" onclick="document.getElementById('id03').style.display='block'"
                             class="small-box-footer">Employee Inactive</a>
                     </div>
                     <div class="icon">
                         <i class="ion ion-stats-bars"></i>
                     </div>
                 </div>
             </div>

             <!-- Belum tau -->
             <div class="col-lg-3 col-6">
                 <div class="small-box bg-honeydew">
                     <div class="inner">
                         <h3>View</h3>
                         <a href="#" onclick="document.getElementById('id04').style.display='block'"
                             class="small-box-footer">Attendance Late</a>
                     </div>
                     <div class="icon">
                         <i class="ion ion-pie-graph"></i>
                     </div>
                 </div>
             </div>

             <!-- Belum tau -->
             <div class="col-lg-3 col-6">
                 <div class="small-box bg-honeydew">
                     <div class="inner">
                         <h3>View</h3>
                         <a href="#" onclick="document.getElementById('id05').style.display='block'"
                             class="small-box-footer">Attendance No Info</a>
                     </div>
                     <div class="icon">
                         <i class="ion ion-pie-graph"></i>
                     </div>
                 </div>
             </div>

         </div>

     </div><!-- /.container-fluid -->
 </section>


 <div id="id01" class="w3-modal small">
     <div class="w3-modal-content w3-animate-top w3-card-4">
         <header class="w3-container w3-teal">
             <span onclick="document.getElementById('id01').style.display='none'"
                 class="w3-button w3-display-topright">&times;</span>
             <h2>Employee Active</h2>
         </header>
         <div class="w3-container">
             <br>
             <?php
                include "aboutuser_employee_active.php";
                ?>
         </div>
         <footer class="w3-container w3-teal">
             <br>
         </footer>
     </div>
 </div>


 <div id="id02" class="w3-modal small">
     <div class="w3-modal-content w3-animate-top w3-card-4">
         <header class="w3-container w3-teal">
             <span onclick="document.getElementById('id02').style.display='none'"
                 class="w3-button w3-display-topright">&times;</span>
             <h2>New Employee</h2>
         </header>
         <div class="w3-container">
             <br>
             <?php
                include "aboutuser_employee_new.php";
                ?>
         </div>
         <footer class="w3-container w3-teal">
             <br>
         </footer>
     </div>
 </div>


 <div id="id03" class="w3-modal small">
     <div class="w3-modal-content w3-animate-top w3-card-4">
         <header class="w3-container w3-teal">
             <span onclick="document.getElementById('id03').style.display='none'"
                 class="w3-button w3-display-topright">&times;</span>
             <h2>Employee Inactive</h2>
         </header>
         <div class="w3-container">
             <br>
             <?php
                include "aboutuser_employee_inactive.php";
                ?>
         </div>
         <footer class="w3-container w3-teal">
             <br>
         </footer>
     </div>
 </div>


 <div id="id04" class="w3-modal small">
     <div class="w3-modal-content w3-animate-top w3-card-4">
         <header class="w3-container w3-teal">
             <span onclick="document.getElementById('id04').style.display='none'"
                 class="w3-button w3-display-topright">&times;</span>
             <h2>Attendance Late</h2>
         </header>
         <div class="w3-container">
             <br>
             <?php
                include "aboutuser_attendance_late.php";
                ?>
         </div>
         <footer class="w3-container w3-teal">
             <br>
         </footer>
     </div>
 </div>


 <div id="id05" class="w3-modal small">
     <div class="w3-modal-content w3-animate-top w3-card-4">
         <header class="w3-container w3-teal">
             <span onclick="document.getElementById('id05').style.display='none'"
                 class="w3-button w3-display-topright">&times;</span>
             <h2>Attendance No Info</h2>
         </header>
         <div class="w3-container">
             <br>
             <?php
                include "aboutuser_attendance_no_info.php";
                ?>
         </div>
         <footer class="w3-container w3-teal">
             <br>
         </footer>
     </div>
 </div>