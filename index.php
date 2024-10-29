<?php
require_once 'core/init.php';
// $users = $user->allUser();


$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
$page = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;

// panggil method total
$totalUser = $user->total($keyword);

$users = $user->pagination($keyword, $page);

// utk mendapatkan total dari data di database 
// ceil membulatkan nilai ke ats / ke bwh cth 6.1 = 7 
$totalPages = ceil($totalUser / 3);

// utk fix no urut
$pg = 3;
$noUrut = ($pg * $page) - $pg;



if (Input::get('hapus')) {
    // $id = $_GET['hapus'];
    $id = Input::get('hapus'); //bisa kek gni krn kita ud buat class input utk menangani global variable PHP
    $delete = $user->delete_user($id);
    if ($delete > 0) {
        echo " <script>
                alert('Data Berhasil Dihapus !');
                document.location.href = 'index.php';
            </script>";
    } else {
        echo " <script>
                alert('Data Gagal Dihapus !');
                document.location.href = 'index.php';
            </script>";
    }
}
// if (Input::get('cari')) {
//     $users = $user->cariuser(Input::get('keyword'));
// }

// $users = $user->cariuser($_POST['keyword']);
require_once 'templates/header.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>

<body>
    <h1> Daftar Users</h1>
    <!-- cari -->
    <form action="" method="GET">
        <input type="text" name="keyword" size="40" autofocus placeholder="Cari Data Yang di Inginkan di Sini" autocomplete="off">
        <input type="submit" name="cari" value="Cari">
    </form><br>
    <!-- end -->

    <!-- navigasi -->
    <?php if ($page > 1): ?>
        <a href="?halaman=<?php echo $page - 1; ?>&keyword=<?php echo urlencode($keyword); ?>">Previous</a>
    <?php endif; ?>
    <!-- end -->


    <!-- number navigasi -->
    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <?php if ($i == $page): ?>
            <a href="?halaman=<?php echo $i; ?>&keyword=<?php echo urlencode($keyword); ?>" style="font-weight:bold; color:red;"><?php echo $i; ?></a>
        <?php else: ?>
            <a href="?halaman=<?php echo $i; ?>&keyword=<?php echo urlencode($keyword); ?>"><?php echo $i; ?></a>
        <?php endif; ?>
    <?php endfor; ?>
    <!-- end -->

    <!-- navigasi -->
    <?php if ($page < $totalPages): ?>
        <a href="?halaman=<?php echo $page + 1; ?>&keyword=<?php echo urlencode($keyword); ?>">Next</a>
    <?php endif; ?>
    <!-- end -->




    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No. </th>
            <th>Username </th>
            <th>E-mail </th>
            <th>Gambar</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>

        <?php $i = $noUrut + 1; ?>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $i; ?></td>
                <td><?= $user['username']; ?></td>
                <td><?= $user['email']; ?></td>
                <td><img src="upload/<?= $user['gambar']; ?>" width="50"></td>
                <td><?= $user['alamat']; ?></td>
                <td>
                    <a href="?hapus=<?= $user['id']; ?>" onclick="return confirm('Yakin ingin menghapus data?')">Hapus</a> |
                    <a href="edit.php?id=<?= $user['id']; ?>">Edit</a>
                </td>
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>


    </table>
</body>

</html><br><br>
<?php require_once 'templates/footer.php'; ?>