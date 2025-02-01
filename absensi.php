<?php
require '../../app/config.php';
include_once '../../template/header.php';
$page = 'kehadiran';
include_once '../../template/sidebar.php';

$id = $_GET['id'];
$q = $con->query("SELECT * FROM diklat WHERE id_diklat = '$id' ");
$d = $q->fetch_array();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="m-0 text-dark"><i class="fa fa-user-check ml-1 mr-1"></i> Data Kehadiran</h4>
                </div><!-- /.col -->
                <div class="col-sm-6 text-right">
                    <a href="index" class="btn btn-xs bg-dark float-right"><i class="fa fa-arrow-left mr-1"></i>Kembali</a>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5">
                    <div class="card card-olive card-outline">
                        <div class="card-body" style="background-color: white;">
                            <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Tema Diklat</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="<?= $d['tema'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Nama Peserta</label>
                                    <div class="col-sm-10">
                                        <select name="id_peserta" class="form-control select2" style="width: 100%;">
                                            <option value="">-- Pilih --</option>
                                            <?php
                                            $dd = $con->query('SELECT id_peserta FROM kehadiran')->fetch_array();
                                            $dt = $con->query("SELECT * FROM pendaftaran a JOIN peserta b ON a.id_peserta = b.id_peserta WHERE a.id_diklat = '$id' ORDER BY a.id_pendaftaran DESC"); ?>
                                            <?php foreach ($dt as $r) : ?>
                                                <option value="<?= $r['id_peserta'] ?>"><?= $r['nm_peserta'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <button type="submit" name="absen" class="btn btn-sm bg-cyan float-right"><i class="fa fa-save"> Simpan</i></button>
                                        <button type="reset" class="btn btn-sm btn-danger float-right mr-1"><i class="fa fa-times-circle"> Batal</i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <!-- Horizontal Form -->
                    <div class="card card-olive card-outline">
                        <!-- form start -->
                        <div class="card-body" style="background-color: white;">
                            <div class="text-center">
                                <p>
                                    <b>
                                        Tema Diklat : <?= $d['tema'] ?>
                                    </b>
                                </p>
                            </div>
                            <hr>
                            <?php if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') { ?>
                                <div id="notif" class="alert bg-teal" role="alert"><i class="fa fa-check-circle mr-2"></i><b><?= $_SESSION['pesan'] ?></b></div>
                            <?php $_SESSION['pesan'] = '';
                            } ?>

                            <?php if (isset($_SESSION['gagal']) && $_SESSION['gagal'] <> '') { ?>
                                <div id="notif" class="alert bg-danger" role="alert"><i class="fa fa-check-circle mr-2"></i><b><?= $_SESSION['gagal'] ?></b></div>
                            <?php $_SESSION['gagal'] = '';
                            } ?>

                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead class="bg-olive">
                                        <tr align="center">
                                            <th>No</th>
                                            <th>Nama Peserta</th>
                                            <th>Asal Instansi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $data = $con->query("SELECT * FROM kehadiran a JOIN peserta b ON a.id_peserta = b.id_peserta WHERE id_diklat = '$id' ORDER BY id_kehadiran DESC");
                                        while ($row = $data->fetch_array()) {
                                        ?>
                                            <tr>
                                                <td align="center" width="5%"><?= $no++ ?></td>
                                                <td><?= $row['nm_peserta'] ?></td>
                                                <td align="center">
                                                    <?php $dt = $con->query("SELECT * FROM pendaftaran a JOIN instansi b ON a.id_instansi = b.id_instansi WHERE id_diklat = '$id' AND id_peserta = '$row[id_peserta]' ")->fetch_array();
                                                    echo $dt['nm_instansi'];
                                                    ?>
                                                </td>
                                                <td align="center" width="5%">
                                                    <a href="hapus-absensi?id=<?= $row[0] ?>&idm=<?= $id ?>" class="btn btn-danger btn-xs alert-hapus mt-1" title="Hapus"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>

                                </table>
                            </div>
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

if (isset($_POST['absen'])) {
    $id_peserta = $_POST['id_peserta'];

    $query = $con->query("SELECT id_peserta, id_diklat FROM kehadiran WHERE id_peserta = '$id_peserta' AND id_diklat = '$id' ");

    if ($query->num_rows > 0) {
        $_SESSION['gagal'] = "Peserta Sudah melakukan Absensi";
        echo "<meta http-equiv='refresh' content='0; url=absensi?id=$id'>";
    } else {
        $tambah = $con->query("INSERT INTO kehadiran VALUES (
            default, 
            '$id',
            '$id_peserta'
        )");

        if ($tambah) {
            $_SESSION['pesan'] = "Data Berhasil di Simpan";
            echo "<meta http-equiv='refresh' content='0; url=absensi?id=$id'>";
        } else {
            echo "Data anda gagal disimpan. Ulangi sekali lagi";
            echo "<meta http-equiv='refresh' content='0; url=absensi?id=$id'>";
        }
    }
}
?>