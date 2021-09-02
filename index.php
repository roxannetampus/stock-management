<?php
include('product.php');
session_start();
error_reporting(0);
$productObject = new Product();
// Insert Record in product table
if (isset($_POST['submit'])) {
    $productObject->insertData($_POST);
}

// Update Record in product table
if (isset($_POST['update'])) {
    $productObject->updateRecord($_POST);
}

// Delete record from table
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $deleteProduct = $_GET['id'];
    $productObject->deleteRecord($deleteProduct);
}

if (isset($_POST['checkout'])) {
    $_SESSION['checkout'] = $_POST;
    header("Location:buy_product.php");
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Stock Management System</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <div style="height:50px;"></div>
        <div class="well" style="margin:auto; padding:auto; width:80%;">
            <span style="font-size:25px;">
                <center><strong>Stock Management System</strong></center>
            </span>
            <?php
            if (isset($_GET['msg1']) == "insert") {
                echo "<div class='alert alert-success alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        Product is added successfully
                      </div>";
            }
            if (isset($_GET['msg2']) == "update") {
                echo "<div class='alert alert-success alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        Product is updated successfully
                      </div>";
            }
            if (isset($_GET['msg3']) == "delete") {
                echo "<div class='alert alert-success alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        Record deleted successfully
                      </div>";
            }
            if (isset($_GET['sale']) == "error") {
                echo "<div class='alert alert-danger alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        Quantity value must lesser or equal to stock!
                      </div>";
            }
            ?>

            <span class="pull-left"><a href="#addnew" data-toggle="modal" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Add New</a></span>
            <div style="height:50px;"></div>
            <form action="./" method="post">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <th>PRODUCTS</th>
                        <th>STOCK</th>
                        <th>PRICE</th>
                        <th>BUY (please input quantity)</th>
                        <th>ACTION</th>
                    </thead>
                    <tbody>
                        <?php
                        $products = $productObject->displayData();
                        foreach ($products as $product) {
                        ?>
                            <tr>
                                <td><?php echo ucwords($product['name']); ?></td>
                                <td><?php echo ucwords($product['stock']); ?></td>
                                <td><?php echo $product['price']; ?></td>
                                <td>
                                    <?php if ($product['stock'] != 0) { ?>
                                        <input class="form-control" type="hidden" name="productname[]" value="<?php echo $product['name'] ?>">
                                        <input class="form-control" type="hidden" name="product_id[]" value="<?php echo $product['id'] ?>">
                                        <input class="form-control" type="hidden" name="productprice[]" value="<?php echo $product['price'] ?>">
                                        <input class="form-control" type="number" name="stock_sale[]" value="0">
                                    <?php } else {
                                        echo "N/A";
                                    } ?>
                                </td>
                                <td>
                                    <a href="#edit<?php echo $product['id']; ?>" data-toggle="modal" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                                    <a href="#del<?php echo $product['id']; ?>" data-toggle="modal" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete</a>
                                    <?php include('action_buttons.php'); ?>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <span class="pull-right"><button type="submit" name="checkout" class="btn btn-success">Checkout</button></span>
            </form>
            <br /><br />
        </div>
    </div>
</body>

</html>