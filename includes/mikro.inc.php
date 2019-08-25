<?php
class Mikro{
	
	private $conn;
	private $table_name = "wp_mikro";
	
	public $id;
	public $nm;
	public $kt;
	
	public function __construct($db){
		$this->conn = $db;
	}
	
	function insert(){ 
		
		$query = "insert into ".$this->table_name." values('',?,'','',?, ?)";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->nm);
		$stmt->bindParam(2, $this->kt);
		// $stmt->bindParam(3, $this->tgl);
		
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		
	}
	
	function readAll(){

		$query = "SELECT a.*, n.nama FROM ".$this->table_name." ORDER BY id ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		
		return $stmt;
	}

	function countAll(){

		$query = "SELECT * FROM ".$this->table_name." ORDER BY id ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		
		return $stmt->rowCount();
	}
	
	function readOne(){
		
		$query = "SELECT * FROM " . $this->table_name . " WHERE id=? LIMIT 0,1";

		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(1, $this->id);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$this->id = $row['id_alternatif'];
		$this->nm = $row['nama_alternatif'];
		$this->kt = $row['id_nasabah'];
	}
	
	// update the product
	function update(){

		$query = "UPDATE 
					" . $this->table_name . " 
				SET 
					nama_alternatif = :nm
					id_nasabah = :kt
				WHERE
					id_alternatif = :id";

		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':nm', $this->nm);
		$stmt->bindParam(':kt', $this->kt);
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
	
		$query = "DELETE FROM " . $this->table_name . " WHERE id_alternatif = ?";
		
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);

		if($result = $stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
	function hapusell($ax){
	
		$query = "DELETE FROM " . $this->table_name . " WHERE id_alternatif in $ax";
		
		$stmt = $this->conn->prepare($query);

		if($result = $stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
}
?>