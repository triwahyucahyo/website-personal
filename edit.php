<?php
require '../../app/config.php';
include_once '../../template/header.php';
$page = 'diklat';
include_once '../../template/sidebar.php';

$id = $_GET['id'];
$query = $con->query(" SELECT * FROM diklat WHERE id_diklat ='$id'");
$row = $query->fetch_array();

$sts = [
    '' => '---Pilih---',
    '1' => 'Aktif',
    '0' => 'Non Aktif',
];
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="m-0 text-dark"><i class="fa fa-calendar-week ml-1 mr-1"></i> Edit Data Diklat</h4>
                </div><!-- /.col -->
                <div class="col-sm-6 float-right">
                    <a href="#" onClick="history.go(-1);" class="btn btn-xs bg-dark float-right"><i class="fa fa-arrow-left"> Kembali</i></a>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- left column -->
            <div class="row">
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="card card-purple card-outline">
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="card-body" style="background-color: white;">
                            <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Tema Diklat</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="tema" value="<?= $row['tema'] ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Materi</label>
                                    <div class="col-sm-10">
                                        <select name="id_materi" class="form-control select2" style="width: 100%;">
                                            <?php
                                            $q = $con->query("SELECT * FROM materi ORDER BY id_materi DESC");
                                            while ($d = $q->fetch_array()) {
                                                if ($d['id_materi'] == $row['id_materi']) {
                                            ?>
                                                    <option value="<?= $d['id_materi']; ?>" selected="<?= $d['id_materi']; ?>"><?= $d['nm_materi'] ?></option>
                                                <?php
                                                } else {
                                                ?>
                                                    <option value="<?= $d['id_materi'] ?>"><?= $d['nm_materi'] ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Nama Tutor</label>
                                    <div class="col-sm-10">
                                        <select name="id_tutor" class="form-control select2" style="width: 100%;">
                                            <?php
                                            $q = $con->query("SELECT * FROM tutor ORDER BY id_tutor DESC");
                                            while ($d = $q->fetch_array()) {
                                                if ($d['id_tutor'] == $row['id_tutor']) {
                                            ?>
                                                    <option value="<?= $d['id_tutor']; ?>" selected="<?= $d['id_tutor']; ?>"><?= $d['nm_tutor'] ?></option>
                                                <?php
                                                } else {
                                                ?>
                                                    <option value="<?= $d['id_tutor'] ?>"><?= $d['nm_tutor'] ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Tanggal Mulai</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" name="tgl_mulai" value="<?= $row['tgl_mulai'] ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Tanggal Selesai</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" name="tgl_selesai" value="<?= $row['tgl_selesai'] ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Jam Mulai</label>
                                    <div class="col-sm-10">
                                        <input type="time" class="form-control" name="jam_mulai" value="<?= $row['jam_mulai'] ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Nama Ruangan</label>
                                    <div class="col-sm-10">
                                        <select name="id_ruangan" class="form-control select2" style="width: 100%;">
                                            <?php
                                            $q = $con->query("SELECT * FROM ruangan ORDER BY id_ruangan DESC");
                                            while ($d = $q->fetch_array()) {
                                                if ($d['id_ruangan'] == $row['id_ruangan']) {
                                            ?>
                                                    <option value="<?= $d['id_ruangan']; ?>" selected="<?= $d['id_ruangan']; ?>"><?= $d['nm_ruangan'] ?></option>
                                                <?php
                                                } else {
                                                ?>
                                                    <option value="<?= $d['id_ruangan'] ?>"><?= $d['nm_ruangan'] ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Status Diklat</label>
                                    <div class="col-sm-10">
                                        <?= form_dropdown('sts', $sts, $row['sts'], 'class="form-control" required') ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <button type="submit" name="submit" class="btn btn-sm bg-cyan float-right"><i class="fa fa-save"> Update</i></button>
                                        <button type="reset" class="btn btn-sm btn-danger float-right mr-1"><i class="fa fa-times-circle"> Batal</i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!--/.col (left) -->
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
include_once '../../template/footer.php';
?>

<?php
if (isset($_POST['submit'])) {
    $tema = $_POST['tema'];
    $id_materi = $_POST['id_materi'];
    $id_tutor = $_POST['id_tutor'];
    $tgl_mulai = $_POST['tgl_mulai'];
    $tgl_selesai = $_POST['tgl_selesai'];
    $jam_mulai = $_POST['jam_mulai'];
    $id_ruangan = $_POST['id_ruangan'];
    $sts = $_POST['sts'];

    $update = $con->query("UPDATE diklat SET 
        tema = '$tema',
        id_materi = '$id_materi',
        id_tutor = '$id_tutor',
        tgl_mulai = '$tgl_mulai',
        tgl_selesai = '$tgl_selesai',
        jam_mulai = '$jam_mulai',
        id_ruangan = '$id_ruangan',
        sts = '$sts'
        WHERE id_diklat = '$id'
    ");

    if ($update) {
        $_SESSION['pesan'] = "Data Berhasil di Update";
        echo "<meta http-equiv='refresh' content='0; url=index'>";
    } else {
        echo "Data anda gagal diubah. Ulangi sekali lagi";
        echo "<meta http-equiv='refresh' content='0; url=edit?id=$id'>";
    }
}


?>