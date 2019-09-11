<?php
class Collateral{ 
	//id
	//id_nasabah
	//tipe agunan
	//nilai agunan
	//no-suratkepemilikan

	private $conn;
	private $table_name = "wp_agunan";
	
	public $id;
	public $idn;
	public $ph;
	public $ad;
	
	public function __construct($db){
		$this->conn = $db;
	}
	
	function insert(){
		
		$query = "insert into ".$this->table_name." values('',?,?,?)";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->idn);
		$stmt->bindParam(2, $this->ph);
		$stmt->bindParam(3, $this->ad);
		
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		
	}
	
	function readAll(){

		$query = "SELECT * FROM ".$this->table_name." ORDER BY id_nasabah ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		
		return $stmt;
	}
	function countAll(){

		$query = "SELECT * FROM ".$this->table_name." ORDER BY id_nasabah ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		
		return $stmt->rowCount();
	}
	
	function readOne(){
		
		$query = "SELECT * FROM " . $this->table_name . " WHERE id_nasabah=? LIMIT 0,1";

		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(1, $this->id);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$this->id = $row['id_nasabah'];
		$this->idn = $row['nama'];
		$this->ph = $row['phone'];
		$this->ad = $row['alamat'];
	}
	
	// update the product
	function update(){

		$query = "UPDATE 
					" . $this->table_name . " 
				SET 
					nama = :idn
					phone = :ph
					alamat = :ad
				WHERE
					id_nasabah = :id";

		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':idn', $this->idn);
		$stmt->bindParam(':ph', $this->kt);
		$stmt->bindParam(':ad', $this->kt);
		$stmt->bindParam(':id', $this->id);
		
		// execute the query
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
	
	// delete the product
	function delete(){
	
		$query = "DELETE FROM " . $this->table_name . " WHERE id_nasabah = ?";
		
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);

		if($result = $stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
	function hapusell($ax){
	
		$query = "DELETE FROM " . $this->table_name . " WHERE id_nasabah in $ax";
		
		$stmt = $this->conn->prepare($query);

		if($result = $stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
}
?>