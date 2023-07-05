<?php
    include 'connection.php';

    $qry = $conn->query("SELECT purchase.*, supplier.*, tax.name as t_name, tax.percent FROM purchase INNER JOIN supplier ON supplier.id=purchase.supplier INNER JOIN tax ON tax.id=purchase.tax WHERE purchase.id=".$_GET['id'])->fetch_array();    
    foreach ($qry as $k => $val) {
        $$k = $val;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estore | Admin</title>

    <!--css links-->
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="assets/css/jquery.dataTables.css">
    <link rel="stylesheet" href="assets/css/jquery.datetimepicker.min.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <!--script links-->
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery.datetimepicker.full.min.js"></script>
    <script src="assets/js/jquery.dataTables.js"></script>
    <script src="assets/js/script.js"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="content">
            <div class="content-header d-flex align-items-center justify-content-between">
                <h4>Purchase Order</h4>
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
</body>
</html>