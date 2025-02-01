<?php
require '../../app/config.php';
include_once '../../template/header.php';
$page = 'kehadiran';
include_once '../../template/sidebar.php';
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="m-0 text-dark"><i class="fa fa-user-check ml-1 mr-1"></i> Data Kehadiran Diklat</h4>
                </div><!-- /.col -->
                <div class="col-sm-6 text-right">
                    <!-- <a href="tambah" class="btn btn-sm bg-dark"><i class="fa fa-plus-circle"> Tambah Data</i></a> -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="card card-purple card-outline">
                        <!-- form start -->
                        <div class="card-body" style="background-color: white;">

                            <?php if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') { ?>
                                <div id="notif" class="alert bg-teal" role="alert"><i class="fa fa-check-circle mr-2"></i><b><?= $_SESSION['pesan'] ?></b></div>
                            <?php $_SESSION['pesan'] = '';
                            } ?>

                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped dataTable">
                                    <thead class="bg-purple">
                                        <tr align="center">
                                            <th>No</th>
                                            <th>Tema Diklat</th>
                                            <th>Peserta Terdaftar</th>
                                            <th>Peserta Hadir</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $data = $con->query("SELECT * FROM diklat ORDER BY id_diklat DESC");
                                        while ($row = $data->fetch_array()) {
                                        ?>
                                            <tr>
                                                <td align="center" width="5%"><?= $no++ ?></td>
                                                <td><?= $row['tema'] ?></td>
                                                <td align="center">
                                                    <?php
                                                    $ttl = $con->query("SELECT COUNT(*) AS total FROM pendaftaran WHERE id_diklat = '$row[id_diklat]'")->fetch_array();
                                                    echo $ttl['total'] . ' Orang';
                                                    ?>
                                                </td>
                                                <td align="center">
                                                    <?php
                                                    $ttl2 = $con->query("SELECT COUNT(*) AS total FROM kehadiran WHERE id_diklat = '$row[id_diklat]'")->fetch_array();
                                                    echo $ttl2['total'] . ' Orang';
                                                    ?>
                                                </td>
                                                <td align="center" width="15%">
                                                    <a href="absensi?id=<?= $row[0] ?>" class="btn bg-primary btn-xs" title="Absensi"><i class="fa fa-plus-circle mr-1"></i> Data Kehadiran</a>
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
?>