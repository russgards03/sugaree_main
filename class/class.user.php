<?php
class User{
	private $DB_SERVER='localhost';
	private $DB_USERNAME='root';
	private $DB_PASSWORD='';
	private $DB_DATABASE='db_sugaree';
	private $conn;
	public function __construct(){
		$this->conn = new PDO("mysql:host=".$this->DB_SERVER.";dbname=".$this->DB_DATABASE,$this->DB_USERNAME,$this->DB_PASSWORD);
	}
    
    /*Function to detect if username or email already exists */
    public function user_exists($username, $email) {
        $sql = "SELECT count(*) FROM tbl_users WHERE user_name = :username OR user_email = :email";
        $q = $this->conn->prepare($sql);
        $q->execute(['username' => $username, 'email' => $email]);
        $number_of_rows = $q->fetchColumn();
        return $number_of_rows > 0;
    }

	/*Function for creating a new user */
	public function new_user($user_firstname,$user_lastname,$user_name,$user_email,$password,$user_status,$user_role){
		
		$data = [
			[$user_firstname,$user_lastname,$user_name,$user_email,$password,$user_status,$user_role],
		];
		/*Stores parameters passed from the creation page inside the database */
		$stmt = $this->conn->prepare("INSERT INTO tbl_users(user_firstname, user_lastname, user_name, user_email, user_password, user_status, user_role) VALUES (?,?,?,?,?,?,?)");
		try {
			$this->conn->beginTransaction();
			foreach ($data as $row)
			{
				$stmt->execute($row);
			}
			$this->conn->commit();
		}catch (Exception $e){
			$this->conn->rollback();
			throw $e;
		}

		return true;

	}

	public function update_user_image($user_id,$user_image){
        /*Updates data from the database using the parameters passed from the profile updating page*/
        $sql = "UPDATE tbl_users SET user_image=:user_image WHERE user_id=:user_id";

        $q = $this->conn->prepare($sql);
        $q->execute(array(':user_id'=>$user_id,':user_image'=>$user_image));
        return true;
    }
	/*Function for updating an admin */
	public function update_user($user_id,$user_firstname,$user_lastname){
		/*Updates data from the database using the parameters passed from the profile updating page */
		$sql = "UPDATE tbl_users SET user_firstname=:user_firstname, user_lastname=:user_lastname WHERE user_id=:user_id";

		$q = $this->conn->prepare($sql);
		$q->execute(array(':user_id'=>$user_id,':user_firstname'=>$user_firstname,':user_lastname'=>$user_lastname));
		return true;
	}
	/*Function for deleting an admin */
	public function delete_admin($username){
		/*Deletes data from admin selected by the user*/
		$sql = "DELETE FROM admin WHERE adm_username = :username";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(':username', $username);
		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	public function list_admin_search($keyword){
		
		//$keyword = "%".$keyword."%";

		$q = $this->conn->prepare('SELECT * FROM `admin` WHERE (`adm_username`) LIKE ?');
		$q->bindValue(1, "%$keyword%", PDO::PARAM_STR);
		$q->execute();

		while($r = $q->fetch(PDO::FETCH_ASSOC)){
		$data[]= $r;
		}
		if(empty($data)){
		   return false;
		}else{
			return $data;	
		}
	}

	/*Function that selects all the records from the admin table */
	public function list_admins(){
		$sql="SELECT * FROM admin";
		$q = $this->conn->query($sql) or die("failed!");
		while($r = $q->fetch(PDO::FETCH_ASSOC)){
		$data[]=$r;
		}
		if(empty($data)){
		   return false;
		}else{
			return $data;	
		}
	}
	/*Function for getting the user id from the database */
	function get_user_id($user_identifier){
		$sql="SELECT user_id FROM tbl_users WHERE user_name = :user_identifier OR user_email = :user_identifier";	
		$q = $this->conn->prepare($sql);
		$q->execute(['user_identifier' => $user_identifier]);
		$user_id = $q->fetchColumn();
		return $user_id;
	}
	/*Function for getting the admin username from the database */
	function get_user_name($user_id){
		$sql="SELECT user_name FROM tbl_users WHERE user_id = :user_id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['user_id' => $user_id]);
		$user_name = $q->fetchColumn();
		return $user_name;
	}
	/*Function for getting the admin password from the database */
	function get_user_email($user_id){
		$sql="SELECT user_email FROM tbl_users WHERE user_id = :user_id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['user_id' => $user_id]);
		$user_email = $q->fetchColumn();
		return $user_email;
	}
	/*Function for getting the admin password from the database */
	function get_user_fname($user_id){
		$sql="SELECT user_firstname FROM tbl_users WHERE user_id = :user_id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['user_id' => $user_id]);
		$user_firstname = $q->fetchColumn();
		return $user_firstname;
	}
	/*Function for getting the admin password from the database */
	function get_user_lname($user_id){
		$sql="SELECT user_lastname FROM tbl_users WHERE user_id = :user_id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['user_id' => $user_id]);
		$user_lastname = $q->fetchColumn();
		return $user_lastname;
	}
	/*Function for getting the admin password from the database */
	function get_user_review($user_id){
		$sql="SELECT review_content FROM tbl_review INNER JOIN tbl_users WHERE tbl_review.user_id = tbl_users.user_id AND tbl_users.user_id = :user_id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['user_id' => $user_id]);
		$user_review = $q->fetchColumn();
		return $user_review;
	}
	/*Function for getting the admin password from the database */
	function get_user_rating($user_id){
		$sql="SELECT review_rating FROM tbl_review INNER JOIN tbl_users WHERE tbl_review.user_id = tbl_users.user_id AND tbl_users.user_id = :user_id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['user_id' => $user_id]);
		$user_rating = $q->fetchColumn();
		return $user_rating;
	}
	/*Function for getting the admin password from the database */
	function get_user_status($user_id){
		$sql="SELECT user_status FROM tbl_users WHERE user_id = :user_id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['user_id' => $user_id]);
		$user_status = $q->fetchColumn();
		return $user_status;
	}
	/*Function for getting the admin password from the database */
	function get_user_role($user_id){
		$sql="SELECT user_role FROM tbl_users WHERE user_id = :user_id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['user_id' => $user_id]);
		$user_role = $q->fetchColumn();
		return $user_role;
	}
	/*Function for getting the session from the database for logging in */
	function get_session(){
		if(isset($_SESSION['login']) && $_SESSION['login'] == true){
			return true;
		}else{
			return false;
		}
	}
	/*Function for checking if the user inputs match from that of the database */
	public function check_login($user_identifier,$user_password){
		
		$sql = "SELECT count(*) FROM tbl_users WHERE (user_name = :user_identifier OR user_email = :user_identifier) AND user_password = :user_password";
		$q = $this->conn->prepare($sql);
		$q->execute(['user_identifier' => $user_identifier,'user_password' => $user_password]);
		$number_of_rows = $q->fetchColumn();
		/*$password = md5($password);*/
		if($number_of_rows == 1){
			
			$_SESSION['login']=true;
			$_SESSION['user_identifier']=$user_identifier;
			return true;
		}else{
			return false;
		}
	}
}
?>