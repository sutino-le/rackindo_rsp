<div class="container-fluid">
  <!-- Trigger the modal with a button -->
  <a class="dropdown-item" href="home_admin.php?page=group_schedule_input" title="Input Data"><button type="button" class="btn btn-primary btn-sm" title="To Add Data"><i class="fa fa-plus"></i>&nbsp;Input Group Schedule</button></a>
</div>

<div class="container-fluid">
  <br>
  <table id="biodata_data" class="table table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>No.</th>
                <th>Group Code</th>
                <th>Group Name</th>
                <th>Duration</th>
                <th>Details</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $no=1;
                $group=mysql_query("SELECT COUNT(gs_durasi) AS minggu, gs_code, gs_nama FROM group_schedule GROUP BY gs_code ASC ");
                while($v_group=mysql_fetch_array($group)){
                    $gs_code=$v_group['gs_code'];
                    $gs_nama=$v_group['gs_nama'];
                    $minggu=$v_group['minggu'];
                    {
                        $shift=mysql_query("SELECT COUNT(gs_shift) AS shift, sd_type, sd_masuk, sd_pulang, sd_break_awal, sd_break_akhir FROM group_schedule JOIN shift_daily ON group_schedule.gs_shift=shift_daily.sd_id WHERE group_schedule.gs_code='$gs_code' GROUP BY group_schedule.gs_shift ASC ");
            ?>
            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $gs_code; ?></td>
                <td><?php echo $gs_nama; ?></td>
                <td><?php echo ($minggu/7)." - Minggu"; ?></td>
                <td>
                    <table>
                        <?php
                            while($v_shit=mysql_fetch_array($shift)){
                        ?>
                        <tr>
                            <td>
                                <?php
                                    echo $v_shit['shift']." x ".$v_shit['sd_type'];
                                ?>
                            </td>
                            <td>
                                <?php
                                    echo ": Waktu Kerja : ".date("H:i",strtotime($v_shit['sd_masuk']))." - ".date("H:i",strtotime($v_shit['sd_pulang']));
                                ?>
                            </td>
                            <td>
                                <?php
                                    echo "Istirahat : ".date("H:i",strtotime($v_shit['sd_break_awal']))." - ".date("H:i",strtotime($v_shit['sd_break_akhir']));
                                ?>
                            </td>
                        </tr>
                        <?php
                            }
                        ?>
                    </table>
                </td>
                <td></td>
            </tr>
            <?php
                $no++;
                    }
                }
            ?>
        </tbody>
  </table>

</div>