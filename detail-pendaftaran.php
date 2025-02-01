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
                    <h5 class="modal-title" id="custom-width-modalLabel"> <button type="button" class="btn btn-default waves-effect" data-dismiss="modal"><i class="fa fa-info-circle"></i></button> Detail Data Pendaftaran Peserta Diklat</h5>
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal"><i class="fa fa-window-close"></i></button>
                </div>
                <?php
                $q = $con->query("SELECT * FROM pendaftaran a JOIN diklat b ON a.id_diklat = b.id_diklat JOIN materi c ON b.id_materi = c.id_materi JOIN tutor d ON b.id_tutor = d.id_tutor JOIN ruangan e ON b.id_ruangan = e.id_ruangan JOIN instansi f ON a.id_instansi = f.id_instansi JOIN peserta g ON a.id_peserta = g.id_peserta WHERE id_pendaftaran = '$id' ");
                $d = $q->fetch_array();
                ?>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="card-body" style="text-align: left;">
                                <dl class="row">
                                    <dt class="col-sm-3">No. Pendaftaran</dt>
                                    <dd class="col-sm-9">:
                                        <?php if (!empty($d['nomor'])) {
                                            echo $d['nomor'];
                                        } else {
                                            echo 'Menunggu Verifikasi';
                                        } ?>
                                    </dd>
                                    <dt class="col-sm-3">Nama Peserta</dt>
                                    <dd class="col-sm-9">: <?= $d['nm_peserta'] ?></dd>
                                    <dt class="col-sm-3">NIP</dt>
                                    <dd class="col-sm-9">: <?= $d['nip'] ?></dd>
                                    <dt class="col-sm-3">Asal Instansi</dt>
                                    <dd class="col-sm-9">: <?= $d['nm_instansi'] ?></dd>
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
                                    <dt class="col-sm-3">Tema Diklat</dt>
                                    <dd class="col-sm-9">: <?= $d['tema'] ?></dd>
                                    <dt class="col-sm-3">Materi Diklat</dt>
                                    <dd class="col-sm-9">: <?= $d['nm_materi'] ?></dd>
                                    <dt class="col-sm-3">Nama Tutor</dt>
                                    <dd class="col-sm-9">: <?= $d['nm_tutor'] ?></dd>
                                    <dt class="col-sm-3">Tanggal</dt>
                                    <dd class="col-sm-9">:
                                        <?php if ($d['tgl_mulai'] == $d['tgl_selesai']) { ?>
                                            <?= tgl($d['tgl_mulai']) ?>
                                        <?php } else { ?>
                                            <?= tgl($d['tgl_mulai']) . ' - ' . tgl($d['tgl_selesai']) ?>
                                        <?php } ?>
                                    </dd>
                                    <dt class="col-sm-3">Jam Mulai</dt>
                                    <dd class="col-sm-9">: <?= $d['jam_mulai'] ?></dd>
                                    <dt class="col-sm-3">Ruangan</dt>
                                    <dd class="col-sm-9">: <?= $d['nm_ruangan'] ?></dd>
                                    <dt class="col-sm-3">Status</dt>
                                    <dd class="col-sm-9">:
                                        <?php if ($d['verif'] == 1) {
                                            echo 'Terverifikasi';
                                        } else {
                                            echo 'Belum Terverifikasi';
                                        } ?>
                                    </dd>
                                </dl>
                            </div>
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
                        </div>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</form>