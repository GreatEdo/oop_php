<?php 
class User{
    private $_db;
    public function __construct() 
    {
        $this->_db = Database::getInstance();
    }

    public function register_user($data,$file){
        if($this->_db->insert('users', $data, $file)) return true;
        
        else return false;
    }

    //menampilkan all user
    public function allUser(){
        
        $result = $this->_db->select('users');
        if($result == true){
            return $result;
        }else{
            echo "<script>alert('Kesalah di database');</script>";
            return false;
        }
    }

    public function pagination($keyword, $page){
        $result = $this->_db->pages('users', $keyword, $page);
        return $result;
    }

    public function total($keyword){
        $result = $this->_db->getTotoalUser('users', $keyword);
        return $result;
    }

    public function getId($id)
    {
        $result = $this->_db->getId('users',$id);
        if($result == true){
            return $result;
        }else{
            echo "<script>alert('Kesalah di database');</script>";
            return false;
        }
       
    }
    public function update_user($data,$file,$id){
      
        if($this->_db->update('users', $data, $file, $id)) return true;
        else return false;
    }
    public function delete_user($id){
        if($this->_db->delete('users',$id)) return true;
        else return false;
    }
    // public function cariuser($keyword){
    //     $result = $this->_db->cari('users', $keyword);
    //     if($result == true){
    //         return $result;
    //     }else{
    //         echo "<script>alert('Kesalah di database');</script>";
    //         return false;
    //     }
        
    // }
}
?>