<?php
require '../../app/config.php';
include_once '../../template/header.php';
include_once '../../template/sidebar.php';
include_once '../../template/footer.php';

$id = $_GET['id'];

$q = $con->query("SELECT * FROM pendaftaran WHERE id_pendaftaran = '$id' ")->fetch_array();

$cek = $con->query("SELECT max(nomor) AS no FROM pendaftaran WHERE id_diklat = '$q[id_diklat]' ");
$data = $cek->fetch_array();
$no = $data['no'];
$nourut = (int) substr($no, 3, 4);
$nourut++;
$a = "NPD";
$nomor = $a . sprintf('%04s', $nourut);


$query  = $con->query("UPDATE pendaftaran SET nomor = '$nomor', verif = 1 WHERE id_pendaftaran = '$id'");
if ($query) {
    $_SESSION['pesan'] = "Data Pendaftaran Diklat telah Terverifikasi";
    echo "<meta http-equiv='refresh' content='0; url=index'>";
} else {
    echo "Data gagal Diverifikasi. Ulangi sekali lagi";
    echo "<meta http-equiv='refresh' content='0; url=index'>";
}
