<?php
if (! defined('SIMPLE_TEST')) {
    define('SIMPLE_TEST', 'vendor/simpletest/simpletest/');
}
require_once(SIMPLE_TEST . 'autorun.php');
require_once('class/Order.php');

class CalculateDiscountTest extends UnitTestCase {
    function testDiscount() {
		$arr_car = array();
		$order = new Order();
		
		// SAMPLE ARRAY totalday = "number of car rental days", totalnum = "number of cars rented", car_built = "year of car built", charge = "price of rented car per days"
		$arr_car[]=array('totalday'=>3,'totalnum'=>1,'car_built'=>2009,'charge'=>50000);
		
		$disc1 = $order->calculateDiscountRule1($arr_car); //UNIT TEST 1. if rent for 3 days discount 5%
		$disc2 = $order->calculateDiscountRule2($arr_car); //UNIT TEST 2. if rent 2 car or more discount 10%
		$disc3 = $order->calculateDiscountRule3($arr_car); //UNIT TEST 3. if the car built below 2010 discount 7%
		
		
		$this->assertTrue($disc1);
		$this->assertTrue($disc2);
		$this->assertTrue($disc3);
    }
}
?>