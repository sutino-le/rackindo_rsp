<div id="content-wrapper">

    <div class="container-fluid">

        <!-- DataTables Example -->
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-hand-holding-usd"></i>
                Salary Report
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Category</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = mysql_query("SELECT * FROM upah_kalkulasi GROUP BY upah_kal_kategori, upah_kal_awal, upah_kal_akhir ");
                            while ($upah_report = mysql_fetch_array($query)) {
                                $upah_kal_kategori = $upah_report['upah_kal_kategori'];
                                $upah_kal_awal = $upah_report['upah_kal_awal'];
                                $upah_kal_akhir = $upah_report['upah_kal_akhir']; {
                                    $nomer++;
                            ?>
                            <tr>
                                <td><?php echo $nomer; ?></td>
                                <td><?php echo $upah_kal_kategori; ?></td>
                                <td><?php echo date("d F Y", strtotime($upah_kal_awal)); ?></td>
                                <td><?php echo date("d F Y", strtotime($upah_kal_akhir)); ?></td>
                                <td>
                                    <a href="salary_report_print.php?kategori=<?php echo $upah_kal_kategori; ?>&awal=<?php echo $upah_kal_awal; ?>&akhir=<?php echo $upah_kal_akhir; ?>"
                                        target="_blank">
                                        <button type="button" title="Review" class="btn btn-info btn-sm"><i
                                                class="fas fa-print"></i></button>
                                    </a>
                                </td>
                            </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>