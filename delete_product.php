<?php
require_once("common/config.php");
try {
    $id = $_POST['id'];
    if (!empty($id)) {
        $getImage = "select image from products where id =" . $id;
        $conn->statement($getImage);
        $result = $conn->execute();
        $row = mysqli_fetch_row($result);
        if (file_exists($row[0])) {
            unlink($row[0]);
        }
        $delquery = "delete from products where id =" . $id;
        $delquerycp = "DELETE FROM `cp` WHERE  pid =" . $id;
        $conn->statement($delquerycp);
        $conn->execute();
        $conn->statement($delquery);
        $conn->execute();
        echo true;
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
