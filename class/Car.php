<?php 
require_once ("class/DBController.php");
class Car
{
    private $db_handle;
    
    function __construct() {
        $this->db_handle = new DBController();
    }
    
    function addCar($name, $car_built, $charge) {
        $query = "INSERT INTO m_car (car_name,car_built,charge) VALUES (?, ?, ?)";
        $paramType = "sii";
        $paramValue = array(
            $name,
            $car_built,
            $charge
        );
        
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);
        return $insertId;
    }
    
    function editCar($name, $car_built, $charge, $student_id) {
        $query = "UPDATE m_car SET car_name = ?,car_built = ?,charge = ? WHERE car_id = ?";
        $paramType = "siii";
        $paramValue = array(
            $name,
            $car_built,
            $charge,
            $student_id
        );
        
        $this->db_handle->update($query, $paramType, $paramValue);
    }
    
    function deleteCar($student_id) {
        $query = "DELETE FROM m_car WHERE car_id = ?";
        $paramType = "i";
        $paramValue = array(
            $student_id
        );
        $this->db_handle->update($query, $paramType, $paramValue);
    }
    
    function getCarById($student_id) {
        $query = "SELECT * FROM m_car WHERE car_id = ?";
        $paramType = "i";
        $paramValue = array(
            $student_id
        );
        
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
    }
    
    function getAllCar() {
        $sql = "SELECT * FROM m_car ORDER BY car_id";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }
}
?>