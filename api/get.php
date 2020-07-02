<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once __DIR__.'/../config/database.php';
include_once __DIR__.'/../helpers/helper.php';
include_once __DIR__.'/../models/Product.php';

// DB connection
$database = new Database();
$db = $database->getConnection();

// Instance of Product
$items = new Product($db);

$query = $items->getProducts();
$itemCount = $query->rowCount();

// Check item count
if ($itemCount > 0) {

    $dataArr["code"] = SUCCESS;
    $dataArr["msg"] = "success";
    $dataArr["data"] = array();

    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {

        $item = array(
            "product_id" => $row["product_id"],
            "name" => $row["name"],
            "stock" => $row["stock"],
            "created_date" => $row["created_date"]
        );

        array_push($dataArr["data"], $item);
    }

    echo json_encode($dataArr);

} else {

    $dataArr["code"] = NOT_FOUND;
    $dataArr["msg"] = "Not found any record.";
    echo json_encode($dataArr);
}
