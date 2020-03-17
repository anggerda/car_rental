<?php
require_once ("class/DBController.php");
require_once ("class/Car.php");
require_once ("class/Order.php");

$db_handle = new DBController();

 $action = "";
if (! empty($_GET["action"])) {
    $action = $_GET["action"];
}
switch ($action) {
    case "order-add":
        if (isset($_POST['add'])) {
            $order = new Order();
            
			$discount1 = 0;
			$discount2 = 0;
			$discount3 = 0;
			$subtotalcar = 0;
			$totalcar = 0;
			
			/*$discount1 = $_POST["discount1"];
			$discount2 = $_POST["discount2"];
			$discount3 = $_POST["discount3"];
			$subtotalcar = $_POST["subtotalcar"];
			$totalcar = $_POST["totalcar"];
            */
			$order_date = date("Y-m-d");
            
            if(!empty($_POST["car_id"])) {
                $id = $order->addOrder($discount1,$discount2,$discount3,$subtotalcar,$totalcar,$order_date);
				$arr_car = array();
                foreach($_POST["car_id"] as $k=> $car_id) {
                    $car = new Car();
					$car_temp = $car->getCarById($car_id);
					$car_startdate = strtotime($_POST["car_startdate"][$k]);
					$startdate = date("Y-m-d", $car_startdate);
					$car_enddate = strtotime($_POST["car_enddate"][$k]);
					$enddate = date("Y-m-d", $car_enddate);
            
					$car_totalday = $_POST["car_totalday"][$k];
                    $car_totalnum = $_POST["car_totalnum"][$k];
					
					$totalcar = $totalcar + ($car_totalday*$car_totalnum*$car_temp[0]["charge"]);
					
					$arr_car[]=array('totalday'=>$car_totalday,'totalnum'=>$car_totalnum,'car_built'=>$car_temp[0]["car_built"],'charge'=>$car_temp[0]["charge"]);
                    $order->addOrderDetail($id, $car_id,$startdate,$enddate,$car_totalday,$car_totalnum);
                }
            }
			
			$subtotalcar = $totalcar;
			
			$disc1 = $order->calculateDiscountRule1($arr_car);
			$disc2 = $order->calculateDiscountRule2($arr_car);
			$disc3 = $order->calculateDiscountRule3($arr_car);
            
			if($disc1) { $discount1 = $totalcar*5/100; $totalcar = $totalcar*95/100;  } //DISCOUNT RULE NO.1 5%
			if($disc2) { $discount2 = $totalcar*10/100; $totalcar = $totalcar*90/100;  } //DISCOUNT RULE NO.2 10%
			if($disc3) { $discount3 = $totalcar*7/100; $totalcar = $totalcar*93/100;  } //DISCOUNT RULE NO.3 7%
			$order->editOrder($discount1,$discount2,$discount3,$subtotalcar,$totalcar,$id);
			
			header("Location: index.php?action=order");
        }
        $car = new Car();
        $carResult = $car->getAllCar();
        require_once "web/order-add.php";
        break;
    
    case "order-edit":
        $order_date = $_GET["date"];
        $order = new Order();
        if (isset($_POST['add'])) {
            if(!empty($_POST["car_id"])) {
				$id = $order_date;
				
				$discount1 = 0;
				$discount2 = 0;
				$discount3 = 0;
				$subtotalcar = 0;
				$totalcar = 0;
				
				/*$discount1 = $_POST["discount1"];
				$discount2 = $_POST["discount2"];
				$discount3 = $_POST["discount3"];
				$subtotalcar = $_POST["subtotalcar"];
				$totalcar = $_POST["totalcar"];
				
				$order->editOrder($discount1,$discount2,$discount3,$subtotalcar,$totalcar,$id);*/
				
				$order->deleteOrderDetail($order_date);
				$arr_car = array();
                foreach($_POST["car_id"] as $k=> $car_id) {
                    $car = new Car();
					$car_temp = $car->getCarById($car_id);
					$car_startdate = strtotime($_POST["car_startdate"][$k]);
					$startdate = date("Y-m-d", $car_startdate);
					$car_enddate = strtotime($_POST["car_enddate"][$k]);
					$enddate = date("Y-m-d", $car_enddate);
            
					$car_totalday = $_POST["car_totalday"][$k];
                    $car_totalnum = $_POST["car_totalnum"][$k];
					
					$totalcar = (float) $totalcar + ((float)$car_totalday*(float)$car_totalnum*(float)$car_temp[0]["charge"]);
					
					$arr_car[]=array('totalday'=>$car_totalday,'totalnum'=>$car_totalnum,'car_built'=>$car_temp[0]["car_built"],'charge'=>$car_temp[0]["charge"]);
                    $order->addOrderDetail($id, $car_id,$startdate,$enddate,$car_totalday,$car_totalnum);
                }
				
				$subtotalcar = $totalcar;
			
				$disc1 = $order->calculateDiscountRule1($arr_car);
				$disc2 = $order->calculateDiscountRule2($arr_car);
				$disc3 = $order->calculateDiscountRule3($arr_car);
				
				if($disc1) { $discount1 = $totalcar*5/100; $totalcar = $totalcar*95/100;  } //DISCOUNT RULE NO.1 5%
				if($disc2) { $discount2 = $totalcar*10/100; $totalcar = $totalcar*90/100;  } //DISCOUNT RULE NO.2 10%
				if($disc3) { $discount3 = $totalcar*7/100; $totalcar = $totalcar*93/100;  } //DISCOUNT RULE NO.3 7%
				$order->editOrder($discount1,$discount2,$discount3,$subtotalcar,$totalcar,$id);
				
            }
            header("Location: index.php?action=order");
        }
        
        $result = $order->getOrderByID($order_date);
        
        $car = new Car();
        $carResult = $car->getAllCar();
        require_once "web/order-edit.php";
        break;
    
    case "order-delete":
        $order_date = $_GET["date"];
        $order = new Order();
        $order->deleteOrder($order_date);
        
        $result = $order->getOrder();
        require_once "web/order.php";
        break;
    
    case "order":
        $order = new Order();
        $result = $order->getOrder();
        require_once "web/order.php";
        break;
    
    case "car-add":
        if (isset($_POST['add'])) {
            $name = $_POST['name'];
            $car_built = $_POST['car_built'];
            /*$dob = "";
            if ($_POST["dob"]) {
                $dob_timestamp = strtotime($_POST["dob"]);
                $dob = date("Y-m-d", $dob_timestamp);
            }*/
            $charge = $_POST['charge'];
            
            $car = new Car();
            $insertId = $car->addCar($name, $car_built, $charge);
            if (empty($insertId)) {
                $response = array(
                    "message" => "Problem in Adding New Record",
                    "type" => "error"
                );
            } else {
                header("Location: index.php");
            }
        }
        require_once "web/car-add.php";
        break;
    
    case "car-edit":
        $car_id = $_GET["id"];
        $car = new Car();
        
        if (isset($_POST['add'])) {
            $name = $_POST['name'];
            $car_built = $_POST['car_built'];
            /*$dob = "";
            if ($_POST["dob"]) {
                $dob_timestamp = strtotime($_POST["dob"]);
                $dob = date("Y-m-d", $dob_timestamp);
            }*/
            $charge = $_POST['charge'];
            
            $car->editCar($name, $car_built, $charge, $car_id);
            
            header("Location: index.php");
        }
        
        $result = $car->getCarById($car_id);
        require_once "web/car-edit.php";
        break;
    
    case "car-delete":
        $car_id = $_GET["id"];
        $car = new Car();
        
        $car->deleteCar($car_id);
        
        $result = $car->getAllCar();
        require_once "web/car.php";
        break;
    
    default:
        $car = new Car();
        $result = $car->getAllCar();
        require_once "web/car.php";
        break;
}
?>