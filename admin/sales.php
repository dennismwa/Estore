<div class="container-fluid">
    <div class="content">
        <div class="content-header d-flex align-items-center justify-content-between">
            <h4>Sales</h4>
            <a href="index.php?page=manage_sales" class="btn btn-primary"><i class="fas fa-plus-circle"></i> New</a>
        </div>
        <div class="content-body">
            <div class="well bg-light p-3">
                <form action="" id="sub_form">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <input type="text" name="invoice" placeholder="Search By Invoice" id="" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-5 mb-3">
                            <div class="form-group d-flex align-items-center gap-3">
                                <input type="date" name="from" id="" class="form-control">
                                <span class="fas fa-arrow-alt-right"></span>
                                <input type="date" name="to" id="" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-1 mb-3">
                            <button class="btn btn-primary w-100" type="submit" name="filter"><i class="fas fa-filter"></i> filter</button>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <select name="filtering" id="" class="form-control">
                                    <option value="" class="fl">Filter Option</option>
                                    <option value="all">All</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="content-data mt-5">
                <table id="table_id" class="cell-border hover nowrap" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Invoice Number</th>
                            <th>Sales Date</th>
                            <th>Client</th>
                            <th>Sales</th>
                            <th>SubTotal</th>
                            <th>Grand Total</th>
                            <th>Paid</th>
                            <th>Due</th>
                            <th>Payment Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="d_data">
                        <?php
                            $serial = 1;
                            $qry = $conn->query("SELECT sales.*, tax.percent, tax.name as t_name FROM sales INNER JOIN tax ON tax.id=sales.tax ORDER BY sales.id DESC");
                            while ($row = $qry->fetch_array()) {
                                ?>
                                    <tr>
                                        <td><?php echo $serial; ?></td>
                                        <td><?php echo $row['invoice']; ?></td>
                                        <td><?php echo date("M d, Y", strtotime($row['sales_date'])); ?></td>
                                        <td>
                                            <div>
                                                <strong>Names: </strong><span><?=$row['name'] ?></span>
                                            </div>
                                            <div>
                                                <strong>Email: </strong><span><?=$row['email'] ?></span>
                                            </div>
                                            <div>
                                                <strong>Mobile Phone: </strong><span><?=$row['phone'] ?></span>
                                            </div>
                                            <div>
                                                <strong>Address: </strong><span><?=$row['address'] ?></span>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <strong>Sales Status: </strong><span><?php if ($row['sales_status'] == 1): ?>
                                                <span class="badge bg-success">Received</span>
                                            <?php elseif ($row['sales_status'] == 2): ?>
                                                <span class="badge bg-warning">Pending</span>
                                            <?php else: ?>
                                                <span class="badge bg-primary">Ordered</span>
                                            <?php endif; ?></span>
                                            </div>
                                            <div>
                                                <strong>Discount: </strong><span><?php echo "KES".number_format($row['discount'], 2); ?></span>
                                            </div>
                                            <div>
                                                <strong>Shipping: </strong><span><?php echo "KES".number_format($row['shipping'], 2); ?></span>
                                            </div>
                                            <div>
                                                <strong>Tax: </strong><span><?php echo $row['t_name']." (".$row['percent']."%)"; ?></span>
                                            </div>
                                        </td>
                                        <td><?php echo "KES".number_format($row['subtotal'], 2); ?></td>
                                        <td><span class="badge bg-primary" style="font-size: 1.4rem;"><?php echo "KES".number_format($row['grand_total'], 2); ?></span></td>
                                        <td><span class="badge bg-success" style="font-size: 1.4rem;"><?php echo "KES".number_format($row['paid'], 2); ?></span></td>
                                        <td><span class="badge bg-danger" style="font-size: 1.4rem;"><?php echo "KES".number_format($row['due'], 2); ?></span></td>
                                        <td>
                                            <?php if ($row['payment_status'] == 1): ?>
                                                <span class="badge bg-warning">Partially Paid</span>
                                            <?php else: ?>
                                                <span class="badge bg-success">FUlly Paid</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="index.php?page=view_invoice&id=<?=$row['id'] ?>" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                                            <button class="btn btn-info btn-edit" id="btnn" data-id="<?php echo $row['id']; ?>"><i class="fas fa-edit"></i></button>
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
        uni_modal("Edit Sales", "edit_sales.php?id="+$(this).attr('data-id'))
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

    $('#sub_form').submit(function(e){
        e.preventDefault()

        start_loader()
        $.ajax({
            url: 'ajax.php?action=view_sales_data',
            method: 'POST',
            data: $(this).serialize(),
            success: function(resp) {
                $('#d_data').html(resp)
                $('.fl').attr('selected', true)
                end_loader()
            }
        })
    })

    $('[name="filtering"]').on('change', function(){
        if ($(this).val() == "all") {
            location.reload()
        }
    })
</script>