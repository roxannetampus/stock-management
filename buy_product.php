<?php
include('product.php');
include('sale.php');
session_start();

$productObject = new Product();
$saleObject = new Sale();
$_POST = $_SESSION['checkout'];

$total_price = 0;
$total_sales = 0;
?>

<!DOCTYPE html>
<html>

<head>
    <title>Checkout</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <div style="height:50px;"></div>
        <div class="well" style="margin:auto; padding:auto; width:80%;">
            <span style="font-size:25px;">
                <center><strong>SUMMARY</strong></center>
            </span>
            <span class="pull-right"><a href="./" data-toggle="modal" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Add sale</a></span>
            <div style="height:20px;"></div>
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <th>PRODUCTS</th>
                    <th>STOCK</th>
                    <th>PRICE</th>
                    <th>TOTAL</th>
                </thead>
                <tbody>
                    <?php
                    foreach ($_POST['product_id'] as $key => $val) {
                        if ($_POST['stock_sale'][$key] != 0) {

                            $saleObject->insertData($_POST['product_id'][$key], $_POST['stock_sale'][$key], $_POST['productprice'][$key])
                    ?>
                            <tr>
                                <td><?php echo $_POST['productname'][$key] ?></td>
                                <td><?php echo $_POST['stock_sale'][$key]; ?></td>
                                <td><?php echo $_POST['productprice'][$key]; ?></td>
                                <td><?php echo number_format(((float)$_POST['productprice'][$key] * (int)$_POST['stock_sale'][$key]), 2); ?></td>

                            </tr>

                    <?php
                            $total_price += (float)$_POST['productprice'][$key] * (int)$_POST['stock_sale'][$key];
                        }
                    }
                    ?>

                </tbody>
            </table>
            <strong>TOTAL PRICE: <?php echo number_format($total_price, 2); ?><strong>
                    <span style="font-size:25px;">
                        <center><strong>OVERALL SALES</strong></center>
                    </span>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <th>PRODUCTS</th>
                            <th>STOCK</th>
                            <th>PRICE</th>
                            <th>TOTAL</th>
                        </thead>
                        <tbody>
                            <?php
                            $sales = $saleObject->displaySales();
                            foreach ($sales as $sale) {
                                $getName = $productObject->displayRecordById($sale['product_id']);
                            ?>
                                <tr>
                                    <td><?php echo ucwords($getName['name']); ?></td>
                                    <td><?php echo $sale['stock_sale'] ?></td>
                                    <td><?php echo number_format($sale['price'], 2); ?></td>
                                    <td><?php echo number_format(((float)$sale['price'] * (int)$sale['stock_sale']), 2); ?></td>

                                </tr>
                            <?php
                                $total_sales += (float)$sale['price'] * (int)$sale['stock_sale'];
                            }
                            ?>
                        </tbody>
                    </table>
                    <strong>TOTAL SALE: <?php echo number_format($total_sales, 2); ?><strong>
        </div>
    </div>
</body>

</html>