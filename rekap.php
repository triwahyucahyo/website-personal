<?php
include '../../app/config.php';

$no = 1;

$sql = mysqli_query($con, "SELECT * FROM diklat a JOIN materi b ON a.id_materi = b.id_materi JOIN tutor c ON a.id_tutor = c.id_tutor JOIN ruangan d ON a.id_ruangan = d.id_ruangan ORDER BY tgl_mulai DESC");
$label = 'LAPORAN REKAPITULASI DIKLAT';

require_once '../../assets/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'LEGAL-L']);
ob_start();
?>

<script type="text/javascript">
    window.print();
</script>

<!DOCTYPE html>
<html>

<head>
    <title>Laporan Rekapitulasi Diklat</title>
</head>

<style>
    th {
        color: white;
    }
</style>

<body>
    <div class="table-responsive">
        <table border="0" cellspacing="0" cellpadding="0" width="100%">
            <tr>
                <td align="center">
                    <img src="<?= base_url('assets/images/logo.png') ?>" align="left" height="100">
                </td>
                <td align="center">
                    <h4>PEMERINTAH PROVINSI KALIMANTAN SELATAN</h4>
                    <h2>Balai Teknologi Informasi Komunikasi Pendidikan (BTIKP)</h2>
                    <h6>Jl. Perdagangan No.106, Kuin Utara, Kec. Banjarmasin Utara, Kota Banjarmasin, Kalimantan Selatan 70124</h6>
                </td>
                <td align="center">
                    <img src="<?= base_url('assets/images/pelengkap.png') ?>" align="right" height="100">
                </td>
            </tr>
        </table>
    </div>
    <hr size="2px" color="black">

    <h4 align="center">
        <?= $label ?><br>
    </h4>
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">
                <table border="1" cellspacing="0" cellpadding="6" width="100%">
                    <thead>
                        <tr bgcolor="#007BFF" align="center">
                            <th>No</th>
                            <th>Tema Diklat</th>
                            <th>Materi</th>
                            <th>Tutor</th>
                            <th>Tanggal</th>
                            <th>Ruangan</th>
                            <th>Peserta Terdaftar</th>
                            <th>Peserta Hadir</th>
                            <th>Sertifikat</th>
                            <th>Penghargaan</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while ($data = mysqli_fetch_array($sql)) { ?>
                            <tr>
                                <td align="center" width="5%"><?= $no++; ?></td>
                                <td><?= $data['tema'] ?></td>
                                <td align="center"><?= $data['nm_materi'] ?></td>
                                <td align="center"><?= $data['nm_tutor'] ?></td>
                                <td align="center">
                                    <?php if ($data['tgl_mulai'] == $data['tgl_selesai']) { ?>
                                        <?= tgl($data['tgl_mulai']) ?>
                                    <?php } else { ?>
                                        <?= tgl($data['tgl_mulai']) . ' - ' . tgl($data['tgl_selesai']) ?>
                                    <?php } ?>
                                    <br>
                                </td>
                                <td align="center"><?= $data['nm_ruangan'] ?></td>
                                <td align="center">
                                    <?php
                                    $ttl = $con->query("SELECT COUNT(*) AS total FROM pendaftaran WHERE id_diklat = '$data[id_diklat]'")->fetch_array();
                                    echo $ttl['total'] . ' Orang';
                                    ?>
                                </td>
                                <td align="center">
                                    <?php
                                    $ttl2 = $con->query("SELECT COUNT(*) AS total FROM kehadiran WHERE id_diklat = '$data[id_diklat]'")->fetch_array();
                                    echo $ttl2['total'] . ' Orang';
                                    ?>
                                </td>
                                <td align="center">
                                    <?php
                                    $ttl3 = $con->query("SELECT COUNT(*) AS total FROM sertifikat WHERE id_diklat = '$data[id_diklat]'")->fetch_array();
                                    echo $ttl3['total'] . ' Orang';
                                    ?>
                                </td>
                                <td align="center">
                                    <?php
                                    $ttl4 = $con->query("SELECT COUNT(*) AS total FROM award WHERE id_diklat = '$data[id_diklat]'")->fetch_array();
                                    echo $ttl4['total'] . ' Orang';
                                    ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
    <br>
    <br>

    <br>
    <div class="table-responsive">
        <table border="0" cellspacing="0" cellpadding="0" width="100%">
            <tr>
                <td align="center" width="85%">
                </td>
                <td align="center">
                    <h6>
                        <?= tgl_indo(date('Y-m-d')) ?><br>
                        Banjarmasin <br>
                        <br><br><br><br>
                        <u>Kepala Balai</u><br>
                    </h6>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
<?php
$html = ob_get_contents();
ob_end_clean();
$mpdf->WriteHTML(utf8_encode($html));
$mpdf->Output();
?>