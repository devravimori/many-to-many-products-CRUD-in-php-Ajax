<?php
require_once("common/config.php");

$name = $conn->realstr($_POST['name']);

$qury = "insert into category(name) values('" . $name . "')";

// validation
$allfields = ['category' => $name];
foreach ($allfields as $key => $value) {
  if (empty($value)) {
    $conn->err[$key] = "$key is required ";
  } else  if (is_numeric($allfields['category'])) {
    $conn->err['category'] = "only number not allowed";
  }
}

// execution
if (empty($conn->err)) {
  $conn->statement($qury);
  $conn->execute();
  $lastID = $conn->getLastId();
  $data = ['id' => $lastID, 'name' => $name];
  echo json_encode($data);
} else {
  $data = ['error' => $conn->err['category']];
  echo json_encode($data);
}
