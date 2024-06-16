<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../config/dbclass.php';
    include_once '../class/findproduct.php';
    $dbclass = new Dbclass();
    $db = $dbclass->getConnection();
    $items = new Findproduct($db);
    $stmt = $items->getProducts();
    $itemCount = $stmt->rowCount();

    //echo json_encode($itemCount);
    if($itemCount > 0){
        
        $productArr = array();
		//$productArr["itemCount"] = $itemCount;
        //$productArr["body"] = array();
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "Imf" => $imf,
                "Description" => $description,
                "Type_issue" => $type_issue,
                "Vend_num" => $vend_num,
                "Man_num" => $man_num,
                "Location" => $location
            );
            //array_push($productArr["body"], $e);
            array_push($productArr, $e);
        }
        echo json_encode($productArr);
    }
    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>