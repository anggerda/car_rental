<?php 
require_once ("class/DBController.php");
class Order {
    private $db_handle;
    
    function __construct() {
        $this->db_handle = new DBController();
    }
    
    function addOrder($discount1,$discount2,$discount3,$subtotal,$total,$order_date) {
        $query = "INSERT INTO t_car_order (discount1,discount2,discount3,subtotal,total,order_date) VALUES (?, ?, ?, ?, ?, ?)";
        $paramType = "sssiis";
        $paramValue = array(
            $discount1,
			$discount2,
			$discount3,
			$subtotal,
            $total,
			$order_date
        );
        
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
        return $insertId;
    }
	
	function addOrderDetail($order_id, $car_id, $startdate, $enddate, $days, $amount) {
        $query = "INSERT INTO t_car_detail (order_id,car_id,startdate,enddate,days,amount) VALUES (?, ?, ?, ?, ?, ?)";
        $paramType = "iissii";
        $paramValue = array(
            $order_id,
            $car_id,
            $startdate,
            $enddate,
            $days,
            $amount
        );
        
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
        return $insertId;
    }
    
	function editOrder($discount1,$discount2,$discount3,$subtotal,$total,$order_id) {
        $query = "UPDATE t_car_order SET discount1 = ?,discount2 = ?,discount3 = ?,subtotal = ?,total = ? WHERE order_id = ?";
        $paramType = "ssssii";
        $paramValue = array(
             $discount1,
			$discount2,
			$discount3,
			$subtotal,
            $total,
            $order_id
        );
        
        $this->db_handle->update($query, $paramType, $paramValue);
    }
	
    function deleteOrder($order_id) {
        $query = "DELETE FROM t_car_order WHERE order_id = ?";
        $paramType = "s";
        $paramValue = array(
            $order_id
        );
        $this->db_handle->update($query, $paramType, $paramValue);
		
		$query = "DELETE FROM t_car_detail WHERE order_id = ?";
        $paramType = "s";
        $paramValue = array(
            $order_id
        );
        $this->db_handle->update($query, $paramType, $paramValue);
    }
    
    function deleteOrderDetail($order_id) {
        $query = "DELETE FROM t_car_detail WHERE order_id = ?";
        $paramType = "s";
        $paramValue = array(
            $order_id
        );
        $this->db_handle->update($query, $paramType, $paramValue);
    }
    
    function getOrder() {
        $sql = "SELECT * FROM t_car_order";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }
	
	function getOrderByID($order_id) {
        $query = "SELECT * FROM t_car_order a join t_car_detail b on a.order_id=b.order_id join m_car c on c.car_id=b.car_id where a.order_id = ?";
        $paramType = "i";
        $paramValue = array(
            $order_id
        );
        
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
		
    }
	
	function calculateDiscountRule1($array_car){ //FLAG DISCOUNT RULE NO.1	
		$is_true = false;
		foreach($array_car as $v){
			if($v['totalday']==3) $is_true = true; //FLAG DISCOUNT RULE NO.1	
		}
		return $is_true;
	}
	
	function calculateDiscountRule2($array_car){ //FLAG DISCOUNT RULE NO.2
		$is_true = false;
		$totalnum = 0;
		foreach($array_car as $v){
			$totalnum = $totalnum + $v['totalnum'];
		}
		
		if($totalnum>=2) $is_true=true; //FLAG DISCOUNT RULE NO.2
		return $is_true;
	}
	
	function calculateDiscountRule3($array_car){ //FLAG DISCOUNT RULE NO.3	
		$is_true = false;
		foreach($array_car as $v){
			if($v['car_built']<2010) $is_true=true; //FLAG DISCOUNT RULE NO.3	
		}
		
		return $is_true;
	}
	
}
?>