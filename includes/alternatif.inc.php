<?php
class Alternatif{
	
	private $conn;
	private $table_name = "wp_alternatif";
	
	public $id;
	public $kt;
	public $ns;
	public $jpk;
	public $tgl;
	
	public function __construct($db){
		$this->conn = $db;
	}
	
	function insert(){ 
		
		$query = "insert into ".$this->table_name." values('',?,'','',?, ?, ?)";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->kt);
		$stmt->bindParam(2, $this->ns);
		$stmt->bindParam(3, $this->jpk);
		$stmt->bindParam(4, $this->tgl);
		
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		
	}
	
	function readAll(){

		$query = "SELECT a.*, n.nama, p.nama AS nama_pengajuan FROM ".$this->table_name." AS a INNER JOIN wp_nasabah AS n ON a.id_nasabah=n.id_nasabah INNER JOIN wp_pengajuan AS p ON a.id_pengajuan=p.id_pengajuan ORDER BY a.id_alternatif ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		
		return $stmt;
	}

	function getAll(){

		$query = "SELECT * FROM ".$this->table_name." ORDER BY id_alternatif ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		
		return $stmt;
	}

	function getAllRank(){

		$query = "SELECT * FROM ".$this->table_name." ORDER BY vektor_v DESC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		
		return $stmt;
	}
	function readAllByMonthYear($month, $year){

		$query = "SELECT a.*, n.nama FROM ".$this->table_name." AS a INNER JOIN wp_nasabah AS n ON a.id_nasabah=n.id_nasabah WHERE MONTH(a.tgl) = $month AND YEAR(a.tgl) = $year  ORDER BY a.id_alternatif ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		
		return $stmt;
	}
	function countAll(){

		$query = "SELECT * FROM ".$this->table_name." ORDER BY id_alternatif ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		
		return $stmt->rowCount();
	}
	
	function readOne(){
		
		$query = "SELECT * FROM " . $this->table_name . " WHERE id_alternatif=? LIMIT 0,1";

		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(1, $this->id);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$this->id = $row['id_alternatif'];
		$this->kt = $row['nama_alternatif'];
		$this->ns = $row['id_nasabah'];
		$this->jpk = $row['id_pengajuan'];
		$this->tgl = $row['tgl'];
	}
	
	// update the product
	function update(){

		$query = "UPDATE 
					" . $this->table_name . " 
				SET 
					nama_alternatif = :kt,
					id_nasabah = :ns,
					id_pengajuan = :jpk,
					tgl = :tgl
				WHERE
					id_alternatif = :id";

		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':kt', $this->kt);
		$stmt->bindParam(':ns', $this->ns);
		$stmt->bindParam(':jpk', $this->jpk);
		$stmt->bindParam(':tgl', $this->tgl);
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