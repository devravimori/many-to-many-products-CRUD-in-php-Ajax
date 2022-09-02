<?php
require_once("common/config.php");

$id = $_POST['id'];
$modyfi = $_POST['updateP'];
try {
    if (!empty($id) && $modyfi == 'false') {
        $getCategory = "select * from products where id = {$id}";
        $conn->statement($getCategory);
        $result = $conn->execute();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        }
        $cateQ = "SELECT cp.cid,  c.name from products p INNER JOIN cp on cp.pid = p.id INNER JOIN category c ON cp.cid = c.id WHERE p.id = " . $id;
        $conn->statement($cateQ);
        $category = $conn->execute();
        $cateData = ['cid' => '', 'name' => ''];
        while ($data = $category->fetch_assoc()) {
            foreach ($data as $key => $value) {
                $cateData["$key"] .= " " . $value;
            }
        }
        $getCategory = "select * from category order by id desc";
        $conn->statement($getCategory);
        $result = $conn->execute();
        $tr = '';
        while ($data = $result->fetch_assoc()) {

            // if (str_contains($cateData['cid'], $data['id'])) {
            if (strpos($cateData['cid'], $data['id']) !== false) {
                $checked = 'checked';
            } else {
                $checked = "";
            }

            $tr .= "<div class='form-check form-check-inline'><label class='form-check-label' for='ad_Checkbox2{$data['id']}'><input class='form-check-input get_value' id='ad_Checkbox2{$data['id']}' name='moify[]' type='checkbox'  value='{$data['id']}' $checked>{$data['name']}</label></div>";
        }
        $row['category'] = $tr;
        echo json_encode($row);
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
