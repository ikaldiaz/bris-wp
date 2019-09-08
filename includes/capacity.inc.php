<?php
class Capacity{ 
/*
id_nasabah
pendapatan
pendapatan usaha/sales
pengeluaran usaha
keuntungan usaha
penghasilan lain
toal penghasilan
pajak
belanja rumah tangga
sewa/kontrak rumah
pendididkan
utilitas
transporatsi
pengleuaran lain
total pengeluaran RT
sisa penghasilan
nilai akhir
*/
	
	private $conn;
	private $table_name = "wp_pendapatan";
	
	//usaha dan pendapatan
	public $id;
	public $su;
	public $bu;
	public $ou;
	public $tu; // 
	
	//pengeluaran
	public $brt;
	public $rent;
	public $edu;
	public $uti;
	public $trans;
	public $oe;
	public $tbrt; //
	public $sp; //

	public $na; //
	
	public function __construct($db){
		$this->conn = $db;
	}
	
	function insert(){
		
		$query = "INSERT INTO ".$this->table_name." values(?,?,?,?)";
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
	
	
	function readOne(){
		
		$query = "SELECT * FROM " . $this->table_name . " WHERE id_capacity=? LIMIT 0,1";

		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(1, $this->id);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$this->id = $row['id_capacity'];
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
					id_capacity = :id";

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
	
		$query = "DELETE FROM " . $this->table_name . " WHERE id_capacity = ?";
		
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);

		if($result = $stmt->execute()){
			return true;
		}else{
			return false;
		}
	}

}
?>