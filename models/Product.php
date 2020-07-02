<?php

class Product
{
    // DB Fields
    private $conn;
    private $table_name = "products";

    // Table Fields
    public $product_id;
    public $name;
    public $stock;
    public $created_date;

    // Constructor
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // GET
    public function getProducts()
    {
        $sqlQuery = "SELECT * FROM " . $this->table_name;
        $qry = $this->conn->prepare($sqlQuery);
        $qry->execute();
        return $qry;
    }

    // POST
    public function create()
    {
        $sqlQuery = "INSERT INTO
                " . $this->table_name . "
            SET
                product_id=:product_id, name=:name, stock=:stock, created_date=:created_date";

        $qry = $this->conn->prepare($sqlQuery);
        $this->product_id = cleanInput($this->product_id);
        $this->name = cleanInput($this->name);
        $this->stock = cleanInput($this->stock);
        $this->created_date = cleanInput($this->created_date);

        $qry->bindParam(":product_id", $this->product_id);
        $qry->bindParam(":name", $this->name);
        $qry->bindParam(":stock", $this->stock);
        $qry->bindParam(":created_date", $this->created_date);

        if ($qry->execute()) {
            return true;
        }
        return false;
    }

    public function checkProductById($product_id)
    {
        $sqlQuery = "SELECT
                       *
                      FROM
                        " . $this->table_name . "
                    WHERE 
                       product_id = ?
                    LIMIT 0,1";

        $qry = $this->conn->prepare($sqlQuery);

        $qry->bindParam(1, $product_id);
        $qry->execute();
        $dataRow = $qry->fetch(PDO::FETCH_ASSOC);
        if($dataRow){
           return true;
        }
        return false;
    }
}
