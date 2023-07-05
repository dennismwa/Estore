<?php
    $action = $_GET['action'];
    include "admin_class.php";
    $crud = new Actions();

    if ($action == "login_auth") {
        $login = $crud->login_auth();
        if ($login)
            echo $login;
    }

    if ($action == "logout") {
        $logout = $crud->logout();
    }

    if ($action == "save_brand") {
        $save = $crud->save_brand();
        if ($save)
            echo $save;
    }

    if ($action == "delete_brand") {
        $del = $crud->delete_brand();
        if ($del)
            echo $del;
    }

    if ($action == "save_supplier") {
        $save = $crud->save_supplier();
        if ($save)
            echo $save;
    }

    if ($action == "delete_supplier") {
        $del = $crud->delete_supplier();
        if ($del)
            echo $del;
    }

    if ($action == "save_staff") {
        $save = $crud->save_staff();
        if ($save)
            echo $save;
    }

    if ($action == "delete_staff") {
        $del = $crud->delete_staff();
        if ($del)
            echo $del;
    }

    if ($action == "save_customer") {
        $save = $crud->save_customer();
        if ($save)
            echo $save;
    }

    if ($action == "delete_customer") {
        $del = $crud->delete_customer();
        if ($del)
            echo $del;
    }

    if ($action == "save_category") {
        $save = $crud->save_category();
        if ($save)
            echo $save;
    }

    if ($action == "delete_category") {
        $del = $crud->delete_category();
        if ($del)
            echo $del;
    }

    if ($action == "save_product") {
        $save = $crud->save_product();
        if ($save)
            echo $save;
    }

    if ($action == "delete_product") {
        $del = $crud->delete_product();
        if ($del)
            echo $del;
    }

    if ($action == "save_purchase") {
        $save = $crud->save_purchase();
        if ($save)
            echo $save;
    }

    if ($action == "save_sales_new") {
        $save = $crud->save_sales_new();
        if ($save)
            echo $save;
    }

    if ($action == "save_purchase_status") {
        $update = $crud->save_purchase_status();
        if ($update)
            echo $update;
    }

    if ($action == "save_sales_status") {
        $update = $crud->save_sales_status();
        if ($update)
            echo $update;
    }

    if ($action == "send_mail") {
        $send = $crud->send_mail();
        if ($send)
            echo $send;
    }

    if ($action == "add_brand_product") {
        extract($_POST);
        $data = "name='$name'";
        $data .= ", description='$desc'";
        $count = $conn->query("SELECT * FROM brand WHERE name='$name'")->num_rows;

        if (!empty($name) && $count == 0) {
            $conn->query("INSERT INTO brand SET ".$data);
        }

        $show = $conn->query("SELECT * FROM brand ORDER BY id DESC");
        foreach ($show as $value) {
            ?>
                <option value="<?=$value['id']; ?>"><?=$value['name']; ?></option>
            <?php
        }
    }

    if ($action == "add_unit_product") {
        extract($_POST);
        $data = "name='$name'";
        $data .= ", short='$short'";
        $count = $conn->query("SELECT * FROM unit WHERE name='$name'")->num_rows;

        if (!empty($name) && $count == 0) {
            $conn->query("INSERT INTO unit SET ".$data);
        }

        $show = $conn->query("SELECT * FROM unit ORDER BY id DESC");
        echo "<option selected disabled>Select Unit</option>";
        foreach ($show as $value) {
            ?>
                <option value="<?=$value['id']; ?>"><?=$value['name']; ?></option>
            <?php
        }
    }

    if ($action == "add_tax_product") {
        extract($_POST);
        $data = "name='$name'";
        $data .= ", percent='$percent'";
        $count = $conn->query("SELECT * FROM tax WHERE name='$name'")->num_rows;

        if (!empty($name) && $count == 0) {
            $conn->query("INSERT INTO tax SET ".$data);
        }

        $show = $conn->query("SELECT * FROM tax ORDER BY id DESC");
        foreach ($show as $value) {
            ?>
                <option value="<?=$value['id']; ?>"><?php echo $value['name']." (".$value['percent']."%)"; ?></option>
            <?php
        }
    }

    if ($action == "add_category_product") {
        extract($_POST);
        $data = "name='$name'";
        $data .= ", description='$desc'";
        $count = $conn->query("SELECT * FROM category WHERE name='$name'")->num_rows;

        if (!empty($name) && $count == 0) {
            $conn->query("INSERT INTO category SET ".$data);
        }

        $show = $conn->query("SELECT * FROM category ORDER BY id DESC");
        foreach ($show as $value) {
            ?>
                <option value="<?=$value['id']; ?>"><?=$value['name']; ?></option>
            <?php
        }
    }

    if ($action == "add_supplier_purchase") {
        extract($_POST);
        $data = "name='$name'";
        $data .= ", phone='$phone'";
        $data .= ", address='$address'";
        $data .= ", email='$email'";

        $count = $conn->query("SELECT * FROM supplier WHERE name='$name' || email='$email' || phone='$phone'")->num_rows;

        if (!empty($name) && !empty($phone) && !empty($address) && !empty($email)) {
            $conn->query("INSERT INTO supplier SET ".$data);
        }

        $show = $conn->query("SELECT * FROM supplier ORDER BY id DESC");
        foreach ($show as $value) {
            ?>
                <option value="<?=$value['id']; ?>"><?=$value['name']; ?></option>
            <?php
        }
    }

    if ($action == "load_product") {
        $p_id = $_POST['p_id'];
        
        $qry = $conn->query("SELECT * FROM products WHERE id='$p_id'")->fetch_array();
        foreach ($qry as $k => $val) {
            $$k = $val;
        }

        if (isset($_SESSION['products'])) {
            $session_array_id = array_column($_SESSION['products'], "id");

            if (!in_array($id, $session_array_id)) {
                $session_array = array(
                    "id" => $id,
                    "name" => $name,
                    "qty" => $quantity,
                    "price" => $purchase_price,
                );
    
                $_SESSION['products'][] = $session_array;
            }
        } else {
            $session_array = array(
                "id" => $id,
                "name" => $name,
                "qty" => $quantity,
                "price" => $purchase_price,
            );

            $_SESSION['products'][] = $session_array;
        }
        
    }

    if ($action == "view_purchase_data") {
        extract($_POST);

        if (!empty($invoice)) {
            $serial = 1;
            $qry = $conn->query("SELECT purchase.*, supplier.name as s_name, tax.percent, tax.name as t_name FROM purchase INNER JOIN supplier ON supplier.id=purchase.supplier INNER JOIN tax ON tax.id=purchase.tax WHERE purchase.invoice='$invoice' ORDER BY purchase.id DESC");
            while ($row = $qry->fetch_array()) {
                ?>
                    <tr>
                        <td><?php echo $serial; ?></td>
                        <td><?php echo $row['invoice']; ?></td>
                        <td><?php echo date("M d, Y", strtotime($row['purchase_date'])); ?></td>
                        <td><?php echo $row['s_name']; ?></td>
                        <td>
                            <div>
                                <strong>Purchase Status: </strong><span><?php if ($row['purchase_status'] == 1): ?>
                                <span class="badge bg-success">Received</span>
                            <?php elseif ($row['purchase_status'] == 2): ?>
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
        }

        if (!empty($supplier) && empty($from) && empty($to)) {
            $serial = 1;
            $qry = $conn->query("SELECT purchase.*, supplier.name as s_name, tax.percent, tax.name as t_name FROM purchase INNER JOIN supplier ON supplier.id=purchase.supplier INNER JOIN tax ON tax.id=purchase.tax WHERE purchase.supplier='$supplier' ORDER BY purchase.id DESC");
            while ($row = $qry->fetch_array()) {
                ?>
                    <tr>
                        <td><?php echo $serial; ?></td>
                        <td><?php echo $row['invoice']; ?></td>
                        <td><?php echo date("M d, Y", strtotime($row['purchase_date'])); ?></td>
                        <td><?php echo $row['s_name']; ?></td>
                        <td>
                            <div>
                                <strong>Purchase Status: </strong><span><?php if ($row['purchase_status'] == 1): ?>
                                <span class="badge bg-success">Received</span>
                            <?php elseif ($row['purchase_status'] == 2): ?>
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
        }

        if (!empty($from) && !empty($to)) {
            $serial = 1;
            $qry = $conn->query("SELECT purchase.*, supplier.name as s_name, tax.percent, tax.name as t_name FROM purchase INNER JOIN supplier ON supplier.id=purchase.supplier INNER JOIN tax ON tax.id=purchase.tax WHERE (date(purchase.purchase_date) BETWEEN '$from' AND '$to')  ORDER BY purchase.id DESC");
            while ($row = $qry->fetch_array()) {
                ?>
                    <tr>
                        <td><?php echo $serial; ?></td>
                        <td><?php echo $row['invoice']; ?></td>
                        <td><?php echo date("M d, Y", strtotime($row['purchase_date'])); ?></td>
                        <td><?php echo $row['s_name']; ?></td>
                        <td>
                            <div>
                                <strong>Purchase Status: </strong><span><?php if ($row['purchase_status'] == 1): ?>
                                <span class="badge bg-success">Received</span>
                            <?php elseif ($row['purchase_status'] == 2): ?>
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
        }

        if (!empty($supplier) && !empty($from) && !empty($to)) {
            $serial = 1;
            $qry = $conn->query("SELECT purchase.*, supplier.name as s_name, tax.percent, tax.name as t_name FROM purchase INNER JOIN supplier ON supplier.id=purchase.supplier INNER JOIN tax ON tax.id=purchase.tax WHERE purchase.supplier='$supplier' AND (date(purchase.purchase_date) BETWEEN '$from' AND '$to')  ORDER BY purchase.id DESC");
            while ($row = $qry->fetch_array()) {
                ?>
                    <tr>
                        <td><?php echo $serial; ?></td>
                        <td><?php echo $row['invoice']; ?></td>
                        <td><?php echo date("M d, Y", strtotime($row['purchase_date'])); ?></td>
                        <td><?php echo $row['s_name']; ?></td>
                        <td>
                            <div>
                                <strong>Purchase Status: </strong><span><?php if ($row['purchase_status'] == 1): ?>
                                <span class="badge bg-success">Received</span>
                            <?php elseif ($row['purchase_status'] == 2): ?>
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
        }
    }


    if ($action == "view_sales_data") {
        extract($_POST);

        if (!empty($invoice)) {
            $serial = 1;
            $qry = $conn->query("SELECT sales.*, tax.percent, tax.name as t_name FROM sales INNER JOIN tax ON tax.id=sales.tax WHERE sales.invoice='$invoice' ORDER BY sales.id DESC");
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
        }

        if (!empty($from) && !empty($to)) {
            $serial = 1;
            $qry = $conn->query("SELECT sales.*, tax.percent, tax.name as t_name FROM sales INNER JOIN tax ON tax.id=sales.tax WHERE (date(sales.sales_date) BETWEEN '$from' AND '$to') ORDER BY sales.id DESC");
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
        }

        if (!empty($supplier) && !empty($from) && !empty($to)) {
            $serial = 1;
            $qry = $conn->query("SELECT purchase.*, supplier.name as s_name, tax.percent, tax.name as t_name FROM purchase INNER JOIN supplier ON supplier.id=purchase.supplier INNER JOIN tax ON tax.id=purchase.tax WHERE purchase.supplier='$supplier' AND (date(purchase.purchase_date) BETWEEN '$from' AND '$to')  ORDER BY purchase.id DESC");
            while ($row = $qry->fetch_array()) {
                ?>
                    <tr>
                        <td><?php echo $serial; ?></td>
                        <td><?php echo $row['invoice']; ?></td>
                        <td><?php echo date("M d, Y", strtotime($row['purchase_date'])); ?></td>
                        <td><?php echo $row['s_name']; ?></td>
                        <td>
                            <div>
                                <strong>Purchase Status: </strong><span><?php if ($row['purchase_status'] == 1): ?>
                                <span class="badge bg-success">Received</span>
                            <?php elseif ($row['purchase_status'] == 2): ?>
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
        }
    }

    