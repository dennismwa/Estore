<style>
    .card-details span{
        font-size: 3rem;
        font-weight: bold;
    }
</style>
<div class="container-fluid">
    <div class="content">
        <div class="content-header">
            <h4>Admin Dashboard</h4>
        </div>
        <div class="content-body">
            <div class="cards mb-5">
                <div class="card-item">
                    <div class="card-details">
                        <span style="font-size: 3rem;color: #000034;">Products</span>
                        <h3><?=$conn->query("SELECT * FROM products")->num_rows; ?></h3>
                        <div class="details"><a href="index.php?page=product" class="menu-link <?php echo $current == '/admin/index.php?page=product' ? "active" : ""; ?>">View Products</a></div>
                    </div>
                    <div class="card-icon">
                        <span class="fas fa-gift"></span>
                    </div>
                </div>
                <div class="card-item">
                    <div class="card-details">
                        <span style="font-size: 3rem;color: #000034;">Pending Orders</span>
                        <h3><?=$conn->query("SELECT * FROM orders WHERE status='1'")->num_rows; ?></h3>
                        <div class="details"><a href="index.php?page=orders" class="menu-link <?php echo $current == '/admin/index.php?page=orders' ? "active" : ""; ?>">View Pending Orders</a></div>                  
                    </div>
                    <div class="card-icon">
                        <span class="fas fa-shopping-cart"></span>
                    </div>
                </div>
                <div class="card-item">
                    <div class="card-details">
                        <span style="font-size: 3rem;color: #000034;">Payed Orders</span>
                        <h3><?=$conn->query("SELECT * FROM orders WHERE status='2'")->num_rows; ?></h3>
                      
                        <div class="details"><a href="index.php?page=orders" class="menu-link <?php echo $current == '/admin/index.php?page=orders' ? "active" : ""; ?>">View Payed Orders</a></div>                  
                    </div>
                    <div class="card-icon">
                        <span class="fas fa-shopping-cart"></span>
                    </div>
                </div>
                <div class="card-item">
                    <div class="card-details">
                        <span style="font-size: 3rem;color: #000034;">Canceled Orders</span>
                        <h3><?=$conn->query("SELECT * FROM orders WHERE status='3'")->num_rows; ?></h3>
                        <div class="details"><a href="index.php?page=orders" class="menu-link <?php echo $current == '/admin/index.php?page=orders' ? "active" : ""; ?>">View Cancelled Orders</a></div>                  
                    </div>
                    <div class="card-icon">
                        <span class="fas fa-shopping-cart"></span>
                    </div>
                </div>
                <div class="card-item">
                    <div class="card-details">
                        <span style="font-size: 3rem;color: #000034;">Payments today</span>
                        <h3>
                            <?php
                                date_default_timezone_set("Africa/Nairobi");
                                $c_date = date("Y-m-d");
                                $qry = $conn->query("SELECT SUM(grand) as sales FROM orders WHERE date(order_date)='$c_date'")->fetch_array();
                                $grand = $qry['sales'];
                                if ($grand > 0) {
                                    echo "Ksh.".number_format($grand, 0);
                                } else {
                                    echo 0;
                                }
                            ?>
                        </h3>
                    </div>
                    <div class="card-icon">
                        <span class="fas fa-dollar-sign"></span>
                    </div>
                </div>
                <div class="card-item">
                    <div class="card-details">
                        <span style="font-size: 3rem;color: #000034;">Active Users</span>
                        <h3>4</h3>
                    </div>
                    <div class="card-icon">
                        <span class="fas fa-user-tie"></span>
                    </div>
                </div>
                <div class="card-item">
                    <div class="card-details">
                        <span style="font-size: 3rem; color: #000034;">Delivery Status</span>
                        <h3><?=$conn->query("SELECT * FROM orders WHERE status='1'")->num_rows; ?></h3>                 
                    </div>
                    <div class="card-icon">
                        <span class="fas fa-truck"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-2">
                    <div class="panel p-4 bg-light">
                        <div class="panel-body">
                            <canvas id="ch" width="100%" height="100"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="panel p-4 bg-light">
                        <div class="panel-body">
                            <canvas id="ch2" width="100%" height="100"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer" style="width: 100%; height: 5vh;background: darkcyan;text-align: center;color: #fff;position: absolute;bottom: 0;">
            <h4 style="margin-top: 6px;">Copyright &copy;2023 :Robin Packaging ltd</h4>
        </div>
    </div>
</div>

<script src="assets/js/chart1.js"></script>
<script src="assets/js/chart2.js"></script>