<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login| Estore</title>
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
    <div class="acc-container">
        <div class="acc-wrapper">
            <div class="left-section">
                <div class="left-section-details">
                    <h2>Estore <span><i class="fas fa-shopping-cart"></i><span></h2>
                    <div class="icon-container">
                        <span class="fas fa-user-circle"></span>
                    </div>
                    <div class="det">
                        Login to make Your orders
                    </div>
                </div>
            </div>
            <div class="right-section">
                <div class="right-section-details">
                    <?php $acc = isset($_GET['acc']) ? $_GET['acc'] : "login_data"; ?>
                    <?php include $acc.".php"; ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>