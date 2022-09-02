<?php
require_once("common/config.php");

$name =  $conn->realstr($_POST['modelName']);
$idforUpdate =  $conn->realstr($_POST['modelID']);
$price =  $conn->realstr($_POST['modelPrice']);
$chageImage = false;


//chage image or not
if (!empty($_FILES['newFile']['tmp_name'])) {
    $image_n = $_FILES['newFile']['name'];
    $temp_image = $_FILES['newFile']['tmp_name'];
    $type = $_FILES['newFile']['type'];
    $extension = pathinfo($image_n, PATHINFO_EXTENSION);
    $image_location = "image/" . rand() . "." . $extension;
    $chageImage = true;
} else {
    $image_location = $conn->realstr($_POST['oldPicture']);
}
// // validation  
$allfields = ['name' => $name, 'price' => $price];
foreach ($allfields as $key => $value) {
    if (empty($value)) {
        $conn->err[$key] = "$key is required ";
    } else {
        if (!is_numeric($allfields['price'])) {
            $conn->err['price'] = "only number allowed";
        }
        if (is_numeric($allfields['name'])) {
            $conn->err['name'] = "only number not allowed";
        }
    }
}
if (isset($_POST['moify']) == false) {
    $conn->err['category'] =  "category is required";
} else {
    $category =  $_POST['moify'];
}
if (!empty($_FILES['newFile']['tmp_name'])) {
    if (stripos($type, "image/") === false) {
        $conn->err['image'] =  "invalid image";
    }
}

try {
    // modyfy
    if (!empty($idforUpdate)) {
        // execution
        if (empty($conn->err)) {
            $modify_query = "update products set name = '" . $name . "' , price = " . $price . " , image ='" . $image_location . "' where id = {$idforUpdate}";
            $conn->statement($modify_query);
            $conn->execute();
            // update category
            $delquerycp = "DELETE FROM `cp` WHERE  pid =" . $idforUpdate;
            $conn->statement($delquerycp);
            $conn->execute();
            foreach ($category as $data) {
                $querycp = "insert into cp(cid,pid)values('" . $data . "','" . $idforUpdate . "')";
                $conn->statement($querycp);
                $conn->execute();
            }
            //  show new data in table
            $getCategory = "SELECT p.id as newID, p.name as newName , p.image newImage , p.price as newPrice ,cp.pid , GROUP_CONCAT(c.name SEPARATOR ' , ') as catename FROM( (products p LEFT JOIN cp on cp.pid = p.id) LEFT JOIN category c ON cp.cid = c.id ) WHERE p.id =$idforUpdate";

            $conn->statement($getCategory);
            $result = $conn->execute();
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
            }
            // image upload
            if (file_exists($_POST['oldPicture']) && $chageImage == true) {
                unlink($_POST['oldPicture']);
            }
            if ($chageImage == true) {
                move_uploaded_file($temp_image, $image_location);
            }
            echo json_encode($row);
        } else {
            echo json_encode($conn->err);
        }
    }
} catch (Exception $e) {
    // echo $e->getMessage();
}
