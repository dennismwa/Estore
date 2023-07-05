<div class="container-fluid">
    <div class="content">
        <div class="content-header d-flex align-items-center justify-content-between">
            <h4>Order List</h4>
        </div>
        <div class="content-body">
            <div class="content-data mt-5">
                <table id="table_id" class="cell-border hover nowrap" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Ref No.</th>
                            <th>User</th>
                            <th>Deliver To</th>
                            <th>Deliver Contact</th>
                            <th>Country</th>
                            <th>Town</th>
                            <th>Street Address</th>
                            <th>Delivery Fee</th>
                            <th>Grand</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $serial = 1;
                            $qry = $conn->query("SELECT orders.*, users.names as user FROM orders INNER JOIN users ON users.id=orders.user_id");
                            while ($row = $qry->fetch_array()) {
                                ?>
                                    <tr>
                                        <td><?php echo $serial; ?></td>
                                        <td><?php echo $row['order_no']; ?></td>
                                        <td><?php echo $row['user']; ?></td>
                                        <td><?php echo $row['delivery_firstname']." ".$row['delivery_last_name']; ?></td>
                                        <td><?php echo $row['delivery_phone']; ?></td>
                                        <td><?php echo $row['country']; ?></td>
                                        <td><?php echo $row['town']; ?></td>
                                        <td><?php echo $row['street_address']; ?></td>
                                        <td><?php echo $row['delivery_fee']; ?></td>
                                        <td><?php echo $row['grand']; ?></td>
                                        <td><?php echo $row['order_date']; ?></td>
                                        <td>
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