<?php
    include "connection.php";
    session_start();

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer/PHPMailer.php';
    require 'PHPMailer/Exception.php';
    require 'PHPMailer/SMTP.php';

    class Actions {

        function login_auth() {
            global $conn;

            extract($_POST);
            $qry = $conn->query("SELECT * FROM admin WHERE username='$username' AND password='$password' AND status='1'")->num_rows;
            if ($qry > 0) {
                $_SESSION['username'] = $username;
                return 1;
            } else {
                return 2;
            }
        }

        function logout() {
            unset($_SESSION['username']);
            session_destroy();
            header('Location:login.php');
        }

        function save_brand() {
            global $conn;

            extract($_POST);
            $data = "name='$name'";
            $data .= ", description='$desc'";

            if (empty($id)) {
                if (!empty($name)) {
                    $qry = $conn->query("SELECT * FROM brand WHERE name='$name'")->num_rows;
                    if ($qry > 0) {
                        return 2;
                    } else {
                        $save = $conn->query("INSERT INTO brand SET ".$data);
                        if ($save)
                            return 1;
                    }
                    
                } else {
                    return 3;
                }
            } else {
                $save = $conn->query("UPDATE brand SET ".$data." WHERE id=".$id);
                if ($save)
                    return 1;
            }
            
        }

        function delete_brand() {
            global $conn;

            $id = $_POST['id'];
            $del = $conn->query("DELETE FROM brand WHERE id='$id'");
            if ($del)
                return 1;
        }

        function save_supplier() {
            global $conn;

            extract($_POST);
            $data = "name='$name'";
            $data .= ", phone='$phone'";
            $data .= ", address='$address'";
            $data .= ", email='$email'";
            if (empty($id)) {
                if (!empty($name) && !empty($email) && !empty($phone) && !empty($address)) {
                    if (filter_var($email, FILTER_VALIDATE_EMAIL) == true) {
                        if (filter_var($phone, FILTER_SANITIZE_NUMBER_INT) == true) {
                            $qry = $conn->query("SELECT * FROM supplier WHERE name='$name' || email='$email' || phone='$phone'")->num_rows;
                            if ($qry > 0) {
                                return 2;
                            } else {
                                $save = $conn->query("INSERT INTO supplier SET ".$data);
                                if ($save)
                                    return 1;
                            }
                            
                        } else {
                            return 5;
                        }
                        
                    } else {
                        return 4;
                    }
                    
                } else {
                    return 3;
                }
                
            } else {
                $save = $conn->query("UPDATE supplier SET ".$data." WHERE id=".$id);
                if ($save)
                    return 1;
            }
            
        }

        function save_staff() {
            global $conn;

            extract($_POST);
            $data = "names='$name'";
            $data .= ", phone='$phone'";
            $data .= ", address='$address'";
            $data .= ", email='$email'";
            $data .= ", department='$dept'";
            $data .= ", salary='$salary'";
            if (empty($id)) {
                if (!empty($name) && !empty($email) && !empty($phone) && !empty($address) && !empty($dept) && !empty($salary)) {
                    if (filter_var($email, FILTER_VALIDATE_EMAIL) == true) {
                        if (filter_var($phone, FILTER_SANITIZE_NUMBER_INT) == true) {
                            $qry = $conn->query("SELECT * FROM staff WHERE names='$name' || email='$email' || phone='$phone'")->num_rows;
                            if ($qry > 0) {
                                return 2;
                            } else {
                                $save = $conn->query("INSERT INTO staff SET ".$data);
                                if ($save)
                                    return 1;
                            }
                            
                        } else {
                            return 5;
                        }
                        
                    } else {
                        return 4;
                    }
                    
                } else {
                    return 3;
                }
                
            } else {
                $save = $conn->query("UPDATE staff SET ".$data." WHERE id=".$id);
                if ($save)
                    return 1;
            }
            
        }

        function save_customer() {
            global $conn;

            extract($_POST);
            $data = "names='$name'";
            $data = ", username='$username'";
            $data .= ", email='$email'";
            $data .= ", phone='$phone'";
            $data .= ", password='$password'";
            if (empty($id)) {
                if (!empty($name) && !empty($email) && !empty($phone) && !empty($username) && !empty($password)) {
                    if (filter_var($email, FILTER_VALIDATE_EMAIL) == true) {
                        if (filter_var($phone, FILTER_SANITIZE_NUMBER_INT) == true) {
                            $qry = $conn->query("SELECT * FROM users WHERE username='$username' || email='$email' || phone='$phone'")->num_rows;
                            if ($qry > 0) {
                                return 2;
                            } else {
                                $save = $conn->query("INSERT INTO users VALUES(NULL, '$name', '$username', '$email', '$phone', '$password') ");
                                if ($save)
                                    return 1;
                            }
                            
                        } else {
                            return 5;
                        }
                        
                    } else {
                        return 4;
                    }
                    
                } else {
                    return 3;
                }
                
            } else {
                $save = $conn->query("UPDATE users SET names='$name', username='$username', email='$email', phone='$phone', password='$password' WHERE id='$id'");
                if ($save)
                    return 1;
            }
            
        }

        function delete_supplier() {
            global $conn;

            $id = $_POST['id'];
            $del = $conn->query("DELETE FROM supplier WHERE id='$id'");
            if ($del)
                return 1;
        }

        function delete_staff() {
            global $conn;

            $id = $_POST['id'];
            $del = $conn->query("DELETE FROM staff WHERE id='$id'");
            if ($del)
                return 1;
        }

        function delete_customer() {
            global $conn;

            $id = $_POST['id'];
            $del = $conn->query("DELETE FROM users WHERE id='$id'");
            if ($del)
                return 1;
        }

        function save_category() {
            global $conn;

            extract($_POST);
            $data = "name='$name'";
            $data .= ", description='$description'";
            if (empty($id)) {
                if (!empty($name)) {
                    $qry = $conn->query("SELECT * FROM category WHERE name='$name'")->num_rows;
                    if ($qry > 0) {
                        return 2;
                    } else {
                        $save = $conn->query("INSERT INTO category SET ".$data);
                        if ($save)
                            return 1;
                    }
                    
                } else {
                    return 3;
                }
                
            } else {
                $save = $conn->query("UPDATE category SET ".$data." WHERE id=".$id);
                if ($save)
                    return 1;
            }
            
        }

        function delete_category() {
            global $conn;

            $id = $_POST['id'];
            $del = $conn->query("DELETE FROM category WHERE id='$id'");
            if ($del)
                return 1;
        }

        function save_product() {
            global $conn;

            $img = $_FILES['img']['name'];
            extract($_POST);
            $data = "name='$name'";
            $data .= ", brand_id='$brand'";
            $data .= ", unit_id='$unit'";
            $data .= ", category_id='$category'";
            $data .= ", quantity='$qty'";
            $data .= ", size='$size'";
            $data .= ", purchase_price='$purchase_price'";
            $data .= ", sale_price='$sale_price'";
            if (empty($id)) {
                if (!empty($name) && !empty($img)) {
                    $qry = $conn->query("SELECT * FROM products WHERE name='$name' AND category_id='$category' AND size='$size'")->num_rows;
                    if ($qry > 0) {
                        return 2;
                    } else {
                        $data .= ", image='$img'";
                        move_uploaded_file($_FILES['img']['tmp_name'], "product_img/".$img);
                        $save = $conn->query("INSERT INTO products SET ".$data);
                        if ($save)
                            return 1;
                    }
                    
                } else {
                    return 3;
                }
                
            } else {
                if (!empty($img)) {
                    $data .= ", image='$img'";
                    move_uploaded_file($_FILES['img']['tmp_name'], "product_img/".$img);
                }
                $save = $conn->query("UPDATE products SET ".$data." WHERE id=".$id);
                if ($save)
                    return 1;
            }
        }

        function delete_product() {
            global $conn;

            $id = $_POST['id'];
            $del = $conn->query("DELETE FROM products WHERE id='$id'");
            if ($del)
                return 1;
        }

        function save_purchase() {
            global $conn;

            extract($_POST);
            $invoice = uniqid('E-');
            $percent = $conn->query("SELECT * FROM tax WHERE id='$tax'")->fetch_array()['percent'];
            $grand_total = (($grnd + ($grnd * $percent / 100)) + $shipping) - $discount;
            $due = $grand_total - $paid;
            if ($due > 0) {
                $payment_status = 1;
            } else {
                $payment_status = 2;
            }
            

            $save_purchase = $conn->query("INSERT INTO purchase VALUES(NULL, '$invoice', '$supplier', '$p_date', '$discount', '$shipping', '$tax', '$grnd', '$grand_total', '$paid', '$due', '$terms', '$status', '$payment_status')");
            if ($save_purchase) {
                $puc_id = $conn->insert_id;
                foreach ($_POST['p_id'] as $id) {
                    $product_id = $id;
                    $qty = $_POST['qty_'.$id];
                    $price = $_POST['price_'.$id];
                    $total = $_POST['total_'.$id];

                    $data = "product_id='$product_id'";
                    $data .= ", purchase_id='$puc_id'";
                    $data .= ", quantity='$qty'";
                    $data .= ", price='$price'";
                    $data .= ", total='$total'";

                    $save = $conn->query("INSERT INTO purchase_products SET ".$data);
                    if ($status == 1) {
                        $conn->query("UPDATE products SET quantity=quantity+'$qty' WHERE id='$product_id'");
                    }
                    
                }

                if ($save) {
                    unset($_SESSION['products']);
                    return 1;
                }
            }

        }

        function save_purchase_status() {
            global $conn;

            extract($_POST);
            $save = $conn->query("UPDATE purchase SET purchase_status='$status' WHERE id='$id'");
            if ($save) {
                if ($status == 1) {
                    $qry = $conn->query("SELECT * FROM purchase_products WHERE purchase_id='$id'");
                    while ($row = $qry->fetch_array()) {
                        $p_id = $row['product_id'];
                        $_qty = $row['quantity'];
                        $conn->query("UPDATE products SET quantity=quantity+'$_qty' WHERE id='$p_id'");
                    }
                }
                return 1;
            }
        }

        function save_sales_new() {
            global $conn;

            extract($_POST);
            $invoice = uniqid('E-');
            $percent = $conn->query("SELECT * FROM tax WHERE id='$tax'")->fetch_array()['percent'];
            $grand_total = (($grnd + ($grnd * $percent / 100)) + $shipping) - $discount;
            $due = $grand_total - $paid;
            if ($due > 0) {
                $payment_status = 1;
            } else {
                $payment_status = 2;
            }
            

            $save_sales = $conn->query("INSERT INTO sales VALUES(NULL, '$invoice', '$name', '$email', '$phone', '$address', '$p_date', '$discount', '$shipping', '$tax', '$grnd', '$grand_total', '$paid', '$due', '$terms', '$status', '$payment_status')");
            if ($save_sales) {
                $sl_id = $conn->insert_id;
                foreach ($_POST['p_id'] as $id) {
                    $product_id = $id;
                    $qty = $_POST['qty_'.$id];
                    $price = $_POST['price_'.$id];
                    $total = $_POST['total_'.$id];

                    $data = "product_id='$product_id'";
                    $data .= ", sales_id='$sl_id'";
                    $data .= ", quantity='$qty'";
                    $data .= ", price='$price'";
                    $data .= ", total='$total'";

                    $save = $conn->query("INSERT INTO sales_products SET ".$data);
                    if ($status == 1) {
                        $conn->query("UPDATE products SET quantity=quantity-'$qty' WHERE id='$product_id'");
                    }
                    
                }

                if ($save) {
                    unset($_SESSION['products']);
                    return 1;
                }
            }

        }

        function save_sales_status() {
            global $conn;

            extract($_POST);
            $save = $conn->query("UPDATE sales SET sales_status='$status' WHERE id='$id'");
            if ($save) {
                if ($status == 1) {
                    $qry = $conn->query("SELECT * FROM sales_products WHERE sales_id='$id'");
                    while ($row = $qry->fetch_array()) {
                        $p_id = $row['product_id'];
                        $_qty = $row['quantity'];
                        $conn->query("UPDATE products SET quantity=quantity+'$_qty' WHERE id='$p_id'");
                    }
                }
                return 1;
            }
        }

        function send_mail() {
            global $conn;

            $email = $_POST['email'];
            $id = $_POST['id'];

            $qry = $conn->query("SELECT purchase.*, supplier.*, tax.name as t_name, tax.percent FROM purchase INNER JOIN supplier ON supplier.id=purchase.supplier INNER JOIN tax ON tax.id=purchase.tax WHERE purchase.id='$id'")->fetch_array();    
            foreach ($qry as $k => $val) {
                $$k = $val;
            }

            $product = $conn->query("SELECT purchase_products.*, products.name as p_name FROM purchase_products INNER JOIN products ON products.id=purchase_products.product_id WHERE purchase_products.purchase_id='$id'");

            

            $message = "
            <html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <meta http-equiv='X-UA-Compatible' content='IE=edge'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC' crossorigin='anonymous'>
                <style>
                    body {
                        background: #f1f5f9;
                        font-family: sans-serif;
                        margin: 0; padding: 0;
                    }
            
                    .header {
                        width: 100%;
                        padding: 1rem;
                        text-align: center;
                        background: #000033;
                    }
            
                    .header h1 {
                        color: #fff;
                    }
                </style>
            </head>
            <body>
                <div class='header'>
                    <h1>Robin Packaging ltd - Purchase Order</h1>
                </div>

                <div class='invoice-header'>
                    <div class='row'>
                        <div class='col-md-6'>
                            <span>Purchase no: <h3>$invoice</h3></span>
                        </div>
                        <div class='col-md-6'>
                            <span>DATE: <h3>$purchase_date</h3></span>
                        </div>
                    </div>
                </div>
                <div class='invoice_title'>
                    <h2>Purchase Order</h2>
                </div>
                <div class='invoice-body'>
                    <div class='row'>
                        <div class='col-md-6'>
                            <div>
                                <strong>Supplier Name: </strong><span>$name</span>
                            </div>
                            <div>
                                <strong>Supplier Address: </strong><span>$address</span>
                            </div>
                        </div>
                        <div class='col-md-6'>
                            <div>
                                <strong>Supplier Email: </strong><span>$email</span>
                            </div>
                            <div>
                                <strong>Supplier Contact: </strong><span>$phone</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='invoice-body'>
                    <table class='table table-bordered'>
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
                            <tr>
                                <th colspan='4' style='text-align:right'>SubTotal</th>
                                <td><?=KES$subtotal</td>
                            </tr>
                            <tr>
                                <th colspan='4' style='text-align:right'>Discount</th>
                                <td><?=KES$discount</td>
                            </tr>
                            <tr>
                                <th colspan='4' style='text-align:right'>Shipping</th>
                                <td><?=KES$shipping</td>
                            </tr>
                            <tr>
                                <th colspan='4' style='text-align:right'>Tax</th>
                                <td>$t_name ($percent%)</td>
                            </tr>
                            <tr>
                                <th colspan='4' style='text-align:right'>GrandTotal</th>
                                <td>KES$grand_total</td>
                            </tr>
                            <tr>
                                <th colspan='4' style='text-align:right'>Paid</th>
                                <td>KES$paid</td>
                            </tr>
                            <tr>
                                <th colspan='4' style='text-align:right'>Due</th>
                                <td><?=KES$due</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
            </body>
            </html>
                ";

                $mail = new PHPMailer(true);

                try {
                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                    $mail->Username   = 'ommykmathy2000@gmail.com';                     //SMTP username
                    $mail->Password   = 'xojimxuzaoihjiez';                               //SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            
                    //Recipients
                    $mail->setFrom('from@example.com', 'Robin Packaging LTD');
                    $mail->addAddress($email);     //Add a recipient
            
                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = 'Purchase Order';
                    $mail->Body    = $message;
                    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            
                    $mail->send();
                    return 1;
                } catch (Exception $e) {
                    return 2;
                }
        }

    }