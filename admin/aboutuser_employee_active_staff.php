<!DOCTYPE html>
<html>

<head>
    <script src="js/Chart.js"></script>
</head>

<body>
    <canvas id="myChart"></canvas>
    <?php
    // Koneksikan ke database
    include "koneksi.php";
    $kon = mysqli_connect("localhost", "root", "", "rackindo");


    //Karyawan Aktif
    $karyawan_aktif = mysql_query("SELECT * FROM karyawan WHERE karyawan_status='Aktif' AND karyawan_kategori='Staff' ");
    $v_karyawan_aktif = mysql_num_rows($karyawan_aktif);
    echo "<center><h1>Employee Active : " . $v_karyawan_aktif . "</h1></center> <br>";

    //Inisialisasi nilai variabel awal
    $nama_karyawan_bagian = "";
    $jumlah = null;
    //Query SQL
    $sql = "SELECT bagian.bagian_nama, karyawan.karyawan_bagian,COUNT(*) AS 'total_bagian' FROM karyawan JOIN bagian ON karyawan.karyawan_bagian=bagian.bagian_id WHERE karyawan.karyawan_kategori='Staff' GROUP by karyawan.karyawan_bagian ASC";
    $hasil = mysqli_query($kon, $sql);

    while ($data = mysqli_fetch_array($hasil)) {
        //Mengambil nilai karyawan_bagian dari database
        $jur = $data['bagian_nama'];
        $nama_karyawan_bagian .= "'$jur'" . ", ";
        //Mengambil nilai total_bagian dari database
        $jum = $data['total_bagian'];
        $jumlah .= "$jum" . ", ";
    }
    ?>
    <script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',
        // The data for our dataset
        data: {
            labels: [<?php echo $nama_karyawan_bagian; ?>],
            datasets: [{
                label: '<?php echo $data['bagian_nama']; ?>',
                backgroundColor: [
                    'rgb(60, 179, 113)',
                    'rgb(60, 179, 113)',
                    'rgb(60, 179, 113)',
                    'rgb(60, 179, 113)',
                    'rgb(60, 179, 113)',
                    'rgb(60, 179, 113)',
                    'rgb(60, 179, 113)',
                    'rgb(60, 179, 113)',
                    'rgb(60, 179, 113)',
                    'rgb(60, 179, 113)',
                    'rgb(60, 179, 113)',
                    'rgb(60, 179, 113)',
                    'rgb(60, 179, 113)',
                    'rgb(60, 179, 113)',
                    'rgb(60, 179, 113)',
                    'rgb(60, 179, 113)',
                    'rgb(60, 179, 113)',
                    'rgb(60, 179, 113)',
                    'rgb(60, 179, 113)',
                    'rgb(60, 179, 113)',
                    'rgb(60, 179, 113)',
                    'rgb(60, 179, 113)',
                    'rgb(60, 179, 113)',
                    'rgb(60, 179, 113)',
                    'rgb(60, 179, 113)',
                    'rgb(60, 179, 113)',
                    'rgb(60, 179, 113)',
                    'rgb(60, 179, 113)',
                    'rgb(60, 179, 113)',
                    'rgb(60, 179, 113)',
                    'rgb(60, 179, 113)',
                    'rgb(60, 179, 113)',
                    'rgb(60, 179, 113)',
                    'rgb(60, 179, 113)',
                    'rgb(60, 179, 113)',
                    'rgb(60, 179, 113)',
                    'rgb(60, 179, 113)',
                    'rgb(60, 179, 113)',
                    'rgb(60, 179, 113)',
                    'rgb(60, 179, 113)',
                    'rgb(60, 179, 113)',
                    'rgb(60, 179, 113)',
                    'rgb(60, 179, 113)'
                ],
                borderColor: ['rgb(60, 179, 113)'],
                data: [<?php echo $jumlah; ?>]
            }]
        },

        // Configuration options go here
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
    </script>
</body>

</html>