<?php
require '../../app/config.php';
include_once '../../template/header.php';
$page = 'diklat';
include_once '../../template/sidebar.php';
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="m-0 text-dark"><i class="fa fa-calendar-week ml-1 mr-1"></i> Data Diklat</h4>
                </div><!-- /.col -->
                <div class="col-sm-6 text-right">
                    <a href="tambah" class="btn btn-sm bg-dark"><i class="fa fa-plus-circle"> Tambah Data</i></a>
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
                                            <th>Tema</th>
                                            <th>Data Materi</th>
                                            <th>Waktu</th>
                                            <th>Ruangan</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $data = $con->query("SELECT * FROM diklat a JOIN materi b ON a.id_materi = b.id_materi JOIN tutor c ON a.id_tutor = c.id_tutor JOIN ruangan d ON a.id_ruangan = d.id_ruangan ORDER BY tgl_mulai DESC");
                                        while ($row = $data->fetch_array()) {
                                        ?>
                                            <tr>
                                                <td align="center" width="5%"><?= $no++ ?></td>
                                                <td><?= $row['tema'] ?></td>
                                                <td>
                                                    <b>Materi</b> : <?= $row['nm_materi'] ?><br>
                                                    <b>Tutor</b> : <?= $row['nm_tutor'] ?>
                                                </td>
                                                <td align="center">
                                                    <?php if ($row['tgl_mulai'] == $row['tgl_selesai']) { ?>
                                                        <?= tgl($row['tgl_mulai']) ?>
                                                    <?php } else { ?>
                                                        <?= tgl($row['tgl_mulai']) . ' - ' . tgl($row['tgl_selesai']) ?>
                                                    <?php } ?>
                                                    <br>
                                                    <b>Jam Mulai</b> : <?= $row['jam_mulai'] ?>
                                                </td>
                                                <td align="center"><?= $row['nm_ruangan'] ?></td>
                                                <td align="center">
                                                    <?php if ($row['sts'] == 1) {
                                                        echo 'Aktif';
                                                    } else {
                                                        echo 'Non Aktif';
                                                    } ?>
                                                </td>
                                                <td align="center" width="9%">
                                                    <a href="edit?id=<?= $row[0] ?>" class="btn btn-info btn-xs" title="Edit"><i class="fa fa-edit"></i></a>
                                                    <a href="hapus?id=<?= $row[0] ?>" class="btn btn-danger btn-xs alert-hapus" title="Hapus"><i class="fa fa-trash"></i> </a>
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