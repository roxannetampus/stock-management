<?php
class Sale
{
    private $servername = "localhost";
    private $username   = "root";
    private $password   = "";
    private $database   = "stock_management";
    public  $conn;


    // Database Connection 
    public function __construct()
    {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->database);
        if (mysqli_connect_error()) {
            trigger_error("Failed to connect to MySQL: " . mysqli_connect_error());
        } else {
            return $this->conn;
        }
    }
    // Insert 
    public function insertData($product_id, $stock_sale, $price)
    {
        $product_id = $this->conn->real_escape_string($product_id);
        $stock_sale = $this->conn->real_escape_string($stock_sale);
        $price = $this->conn->real_escape_string($price);
        $product = new Product();
        $getStock = $product->displayRecordById($product_id);
        if ($stock_sale <= $getStock['stock']) {
            $remaining_stock = $getStock['stock'] - $stock_sale;
            $product->updateStock($product_id, $remaining_stock);
            $query = "INSERT INTO sales(product_id, stock_sale, price) VALUES('$product_id','$stock_sale','$price')";
            $this->conn->query($query);
        } else {
            header("Location:index.php?sale=error");
        }
    }


    public function displaySales()
    {
        $query = "SELECT product_id, sum(stock_sale) as stock_sale, sum(price) as price FROM sales GROUP by product_id, price;";
        $result = $this->conn->query($query);
        if ($result->num_rows > 0) {
            $data = array();
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        } else {
            echo "No found records!";
        }
    }
}
