<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once __DIR__ . '/../config/database.php';
include_once __DIR__ . '/../helpers/helper.php';
include_once __DIR__ . '/../models/Product.php';

// DB connection
$database = new Database();
$db = $database->getConnection();

// Instance of Product
$item = new Product($db);

// Inputs
$data = json_decode(file_get_contents("php://input"));

// Check Empty of Inputs
if (!empty($data->product_id) &&
    !empty($data->name) &&
    !empty($data->stock)
) {

    // Check integer value of Product ID and Stock
    if (isInt($data->product_id) && isInt($data->stock)) {
        // Product ID value unique control
        if (!$item->checkProductById($data->product_id)) {
            $item->product_id = $data->product_id;
            $item->name = $data->name;
            $item->stock = $data->stock;
            $item->created_date = date('Y-m-d H:i:s');

            // Create data
            if ($item->create()) {

                $dataArr["code"] = SUCCESS;
                $dataArr["msg"] = "success";
                $dataArr["data"] = [
                    "product_id" => $item->product_id,
                    "name" => $item->name,
                    "stock" => (int)$item->stock,
                    "created_date" => $item->created_date,
                ];

                echo json_encode($dataArr);

            } else {

                $dataArr["code"] = NOT_MODIFIED;
                $dataArr["msg"] = "Data can not created. Try Again.";

                echo json_encode($dataArr);
            }
        } else {

            $dataArr["code"] = NOT_MODIFIED;
            $dataArr["msg"] = "Product ID value must be unique. Please try again with another ID value.";

            echo json_encode($dataArr);
        }

    } else {
        echo json_encode(["code" => BAD_REQUEST, "msg" => "Product ID and Stock are must be integer. Try again."]);
    }

} else {
    echo json_encode(["code" => BAD_REQUEST, "msg" => "Required fields cannot be empty. Please fill the fields completely and try again."]);
}
