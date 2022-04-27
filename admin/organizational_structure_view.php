<?php
include "koneksi.php";
// header("Content-type: application/vnd-ms-excel");
// header("Content-Disposition: attachment; filename=struktur organisasi.xls");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Struktur Organisasi</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
body {
    width: 400%;
    font-size: 30px;
    font-style: bold;
}
</style>

<body>


    <div class="container-fluid">

        <div class="tree">
            <?php
            $level1 = mysql_query("SELECT * FROM bagian WHERE bagian_parent='NULL' ");
            while ($v_level1 = mysql_fetch_array($level1)) {
            ?>
            <ul>
                <li>
                    <a href="#">
                        <?php
                            echo "<table border='0' cellspacing='5' cellspadding='5'><tr>";
                            echo "<td bgcolor='cyan'><font size='10'><b>" . $v_level1['bagian_nama'] . "</b></font></td></tr>";
                            $id_bagian_lev1 = $v_level1['bagian_id'];
                            $id_query1 = mysql_query("SELECT * FROM karyawan JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor WHERE karyawan.karyawan_bagian='$id_bagian_lev1' ORDER BY karyawan_jabatan ASC ");
                            while ($v_id_query1 = mysql_fetch_array($id_query1)) {
                                if ($v_id_query1['karyawan_jabatan'] == "3") {
                                    $color = "#ffb3b3";
                                } else if ($v_id_query1['karyawan_jabatan'] == "4") {
                                    $color = "#b3ffcc";
                                } else if ($v_id_query1['karyawan_jabatan'] == "5") {
                                    $color = "#ffffff";
                                } else if ($v_id_query1['karyawan_jabatan'] == "6") {
                                    $color = "#ffffff";
                                }
                                echo "<tr bgcolor='" . $color . "'><td><font size='8'>" . $v_id_query1['ktp_nama'] . "</font></td></tr>";
                            }
                            echo "</table>";
                            ?>
                    </a>
                    <ul>
                        <?php
                            $id_level1 = $v_level1['bagian_id'];
                            $level2 = mysql_query("SELECT * FROM bagian WHERE bagian_parent='$id_level1' ");
                            while ($v_level2 = mysql_fetch_array($level2)) {
                            ?>
                        <li>
                            <a href="#">
                                <?php
                                        echo "<table border='0' cellspacing='5' cellspadding='5'><tr>";
                                        echo "<td bgcolor='cyan'><font size='10'><b>" . $v_level2['bagian_nama'] . "</b></font></td></tr>";
                                        $id_bagian_lev2 = $v_level2['bagian_id'];
                                        $id_query2 = mysql_query("SELECT * FROM karyawan JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor WHERE karyawan.karyawan_bagian='$id_bagian_lev2' ORDER BY karyawan_jabatan ASC ");
                                        while ($v_id_query2 = mysql_fetch_array($id_query2)) {
                                            if ($v_id_query2['karyawan_jabatan'] == "3") {
                                                $color = "#ffb3b3";
                                            } else if ($v_id_query2['karyawan_jabatan'] == "4") {
                                                $color = "#b3ffcc";
                                            } else if ($v_id_query2['karyawan_jabatan'] == "5") {
                                                $color = "#ffffff";
                                            } else if ($v_id_query2['karyawan_jabatan'] == "6") {
                                                $color = "#ffffff";
                                            }
                                            echo "<tr bgcolor='" . $color . "'><td><font size='8'>" . $v_id_query2['ktp_nama'] . "</font></td></tr>";
                                        }
                                        echo "</table>";
                                        ?>
                            </a>
                            <ul>
                                <?php
                                        $id_level2 = $v_level2['bagian_id'];
                                        $level3 = mysql_query("SELECT * FROM bagian WHERE bagian_parent='$id_level2' ");
                                        while ($v_level3 = mysql_fetch_array($level3)) {
                                        ?>
                                <li>
                                    <a href="#">
                                        <?php
                                                    echo "<table border='0' cellspacing='5' cellspadding='5'><tr>";
                                                    echo "<td bgcolor='cyan'><font size='10'><b>" . $v_level3['bagian_nama'] . "</b></font></td></tr>";
                                                    $id_bagian_lev3 = $v_level3['bagian_id'];
                                                    $id_query3 = mysql_query("SELECT * FROM karyawan JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor WHERE karyawan.karyawan_bagian='$id_bagian_lev3' ORDER BY karyawan_jabatan ASC ");
                                                    while ($v_id_query3 = mysql_fetch_array($id_query3)) {
                                                        if ($v_id_query3['karyawan_jabatan'] == "3") {
                                                            $color = "#ffb3b3";
                                                        } else if ($v_id_query3['karyawan_jabatan'] == "4") {
                                                            $color = "#b3ffcc";
                                                        } else if ($v_id_query3['karyawan_jabatan'] == "5") {
                                                            $color = "#ffffff";
                                                        } else if ($v_id_query3['karyawan_jabatan'] == "6") {
                                                            $color = "#ffffff";
                                                        }
                                                        echo "<tr bgcolor='" . $color . "'><td><font size='8'>" . $v_id_query3['ktp_nama'] . "</font></td></tr>";
                                                    }
                                                    echo "</table>";
                                                    ?>
                                    </a>
                                    <ul>
                                        <?php
                                                    $id_level3 = $v_level3['bagian_id'];
                                                    $level4 = mysql_query("SELECT * FROM bagian WHERE bagian_parent='$id_level3' ");
                                                    while ($v_level4 = mysql_fetch_array($level4)) {
                                                    ?>
                                        <li>
                                            <a href="#">
                                                <?php
                                                                echo "<table border='0' cellspacing='5' cellspadding='5'><tr>";
                                                                echo "<td bgcolor='cyan'><font size='10'><b>" . $v_level4['bagian_nama'] . "</b></font></td></tr>";
                                                                $id_bagian_lev4 = $v_level4['bagian_id'];
                                                                $id_query4 = mysql_query("SELECT * FROM karyawan JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor WHERE karyawan.karyawan_bagian='$id_bagian_lev4' ORDER BY karyawan_jabatan ASC ");
                                                                while ($v_id_query4 = mysql_fetch_array($id_query4)) {
                                                                    if ($v_id_query4['karyawan_jabatan'] == "3") {
                                                                        $color = "#ffb3b3";
                                                                    } else if ($v_id_query4['karyawan_jabatan'] == "4") {
                                                                        $color = "#b3ffcc";
                                                                    } else if ($v_id_query4['karyawan_jabatan'] == "5") {
                                                                        $color = "#ffffff";
                                                                    } else if ($v_id_query4['karyawan_jabatan'] == "6") {
                                                                        $color = "#ffffff";
                                                                    }
                                                                    echo "<tr bgcolor='" . $color . "'><td><font size='8'>" . $v_id_query4['ktp_nama'] . "</font></td></tr>";
                                                                }
                                                                echo "</table>";
                                                                ?>
                                            </a>
                                            <ul>
                                                <?php
                                                                $id_level4 = $v_level4['bagian_id'];
                                                                $level5 = mysql_query("SELECT * FROM bagian WHERE bagian_parent='$id_level4' ");
                                                                while ($v_level5 = mysql_fetch_array($level5)) {
                                                                ?>
                                                <li>
                                                    <a href="#">
                                                        <?php
                                                                            echo "<table border='0' cellspacing='5' cellspadding='5'><tr>";
                                                                            echo "<td bgcolor='cyan'><font size='10'><b>" . $v_level5['bagian_nama'] . "</b></font></td></tr>";
                                                                            $id_bagian_lev5 = $v_level5['bagian_id'];
                                                                            $id_query5 = mysql_query("SELECT * FROM karyawan JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor WHERE karyawan.karyawan_bagian='$id_bagian_lev5' ORDER BY karyawan_jabatan ASC ");
                                                                            while ($v_id_query5 = mysql_fetch_array($id_query5)) {
                                                                                if ($v_id_query5['karyawan_jabatan'] == "3") {
                                                                                    $color = "#ffb3b3";
                                                                                } else if ($v_id_query5['karyawan_jabatan'] == "4") {
                                                                                    $color = "#b3ffcc";
                                                                                } else if ($v_id_query5['karyawan_jabatan'] == "5") {
                                                                                    $color = "#ffffff";
                                                                                } else if ($v_id_query5['karyawan_jabatan'] == "6") {
                                                                                    $color = "#ffffff";
                                                                                }
                                                                                echo "<tr bgcolor='" . $color . "'><td><font size='8'>" . $v_id_query5['ktp_nama'] . "</font></td></tr>";
                                                                            }
                                                                            echo "</table>";
                                                                            ?>
                                                    </a>
                                                    <ul>
                                                        <?php
                                                                            $id_level5 = $v_level5['bagian_id'];
                                                                            $level6 = mysql_query("SELECT * FROM bagian WHERE bagian_parent='$id_level5' ");
                                                                            while ($v_level6 = mysql_fetch_array($level6)) {
                                                                            ?>
                                                        <li>
                                                            <a href="#">
                                                                <?php
                                                                                        echo "<table border='0' cellspacing='5' cellspadding='5'><tr>";
                                                                                        echo "<td bgcolor='cyan'><font size='10'><b>" . $v_level6['bagian_nama'] . "</b></font></td></tr>";
                                                                                        $id_bagian_lev6 = $v_level6['bagian_id'];
                                                                                        $id_query6 = mysql_query("SELECT * FROM karyawan JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor WHERE karyawan.karyawan_bagian='$id_bagian_lev6' ORDER BY karyawan_jabatan ASC ");
                                                                                        while ($v_id_query6 = mysql_fetch_array($id_query6)) {
                                                                                            if ($v_id_query6['karyawan_jabatan'] == "3") {
                                                                                                $color = "#ffb3b3";
                                                                                            } else if ($v_id_query6['karyawan_jabatan'] == "4") {
                                                                                                $color = "#b3ffcc";
                                                                                            } else if ($v_id_query6['karyawan_jabatan'] == "5") {
                                                                                                $color = "#ffffff";
                                                                                            } else if ($v_id_query6['karyawan_jabatan'] == "6") {
                                                                                                $color = "#ffffff";
                                                                                            }
                                                                                            echo "<tr bgcolor='" . $color . "'><td><font size='8'>" . $v_id_query6['ktp_nama'] . "</font></td></tr>";
                                                                                        }
                                                                                        echo "</table>";
                                                                                        ?>
                                                            </a>
                                                            <ul>
                                                                <?php
                                                                                        $id_level6 = $v_level6['bagian_id'];
                                                                                        $level7 = mysql_query("SELECT * FROM bagian WHERE bagian_parent='$id_level6' ");
                                                                                        while ($v_level7 = mysql_fetch_array($level7)) {
                                                                                        ?>
                                                                <li>
                                                                    <a href="#">
                                                                        <?php
                                                                                                    echo "<table border='0' cellspacing='5' cellspadding='5'><tr>";
                                                                                                    echo "<td bgcolor='cyan'><font size='10'><b>" . $v_level7['bagian_nama'] . "</b></font></td></tr>";
                                                                                                    $id_bagian_lev7 = $v_level7['bagian_id'];
                                                                                                    $id_query7 = mysql_query("SELECT * FROM karyawan JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor WHERE karyawan.karyawan_bagian='$id_bagian_lev7' ORDER BY karyawan_jabatan ASC ");
                                                                                                    while ($v_id_query7 = mysql_fetch_array($id_query7)) {
                                                                                                        if ($v_id_query7['karyawan_jabatan'] == "3") {
                                                                                                            $color = "#ffb3b3";
                                                                                                        } else if ($v_id_query7['karyawan_jabatan'] == "4") {
                                                                                                            $color = "#b3ffcc";
                                                                                                        } else if ($v_id_query7['karyawan_jabatan'] == "5") {
                                                                                                            $color = "#ffffff";
                                                                                                        } else if ($v_id_query7['karyawan_jabatan'] == "6") {
                                                                                                            $color = "#ffffff";
                                                                                                        }
                                                                                                        echo "<tr bgcolor='" . $color . "'><td><font size='8'>" . $v_id_query7['ktp_nama'] . "</font></td></tr>";
                                                                                                    }
                                                                                                    echo "</table>";
                                                                                                    ?>
                                                                    </a>
                                                                    <ul>
                                                                        <?php
                                                                                                    $id_level7 = $v_level7['bagian_id'];
                                                                                                    $level8 = mysql_query("SELECT * FROM bagian WHERE bagian_parent='$id_level7' ");
                                                                                                    while ($v_level8 = mysql_fetch_array($level8)) {
                                                                                                    ?>
                                                                        <li>
                                                                            <a href="#">
                                                                                <?php
                                                                                                                echo "<table border='0' cellspacing='5' cellspadding='5'><tr>";
                                                                                                                echo "<td bgcolor='cyan'><font size='10'><b>" . $v_level8['bagian_nama'] . "</b></font></td></tr>";
                                                                                                                $id_bagian_lev8 = $v_level8['bagian_id'];
                                                                                                                $id_query8 = mysql_query("SELECT * FROM karyawan JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor WHERE karyawan.karyawan_bagian='$id_bagian_lev8' ORDER BY karyawan_jabatan ASC ");
                                                                                                                while ($v_id_query8 = mysql_fetch_array($id_query8)) {
                                                                                                                    if ($v_id_query8['karyawan_jabatan'] == "3") {
                                                                                                                        $color = "#ffb3b3";
                                                                                                                    } else if ($v_id_query8['karyawan_jabatan'] == "4") {
                                                                                                                        $color = "#b3ffcc";
                                                                                                                    } else if ($v_id_query8['karyawan_jabatan'] == "5") {
                                                                                                                        $color = "#ffffff";
                                                                                                                    } else if ($v_id_query8['karyawan_jabatan'] == "6") {
                                                                                                                        $color = "#ffffff";
                                                                                                                    }
                                                                                                                    echo "<tr bgcolor='" . $color . "'><td><font size='8'>" . $v_id_query8['ktp_nama'] . "</font></td></tr>";
                                                                                                                }
                                                                                                                echo "</table>";
                                                                                                                ?>
                                                                            </a>
                                                                            <ul>
                                                                                <?php
                                                                                                                $id_level8 = $v_level8['bagian_id'];
                                                                                                                $level9 = mysql_query("SELECT * FROM bagian WHERE bagian_parent='$id_level8' ");
                                                                                                                while ($v_level9 = mysql_fetch_array($level9)) {
                                                                                                                ?>
                                                                                <li>
                                                                                    <a href="#">
                                                                                        <?php
                                                                                                                            echo "<table border='0' cellspacing='5' cellspadding='5'><tr>";
                                                                                                                            echo "<td bgcolor='cyan'><font size='10'><b>" . $v_level9['bagian_nama'] . "</b></font></td></tr>";
                                                                                                                            $id_bagian_lev9 = $v_level9['bagian_id'];
                                                                                                                            $id_query9 = mysql_query("SELECT * FROM karyawan JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor WHERE karyawan.karyawan_bagian='$id_bagian_lev9' ORDER BY karyawan_jabatan ASC ");
                                                                                                                            while ($v_id_query9 = mysql_fetch_array($id_query9)) {
                                                                                                                                if ($v_id_query9['karyawan_jabatan'] == "3") {
                                                                                                                                    $color = "#ffb3b3";
                                                                                                                                } else if ($v_id_query9['karyawan_jabatan'] == "4") {
                                                                                                                                    $color = "#b3ffcc";
                                                                                                                                } else if ($v_id_query9['karyawan_jabatan'] == "5") {
                                                                                                                                    $color = "#ffffff";
                                                                                                                                } else if ($v_id_query9['karyawan_jabatan'] == "6") {
                                                                                                                                    $color = "#ffffff";
                                                                                                                                }
                                                                                                                                echo "<tr bgcolor='" . $color . "'><td><font size='8'>" . $v_id_query9['ktp_nama'] . "</font></td></tr>";
                                                                                                                            }
                                                                                                                            echo "</table>";
                                                                                                                            ?>
                                                                                    </a>
                                                                                    <ul>
                                                                                        <?php
                                                                                                                            $id_level9 = $v_level9['bagian_id'];
                                                                                                                            $level10 = mysql_query("SELECT * FROM bagian WHERE bagian_parent='$id_level9' ");
                                                                                                                            while ($v_level10 = mysql_fetch_array($level10)) {
                                                                                                                            ?>
                                                                                        <li>
                                                                                            <a href="#">
                                                                                                <?php
                                                                                                                                        echo "<table border='0' cellspacing='5' cellspadding='5'><tr>";
                                                                                                                                        echo "<td bgcolor='cyan'><font size='10'><b>" . $v_level10['bagian_nama'] . "</b></font></td></tr>";
                                                                                                                                        $id_bagian_lev10 = $v_level10['bagian_id'];
                                                                                                                                        $id_query10 = mysql_query("SELECT * FROM karyawan JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor WHERE karyawan.karyawan_bagian='$id_bagian_lev10' ORDER BY karyawan_jabatan ASC ");
                                                                                                                                        while ($v_id_query10 = mysql_fetch_array($id_query10)) {
                                                                                                                                            if ($v_id_query10['karyawan_jabatan'] == "3") {
                                                                                                                                                $color = "#ffb3b3";
                                                                                                                                            } else if ($v_id_query10['karyawan_jabatan'] == "4") {
                                                                                                                                                $color = "#b3ffcc";
                                                                                                                                            } else if ($v_id_query10['karyawan_jabatan'] == "5") {
                                                                                                                                                $color = "#ffffff";
                                                                                                                                            } else if ($v_id_query10['karyawan_jabatan'] == "6") {
                                                                                                                                                $color = "#ffffff";
                                                                                                                                            }
                                                                                                                                            echo "<tr bgcolor='" . $color . "'><td><font size='8'>" . $v_id_query10['ktp_nama'] . "</font></td></tr>";
                                                                                                                                        }
                                                                                                                                        echo "</table>";
                                                                                                                                        ?>
                                                                                            </a>
                                                                                            <ul>
                                                                                                <?php
                                                                                                                                        $id_level10 = $v_level10['bagian_id'];
                                                                                                                                        $level11 = mysql_query("SELECT * FROM bagian WHERE bagian_parent='$id_level10' ");
                                                                                                                                        while ($v_level11 = mysql_fetch_array($level11)) {
                                                                                                                                        ?>
                                                                                                <li>
                                                                                                    <a href="#">
                                                                                                        <?php
                                                                                                                                                    echo "<table border='0' cellspacing='5' cellspadding='5'><tr>";
                                                                                                                                                    echo "<td bgcolor='cyan'><font size='10'><b>" . $v_level11['bagian_nama'] . "</b></font></td></tr>";
                                                                                                                                                    $id_bagian_lev11 = $v_level11['bagian_id'];
                                                                                                                                                    $id_query11 = mysql_query("SELECT * FROM karyawan JOIN biodata_ktp ON karyawan.karyawan_ktp=biodata_ktp.ktp_nomor WHERE karyawan.karyawan_bagian='$id_bagian_lev11' ORDER BY karyawan_jabatan ASC ");
                                                                                                                                                    while ($v_id_query11 = mysql_fetch_array($id_query11)) {
                                                                                                                                                        if ($v_id_query11['karyawan_jabatan'] == "3") {
                                                                                                                                                            $color = "#ffb3b3";
                                                                                                                                                        } else if ($v_id_query11['karyawan_jabatan'] == "4") {
                                                                                                                                                            $color = "#b3ffcc";
                                                                                                                                                        } else if ($v_id_query11['karyawan_jabatan'] == "5") {
                                                                                                                                                            $color = "#ffffff";
                                                                                                                                                        } else if ($v_id_query11['karyawan_jabatan'] == "6") {
                                                                                                                                                            $color = "#ffffff";
                                                                                                                                                        }
                                                                                                                                                        echo "<tr bgcolor='" . $color . "'><td><font size='8'>" . $v_id_query11['ktp_nama'] . "</font></td></tr>";
                                                                                                                                                    }
                                                                                                                                                    echo "</table>";
                                                                                                                                                    ?>
                                                                                                    </a>
                                                                                                </li>
                                                                                                <?php
                                                                                                                                        }
                                                                                                                                        ?>
                                                                                            </ul>
                                                                                        </li>
                                                                                        <?php
                                                                                                                            }
                                                                                                                            ?>
                                                                                    </ul>
                                                                                </li>
                                                                                <?php
                                                                                                                }
                                                                                                                ?>
                                                                            </ul>
                                                                        </li>
                                                                        <?php
                                                                                                    }
                                                                                                    ?>
                                                                    </ul>
                                                                </li>
                                                                <?php
                                                                                        }
                                                                                        ?>
                                                            </ul>
                                                        </li>
                                                        <?php
                                                                            }
                                                                            ?>
                                                    </ul>
                                                </li>
                                                <?php
                                                                }
                                                                ?>
                                            </ul>
                                        </li>
                                        <?php
                                                    }
                                                    ?>
                                    </ul>
                                </li>
                                <?php
                                        }
                                        ?>
                            </ul>
                        </li>
                        <?php
                            }
                            ?>
                    </ul>
                </li>
            </ul>
            <?php
            }
            ?>

        </div>
    </div>

</body>

</html>