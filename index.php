<?php
require '../../app/config.php';
include_once '../../template/header.php';
$page = 'award';
include_once '../../template/sidebar.php';
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="m-0 text-dark"><i class="fa fa-award ml-1 mr-1"></i> Data Penghargaan</h4>
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
                                            <th>Tema Diklat</th>
                                            <th>Nama Peserta</th>
                                            <th>Asal Instansi</th>
                                            <th>Penghargaan</th>
                                            <th>Link</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $data = $con->query("SELECT * FROM award a JOIN diklat b ON a.id_diklat = b.id_diklat JOIN peserta c ON a.id_peserta = c.id_peserta ORDER BY id_award DESC");
                                        while ($row = $data->fetch_array()) {
                                        ?>
                                            <tr>
                                                <td align="center" width="5%"><?= $no++ ?></td>
                                                <td><?= $row['tema'] ?></td>
                                                <td><?= $row['nm_peserta'] ?></td>
                                                <td align="center">
                                                    <?php $dt = $con->query("SELECT * FROM pendaftaran a JOIN instansi b ON a.id_instansi = b.id_instansi WHERE id_peserta = '$row[id_peserta]' ")->fetch_array();
                                                    echo $dt['nm_instansi'];
                                                    ?>
                                                </td>
                                                <td align="center"><?= $row['nm_award'] ?></td>
                                                <td align="center">
                                                    <a href="<?= $row['link'] ?>" target="_BLANK" class="btn btn-xs btn-primary"> Penghargaan</a>
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