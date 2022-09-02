<?php
require_once("common/config.php");
$getCategory = "SELECT p.id , p.name , p.image , p.price  ,cp.pid , GROUP_CONCAT(c.name SEPARATOR ' , ') as catename
    FROM( (products p LEFT JOIN cp on cp.pid = p.id)
    LEFT JOIN category c ON cp.cid = c.id
    ) GROUP BY p.id order by p.id DESC";
try {
    $conn->statement($getCategory);
    $result = $conn->execute();
    if ($result->num_rows > 0) {
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    echo json_encode($data);
} catch (Exception $e) {
    echo $e->getMessage();
}
