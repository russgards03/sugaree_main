<!--User Class File-->
<?php
/*Creates User Object with database connection */
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
	public function new_user($user_firstname,$user_lastname,$user_name,$user_email,$password){
		
		$data = [
			[$user_firstname,$user_lastname,$user_name,$user_email,$password],
		];
		/*Stores parameters passed from the creation page inside the database */
		$stmt = $this->conn->prepare("INSERT INTO tbl_users(user_firstname, user_lastname, user_name, user_email, user_password) VALUES (?,?,?,?,?)");
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
	/*Function for updating an admin */
	public function update_admin($username,$password,$email,$fname,$lname,$cnumber,$access){
		/*Updates data from the database using the parameters passed from the profile updating page */
		$sql = "UPDATE admin SET adm_password=:adm_password, adm_email=:adm_email, adm_fname=:adm_fname, adm_lname=:adm_lname, adm_cnumber=:adm_cnumber, adm_access=:adm_access WHERE adm_username=:adm_username";

		$q = $this->conn->prepare($sql);
		$q->execute(array(':adm_password'=>$password, ':adm_email'=>$email,':adm_fname'=>$fname,':adm_lname'=>$lname,':adm_cnumber'=>$cnumber, ':adm_username'=>$username, ':adm_access'=>$access));
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
	/*Function for getting the admin username from the database */
	function get_username($username){
		$sql="SELECT adm_username FROM admin WHERE adm_username = :username";	
		$q = $this->conn->prepare($sql);
		$q->execute(['username' => $username]);
		$username = $q->fetchColumn();
		return $username;
	}
	/*Function for getting the admin password from the database */
	function get_password($username){
		$sql="SELECT adm_password FROM admin WHERE adm_username = :username";	
		$q = $this->conn->prepare($sql);
		$q->execute(['username' => $username]);
		$password = $q->fetchColumn();
		return $password;
	}
	/*Function for getting the admin email from the database */
	function get_email($username){
		$sql="SELECT adm_email FROM admin WHERE adm_username = :username";	
		$q = $this->conn->prepare($sql);
		$q->execute(['username' => $username]);
		$email = $q->fetchColumn();
		return $email;
	}
	/*Function for getting the admin firstname from the database */
	function get_fname($username){
		$sql="SELECT adm_fname FROM admin WHERE adm_username = :username";	
		$q = $this->conn->prepare($sql);
		$q->execute(['username' => $username]);
		$fname = $q->fetchColumn();
		return $fname;
	}
	/*Function for getting the admin lastname from the database */
	function get_lname($username){
		$sql="SELECT adm_lname FROM admin WHERE adm_username = :username";	
		$q = $this->conn->prepare($sql);
		$q->execute(['username' => $username]);
		$lname = $q->fetchColumn();
		return $lname;
	}
	/*Function for getting the admin contact number from the database */
	function get_cnumber($username){
		$sql="SELECT adm_cnumber FROM admin WHERE adm_username = :username";	
		$q = $this->conn->prepare($sql);
		$q->execute(['username' => $username]);
		$cnumber = $q->fetchColumn();
		return $cnumber;
	}
	/*Function for getting the admin access level from the database */
	function get_adm_access($username){
		$sql="SELECT adm_access FROM admin WHERE adm_username = :username";	
		$q = $this->conn->prepare($sql);
		$q->execute(['username' => $username]);
		$adm_access = $q->fetchColumn();
		return $adm_access;
	}
	/*Function for getting the admin status from the database */
	function get_adm_status($username){
		$sql="SELECT adm_status FROM admin WHERE adm_username = :username";	
		$q = $this->conn->prepare($sql);
		$q->execute(['username' => $username]);
		$adm_status = $q->fetchColumn();
		return $adm_status;
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
			$_SESSION['user_name']=$user_identifier;
			return true;
		}else{
			return false;
		}
	}
}
?>