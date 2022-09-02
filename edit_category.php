<?php
require_once("common/config.php");
$id = $_POST['id'];
$modyfi = $_POST['modyfi'];
// validation
if (isset($_POST['name'])) {
    $name = $conn->realstr($_POST['name']);
    if (empty($name)) {
        $conn->err['category'] = "category is required ";
    } else  if (is_numeric($name)) {
        $conn->err['category'] = "only number not allowed";
    }
}
try {
    // for show data in form
    if (!empty($id) && $modyfi == 'false') {
        $getCategory = "select * from category where id = {$id}";
        $conn->statement($getCategory);
        $result = $conn->execute();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        }
        echo json_encode($row);
    }
    // modyfy
    if ($modyfi == 'true' && !empty($id)) {
        $modify_query = "update category set name = '" . $name . "' where id = {$id}";

        // execution
        if (empty($conn->err)) {
            $conn->statement($modify_query);
            $conn->execute();
            $data = ['id' => $id, 'name' => $name];
            echo json_encode($data);
        } else {
            $data = ['error' => $conn->err['category']];
            echo json_encode($data);
        }
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
