<?php
    include 'admin/connection.php';

    $order_no = "EO-".mt_rand(10000000, 99999999);
    $user_id = $_POST['user_id'];
    $checkout_no = $_POST['checkout_no'];

    // Personal Information
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    //Delivery details
    $d_fname = $_POST['d_fname'];
    $d_lname = $_POST['d_lname'];
    $d_phone = $_POST['d_phone'];
    $country = $_POST['country'];
    $s_address = $_POST['s_address'];
    $city = $_POST['city'];
    $county = $_POST['county'];
    $d_fee = $_POST['fee'];
    $grand = $_POST['grand'];

    $save = $conn->query("INSERT INTO orders VALUES(NULL, '$order_no', '$user_id', '$fname', '$lname', '$phone', '$email', '$d_fname', '$d_lname', '$d_phone', '$country', '$city', '$county', '$s_address', '$d_fee', '$grand', '1', NULL)");
    if ($save) {
        $conn->query("DELETE FROM cart WHERE user_id='$user_id'");
        ?>
            <script>alert("Order saved successfully")</script>
            <script>location.href='payment.php?order_no=<?php echo $order_no; ?>'</script>
        <?php
    }
