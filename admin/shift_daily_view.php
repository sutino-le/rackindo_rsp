<div class="container-fluid">
  <!-- Trigger the modal with a button -->
  <a class="dropdown-item" href="home_admin.php?page=shift_daily_input" title="Input Data"><button type="button" class="btn btn-primary btn-sm" title="To Add Data"><i class="fa fa-plus"></i>&nbsp;Input Shift Daily</button></a>
</div>

<div class="container-fluid">
  <br>
  <table id="biodata_data" class="table table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>No.</th>
                <th>Shift Code</th>
                <th>Shift Type</th>
                <th>Working  hours</th>
                <th>Break</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $no=1;
                $shift_daily=mysql_query("SELECT * FROM shift_daily ORDER BY sd_masuk ASC ");
                while($v_shift_daily=mysql_fetch_array($shift_daily)){
                    $sd_id=$v_shift_daily['sd_id'];
                    $sd_code=$v_shift_daily['sd_code'];
                    $sd_type=$v_shift_daily['sd_type'];
                    $sd_masuk=$v_shift_daily['sd_masuk'];
                    $sd_pulang=$v_shift_daily['sd_pulang'];
                    $sd_break_awal=$v_shift_daily['sd_break_awal'];
                    $sd_break_akhir=$v_shift_daily['sd_break_akhir'];
                    { 
                        
                        $jam_masuk = date_create($sd_masuk); 
                        $jam_pulang = date_create($sd_pulang); 
                        $diff_kerja = date_diff($jam_masuk, $jam_pulang); 
                        $selisih_kerja = $diff_kerja->format('%h%');
                        $selisih_kerja_menit = $diff_kerja->format('%i%');

                        
                        $break_start = date_create($sd_break_awal); 
                        $break_end = date_create($sd_break_akhir); 
                        $diff_break = date_diff($break_start, $break_end); 
                        $selisih_break = $diff_break->format('%h%');
                        $selisih_break_menit = $diff_break->format('%i%');
                        
                        if($selisih_kerja=="0" AND $selisih_break=="0"){
                            $jumlah_selesih_kerja="0";
                            $jumlah_selesih_break="0";
                        } else {
                            $jumlah_selesih_kerja=(($selisih_kerja-$selisih_break)+($selisih_kerja_menit/60));
                            $jumlah_selesih_break=$selisih_break+($selisih_break_menit/60);
                        }
            ?>
            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $sd_code; ?></td>
                <td><?php echo $sd_type; ?></td>
                <td><?php echo date("H:i",strtotime($sd_masuk))." - ".date("H:i",strtotime($sd_pulang))."<b> (  ".$jumlah_selesih_kerja." Jam )</b>"; ?></td>
                <td><?php echo date("H:i",strtotime($sd_break_awal))." - ".date("H:i",strtotime($sd_break_akhir))."<b> (  ".$jumlah_selesih_break." Jam )</b>"; ?></td>
                <td><a href="home_admin.php?page=shift_daily_edit&id=<?php echo $sd_id; ?>"><button type="button" class="btn btn-success btn-sm" title="Edit" ><i class="fa fa-edit"></i></button></a></td>
            </tr>
            <?php
                $no++;
                    }
                }
            ?>
        </tbody>
  </table>

</div>