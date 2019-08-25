<?php
class Rangking{
	
	private $conn;
	private $table_name = "wp_rangking";
	
	public $ia;
	public $ik;
	public $nn;
	public $nn2;
	public $nn3;
	public $nn4;
	public $mnr1;
	public $mnr2;
	public $has1;
	public $has2;
	
	public function __construct($db){
		$this->conn = $db;
	}
	 
	function insert(){
		
		$query = "insert into ".$this->table_name." values(?,?,?,'')";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->ia);
		$stmt->bindParam(2, $this->ik);
		$stmt->bindParam(3, $this->nn);
		
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		
	}
	
	function readAll(){

		$query = "SELECT * FROM ".$this->table_name;
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		
		return $stmt;
	}
	function countAll(){

		$query = "SELECT * FROM ".$this->table_name;
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		
		return $stmt->rowCount();
	}
	
	function readKhusus(){

		$query = "SELECT * FROM wp_alternatif a, wp_kriteria b, wp_rangking c where a.id_alternatif=c.id_alternatif and b.id_kriteria=c.id_kriteria order by a.id_alternatif asc";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		
		return $stmt;
	}
	
	function readR($a){

		$query = "SELECT * FROM wp_alternatif a, wp_kriteria b, wp_rangking c, wp_bobot d where b.id_kriteria=d.id_kriteria and a.id_alternatif=c.id_alternatif and b.id_kriteria=c.id_kriteria and c.id_alternatif='$a'";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		
		return $stmt;
	}
	
	function readMax(){
		
		$query = "SELECT sum(vektor_s) as mnr1 FROM wp_alternatif";

		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}
	
	function readHasil1($a){
		
		$query = "SELECT EXP(SUM(LOG(coalesce(nilai_normalisasi,1)))) as bbn FROM " . $this->table_name . " WHERE id_alternatif='$a' limit 0,1";

		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}
	
	// used when filling up the update product form
	function readOne(){
		
		$query = "SELECT * FROM " . $this->table_name . " WHERE id_alternatif=? and id_kriteria=? LIMIT 0,1";

		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(1, $this->ia);
		$stmt->bindParam(2, $this->ik);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$this->ia = $row['id_alternatif'];
		$this->ik = $row['id_kriteria'];
		$this->nn = $row['nilai_rangking']; 
	}
	
	// update the product
	function update(){

		$query = "UPDATE 
					" . $this->table_name . " 
				SET 
					nilai_rangking = :nn
				WHERE
					id_alternatif = :ia 
				AND
					id_kriteria = :ik";

		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':nn', $this->nn);
		$stmt->bindParam(':ia', $this->ia);
		$stmt->bindParam(':ik', $this->ik);
		
		// execute the query
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
	
	function normalisasi1(){

		$query = "UPDATE 
					" . $this->table_name . " 
				SET 
					nilai_normalisasi = :nn4
				WHERE
					id_alternatif = :ia 
				AND
					id_kriteria = :ik";

		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':nn4', $this->nn4);
		$stmt->bindParam(':ia', $this->ia);
		$stmt->bindParam(':ik', $this->ik);
		
		// execute the query
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
	
	function normalisasi2(){

		$query = "UPDATE 
					wp_alternatif
				SET 
					vektor_s = :nn2,
					vektor_v = :nn3
				WHERE
					id_alternatif = :ia 
				AND
					id_kriteria = :ik";

		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':nn2', $this->nn2);
		$stmt->bindParam(':nn3', $this->nn3);
		$stmt->bindParam(':ia', $this->ia);
		$stmt->bindParam(':ik', $this->ik);
		
		// execute the query
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
	
	function hasil1(){

		$query = "UPDATE 
					wp_alternatif
				SET 
					vektor_s = :has1
				WHERE
					id_alternatif = :ia";

		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':has1', $this->has1);
		$stmt->bindParam(':ia', $this->ia);
		
		// execute the query
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
		
	function hasil2(){

		$query = "UPDATE 
					wp_alternatif
				SET 
					vektor_v = :has2
				WHERE
					id_alternatif = :ia";

		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':has2', $this->has2);
		$stmt->bindParam(':ia', $this->ia);
		
		// execute the query
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
	
	// delete the product
	function delete(){
	
		$query = "DELETE FROM " . $this->table_name . " WHERE id_alternatif = ? and id_kriteria = ?";
		
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->ia);
		$stmt->bindParam(2, $this->ik);

		if($result = $stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
}
?>