<?php
include '../../app/config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grafik Peserta Diklat</title>
</head>

<body>

    <figure class="highcharts-figure">
        <div id="container" style="margin-top: 80px;"></div>
    </figure>

    <script src="<?= base_url() ?>/assets/chart/highcharts.js"></script>
    <script src="<?= base_url() ?>/assets/chart/exporting.js"></script>
    <script src="<?= base_url() ?>/assets/chart/export-data.js"></script>
    <script src="<?= base_url() ?>/assets/chart/accessibility.js"></script>

    <?php if (isset($_POST['cetak'])) {

        $tahun = $_POST['tahun'];
        $cektahun = isset($tahun);

        if ($tahun == $cektahun) {
            $sql = mysqli_query($con, "SELECT * FROM diklat a JOIN materi b ON a.id_materi = b.id_materi JOIN tutor c ON a.id_tutor = c.id_tutor JOIN ruangan d ON a.id_ruangan = d.id_ruangan WHERE YEAR(a.tgl_mulai) = '$tahun' ORDER BY a.tgl_mulai ASC ");

            $tema = array();
            $jml = array();
            while ($data = $sql->fetch_array()) {
                $ttl = $con->query("SELECT COUNT(*) AS total FROM kehadiran WHERE id_diklat = '$data[id_diklat]'")->fetch_array();
                $jml[] = intval($ttl['total']);
                $tema[] = '<b>' . $data['tema'] . '</b> <br> ' . tgl($data['tgl_mulai']);
            }
            $title = 'GRAFIK PESERTA DIKLAT<br><br> <p style="font-size: 14px"><b> Tahun : ' . $tahun;
            $label = '';
        }

    ?>
        <script>
            Highcharts.chart('container', {
                chart: {
                    type: 'bar'
                },
                title: {
                    text: '<?= $title ?>'
                },
                subtitle: {
                    text: '<?= $label ?>'
                },
                xAxis: {
                    categories: <?= json_encode($tema) ?>,
                    tickmarkPlacement: 'on',
                    title: {
                        enabled: false
                    }
                },
                yAxis: {
                    title: {
                        text: 'Peserta Hadir'
                    },
                    labels: {
                        formatter: function() {
                            return this.value;
                        }
                    }
                },
                tooltip: {
                    split: true,
                    valueSuffix: ' Orang'
                },
                plotOptions: {
                    area: {
                        stacking: 'normal',
                        lineColor: '#17A2B8',
                        lineWidth: 1,
                        marker: {
                            lineWidth: 1,
                            lineColor: '#17A2B8'
                        }
                    }
                },
                series: [{
                    name: 'Peserta Hadir',
                    data: <?= json_encode($jml) ?>,
                    color: '#17A2B8'
                }],
                exporting: {
                    sourceWidth: 1280,
                    sourceHeight: 720,
                    filename: '<?= 'Grafik Peserta Diklat Tahun ' . $tahun ?> '
                    // scale: 2 (default)
                    // chartOptions: {
                    //     subtitle: '<?= $label ?>'
                    // }
                }
            });
        </script>
    <?php } ?>
</body>

</html>