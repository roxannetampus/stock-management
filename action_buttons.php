<?php
$productRow = $productObject->displayRecordById($product['id']);
?>
<!-- Delete -->
<div class="modal fade" id="del<?php echo $product['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center>
                    <h4 class="modal-title" id="myModalLabel">Delete</h4>
                </center>
            </div>
            <div class="modal-body">



                <div class="container-fluid">
                    <h5>
                        <center>Are you sure to delete <strong><?php echo ucwords($productRow['name']); ?></strong> from the list of products?</center>
                    </h5>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <a href="index.php?id=<?php echo $product['id']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete</a>
            </div>

        </div>
    </div>
</div>
<!-- /.modal -->

<!-- Edit -->
<div class="modal fade" id="edit<?php echo $product['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center>
                    <h4 class="modal-title" id="myModalLabel">Edit</h4>
                </center>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form method="POST" action="index.php">
                        <div class="row">
                            <input type="hidden" name="id" class="form-control" value="<?php echo $productRow['id']; ?>">
                            <div class="col-lg-2">
                                <label style="position:relative; top:7px;">Name:</label>
                            </div>
                            <div class="col-lg-10">
                                <input type="text" name="name" class="form-control" value="<?php echo $productRow['name']; ?>">
                            </div>
                        </div>
                        <div style="height:10px;"></div>
                        <div class="row">
                            <div class="col-lg-2">
                                <label style="position:relative; top:7px;">Stock:</label>
                            </div>
                            <div class="col-lg-10">
                                <input type="number" name="stock" class="form-control" value="<?php echo $productRow['stock']; ?>">
                            </div>
                        </div>
                        <div style="height:10px;"></div>
                        <div class="row">
                            <div class="col-lg-2">
                                <label style="position:relative; top:7px;">Price:</label>
                            </div>
                            <div class="col-lg-10">
                                <input type="number" name="price" class="form-control" value="<?php echo $productRow['price']; ?>">
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <button type="submit" name="update" class="btn btn-warning"><span class="glyphicon glyphicon-check"></span> Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- /.modal -->

<!-- /.add button -->
<div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center>
                    <h4 class="modal-title" id="myModalLabel">Add New Product</h4>
                </center>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form method="POST" action="index.php">
                        <div class=" row">
                            <div class="col-lg-2">
                                <label class="control-label" style="position:relative; top:7px;">Name:</label>
                            </div>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" name="name" required>
                            </div>
                        </div>
                        <div style="height:10px;"></div>
                        <div class="row">
                            <div class="col-lg-2">
                                <label class="control-label" style="position:relative; top:7px;">Stock:</label>
                            </div>
                            <div class="col-lg-10">
                                <input type="number" class="form-control" name="stock" required>
                            </div>
                        </div>
                        <div style="height:10px;"></div>
                        <div class="row">
                            <div class="col-lg-2">
                                <label class="control-label" style="position:relative; top:7px;">Price:</label>
                            </div>
                            <div class="col-lg-10">
                                <input type="number" class="form-control" name="price" required>
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <button type="submit" name="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Save</a>
                    </form>
            </div>

        </div>
    </div>
</div>