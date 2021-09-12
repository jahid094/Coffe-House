<?php
    $filepath = realpath(dirname(__FILE__));
    include_once($filepath."/../lib/Database.php");
    include_once($filepath."/../helpers/Format.php");
?>
<?php 
class Cart {
    private $db;
    private $fm;
    public function __construct() {
        $this->db = new Database();
        $this->fm = new Format();
    }
    
    public function addToCart($quantity,$id) {
        $quantity = $this->fm->validation($quantity); 
        $quantity = mysqli_real_escape_string($this->db->link , $quantity);
        $productId = mysqli_real_escape_string($this->db->link , $id);
        $sId = session_id();
        
        $squery = "SELECT * FROM product WHERE productId = '$productId'";
        $result = $this->db->select($squery)->fetch_assoc();
        
        $productName = $result['productName'];
        $price = $result['price'] * $quantity;
        $image = $result['image'];
        
        $chquery = "SELECT * FROM cart WHERE productId = '$productId' AND sId = '$sId'";
        $getPro = $this->db->select($chquery);
        if($getPro){
            $msg = "Product Already Added";
            return $msg;
        } else{
            $query = "INSERT INTO cart(sId,productId,productName,price,quantity,image) VALUES('$sId','$productId','$productName','$price','$quantity','$image')";
             
            $inserted_row = $this->db->insert($query);
            if($inserted_row){
                echo "<script>window.location = 'viewCart.php'; </script>"; 
                header("Location:viewCart.php");
            } else {
                header("Location:404.php");
            }
        }
    }
    
     public function getCartProduct(){
        $sId = session_id();
        $query = "SELECT * FROM cart WHERE sId = '$sId'";
        $result = $this->db->select($query);
        return $result;
    }
    
    public function updateCartQuantity($cartId,$quantity,$productId){
        $cartId = mysqli_real_escape_string($this->db->link , $cartId);
        $quantity = mysqli_real_escape_string($this->db->link , $quantity);
        $productId = mysqli_real_escape_string($this->db->link , $productId);
		$squery = "SELECT * FROM product WHERE productId = '$productId'";
        $result = $this->db->select($squery)->fetch_assoc();
        
        $price = $result['price'] * $quantity;
        
        $query = "UPDATE cart SET quantity = '$quantity', price = '$price' WHERE cartId = '$cartId'";
        $updated_row = $this->db->update($query);
        if($updated_row){
            header("Location:viewCart.php");
        } else {
            $msg = "<span class='error'>Quantity Not Updated.</span>";
            return $msg;
        }
    }
    
    public function delProductByCart($delId){
        $delId = mysqli_real_escape_string($this->db->link , $delId);
        $query = "DELETE FROM cart WHERE cartId = '$delId'";
        $delData = $this->db->delete($query);
        if($delData){
            echo "<script>window.location = 'viewCart.php'; </script>"; 
            $msg = "<span class='success'>Cart Deleted Successfully</span>";
            return $msg;
        }
        else {
            $msg = "<span class='error'>Product Not Deleted.</span>";
            return $msg;
        } 
    }
    
    public function checkCartTable(){
        $sId = session_id();
        $query = "SELECT * FROM cart WHERE sId = '$sId'";
        $result = $this->db->select($query);
        return $result;
    }
    
    public function delCustomerCart(){
        $sId = session_id();
        $query = "DELETE FROM cart WHERE sId = '$sId'";
        $result = $this->db->delete($query);
        return $result;
    }
    
    public function orderProduct($cmrId){
        $sId = session_id();
        $query = "SELECT * FROM cart WHERE sId = '$sId'";
        $getPro = $this->db->select($query);
        if($getPro){
            while($result = $getPro->fetch_assoc()){
                $productId = $result['productId'];
                $productName = $result['productName'];
                $quantity = $result['quantity'];
                $price = $result['price'];
                $image = $result['image'];
                
                $query = "INSERT INTO tbl_order(cmrId,productId,productName,quantity,price,image) VALUES('$cmrId','$productId','$productName','$quantity','$price','$image')";
             
                $inserted_row = $this->db->insert($query);
            }
        }
    }
    
    public function PayableAmount($cmrId){
        $query = "SELECT price FROM tbl_order WHERE cmrId = '$cmrId' AND date = now()";
        $result = $this->db->select($query);
        return $result;
    }
    
    public function getOrderedProduct($cmrId){
        $query = "SELECT * FROM tbl_order WHERE cmrId = '$cmrId' ORDER BY productId DESC";
        $result = $this->db->select($query);
        return $result;
    }
	
	public function checkOrder($cmrId){
        $query = "SELECT * FROM tbl_order WHERE cmrId = '$cmrId'";
        $result = $this->db->select($query);
        return $result;
    }
    
    public function getAllOrderProduct(){
        $query = "SELECT * FROM tbl_order ORDER BY date DESC";
        $result = $this->db->select($query);
        return $result;
    }
    
    public function productShifted($id,$time,$price){
        $id = mysqli_real_escape_string($this->db->link , $id);
        $time = mysqli_real_escape_string($this->db->link , $time);
        $price = mysqli_real_escape_string($this->db->link , $price);
        $query = "UPDATE tbl_order SET status = '1' WHERE cmrId = '$id' AND date = '$time' AND price = '$price'";
        $updated_row = $this->db->update($query);
        if($updated_row){
            $msg = "<span class='error'>Product Shifted Successfully.</span>";
            return $msg;
        } else {
            $msg = "<span class='error'>Product Not Shifted.</span>";
            return $msg;
        }
    }
    
    public function delProductShifted($id,$time,$price){
        $id = mysqli_real_escape_string($this->db->link , $id);
        $time = mysqli_real_escape_string($this->db->link , $time);
        $price = mysqli_real_escape_string($this->db->link , $price);
        $query = "DELETE FROM tbl_order WHERE cmrId = '$id' AND date = '$time' AND price = '$price'";
        $updated_row = $this->db->delete($query);
        if($updated_row){
            $msg = "<span class='error'>Product Removed Successfully.</span>";
            return $msg;
        } else {
            $msg = "<span class='error'>Product Not Removed.</span>";
            return $msg;
        }
    }
    
    public function productShiftConfirm($id,$time,$price){
        $id = mysqli_real_escape_string($this->db->link , $id);
        $time = mysqli_real_escape_string($this->db->link , $time);
        $price = mysqli_real_escape_string($this->db->link , $price);
        $query = "UPDATE tbl_order SET status = '2' WHERE cmrId = '$id' AND date = '$time' AND price = '$price'";
        $updated_row = $this->db->update($query);
        if($updated_row){
            $msg = "<span class='error'>Product Shifted Successfully.</span>";
            return $msg;
        } else {
            $msg = "<span class='error'>Product Not Shifted.</span>";
            return $msg;
        }
    }
}
?>