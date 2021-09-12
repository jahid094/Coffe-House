<?php 
    $filepath = realpath(dirname(__FILE__));
    include_once($filepath."/../lib/Database.php");
    include_once($filepath."/../helpers/Format.php");
?>
<?php
    class Product {
        private $db;
        private $fm;
        public function __construct() {
            $this->db = new Database();
            $this->fm = new Format();
        }
        
        public function productInsert($data,$file){
            $productName = mysqli_real_escape_string($this->db->link , $data['productName']);
            $body = mysqli_real_escape_string($this->db->link , $data['body']);
            $price = mysqli_real_escape_string($this->db->link , $data['price']);

            $permited  = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $file['image']['name'];
            $file_size = $file['image']['size'];
            $file_temp = $file['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "uploads/".$unique_image;
            
            if($productName == "" || $body == "" || $price == "" || $file_name == "" ){
                $msg = "<span class='error'>Fields must not be empty !</span>";
                return $msg;
            } else if ($file_size >1048567) {
                 echo "<span class='error'>Image Size should be less then 1MB!</span>";
            } else if (in_array($file_ext, $permited) === false) {
                 echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
            } else{
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "INSERT INTO product(productName,body,price,image) VALUES('$productName','$body','$price','$uploaded_image')";
                
                $inserted_row = $this->db->insert($query);
                if($inserted_row){
                    $msg = "<span class='success'>Product Inserted Successfully</span>";
                    return $msg;
                } else {
                    $msg = "<span class='error'>Product Not Inserted.</span>";
                    return $msg;
                }
            } 
        }
        
        public function getAllProduct(){
            $query = "SELECT * FROM product ORDER BY productId DESC";
            $result = $this->db->select($query);
            return $result;
        }
		
		public function delProById($id){
            $query = "SELECT * FROM product WHERE productId = '$id'";
            $getData = $this->db->select($query);
            if($getData){
                while($delImg = $getData->fetch_assoc()){
                    $dellink = $delImg['image']; 
                    unlink($dellink);
                      
                }
            }
                
            $delquery = "DELETE FROM product WHERE productId = '$id'";
            $delData = $this->db->delete($delquery);
            if($delData){
                $msg = "<span class='success'>Product Deleted Successfully</span>";
                return $msg;
            }
            else {
                $msg = "<span class='error'>Product Not Deleted.</span>";
                return $msg;
            } 
        }
        
        
        public function getProById($id){
            $query = "SELECT * FROM product WHERE productId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }
        
        public function productUpdate($data,$file,$id){
            $productName = mysqli_real_escape_string($this->db->link , $data['productName']);
            $body = mysqli_real_escape_string($this->db->link , $data['body']);
            $price = mysqli_real_escape_string($this->db->link , $data['price']);

            $permited  = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $file['image']['name'];
            $file_size = $file['image']['size'];
            $file_temp = $file['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "uploads/".$unique_image;
            
            if($productName == "" || $body == "" || $price == "" ){
                $msg = "<span class='error'>Fields must not be empty !</span>";
                return $msg;
            } else {
                if(!empty($file_name)) {
                    if ($file_size >1048567) {
                        echo "<span class='error'>Image Size should be less then 1MB!</span>";
                    } else if (in_array($file_ext, $permited) === false) {
                        echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
                    } else{
                        move_uploaded_file($file_temp, $uploaded_image);
                        $query = "UPDATE product SET productName = '$productName',body = '$body',price = '$price',image = '$uploaded_image' WHERE productId = '$id'";
                        $updated_row = $this->db->update($query);
                        if($updated_row){
                            $msg = "<span class='success'>Product Updated Successfully</span>";
                            return $msg;
                        } else {
                            $msg = "<span class='error'>Product Not Updated.</span>";
                            return $msg;
                        }
                    } 
                } else {
                    $query = "UPDATE product SET productName = '$productName',body = '$body',price = '$price' WHERE productId = '$id'";
                    $updated_row = $this->db->update($query);
                    if($updated_row){
                        $msg = "<span class='success'>Product Updated Successfully</span>";
                        return $msg;
                    } else {
                        $msg = "<span class='error'>Product Not Updated.</span>";
                        return $msg;
                    }
                }
            }
        }
        
        public function getSingleProduct($id){
            $query = "SELECT * FROM product WHERE productId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }
        
        /*public function getFeaturedProduct(){
            $query = "SELECT * FROM tbl_product WHERE type = '0' ORDER BY productId DESC LIMIT 4";
            $result = $this->db->select($query);
            return $result;
        }*/
        
        /*public function getAllProduct(){
            $query = "SELECT * FROM product ORDER BY productId DESC";
            $result = $this->db->select($query);
            return $result;
        }*/
        
        /*
        
        public function latestFromIphone(){
            $query = "SELECT * FROM tbl_product WHERE brandId = '3' ORDER BY productId DESC LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }
        
        public function latestFromSamsung(){
            $query = "SELECT * FROM tbl_product WHERE brandId = '2' ORDER BY productId DESC LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }
        
        public function latestFromAcer(){
            $query = "SELECT * FROM tbl_product WHERE brandId = '1' ORDER BY productId DESC LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }
        
        public function latestFromCanon(){
            $query = "SELECT * FROM tbl_product WHERE brandId = '6' ORDER BY productId DESC LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }
        
        public function productByCat($id){
            $id = mysqli_real_escape_string($this->db->link , $id);
            $query = "SELECT * FROM tbl_product WHERE catId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }*/
    }
?>