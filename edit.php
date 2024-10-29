<?php
require_once 'core/init.php';
if (Input::get('id')) {
    $id = $_GET['id'];
}
// var_dump($id);die;
$users = $user->getId($id); //mengambil data user berdasarkan id

if(Input::get('submit')){
    $update = $user->update_user($_POST, $_FILES, $id);
    if($update > 0){
        echo " <script>
                alert('Data Berhasil Diupdate !');
            </script>";
    }else {
        echo " <script>
                alert('Data Gagal Diupdate !');
            </script>";
    }
}


require_once 'templates/header.php';
?>

<h1>Edit User</h1>

<?php foreach ($users as $user): ?>
    <form action="" method="POST" enctype="multipart/form-data">
        <!-- gambar lama di sini utk menampung jika user tdk mengupload gambar -->
        <input type="hidden" name="id" value="<?= $user['id'];?>" >
        <input type="hidden" name="gambarlama" value="<?= $user["gambar"];?>">
        <!--  -->
        <label for="username">User Name</label>
        <input type="text" name="username" id="username" value="<?= $user['username']; ?>" required><br><br>

        <label for="email">E-mail</label>
        <input type="email" name="email" id="email" value="<?= $user['email']; ?>" required><br><br>

        <label for="gambar">Gambar: </label>
        <input type="file" name="gambar" id="gambar"><br>
        <img src="upload/<?= $user['gambar']; ?>" width="50"><br><br>

        <label for="alamat">Alamat</label>
        <input type="alamat" name="alamat" id="alamat" value="<?= $user['alamat']; ?>" required><br><br>

        <input type="submit" value="Update" name="submit"><br><br>
    </form>
<?php endforeach; ?>
<?php require_once 'templates/footer.php'; ?>