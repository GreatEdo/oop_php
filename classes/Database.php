<?php

require_once 'connection.php'; //memanggil file connection 
class Database
{
    private static $INSTANCE = NULL;

    private $mysqli,
        $HOST = HOST,
        $USER = USER,
        $PASS = PASSWORD,
        $DBNAME = DATABASE;

    public function __construct()
    {
        $this->mysqli = new mysqli(
            $this->HOST,
            $this->USER,
            $this->PASS,
            $this->DBNAME
        );
        if (mysqli_connect_error()) {
            die('Koneksi gagal !');
        }
    }

    /* 
    singleton pattern 
    menguji koneksi agar tidak double
    */
    public static function getInstance()
    {
        if (!isset(self::$INSTANCE)) {
            self::$INSTANCE = new Database();
        }
        return self::$INSTANCE;
    }



    public function insert($table, $data, $file)
    {


        $username = htmlspecialchars($data["username"]);
        $email = htmlspecialchars($data["email"]);
        $alamat = htmlspecialchars($data["alamat"]);


        $gambar = $this->upload($file);

        if (!$gambar) {
            return false;
        }

        $query = "INSERT INTO $table (username, email, gambar, alamat) VALUES ('$username', '$email', '$gambar','$alamat')";
        // die($query);
        if ($this->mysqli->query($query)) return true;
        else return false;
    }

    public function upload($file)
    {
        $namaFile = $file['gambar']['name'];
        $ukuranFile = $file['gambar']['size'];
        $error = $file['gambar']['error'];
        $tmpName = $file['gambar']['tmp_name'];

        if ($error === 4) {
            // 4 itu artinya tdk ada gambar yg diupload 
            echo "<script> alert('Pilih gambar terlebih dahulu') </script>";
            return false;
        }

        // cek yg diupload harus berupa gambar
        $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
        $ekstensiGambar = explode('.', $namaFile);
        $ekstensiGambar = strtolower(end($ekstensiGambar));

        if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
            echo "<script> alert('Format gambar salah!') </script>";
            return false;
        }

        // cek jika gambar terlalu besar
        if ($ukuranFile > 1000000) {
            echo "<script> alert('Ukuran Gambar Terlalu Besar!') </script>";
            return false;
        }


        $namaFileBaru = uniqid();
        $namaFileBaru .= '.';
        $namaFileBaru .= $ekstensiGambar;


        move_uploaded_file($tmpName, 'upload/' . $namaFileBaru);

        return $namaFileBaru;
    }
    public function select($table)
    {
        // $query = "SELECT * FROM $table ORDER BY id DESC";
        $query = "SELECT * FROM $table ";


        $result = mysqli_query($this->mysqli, $query);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;



        if ($this->mysqli->query($query)) return true;
        else return false;
    }

    private $jumlahDataperHalaman = 3;

    public function pages($table,  $keyword = '', $page = 1,)
    {
        $awalData = ($page - 1) * $this->jumlahDataperHalaman;
        $query = "SELECT * FROM $table
                    WHERE 
                    username LIKE '%$keyword%' OR
                    email LIKE '%$keyword%' OR
                    alamat LIKE '%$keyword%' 
                    LIMIT $awalData ,$this->jumlahDataperHalaman";

        $db = mysqli_query($this->mysqli, $query);
        $cek = mysqli_num_rows($db);
        if (empty($cek)) {
            echo "
                <script>
                    alert('Data Tidak Ditemukan');
                    document.location.href = 'index.php'
                </script>
                ";
        } else {
            return $this->mysqli->query($query);
        }
    }

    public function getTotoalUser($table, $keyword=''){
        $query = "SELECT * FROM $table
                 WHERE 
                    username LIKE '%$keyword%' OR
                    email LIKE '%$keyword%' OR
                    alamat LIKE '%$keyword%' 
        ";
        $db = mysqli_query($this->mysqli,$query);
        $result = mysqli_num_rows($db);
        return $result;
      
    }
    // public function cari($table, $keyword )
    // {
    //     
    //     $query = "SELECT * FROM $table 
    //             WHERE username LIKE '%$keyword%' OR
    //                     email LIKE '%$keyword%' OR
    //                     alamat LIKE '%$keyword%'        
    //     ";

    //     $db = mysqli_query($this->mysqli, $query);
    //     $cek = mysqli_num_rows($db);
    //     if (empty($cek)) {
    //         echo "
    //         <script>
    //             alert('Data Tidak Ditemukan');
    //             document.location.href = 'index.php'
    //         </script>
    //          ";
    //     } else {
    //         return $this->mysqli->query($query);
    //     }
    // }

    public function getId($table, $id)
    {

        $query = "SELECT * FROM $table WHERE id = '$id'";

        $result = mysqli_query($this->mysqli, $query);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;



        if ($this->mysqli->query($query)) return true;
        else return false;
    }
    public function update($table, $data, $file, $id)
    {

        $username = htmlspecialchars($data["username"]);
        $email = htmlspecialchars($data["email"]);
        $alamat = htmlspecialchars($data["alamat"]);


        $gambarlama = htmlspecialchars($data['gambarlama']);

        if ($_FILES['gambar']['error'] === 4) {
            $gambar = $gambarlama;
        } else {
            $imgquery = mysqli_query($this->mysqli, "SELECT gambar FROM $table WHERE id = '$id'");
            $imgfile = mysqli_fetch_assoc($imgquery);
            $namaFile = implode('.', $imgfile);
            unlink('upload/' . $namaFile);
            $gambar = $this->upload($file);
        }

        $query = "UPDATE $table SET
                    username = '$username',
                    email = '$email',
                    gambar = '$gambar',
                    alamat = '$alamat'
                    WHERE id = '$id' ";
        // die($query);
        if ($this->mysqli->query($query)) return true;
        else return false;
    }
    public function delete($table, $id)
    {
        $imgquery = mysqli_query($this->mysqli, "SELECT gambar FROM $table WHERE id = '$id'");
        $imgfile = mysqli_fetch_assoc($imgquery);
        $namaFile = implode('.', $imgfile);
        unlink('upload/' . $namaFile);

        $query_hapus = "DELETE FROM $table WHERE id = '$id'";
        if ($this->mysqli->query($query_hapus)) return true;
        else return false;
    }
}
// $db = Database::getInstance();
// var_dump($db);die;
