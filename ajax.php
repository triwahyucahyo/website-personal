<?php
require '../../app/config.php';

switch ($_GET['jenis']) {

    case 'diklat';
        $id  = $_POST['diklat'];
        if ($id == '') {
            exit;
        } else {
            $data = $con->query("SELECT * FROM kehadiran a JOIN peserta b ON a.id_peserta = b.id_peserta WHERE a.id_diklat = '$id' ORDER BY nm_peserta ASC");
            echo "<option disabled selected> -- Pilih Peserta -- </option>";
            while ($row = mysqli_fetch_array($data)) {
                echo '<option value="' . $row["id_peserta"] . '">' . $row['nm_peserta'] . '</option><br>';
            }
            exit;
        }
        break;
}
