<?php
require_once("common/config.php");

$name = $conn->realstr($_POST['name']);
$price = $conn->realstr($_POST['price']);
$image_n = $_FILES['file']['name'];
$temp_image = $_FILES['file']['tmp_name'];
$type = $_FILES['file']['type'];
$extension = pathinfo($image_n, PATHINFO_EXTENSION);
$image_location = "image/" . rand() . "." . $extension;

// validation
$allfields = ['name' => $name, 'price' => $price, 'image' => $temp_image];
if (is_numeric($allfields['name'])) {
    $conn->err['name'] = "only number not allowed";
}
if (!is_numeric($allfields['price'])) {
    $conn->err['price'] = "Price only can be numeric.";
}
if (stripos($type, "image/") === false && !empty($temp_image)) {
    $conn->err['image'] =  "invalid image";
}
if (isset($_POST['insert']) == false) {
    $conn->err['category'] =  "category is required";
} else {
    $category = $_POST['insert'];
}
foreach ($allfields as $key => $value) {
    if (empty($value)) {
        $conn->err[$key] = "$key is required ";
    }
}

// echo print_r($conn->err, true);
// execution
if (empty($conn->err)) {
    $qury = "insert into products(name,price,image) values('" . $name . "','$price','" . $image_location . "')";
    $conn->statement($qury);
    // $conn->execute();
    if ($conn->execute() == true) {
        move_uploaded_file($temp_image, $image_location);
        $pid = $conn->getLastId();
        for ($i = 0; $i < count($category); $i++) {
            $querycp = "insert into cp(cid,pid)values(" . $category[$i] . "," . $pid . ")";
            $conn->statement($querycp);
            $conn->execute();
        }
        $categoryname = "SELECT GROUP_CONCAT(c.name SEPARATOR ' , ') as catename from products p INNER JOIN cp on cp.pid = p.id INNER JOIN category c on cp.cid = c.id WHERE p.id =$pid GROUP by p.id";
        $conn->statement($categoryname);
        $result = $conn->execute();
        $row = mysqli_fetch_row($result);
        // send new data at first row in table
        $newData = ['categoryinserted' => $row[0], 'pid' => $pid, 'newName' => $name, 'newPrice' => $price, 'newImage' => $image_location];
        echo json_encode($newData);
    }
} else {
    echo json_encode($conn->err);
}
