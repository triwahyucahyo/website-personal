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
                    <h4 class="m-0 text-dark"><i class="fa fa-calendar-week ml-1 mr-1"></i> Tambah Data Penghargaan</h4>
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
                        <?php if (isset($_SESSION['gagal']) && $_SESSION['gagal'] <> '') { ?>
                            <div id="notif" class="alert bg-danger" role="alert"><i class="fa fa-check-circle mr-2"></i><b><?= $_SESSION['gagal'] ?></b></div>
                        <?php $_SESSION['gagal'] = '';
                        } ?>
                        <div class="card-body" style="background-color: white;">
                            <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Diklat</label>
                                    <div class="col-sm-10">
                                        <select name="id_diklat" id="id_diklat" class="form-control select2" style="width: 100%;">
                                            <option value="">-- Pilih --</option>
                                            <?php $data = $con->query("SELECT * FROM diklat WHERE sts = 1 ORDER BY id_diklat DESC"); ?>
                                            <?php foreach ($data as $row) : ?>
                                                <option value="<?= $row['id_diklat'] ?>"><?= $row['tema'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Nama Peserta</label>
                                    <div class="col-sm-10">
                                        <select class="form-control select2" style="width: 100%;" name="id_peserta" id="id_peserta" required>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Nama Penghargaan</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="nm_award" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Link Penghargaan</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="link" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <button type="submit" name="submit" class="btn btn-sm bg-cyan float-right"><i class="fa fa-save"> Simpan</i></button>
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

<script>
    $("#id_diklat").change(function() {

        var id_diklat = $("#id_diklat").val();

        $.ajax({
            type: "POST",
            dataType: "html",
            url: "ajax.php?jenis=diklat",
            data: "diklat=" + id_diklat,
            success: function(msg) {

                if (msg == '') {
                    alert('Tidak ada data');
                } else {
                    $("#id_peserta").html(msg);
                }

            }
        });
    });
</script>

<?php
if (isset($_POST['submit'])) {
    $id_diklat = $_POST['id_diklat'];
    $id_peserta = $_POST['id_peserta'];
    $nm_award = $_POST['nm_award'];
    $link = $_POST['link'];

    $query = $con->query("SELECT id_peserta, id_diklat FROM award WHERE id_peserta = '$id_peserta' AND id_diklat = '$id_diklat' ");

    if ($query->num_rows > 0) {
        $_SESSION['gagal'] = "Peserta Sudah mendapatkan Penghargaan";
        echo "<meta http-equiv='refresh' content='0; url=tambah'>";
    } else {
        $tambah = $con->query("INSERT INTO award VALUES (
            default, 
            '$id_diklat', 
            '$id_peserta', 
            '$nm_award', 
            '$link'
        )");

        if ($tambah) {
            $_SESSION['pesan'] = "Data Berhasil di Simpan";
            echo "<meta http-equiv='refresh' content='0; url=index'>";
        } else {
            echo "Data anda gagal disimpan. Ulangi sekali lagi";
            echo "<meta http-equiv='refresh' content='0; url=tambah'>";
        }
    }
}


?>