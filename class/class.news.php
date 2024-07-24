<?php
class News{
	private $DB_SERVER='localhost';
	private $DB_USERNAME='root';
	private $DB_PASSWORD='';
	private $DB_DATABASE='db_sugaree';
	private $conn;
	public function __construct(){
		$this->conn = new PDO("mysql:host=".$this->DB_SERVER.";dbname=".$this->DB_DATABASE,$this->DB_USERNAME,$this->DB_PASSWORD);
	}

    public function new_news($news_title, $news_description){
		
		$data = [
			[$news_title,$news_description],
		];
		/*Stores parameters passed from the creation page inside the database */
		$stmt = $this->conn->prepare("INSERT INTO tbl_news(news_title, news_description) VALUES (?,?)");
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

    public function update_news($news_id, $news_title,$news_description) {
		$sql = "UPDATE tbl_news SET news_title=:news_title, news_description WHERE news_id=:news_id";
	
		$q = $this->conn->prepare($sql);
		$q->execute(array(
			':news_id' => $news_id,
			':news_title' => $news_title,
			':news_description' => $news_description
		));
		return true;
	}

	public function delete_news($news_id){
		$sql = "DELETE FROM tbl_news WHERE news_id = :news_id";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(':news_id', $news_id);
		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

    function get_news_id($news_title){
		$sql="SELECT news_id FROM tbl_news WHERE news_title = :news_title";	
		$q = $this->conn->prepare($sql);
		$q->execute(['news_title' => $news_title]);
		$news_id = $q->fetchColumn();
		return $news_id;
	}
    public function get_news($news_id){
        $sql = "SELECT * FROM tbl_news WHERE news_id = :news_id";
        $q = $this->conn->prepare($sql);
        $q->execute(['news_id' => $news_id]);
        return $q->fetch(PDO::FETCH_ASSOC);
    }
}
?>