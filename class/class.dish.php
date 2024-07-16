<?php
class Dish{
	private $DB_SERVER='localhost';
	private $DB_USERNAME='root';
	private $DB_PASSWORD='';
	private $DB_DATABASE='db_sugaree';
	private $conn;
	public function __construct(){
		$this->conn = new PDO("mysql:host=".$this->DB_SERVER.";dbname=".$this->DB_DATABASE,$this->DB_USERNAME,$this->DB_PASSWORD);
	}

    public function dish_exists($dishname) {
        $sql = "SELECT count(*) FROM tbl_dishes WHERE dish_name = :dishname";
        $q = $this->conn->prepare($sql);
        $q->execute(['dish_name' => $dishname]);
        $number_of_rows = $q->fetchColumn();
        return $number_of_rows > 0;
    }

    public function new_dish($dish_name,$dish_popularity,$dish_category,$dish_description){
		
		$data = [
			[$dish_name,$dish_popularity,$dish_category,$dish_description],
		];
		/*Stores parameters passed from the creation page inside the database */
		$stmt = $this->conn->prepare("INSERT INTO tbl_dishes(dish_name, dish_popularity, dish_category, dish_description) VALUES (?,?,?,?)");
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

    public function update_dish($dish_id, $dish_name, $dish_popularity, $dish_category, $dish_description) {
		$sql = "UPDATE tbl_dishes SET dish_name=:dish_name, dish_popularity=:dish_popularity, dish_category=:dish_category, dish_description=:dish_description WHERE dish_id=:dish_id";
	
		$q = $this->conn->prepare($sql);
		$q->execute(array(
			':dish_id' => $dish_id,
			':dish_name' => $dish_name,
			':dish_popularity' => $dish_popularity,
			':dish_category' => $dish_category,
			':dish_description' => $dish_description
		));
		return true;
	}

	
	public function delete_dish($dish_id){
		$sql = "DELETE FROM tbl_dishes WHERE dish_id = :dish_id";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(':dish_id', $dish_id);
		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

    function get_dish_id($dish_name){
		$sql="SELECT dish_id FROM tbl_dishes WHERE dish_name = :dish_name";	
		$q = $this->conn->prepare($sql);
		$q->execute(['dish_name' => $dish_name]);
		$dish_id = $q->fetchColumn();
		return $dish_id;
	}
    public function get_dish($dish_id){
        $sql = "SELECT * FROM tbl_dishes WHERE dish_id = :dish_id";
        $q = $this->conn->prepare($sql);
        $q->execute(['dish_id' => $dish_id]);
        return $q->fetch(PDO::FETCH_ASSOC);
    }
}

