<?php
require 'app/config.php';
$jk = [
    '' => '-- Pilih --',
    'Laki-laki' => 'Laki-laki',
    'Perempuan' => 'Perempuan',
];

$pdd = [
    '' => '-- Pilih --',
    'SLTA' => 'SLTA',
    'Sarjana' => 'Sarjana',
    'Magister' => 'Magister',
    'Doktor' => 'Doktor',
];
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="assets/images/logo.png">
    <title>Sistem Informasi Diklat</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="assets/alert/sweetalert.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body>
    <div class="hold-transition login-page" id="form-login" style="display: none;">
        <div class="login-box">
            <!-- /.login-logo -->
            <div class="card">
                <div class="card-body login-card-body">
                    <div style="text-align: center;">
                        <img src="assets/images/logo.png" alt="Logo" width="140">
                    </div>
                    <hr>
                    <h6 class="login-box-msg">Login Sistem Informasi Pelayanan Diklat Berbasis Web Di Balai Teknologi Informasi Komunikasi Dan Pendidikan Banjarmasin</h6>
                    <form action="" method="POST">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="username" placeholder="Username">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" name="password" placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row text-center">
                            <div class="col-12">
                                <button type="submit" class="btn btn-block bg-cyan mb-2" name="log">Login</button>
                                <a href="" class="text-center tab-register"><u> Belum Punya Akun ?</u></a><br>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                    <br>
                    <center><p>Repost by <a href='https://stokcoding.com/' title='StokCoding.com' target='_blank'>StokCoding.com</a></p></center>

                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
        <!-- /.login-box -->
    </div>

    <div class="hold-transition" style="margin-left: 200px; margin-right: 200px; margin-top: 30px; display: none;" id="form-register">
        <div class="card card-purple">
            <div class="card-header">
                <h3 class="card-title"><i class="fa fa-users mr-1"></i> Register Akun Peserta Diklat</h3>
            </div>
            <div class="card-body">
                <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nama Lengkap</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="nm_peserta" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">NIP</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" name="nip" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Tempat & Tanggal Lahir</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="tmpt_lahir" placeholder="Tempat Lahir" required>
                        </div>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" name="tgl_lahir" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-9">
                            <?= form_dropdown('jk', $jk, '', 'class="form-control" required') ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Kontak</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="hp_peserta" placeholder="No. HP/WA" required>
                        </div>
                        <div class="col-sm-4">
                            <input type="email" class="form-control" name="email_peserta" placeholder="Email Aktif" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Pendidikan</label>
                        <div class="col-sm-9">
                            <?= form_dropdown('pendidikan', $pdd, '', 'class="form-control" required') ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Upload Pas Foto</label>
                        <div class="col-sm-9">
                            <input type="file" accept=".jpg,.jpeg,.png,.JPG.,JPEG,.PNG" class="form-control" name="pas_foto" required>
                            <label style='color: red; font-style: italic; font-size: 12px;'>* File harus Gambar dan Ukuran file maksimal 2MB</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Username</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="username2" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Password</label>
                        <div class="input-group col-sm-9">
                            <input type="password" class="form-control" id="pw" name="password2" required>
                            <div class="input-group-append">
                                <div class="input-group-text" id="lihatpw">
                                    <span class="fas fa-eye" title="Lihat Password" onclick="change1();"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="form-group row">
                        <div class="col-sm-4">

                        </div>
                        <div class="col-sm-4 text-center">
                            <button type="submit" name="register" class="btn btn-block btn-block bg-purple mb-2">Register Akun</i></button>
                            <a href="" class="text-center tab-login"><u> Sudah Punya Akun ?</u></a>
                        </div>
                        <div class="col-sm-4">

                        </div>
                    </div>
                </form>
                <br>
                <center><p>Repost by <a href='https://stokcoding.com/' title='StokCoding.com' target='_blank'>StokCoding.com</a></p></center>

            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="assets/dist/js/adminlte.min.js"></script>
    <script src="assets/alert/sweetalert.min.js"></script>

    <script>
        $('#form-login').show();

        $('.tab-register').on('click', function(e) {
            e.preventDefault();
            $('#form-login').hide();
            $('#form-register').show();
            $('#form-login').trigger('reset');
            $('#form-register').trigger('reset');
        });

        $('.tab-login').on('click', function(e) {
            e.preventDefault();
            $('#form-register').hide();
            $('#form-login').show();
            $('#form-login').trigger('reset');
            $('#form-register').trigger('reset');
        });
    </script>

    <script>
        function change1() {
            var x = document.getElementById('pw').type;

            if (x == 'password') {
                document.getElementById('pw').type = 'text';
                document.getElementById('lihatpw').innerHTML = '<span class="fas fa-eye" title="Lihat Password" style="color: blue;" id="lihatpw" onclick="change1();"></span>';
            } else {
                document.getElementById('pw').type = 'password';
                document.getElementById('lihatpw').innerHTML = '<span class="fas fa-eye" title="Lihat Password" id="lihatpw" onclick="change1();"></span>';
            }
        }
    </script>

</body>

</html>

<?php
if (isset($_POST['log'])) {
    $user = $con->real_escape_string($_POST['username']);
    $pass = $con->real_escape_string($_POST['password']);

    $pass = md5($pass);
    $query = $con->query("SELECT * FROM user WHERE username = '$user' AND password='$pass'");
    $data = $query->fetch_array();
    $username = $data['username'];
    $password = $data['password'];
    $id = $data['id_user'];
    $level = $data['level'];
    $usr = $data['nm_user'];

    if ($user == $username && $pass == $password) {

        $_SESSION["login"] = true;
        $_SESSION['id_user'] = $id;
        $_SESSION['level'] = $level;
        $_SESSION['nm_user'] = $usr;
        if ($level == 3) {
            echo "
            <script type='text/javascript'>
                setTimeout(function () {
                    swal({
                        title: 'Login Berhasil',
                        text:  'Anda Login Sebagai $usr',
                        type: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });
                },10);
                window.setTimeout(function(){
                    window.location.replace('peserta/');
                } ,2000);
            </script>";
        } else {
            echo "
            <script type='text/javascript'>
                setTimeout(function () {
                    swal({
                        title: 'Login Berhasil',
                        text:  'Anda Login Sebagai $usr',
                        type: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });
                },10);
                window.setTimeout(function(){
                    window.location.replace('admin/');
                } ,2000);
            </script>";
        }
    } else {
        echo "
        <script type='text/javascript'>
            setTimeout(function () {
                swal({
                    title: 'Login Gagal',
                    text:  'Username atau Password Tidak Ditemukan',
                    type: 'error',
                    timer: 2000,
                    showConfirmButton: false
                });
            },10);
            window.setTimeout(function(){
                window.location.replace('index');
            } ,2000);
        </script>";
    }
}

if (isset($_POST['register'])) {
    $nama = $_POST['nm_peserta'];
    $nip = $_POST['nip'];
    $tmpt_lahir = $_POST['tmpt_lahir'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $jk = $_POST['jk'];
    $hp = $_POST['hp_peserta'];
    $email = $_POST['email_peserta'];
    $pdd = $_POST['pendidikan'];
    $username = $_POST['username2'];
    $pw = md5($_POST['password2']);

    $f_pas_foto = "";

    if (!empty($_FILES['pas_foto']['name'])) {

        // UPLOAD FILE
        $file      = $_FILES['pas_foto']['name'];
        $x_file    = explode('.', $file);
        $ext_file  = end($x_file);
        $pas_foto = rand(1, 99999) . '.' . $ext_file;
        $size_file = $_FILES['pas_foto']['size'];
        $tmp_file  = $_FILES['pas_foto']['tmp_name'];
        $dir_file  = 'pas-foto/';
        $allow_ext        = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');
        $allow_size       = 2097152;
        // var_dump($pas_foto); die();

        if (in_array($ext_file, $allow_ext) === true) {
            if ($size_file <= $allow_size) {
                move_uploaded_file($tmp_file, $dir_file . $pas_foto);

                $f_pas_foto .= "Upload Success";
            } else {
                echo "
                <script type='text/javascript'>
                    setTimeout(function () {
                        swal({
                            title: '',
                            text:  'Ukuran Foto Terlalu Besar, Maksimal 2 Mb',
                            type: 'warning',
                            timer: 3000,
                            showConfirmButton: true
                        });
                    },10);
                    window.setTimeout(function(){
                        window.location.replace('tambah');
                    } ,2000);
                </script>";
            }
        } else {
            echo "
            <script type='text/javascript'>
                setTimeout(function () {
                    swal({
                        title: 'Format File Tidak Didukung',
                        text:  'File Harus Berupa Gambar',
                        type: 'warning',
                        timer: 3000,
                        showConfirmButton: true
                    });
                },10);
                window.setTimeout(function(){
                    window.location.replace('tambah');
                } ,2000);
            </script>";
        }
    } else {
        $pas_foto = $_POST['pas_foto'];
        $f_pas_foto .= "Upload Success!";
    }

    if (!empty($f_pas_foto)) {

        $tambah = $con->query("INSERT INTO peserta VALUES (
            default,
            '$nama',
            '$nip',
            '$tmpt_lahir',
            '$tgl_lahir',
            '$jk',
            '$hp',
            '$email',
            '$pdd',
            '$pas_foto'
        )");

        if ($tambah) {
            $dt = mysqli_insert_id($con);
            $con->query("INSERT INTO user VALUES (
                default,
                $dt,
                '$nama',
                '$username',
                '$pw',
                3
            )");

            $user = $con->real_escape_string($_POST['username2']);
            $pass = $con->real_escape_string($_POST['password2']);

            $pass = md5($pass);
            $query = $con->query("SELECT * FROM user WHERE username = '$user' AND password='$pass'");
            $data = $query->fetch_array();
            $username2 = $data['username'];
            $password2 = $data['password'];
            $id = $data['id_user'];
            $level = $data['level'];
            $usr = $data['nm_user'];

            if ($user == $username2 && $pass == $password2) {

                $_SESSION["login"] = true;
                $_SESSION['id_user'] = $id;
                $_SESSION['level'] = $level;
                $_SESSION['nm_user'] = $usr;
                echo "
                <script type='text/javascript'>
                    setTimeout(function () {
                        swal({
                            title: 'Register Akun Berhasil',
                            text:  'Sekarang anda Login Sebagai $usr',
                            type: 'success',
                            timer: 3000,
                            showConfirmButton: false
                        });
                    },10);
                    window.setTimeout(function(){
                        window.location.replace('peserta/');
                    } ,3000);
                </script>";
            } else {
                echo "
                <script type='text/javascript'>
                    setTimeout(function () {
                        swal({
                            title: 'Login Gagal',
                            text:  'Username atau Password Tidak Ditemukan',
                            type: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    },10);
                    window.setTimeout(function(){
                        window.location.replace('index');
                    } ,2000);
                </script>";
            }
        } else {
            echo "
            <script type='text/javascript'>
                setTimeout(function () {
                    swal({
                        title: 'Register Gagal',
                        text:  'Silahkan Isi Data dengan Benar',
                        type: 'error',
                        timer: 2000,
                        showConfirmButton: false
                    });
                },10);
                window.setTimeout(function(){
                    window.location.replace('index.php#form-register');
                } ,2000);
            </script>";
        }
    }
}
