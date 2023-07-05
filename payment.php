<?php
    include 'inc/top.php';

    $user_id = $m['id'];
    $order_no = $_GET['order_no'];
    $qry = $conn->query("SELECT * FROM orders WHERE order_no='$order_no'")->fetch_array();
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
    <title>Estore | Payment</title>
        <link rel="stylesheet" href="assets/css/all.min.css">
        <link rel="stylesheet" href="assets/css/fontawesome.min.css">
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
        <link rel="stylesheet" href="assets/css/owl.theme.default.css">
        <link rel="stylesheet" href="assets/css/style.css">

        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.min.js"></script>
</head>
<body>
    <?php include 'inc/header.php'; ?>
    <div class="container-fluid" id="container">
        <form id="pay" action="mpesa.php" method="POST"style="margin-top: 20vh;">
            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
            <input type="hidden" name="order_no" value="<?php echo $order_no; ?>">
            <h2><span class="payy">Pay</span>ment</h2><br>
            <label for=""style="font-weight: bolder;font-size: 1.4rem">Mpesa Phone Number</label>
            <input type="text" name="phone_number" id="phone" placeholder="Phone Number"style="width: 250px;border-radius: 8px;padding: 8px 8px; display: block; margin-left: 10%;" required>
            <label for="" style="font-weight: bolder;font-size: 1.4rem;">Amount</label>
            <input type="number" name="amount" placeholder="Amount" value="<?php echo $grand; ?>" style="width: 200px;padding: 5px 8px;text-align: center;border: thin solid #000;border-radius: 8px; display: block; margin-left: 10%;font-size: 1.5rem;"readonly>
            <button type="submit" class="btn btn-primary" id="pay-submit">Submit</button>
        </form>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>