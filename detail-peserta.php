<?php
require 'configtables.php';
$con = mysqli_connect($con['host'], $con['user'], $con['pass'], $con['db']);
if (mysqli_connect_errno()) {
    echo mysqli_connect_error();
}
?>

<form action="#" method="POST" target="blank">
    <div id="id<?= $id = $row[0]; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">Close</button> -->
                    <h5 class="modal-title" id="custom-width-modalLabel"> <button type="button" class="btn btn-default waves-effect" data-dismiss="modal"><i class="fa fa-info-circle"></i></button> Detail Data Peserta Diklat</h5>
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal"><i class="fa fa-window-close"></i></button>
                </div>
                <?php
                $q = $con->query("SELECT * FROM peserta WHERE id_peserta = '$id' ");
                $d = $q->fetch_array();
                ?>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="card card-purple card-outline collapsed-card">
                                <div class="card-header">
                                    <h3 class="card-title"><b>Pas Foto</b></h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body" style="background-color: white;">
                                    <div class="row">
                                        <img src="<?= base_url() ?>/pas-foto/<?= $d['pas_foto'] ?>" width="100%" alt="Pas Foto">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="card-body" style="text-align: left;">
                                <dl class="row">
                                    <dt class="col-sm-3">Nama Peserta</dt>
                                    <dd class="col-sm-9">: <?= $d['nm_peserta'] ?></dd>
                                    <dt class="col-sm-3">NIP</dt>
                                    <dd class="col-sm-9">: <?= $d['nip'] ?></dd>
                                    <dt class="col-sm-3">Tempat Lahir</dt>
                                    <dd class="col-sm-9">: <?= $d['tmpt_lahir'] ?></dd>
                                    <dt class="col-sm-3">Tanggal Lahir</dt>
                                    <dd class="col-sm-9">: <?= tgl($d['tgl_lahir']) ?></dd>
                                    <dt class="col-sm-3">Jenis Kelamin</dt>
                                    <dd class="col-sm-9">: <?= $d['jk'] ?></dd>
                                    <dt class="col-sm-3">No HP</dt>
                                    <dd class="col-sm-9">: <?= $d['hp_peserta'] ?></dd>
                                    <dt class="col-sm-3">Email</dt>
                                    <dd class="col-sm-9">: <?= $d['email_peserta'] ?></dd>
                                    <dt class="col-sm-3">Pendidikan</dt>
                                    <dd class="col-sm-9">: <?= $d['pendidikan'] ?></dd>
                                </dl>

                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</form>