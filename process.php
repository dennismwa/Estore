<?php
    include 'admin/connection.php';
    session_start();

    $p = $_GET['p'];

    if ($p == "save_cart") {
        extract($_POST);
        

        $data = "product_id='$p_id'";
        $data .= ", user_id='$user_id'";
        $data .= ", quantity='$qty'";
        $data .= ", total='$total'";

        if ($qty > $p_qty) {
            echo 3;
        } else {
            $check = $conn->query("SELECT * FROM cart WHERE user_id='$user_id' AND product_id='$p_id'")->num_rows;
            if ($check > 0) {
                echo 2;
            } else {
                $save = $conn->query("INSERT INTO cart SET ".$data);
                if ($save) {
                    echo 1;
                }
            }
            
        }
        
    }

    if ($p == "delete_cart") {
        $id = $_POST['id'];

        $del = $conn->query("DELETE FROM cart WHERE id='$id'");
        if ($del)
            echo 1;
    }

    if ($p == "save_checkout") {
        $order_no = mt_rand(10000000, 99999999);
        $user_id = $_POST['user_id'];

        foreach ($_POST['id'] as $p_id) {
            $ref_no = "PO-".mt_rand(10000000, 99999999);

            $qty = $_POST['qty_'.$p_id];
            $price = $_POST['price_'.$p_id];
            $total = $_POST['total_'.$p_id];
            $vat = ($total * 0.02);
            $sub = $total + $vat;

            $data = "checkout_no='$order_no'";
            $data .= ", ref_no='$ref_no'";
            $data .= ", product_id='$p_id'";
            $data .= ", user_id='$user_id'";
            $data .= ", quantity='$qty'";
            $data .= ", price='$price'";
            $data .= ", total='$total'";
            $data .= ", vat='$vat'";
            $data .= ", subtotal='$sub'";

            $save = $conn->query("INSERT INTO checkout SET ".$data);
        }

        if ($save) {
            echo "<script>alert('Order saved successfully')</script>";
            header('Location:deliverly.php?checkout_no='.$order_no);
        }
    }

    if ($p == "save_user") {
        extract($_POST);
        $pass = md5($password1);
        $data = "names='$names'";
        $data .= ", username='$username'";
        $data .= ", email='$email'";
        $data .= ", phone='$phone'";
        $data .= ", password='$pass'";

        $uppercase = preg_match('@[A-Z]@', $password1);
        $lowercase = preg_match('@[a-z]@', $password1);
        $number = preg_match('@[0-9]@', $password1);
        $specialChars = preg_match('@[^\W]@', $password1);

        if (strlen($password1) < 8 || !$uppercase || !$lowercase || !$number || !$specialChars) {
            echo 4;
        } else {
            if ($password1 == $password2) {
                $qry = $conn->query("SELECT * FROM users WHERE username='$username' OR email='$email' OR phone='$phone'")->num_rows;
                if ($qry > 0) {
                    echo 2;
                } else {
                    $save = $conn->query("INSERT INTO users SET ".$data);
                    if ($save) {
                        echo 1;
                    }
                }
                
            } else {
                echo 3;
            }
        }
        
    }

    if ($p == "user_auth") {
        extract($_POST);

        $password = md5($password);
        $auth = $conn->query("SELECT * FROM users WHERE username='$username' AND password='$password'")->num_rows;
        if ($auth > 0) {
            $_SESSION['username'] = $username;  
            echo 1;
        } else {
            echo 2;
        }
        
    }

?>