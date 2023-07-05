<?php
    $qry = $conn->query("SELECT purchase.*, supplier.*, tax.name as t_name, tax.percent FROM purchase INNER JOIN supplier ON supplier.id=purchase.supplier INNER JOIN tax ON tax.id=purchase.tax WHERE purchase.id=".$_GET['id'])->fetch_array();    
    foreach ($qry as $k => $val) {
        $$k = $val;
    }
?>

<div class="container-fluid">
    <div class="content">
        <div class="content-header d-flex align-items-center justify-content-between">
            <h4>Purchase Order</h4>
            <div class="btn-controls">
                <button class="btn btn-success btn-print"><i class="fas fa-print"></i> print</button>
                <button class="btn btn-primary btn-send" data-email="<?=$email ?>" data-id="<?=$_GET['id'] ?>"><i class="fas fa-paper-plane"></i> send</button>
            </div>
        </div>
        <div class="content-body">
            <div class="content-data mt-5">
                <div class="invoice-header">
                    <div class="row">
                        <div class="col-md-6">
                            <span>Purchase no: <h3><?=$invoice ?></h3></span>
                        </div>
                        <div class="col-md-6">
                            <span>DATE: <h3><?=date("d M Y", strtotime($purchase_date)) ?></h3></span>
                        </div>
                    </div>
                </div>
                <div class="invoice_title">
                    <h2>Purchase Order</h2>
                </div>
                <div class="invoice-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div>
                                <strong>Supplier Name: </strong><span><?=$name ?></span>
                            </div>
                            <div>
                                <strong>Supplier Address: </strong><span><?=$address ?></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div>
                                <strong>Supplier Email: </strong><span><?=$email ?></span>
                            </div>
                            <div>
                                <strong>Supplier Contact: </strong><span><?=$phone ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="invoice-body">
                    <div class="stat d-flex align-items-center justify-content-between mb-4" style="font-size: 1.4rem;">
                        <div>
                            <strong>Purchase Status: </strong>
                            <?php if ($purchase_status == 1): ?>
                                <span class="badge bg-success">Received</span>
                            <?php elseif ($purchase_status == 2): ?>
                                <span class="badge bg-warning">Pending</span>
                            <?php else: ?>
                                <span class="badge bg-primary">Ordered</span>
                            <?php endif; ?>
                        </div>
                        <div>
                            <strong>Payment Status: </strong>
                            <?php if ($payment_status == 1): ?>
                                <span class="badge bg-warning">Patially Paid</span>
                            <?php else: ?>
                                <span class="badge bg-success">Fully Paid</span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $s = 1;
                                $qry = $conn->query("SELECT purchase_products.*, products.name as p_name FROM purchase_products INNER JOIN products ON products.id=purchase_products.product_id WHERE purchase_products.purchase_id=".$_GET['id']);
                                while ($row = $qry->fetch_array()) {
                                    ?>
                                        <tr>
                                            <td><?=$s ?></td>
                                            <td><?=$row['p_name'] ?></td>
                                            <td><?=$row['quantity'] ?></td>
                                            <td><?="KES".number_format($row['price'],2) ?></td>
                                            <td><?="KES".number_format($row['total'],2) ?></td>
                                        </tr>
                                    <?php
                                    $s++;
                                }
                            ?>
                            <tr>
                                <th colspan="4" style="text-align:right">SubTotal</th>
                                <td><?="KES".number_format($subtotal,2) ?></td>
                            </tr>
                            <tr>
                                <th colspan="4" style="text-align:right">Discount</th>
                                <td><?="KES".number_format($discount,2) ?></td>
                            </tr>
                            <tr>
                                <th colspan="4" style="text-align:right">Shipping</th>
                                <td><?="KES".number_format($shipping,2) ?></td>
                            </tr>
                            <tr>
                                <th colspan="4" style="text-align:right">Tax</th>
                                <td><?=$t_name." (".$percent."%)" ?></td>
                            </tr>
                            <tr>
                                <th colspan="4" style="text-align:right">GrandTotal</th>
                                <td><?="KES".number_format($grand_total,2) ?></td>
                            </tr>
                            <tr>
                                <th colspan="4" style="text-align:right">Paid</th>
                                <td><?="KES".number_format($paid,2) ?></td>
                            </tr>
                            <tr>
                                <th colspan="4" style="text-align:right">Due</th>
                                <td><?="KES".number_format($due,2) ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('.btn-print').click(function(){
        var wnd = window.open("print_purchase_order.php?id=<?php echo $_GET['id']; ?>", "__blank", "width=900, height=500")
        setTimeout(() => {
            wnd.print()
            setTimeout(() => {
                wnd.close()
            }, 200);
        }, 100);
    })

    $('.btn-send').click(function(){
        start_loader()

        $.ajax({
            url: 'ajax.php?action=send_mail',
            method: 'POST',
            data: {email:$(this).attr('data-email'), id:$(this).attr('data-id')},
            success: function(resp) {
                if (resp == 1) {
                    alert_pop("Email sent to supplier", "success")
                    end_loader()
                    setTimeout(() => {
                        location.reload()
                    }, 1500);
                }

                if (resp == 2) {
                    alert_pop("Email not sent, Check your connection", "danger")
                    end_loader()
                    setTimeout(() => {
                        location.reload()
                    }, 1500);
                }
            }
        })
    })
</script>