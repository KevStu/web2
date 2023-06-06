<?php
class Inventory{
	private $DB_SERVER='localhost';
	private $DB_USERNAME='root';
	private $DB_PASSWORD='';
	private $DB_DATABASE='products';
	private $conn;
	public function __construct(){
		$this->conn = new PDO("mysql:host=".$this->DB_SERVER.";dbname=".$this->DB_DATABASE,$this->DB_USERNAME,$this->DB_PASSWORD);
		
	}
	
	
	public function list_instock(){
		$sql="SELECT * FROM tbl_product";
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
	public function update_product($rec,$rel, $pid){
		
		/* Setting Timezone for DB */
		$NOW = new DateTime('now', new DateTimeZone('Asia/Manila'));
		$NOW = $NOW->format('Y-m-d H:i:s');

		$sql = "UPDATE tbl_receive, tbl_release, tbl_product SET tbl_receive.rec_amount=:rec,tbl_release.rel_amount=:rel WHERE prod_id=:pid AND rec_id=:pid AND rel_id=:pid";

		$q = $this->conn->prepare($sql);
		$q->execute(array(':rec'=>$rec, ':rel'=>$rel,':pid'=>$pid));
		return true;
	}


	function get_product_receive_inv($id){
		$sql="SELECT rec_amount FROM tbl_receive WHERE rec_id = :id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['id' => $id]);
		$instock = $q->fetchColumn();
		return $instock;
	}
	function get_product_release_inv($id){
		$sql="SELECT SUM(rel_amount) AS outstock FROM tbl_release WHERE rel_id = :id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['id' => $id]);
		$outstock = $q->fetchColumn();
		return $outstock;
	}
	function get_receive_amount($id){
		$sql="SELECT rec_amount FROM tbl_receive WHERE rec_id = :id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['id' => $id]);
		$type_id = $q->fetchColumn();
		return $type_id;
	}
	function get_prod_price($id){
		$sql="SELECT prod_price FROM tbl_product WHERE prod_id = :id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['id' => $id]);
		$type_id = $q->fetchColumn();
		return $type_id;
	}
	public function list_product_search($keyword){
		
		//$keyword = "%".$keyword."%";

		$q = $this->conn->prepare('SELECT * FROM `tbl_product` WHERE `prod_name` LIKE ?');
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
}