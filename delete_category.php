<?php
require_once("common/config.php");
try {
  
    $id = $_POST['id'];
    if(!empty($id)){
        $delquery = "delete from category where id = {$id}";
        $delquerycp = "DELETE FROM `cp` WHERE  cid = {$id}";
            
        $conn->statement($delquerycp);
        $conn->execute();

        $conn->statement($delquery);
        $conn->execute();

        echo true;
    }
  
    
} catch (Exception $e) {
   echo $e->getMessage();
}
