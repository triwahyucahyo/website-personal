<?php
include '../../app/config.php';

$no = 1;



if (isset($_POST['cetak'])) {

    $id_diklat = $_POST['id_diklat'];
    $cekid_diklat = isset($id_diklat);
    $id_instansi = $_POST['id_instansi'];
    $cekid_instansi = isset($id_instansi);
    if ($id_diklat == $cekid_diklat && $id_instansi == null) {

        $sql = mysqli_query($con, "SELECT * FROM pendaftaran a JOIN diklat b ON a.id_diklat = b.id_diklat JOIN peserta c ON a.id_peserta = c.id_peserta JOIN instansi d ON a.id_instansi = d.id_instansi WHERE a.id_diklat = '$id_diklat' ORDER BY id_pendaftaran DESC ");

        $dt = $con->query("SELECT * FROM diklat WHERE id_diklat = '$id_diklat'")->fetch_array();
        $label = 'LAPORAN PESERTA DIKLAT <br> Tema Diklat : ' . $dt['tema'];
    } else if ($id_diklat == null && $id_instansi == $cekid_instansi) {

        $sql = mysqli_query($con, "SELECT * FROM pendaftaran a JOIN diklat b ON a.id_diklat = b.id_diklat JOIN peserta c ON a.id_peserta = c.id_peserta JOIN instansi d ON a.id_instansi = d.id_instansi WHERE a.id_instansi = '$id_instansi' ORDER BY id_pendaftaran DESC ");

        $dt = $con->query("SELECT * FROM instansi WHERE id_instansi = '$id_instansi'")->fetch_array();
        $label = 'LAPORAN PESERTA DIKLAT <br> Asal Instansi : ' . $dt['nm_instansi'];
    } else if ($id_instansi == $cekid_instansi && $id_diklat == $cekid_diklat) {

        $sql = mysqli_query($con, "SELECT * FROM pendaftaran a JOIN diklat b ON a.id_diklat = b.id_diklat JOIN peserta c ON a.id_peserta = c.id_peserta JOIN instansi d ON a.id_instansi = d.id_instansi WHERE a.id_instansi = '$id_instansi' AND a.id_diklat = '$id_diklat' ORDER BY id_pendaftaran DESC ");

        $dt1 = $con->query("SELECT * FROM diklat WHERE id_diklat = '$id_diklat'")->fetch_array();
        $dt2 = $con->query("SELECT * FROM instansi WHERE id_instansi = '$id_instansi'")->fetch_array();
        $label = 'LAPORAN PESERTA DIKLAT <br> Tema Diklat : ' . $dt1['tema'] . '<br> Asal Instansi :' . $dt2['nm_instansi'];
    } else if ($id_diklat == null && $id_instansi == null) {

        $sql = mysqli_query($con, "SELECT * FROM peserta ORDER BY id_peserta DESC");

        // $sql = mysqli_query($con, "SELECT * FROM pendaftaran a JOIN diklat b ON a.id_diklat = b.id_diklat JOIN peserta c ON a.id_peserta = c.id_peserta JOIN instansi d ON a.id_instansi = d.id_instansi GROUP BY a.id_peserta ORDER BY id_pendaftaran DESC");
        $label = 'LAPORAN PESERTA DIKLAT';
    }
}

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
    <title>Laporan Peserta Diklat</title>
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
                            <th>Nama</th>
                            <th>NIP</th>
                            <th>Tempat & Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>No HP</th>
                            <th>Email</th>
                            <th>Pendidikan</th>
                            <?php if ($id_diklat == $cekid_diklat || $id_instansi == $cekid_instansi) { ?>
                                <th>Asal Instansi</th>
                                <th>Diklat</th>
                            <?php } ?>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while ($data = mysqli_fetch_array($sql)) { ?>
                            <tr>
                                <td align="center" width="5%"><?= $no++; ?></td>
                                <td><?= $data['nm_peserta'] ?></td>
                                <td align="center"><?= $data['nip'] ?></td>
                                <td><?= $data['tmpt_lahir'] . ', ' . tgl($data['tgl_lahir']) ?></td>
                                <td align="center"><?= $data['jk'] ?></td>
                                <td align="center"><?= $data['hp_peserta'] ?></td>
                                <td align="center"><?= $data['email_peserta'] ?></td>
                                <td align="center"><?= $data['pendidikan'] ?></td>
                                <?php if ($id_diklat == $cekid_diklat || $id_instansi == $cekid_instansi) { ?>
                                    <td align="center"><?= $data['nm_instansi'] ?></td>
                                    <td><?= $data['tema'] ?></td>
                                <?php } ?>
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
                        <u>Kepala Diklat</u><br>
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