<?php
    $filepath = realpath(dirname(__FILE__));
    include_once($filepath."/../lib/Database.php");
    include_once($filepath."/../helpers/Format.php");
?>
<?php 
class Customer {
    private $db;
    private $fm;
    public function __construct() {
        $this->db = new Database();
        $this->fm = new Format();
    }
    
    public function customerRegistration($data){
        $firstname = mysqli_real_escape_string($this->db->link , $data['firstname']);
        $lastname = mysqli_real_escape_string($this->db->link , $data['lastname']);
        $address = mysqli_real_escape_string($this->db->link , $data['address']);
        $email = mysqli_real_escape_string($this->db->link , $data['email']);
		$phone = mysqli_real_escape_string($this->db->link , $data['phone']);
        $pass = mysqli_real_escape_string($this->db->link , md5($data['pass']));
		if(isset($data['gender'])){
			$gender = mysqli_real_escape_string($this->db->link , $data['gender']);
		} else {
			$gender = "";
		}

        if($firstname == "" || $lastname == "" || $address == "" || $phone == "" || $email == "" || $gender == "" ){
            $msg = "<span class='error'>Fields must not be empty !</span>";
            return $msg;
        } 
        $mailquery = "SELECT * FROM customer WHERE email = '$email' LIMIT 1";
        $mailchk = $this->db->select($mailquery);
        if($mailchk != false){
            $msg = "<span class='success'>Email already Exist !</span>";
            return $msg;
        } else{
            $query = "INSERT INTO customer(firstname,lastname,address,email,phone,pass,gender) VALUES('$firstname','$lastname','$address','$email','$phone','$pass','$gender')";
            $inserted_row = $this->db->insert($query);
            if($inserted_row){
                $msg = "<span class='success'>Customer Data Inserted Successfully</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Customer Data Not Inserted.</span>";
                return $msg;
            }
        } 
    }
    
    public function  customerLogin($data){
        $email = mysqli_real_escape_string($this->db->link , $data['email']);
        $pass = mysqli_real_escape_string($this->db->link , md5($data['pass']));
        
        if(empty($email) || empty($pass)){
            $msg = "<span class='error'>Fields must not be empty !</span>";
            return $msg;
        } 
        $query = "SELECT * FROM customer WHERE email = '$email' AND pass = '$pass'";
        $result = $this->db->select($query);
        if($result != false){
            $value = $result->fetch_assoc();
            Session::set("cuslogin",true);
            Session::set("cmrId",$value['customerId']);
            Session::set("cmrName",$value['name']);
			if(!empty($data["remember"])){
				setcookie ("user_email",$email,time()+ (10 * 365 * 24 * 60 * 60));  
				setcookie ("user_password",$data['pass'],time()+ (10 * 365 * 24 * 60 * 60));
			} else {  
				if(isset($_COOKIE["user_email"])) {  
					setcookie ("user_email","");  
				}  
				if(isset($_COOKIE["user_password"])) {  
					setcookie ("user_password","");  
				}  
			}
			header("Location:index.php");
			
		} else{
            $msg = "<span class='error'>Email or Password Not matched!</span>";
            return $msg;
        }
    } 
	
	public function getCustomerData($id){
        $query = "SELECT * FROM customer WHERE customerId = '$id'";
        $result = $this->db->select($query);
        return $result;
    }
    
    public function customerUpdate($data,$id){
        $firstname = mysqli_real_escape_string($this->db->link , $data['firstname']);
        $lastname = mysqli_real_escape_string($this->db->link , $data['lastname']);
        $address = mysqli_real_escape_string($this->db->link , $data['address']);
        $email = mysqli_real_escape_string($this->db->link , $data['email']);
        $phone = mysqli_real_escape_string($this->db->link , $data['phone']);
        $id = mysqli_real_escape_string($this->db->link , $id);
        
        if($firstname == "" || $lastname == "" || $address == "" || $phone == "" || $email == ""){
            $msg = "<span class='error'>Fields must not be empty !</span>";
            return $msg;
        } else{
            $query = "UPDATE customer 
                      SET 
                      firstname = '$firstname', lastname = '$lastname', address='$address', phone='$phone', email='$email' 
                      WHERE customerId = '$id'";
            $updated_row = $this->db->update($query);
            if($updated_row){
                $msg = "<span class='success'>Customer Data Updated Successfully</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Customer Data Not Updated.</span>";
                return $msg;
            }
        }
    }
	
	public function sendFeedback($data,$id){
        $name = mysqli_real_escape_string($this->db->link , $data['name']);
        $address = mysqli_real_escape_string($this->db->link , $data['address']);
        $email = mysqli_real_escape_string($this->db->link , $data['email']);
        $phone = mysqli_real_escape_string($this->db->link , $data['phone']);
        $subject = mysqli_real_escape_string($this->db->link , $data['subject']);
        $body = mysqli_real_escape_string($this->db->link , $data['body']);
        $id = mysqli_real_escape_string($this->db->link , $id);
        
        if($name == "" || $address == "" || $phone == "" || $email == "" || $subject == "" || $body == ""){
            $msg = "<span class='error'>Fields must not be empty !</span>";
            return $msg;
        } else{
            $query = "INSERT INTO feedback(customerId,name,email,phone,address,subject,body) VALUES('$id','$name','$email','$phone','$address','$subject','$body')";
            $inserted_row = $this->db->insert($query);
            if($inserted_row){
                $msg = "<span class='success'>Feedback Sent Successfully</span>";
                return $msg;
            } else {
                $msg = "<span class='error'>Feedback Not Sent.</span>";
                return $msg;
            }
        }
    }
	
	public function getAllFeedback(){
		$query = "SELECT * FROM feedback ORDER BY feedbackId DESC";
		$result = $this->db->select($query);
        return $result;
    }
	
	public function delFeedbackById($id){
		$query = "DELETE FROM feedback WHERE feedbackId = '$id'";
		$delData = $this->db->delete($query);
		if($delData){
			$msg = "<span class='success'>Feedback Deleted Successfully</span>";
			return $msg;
		}
		else {
			$msg = "<span class='error'>Feedback Not Deleted.</span>";
			return $msg;
		} 
	}
}
?>