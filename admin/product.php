<div class="container-fluid">
    <div class="content">
        <div class="content-header d-flex align-items-center justify-content-between">
            <h4>Product List</h4>
            <a href="index.php?page=manage_product" class="btn btn-primary"><i class="fas fa-plus-circle"></i> New</a>
        </div>
        <div class="content-body">
            <div class="content-data mt-5">
                <table id="table_id" class="cell-border hover nowrap" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Product Name</th>
                            <th>Brand</th>
                            <th>Category</th>
                            <th>Quantity</th>
                            <th>Size</th>
                            <th>Purchase Price</th>
                            <th>Sale Price</th>
                            <th>Added On</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $serial = 1;
                            $qry = $conn->query("SELECT products.*, category.name as cat, brand.name as brand, unit.short as unit FROM products INNER JOIN category ON category.id=products.category_id INNER JOIN brand ON brand.id=products.brand_id INNER JOIN unit ON unit.id=products.unit_id");
                            while ($row = $qry->fetch_array()) {
                                ?>
                                    <tr>
                                        <td><?php echo $serial; ?></td>
                                        <td><img src="product_img/<?php echo $row['image']; ?>" alt=""></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['brand']; ?></td>
                                        <td><?php echo $row['cat']; ?></td>
                                        <td><?php echo $row['quantity'].$row['unit']; ?></td>
                                        <td><?php echo $row['size']; ?></td>
                                        <td><?php echo number_format($row['purchase_price'], 2); ?></td>
                                        <td><?php echo number_format($row['sale_price'], 2); ?></td>
                                        <td><?php echo $row['date_added']; ?></td>
                                        <td>
                                            <a href="index.php?page=manage_product&id=<?=$row['id'] ?>" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                            <button class="btn btn-danger btn-delete" id="btnn" data-id="<?php echo $row['id']; ?>"><i class="fas fa-trash-alt"></i></button>
                                        </td>
                                    </tr>
                                <?php

                                $serial++;
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $('.add_btn').click(function(){
        uni_modal("Product Form", "manage_product.php")
    })

    $('.btn-edit').click(function(){
        uni_modal("Edit Product", "manage_product.php?id="+$(this).attr('data-id'))
    })

    $('.btn-delete').click(function(){
        var conf = confirm("Do you really want to delete product data")
        if (conf == true) {
            $.ajax({
                url: 'ajax.php?action=delete_product',
                method: 'POST',
                data: {id:$(this).attr('data-id')},
                success: function(resp) {
                    if (resp == 1) {
                        alert_pop("Product deleted successfully", "danger")
                        setTimeout(() => {
                            location.reload()
                        }, 1500);
                    }
                }
            })
        }
    })
</script>