<?php
include("koneksi.php");
date_default_timezone_set("Asia/Jakarta");


$con = mysqli_connect('localhost', 'root', '', 'rackindo')
    or die("connection failed" . mysqli_errno());
?>

<div id="content-wrapper">

    <div class="container-fluid">

        <!-- DataTables Example -->
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                BPJS Health Data
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Card Id</th>
                                <th>Full Name</th>
                                <th>Register Date</th>
                                <th>Status</th>
                                <th>Entitas</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $query = mysql_query("SELECT * FROM biodata_ktp INNER JOIN bpjs_kes ON biodata_ktp.ktp_nomor=bpjs_kes.bpjskes_ktp GROUP BY bpjs_kes.bpjskes_ktp ORDER BY bpjs_kes.bpjskes_status DESC ");
                            while ($data_bpjskes = mysql_fetch_array($query)) {
                                $ktp_nomor = $data_bpjskes['ktp_nomor'];
                                $ktp_nama = $data_bpjskes['ktp_nama'];
                                $bpjskes_nomor = $data_bpjskes['bpjskes_nomor'];
                                $bpjskes_masuk = $data_bpjskes['bpjskes_masuk'];
                                $bpjskes_status = $data_bpjskes['bpjskes_status']; {
                                    $nomer++;
                            ?>
                            <tr>
                                <td><?php echo $nomer; ?></td>
                                <td><?php echo $ktp_nomor; ?></td>
                                <td><?php echo $ktp_nama; ?></td>
                                <td><?php echo date("d - F - Y", strtotime($bpjskes_masuk)); ?></td>
                                <td><?php echo $bpjskes_status; ?></td>
                                <td><?php echo $bpjskes_nomor; ?></td>
                                <td>
                                    <?php
                                            if ($bpjskes_status == "Aktif") {
                                                echo "";
                                            } else {
                                            ?>
                                    <button
                                        onclick="document.getElementById('<?php echo $ktp_nomor; ?>').style.display='block'"
                                        type="button" title="Approve" class="btn btn-info btn-sm"
                                        <?php echo $tombol; ?>><i class='fas fa-handshake'></i></button>

                                    <div id="<?php echo $ktp_nomor; ?>" class="w3-modal small">
                                        <div class="w3-modal-content w3-animate-top w3-card-4">
                                            <header class="w3-container w3-teal">
                                                <span
                                                    onclick="document.getElementById('<?php echo $ktp_nomor; ?>').style.display='none'"
                                                    class="w3-button w3-display-topright">&times;</span>
                                                <h3>Approve <br>
                                                    <?php echo $nama . " ( " . $ktp_nomor . " )"; ?>
                                                </h3>
                                            </header>
                                            <form action="home_admin.php?page=bpjskes_approve_process" method="POST">
                                                <input type="hidden" name="bpjskes_ktp"
                                                    value="<?php echo $ktp_nomor; ?>">

                                                <div class="w3-container">
                                                    <br>
                                                    <div class="form-group">
                                                        Number Entitas
                                                        <input type="text" name="bpjskes_nomor" class="form-control"
                                                            required>
                                                    </div>

                                                </div>
                                                <footer class="w3-container w3-teal">
                                                    <button type="submit" class="btn btn-info btn-sm">Submit</button>
                                                    <span
                                                        onclick="document.getElementById('<?php echo $ktp_nomor; ?>').style.display='none'"
                                                        class="w3-button"><button type="button"
                                                            class="btn btn-secondary btn-sm">Back</button></span>
                                                </footer>
                                            </form>
                                        </div>
                                    </div>
                                    <?php
                                            }
                                            ?>
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