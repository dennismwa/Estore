<?php
    include "connection.php";
    session_start();    

    $current = $_SERVER['REQUEST_URI'];
    if (strlen($_SESSION['username']) == 0) {
        header('Location:login.php');
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
    <link rel="stylesheet" href="assets/css/Chart.min.js">

    <!--script links-->
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery.datetimepicker.full.min.js"></script>
    <script src="assets/js/jquery.dataTables.js"></script>
    <script src="assets/js/script.js"></script>
    <script src="assets/js/Chart.min.js"></script>
    <script src="assets/js/Chart.bundle.min.js"></script>
</head>
<body>
    <!--navbar-->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <div class="navbar-brand">
                    <span class="fas fa-angle-left" id="menu-bar"></span>
                </div>
                <div class="heading"><h2>Robin Packaging ltd</h2></div>
            </div>
            <div class="profile">
                <span><?php echo isset($_SESSION['username']) ? $_SESSION['username'] : "admin name"; ?></span>
                <a href="ajax.php?action=logout"><i class="fas fa-power-off"></i>LogOut</a>
            </div>
        </div>
    </nav>
    <!--/navbar-->

    <!--preloader-->
    <div class="preloader"></div>
    <!--/preloader-->

    <!--Alert-->
    <div class="alert-pop bg-success" role="alert">
        <span class="msg">Testimg Message</span>
        <span class="close"><i class="fas fa-times-circle"></i></span>
    </div>
    <!--/Alert-->

    <!--Sidebar-->
    <div class="sidebar">
        <div class="sidebar-header">
            <h3><i class="fas fa-face-laugh-wink"></i> <span>admin</span></h3>
        </div>

        <a href="index.php?page=home" class="menu-link <?php echo $current == '/Estore/admin/index.php?page=home' ? "active" : ""; ?>"><span class="fas fa-tachometer-alt"></span> <span>Dashboard</span></a>
        <span class="inactive">Menus</span>
        <a href="index.php?page=product" class="menu-link <?php echo $current == '/Estore/admin/index.php?page=product' ? "active" : ""; ?>"><span class="fas fa-gift"></span> <span>Products</span></a>
        <a href="index.php?page=category" class="menu-link <?php echo $current == '/Estore/admin/index.php?page=category' ? "active" : ""; ?>"><span class="fas fa-th"></span> <span>Category</span></a>
        <a href="index.php?page=brand" class="menu-link <?php echo $current == '/Estore/admin/index.php?page=brand' ? "active" : ""; ?>"><span class="fas fa-list"></span> <span>Brand</span></a>
        <a href="index.php?page=supplier" class="menu-link <?php echo $current == '/Estore/admin/index.php?page=supplier' ? "active" : ""; ?>"><span class="fas fa-user-tie"></span> <span>Supplier</span></a>
        <a href="index.php?page=purchase" class="menu-link <?php echo $current == '/Estore/admin/index.php?page=purchase' ? "active" : ""; ?>"><span class="fas fa-box"></span> <span>Purchases</span></a>
        <a href="index.php?page=purchase_delivered" class="menu-link <?php echo $current == '/Estore/admin/index.php?page=purchase_delivered' ? "active" : ""; ?>"><span class="fas fa-box"></span> <span>Purchase Delivered</span></a>
        <a href="index.php?page=sales" class="menu-link <?php echo $current == '/Estore/admin/index.php?page=sales' ? "active" : ""; ?>"><span class="fas fa-shopping-bag"></span> <span>Sales</span></a>
        <a href="index.php?page=sales_delivered" class="menu-link <?php echo $current == '/Estore/admin/index.php?page=sales_delivered' ? "active" : ""; ?>"><span class="fas fa-shopping-bag"></span> <span>Sales Delivered</span></a>
        <a href="index.php?page=orders" class="menu-link <?php echo $current == '/Estore/admin/index.php?page=orders' ? "active" : ""; ?>"><span class="fas fa-shopping-bag"></span> <span>Orders</span></a>
        <a href="index.php?page=payments" class="menu-link <?php echo $current == '/Estore/admin/index.php?page=payments' ? "active" : ""; ?>"><span class="fas fa-money-bill-wave"></span> <span>Payments</span></a>
        <a href="index.php?page=staffs" class="menu-link <?php echo $current == '/Estore/admin/index.php?page=staffs' ? "active" : ""; ?>"><span class="fas fa-user-tie"></span> <span>Staffs</span></a>
        <a href="index.php?page=admin" class="menu-link <?php echo $current == '/Estore/admin/index.php?page=admin' ? "active" : ""; ?>"><span class="fas fa-user-tie"></span> <span>Admins</span></a>
        <a href="index.php?page=customers" class="menu-link <?php echo $current == '/Estore/admin/index.php?page=customers' ? "active" : ""; ?>"><span class="fas fa-user-friends"></span> <span>Customers</span></a>
    </div>
    <!--/Sidebar-->

    <!--main section-->
    <main>
        <?php $page = isset($_GET['page']) ? $_GET['page'] : "home"; ?>
        <?php include "$page".".php"; ?>
    </main>
    <!--/main section-->

    <!--Modal-->
    <div class="modal fade" id="uni_modal" tabindex="-1" aria-labelledby="exampleModalCenteredScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenteredScrollableTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="$('#uni_modal form').submit()">Save</button>
            </div>
            </div>
        </div>
    </div>
    <!--/Modal-->
</body>
</html>

<script>
    $(document).ready(function(){
        $('.navbar-brand').click(function(){
            $(this).toggleClass('active')
            $('.sidebar').toggleClass('active')
            $('.navbar').toggleClass('active')
        })

        $('#table_id').DataTable({
            'scrollX': true
        });

        window.start_loader = function() {
            $('body').prepend("<div class='preloader2'></div>")
        }

        window.end_loader = function() {
            $('.preloader2').fadeOut('fast', function(){
                $(this).remove()
            })
        }

        window.uni_modal = function($title="", $url="") {
            start_loader()

            $.ajax({
                url: $url,
                error: err => {
                    console.log(err)
                    alert("An error occured!!!")
                    end_loader()
                },
                success: function(resp) {
                    end_loader()
                    $('#uni_modal .modal-title').html($title)
                    $('#uni_modal .modal-body').html(resp)
                    $('#uni_modal').modal('show')
                }
            })
        }

        window.alert_pop = function($msg="Test", $bg="success") {
            $('.alert-pop').removeClass('bg-success')
            $('.alert-pop').removeClass('bg-info')
            $('.alert-pop').removeClass('bg-danger')
            $('.alert-pop').removeClass('bg-warning')

            if ($bg == "success")
                $('.alert-pop').addClass('bg-success')
            if ($bg == "info")
                $('.alert-pop').addClass('bg-info')
            if ($bg == "danger")
                $('.alert-pop').addClass('bg-danger')
            if ($bg == "warning")
                $('.alert-pop').addClass('bg-warning')

            $('.alert-pop .msg').html($msg)
            $('.alert-pop').delay(50).fadeIn('show')
        }

        $('.close').click(function(){
            $('.alert-pop').fadeOut('slow')
        })
    })
</script>