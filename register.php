<?php
require_once 'core/init.php';
// $db = new Database();
if(Input::get('submit')){
    // echo "hello";
    // var_dump(Input::get('gambar'));die;  
    $register = $user->register_user($_POST, $_FILES);
    
    if($register > 0){
        echo " <script>
                alert('Data Berhasil Ditambah !');
                document.location.href = 'index.php';
            </script>";
    }else {
        echo " <script>
                alert('Data Gagal Ditambah !');
                document.location.href = 'register.php';
            </script>";
    }
}
require_once 'templates/header.php';
?>

<h1>Tambah User</h1><br>
<form action="" method="POST" enctype="multipart/form-data">
    <label for="username">User Name</label>
    <input type="text" name="username" id="username" ><br><br>

    <label for="email">E-mail</label>
    <input type="email" name="email" id="email" ><br><br>

    <label for="gambar">Gambar: </label>
    <input type="file" name="gambar" id="gambar" ><br><br>

    <label for="alamat">Alamat </label>
    <input type="alamat" name="alamat" id="alamat" ><br><br>

    <input type="submit" name="submit" >
</form><br><br>
<?php  require_once 'templates/footer.php'; ?>