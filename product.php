<?php

class Product
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
    public function insertData($post)
    {
        $name = $this->conn->real_escape_string($_POST['name']);
        $stock = $this->conn->real_escape_string($_POST['stock']);
        $price = $this->conn->real_escape_string($_POST['price']);
        $query = "INSERT INTO products(`name`,stock,price) VALUES('$name',$stock,$price)";
        $sql = $this->conn->query($query);
        if ($sql == true) {
            header("Location:index.php?msg1=insert");
        } else {
            echo "Product registration failed!";
        }
    }

    // Fetch all data
    public function displayData()
    {
        $query = "SELECT * FROM products";
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

    // Fetch single data 
    public function displayRecordById($id)
    {
        $query = "SELECT * FROM products WHERE id = $id";
        $result = $this->conn->query($query);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        } else {
            echo "Record not found!";
        }
    }

    // Update 
    public function updateRecord($postData)
    {
        $name = $this->conn->real_escape_string($_POST['name']);
        $stock = $this->conn->real_escape_string($_POST['stock']);
        $price = $this->conn->real_escape_string($_POST['price']);
        $id = $this->conn->real_escape_string($_POST['id']);
        if (!empty($id) && !empty($postData)) {
            $query = "UPDATE products SET `name` = '$name', stock = $stock, price=$price WHERE id = $id";
            $sql = $this->conn->query($query);
            if ($sql == true) {
                header("Location:index.php?msg2=update");
            } else {
                echo "Registration updated failed try again!";
            }
        }
    }

    // Delete 
    public function deleteRecord($id)
    {
        $query = "DELETE FROM products WHERE id = '$id'";
        $sql = $this->conn->query($query);
        if ($sql == true) {
            header("Location:index.php?msg3=delete");
        } else {
            echo "Record does not delete try again";
        }
    }

    public function updateStock($id, $stock)
    {
        $query = "UPDATE products SET stock = $stock WHERE id = $id";
        $this->conn->query($query);
    }
}
