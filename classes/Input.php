<?php 
class Input{
    public static function get($name){
        if(isset($_POST[$name])){
            return $_POST[$name];
        }elseif(isset($_GET[$name])){
            return $_GET[$name];
        }
        elseif(isset($_FILES[$name])){ 
            return $_FILES[$name];
        } 
        return false;
    }
}

?>