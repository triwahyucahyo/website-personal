<?php
require '../../app/config.php';
include_once '../../template/header.php';
$page = 'award';
include_once '../../template/sidebar.php';

$id = $_GET['id'];
$query = $con->query(" SELECT * FROM award WHERE id_award ='$id'");
$row = $query->fetch_array();

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
                                    <label class="col-sm-2 col-form-label">Diklat</label>
                                    <div class="col-sm-10">
                                        <select name="id_diklat" id="id_diklat" class="form-control select2" style="width: 100%;">
                                            <option value="">-- Pilih --</option>
                                            <?php $data = $con->query("SELECT * FROM diklat WHERE sts = 1 ORDER BY id_diklat DESC"); ?>
                                            <?php foreach ($data as $r) :
                                                if ($r['id_diklat'] == $row['id_diklat']) { ?>
                                                    <option value="<?= $r['id_diklat']; ?>" selected="<?= $r['id_diklat']; ?>"><?= $r['tema'] ?></option>
                                                <?php } else { ?>
                                                    <option value="<?= $r['id_diklat'] ?>"><?= $r['tema'] ?></option>
                                            <?php }
                                            endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Nama Peserta</label>
                                    <div class="col-sm-10">
                                        <select class="form-control select2" style="width: 100%;" name="id_peserta" id="id_peserta" required>
                                            <option value="">-- Pilih --</option>
                                            <?php $data = $con->query("SELECT * FROM kehadiran a JOIN peserta b ON a.id_peserta = b.id_peserta WHERE a.id_diklat = '$row[id_diklat]' ORDER BY nm_peserta ASC"); ?>
                                            <?php foreach ($data as $r) :
                                                if ($r['id_peserta'] == $row['id_peserta']) { ?>
                                                    <option value="<?= $r['id_peserta']; ?>" selected="<?= $r['id_peserta']; ?>"><?= $r['nm_peserta'] ?></option>
                                                <?php } else { ?>
                                                    <option value="<?= $r['id_peserta'] ?>"><?= $r['nm_peserta'] ?></option>
                                            <?php }
                                            endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Nama Penghargaan</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="nm_award" value="<?= $row['nm_award'] ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Link Penghargaan</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="link" value="<?= $row['link'] ?>" required>
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

    $update = $con->query("UPDATE award SET 
        id_diklat = '$id_diklat',
        id_peserta = '$id_peserta',
        nm_award = '$nm_award',
        link = '$link'
        WHERE id_award = '$id'
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