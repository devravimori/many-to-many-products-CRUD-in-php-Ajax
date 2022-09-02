<?php
require_once("common/config.php");
    $getCategory ="select * from category order by id desc";
    try{
        $conn->statement($getCategory);
        $result = $conn->execute();
        if($result->num_rows > 0){
            $data = [];
            while($row = $result->fetch_assoc()){
                $data[]=$row;
            }
        }
        echo json_encode($data);
    }catch(Exception $e){
        echo $e->getMessage();
    }
