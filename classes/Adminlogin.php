<?php 
    include("../lib/Session.php");
    Session::checkLogin();
    include_once("../lib/Database.php");
    include_once("../helpers/Format.php");
?>
<?php
class Adminlogin {
    private $db;
    private $fm;
    public function __construct() {
        $this->db = new Database();
        $this->fm = new Format();
    }
    
    public function adminLogin($adminEmail,$adminPass){
        $adminEmail = $this->fm->validation($adminEmail);
        $adminPass = $this->fm->validation($adminPass);
        
        $adminEmail = mysqli_real_escape_string($this->db->link , $adminEmail);
        $adminPass = mysqli_real_escape_string($this->db->link , $adminPass);
        
        if(empty($adminEmail) || empty($adminPass)){
            $loginmsg = "Email or Password must not be empty !";
            return $loginmsg;
        } else{
            $query = "SELECT * FROM admin WHERE adminEmail = '$adminEmail' AND adminPass = '$adminPass'";
            $result = $this->db->select($query);
            if($result != false){
                $value = $result->fetch_assoc();
                Session::set("adminlogin", true);
                Session::set("adminId", $value['adminId']);
                Session::set("adminEmail", $value['adminEmail']);
                Session::set("adminName", $value['adminName']);
                header("Location:dashboard.php");
            } else {
                $loginmsg = "Username or Password not match !";
                return $loginmsg;
            }
        }
    }
}
?>