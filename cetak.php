<?php
include '../../app/config.php';

$no = 1;

// if (isset($_POST['cetak'])) {

//     $id_diklat = $_POST['id_diklat'];
//     $cekid_diklat = isset($id_diklat);
//     if ($id_diklat == $cekid_diklat) {

//         $sql = mysqli_query($con, "SELECT * FROM award a JOIN peserta b ON a.id_peserta = b.id_peserta WHERE a.id_diklat = '$id_diklat' ORDER BY id_award DESC ");

//         $dt = $con->query("SELECT * FROM diklat WHERE id_diklat = '$id_diklat'")->fetch_array();
//         $label = 'LAPORAN PENERIMA PENGHARGAAN DIKLAT <br> Tema Diklat : ' . $dt['tema'];
//     }
// }

$sql = mysqli_query($con, "SELECT * FROM award a JOIN peserta b ON a.id_peserta = b.id_peserta ORDER BY id_award DESC ");

$label = 'LAPORAN PENERIMA PENGHARGAAN DIKLAT';

require_once '../../assets/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);
ob_start();
?>

<script type="text/javascript">
    window.print();
</script>

<!DOCTYPE html>
<html>

<head>
    <title>Laporan Penerima Penghargaan Diklat</title>
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
                            <th>Penghargaan</th>
                            <th>Nama Peserta</th>
                            <th>NIP</th>
                            <th>Pendidikan</th>
                            <th>Asal Instansi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while ($data = mysqli_fetch_array($sql)) { ?>
                            <tr>
                                <td align="center" width="5%"><?= $no++; ?></td>
                                <td><?= $data['nm_award'] ?></td>
                                <td><?= $data['nm_peserta'] ?></td>
                                <td align="center"><?= $data['nip'] ?></td>
                                <td align="center"><?= $data['pendidikan'] ?></td>
                                <td align="center">
                                    <?php $dt = $con->query("SELECT * FROM pendaftaran a JOIN instansi b ON a.id_instansi = b.id_instansi WHERE id_diklat = '$data[id_diklat]' AND id_peserta = '$data[id_peserta]' ")->fetch_array();
                                    echo $dt['nm_instansi'];
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