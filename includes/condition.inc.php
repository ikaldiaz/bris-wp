<?php
class Condition{ 
	//peuntukan lokasi : tempat tinggal, kios
	//akses jalan : 7 meter
	//perkembangan lingkungan : sangat pesat dan ramai, wilayah ramai usaha
	//fasilitas sosial : lengkap
	//kepadatan : ramai dan sepi



	
	private $conn;
	private $table_name = "wp_kondisi";
	
	public $id;
	public $idn;
	public $ph;
	public $ad;
	
	public function __construct($db){
		$this->conn = $db;
	}
	
	function insert(){
		
		$query = "insert into ".$this->table_name." values(?,?,?,?)";
		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(1, $this->id);
		$stmt->bindParam(2, $this->ph);
		$stmt->bindParam(3, $this->ad);
		$stmt->bindParam(4, $this->ad);
		
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		
	}
	
	// function readAll(){
	// 	$query = "SELECT * FROM ".$this->table_name." ORDER BY id_capital ASC";
	// 	$stmt = $this->conn->prepare( $query );
	// 	$stmt->execute();
	// 	return $stmt;
	// }
	
	// function countAll(){
	// 	$query = "SELECT * FROM ".$this->table_name." ORDER BY id_capital ASC";
	// 	$stmt = $this->conn->prepare( $query );
	// 	$stmt->execute();
	// 	return $stmt->rowCount();
	// }
	
	function readOne(){
		
		$query = "SELECT * FROM " . $this->table_name . " WHERE id_capital=? LIMIT 0,1";

		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(1, $this->id);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$this->id = $row['id_capital'];
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
					id_capital = :id";

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
	
		$query = "DELETE FROM " . $this->table_name . " WHERE id_capital = ?";
		
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);

		if($result = $stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
	// function hapusell($ax){
	// 	$query = "DELETE FROM " . $this->table_name . " WHERE id_capital in $ax";
	// 	$stmt = $this->conn->prepare($query);
	// 	if($result = $stmt->execute()){
	// 		return true;
	// 	}else{
	// 		return false;
	// 	}
	// }
}
?>