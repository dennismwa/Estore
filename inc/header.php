<?php
    $user_id = $m['id'];
?>

<header>
    <div class="top-header">
        <div class="header-title">
            <a href="index.php"><span>E</span>STORE</a>
        </div>
        <form action="search.php" method="POST">
            <div class="search-bar">
                <input type="search" name="search" id="search" placeholder="Search here...." value="<?=isset($_POST['search']) ? $_POST['search'] : "" ?>">
                <button class="btn-search" type="submit">Search</button>
            </div>
            
        </form>
        <div class="view">
            <?php if (isset($_SESSION['username'])): ?>
            <a href="cart_details.php?user_id=<?php echo $m['id']; ?>"><span class="badge bg-danger"><?php echo $conn->query("SELECT * FROM cart WHERE user_id='$user_id'")->num_rows; ?></span><i class="fas fa-shopping-cart"></i> </a>
            <?php else: ?>
                <a href="#">View your Cart<i class="fas fa-shopping-cart"></i></a>
            <?php endif; ?>
        </div>
            <div class="profile">
                <button class="dropbtn" onclick="myFunction()"><span class="fas fa-user-alt"><span><span class="fas fa-caret-down"><span></button>
                    <div class="dropdown-content" id="myDropdown"><a href="Login.php">Profile</a><hr>
                        <a href="logout.php">Log Out</a>
                    </div>
            </div>
    </div>
    <div class="bottom-header">
        <div class="logo">
           <a href="index.php"> <img src="assets/images/logo.png" alt=" "></a>
        </div>
        <div class="links">
                <a href="about1.php">About Us</a>&nbsp; / &nbsp;
                <a href="service.html">Services</a>
        </div>
        <div class="contacts">
            <span><i class="fas fa-phone"></i> (+254)758256440</span>&nbsp;&nbsp;
            <span><i class="fas fa-envelope"></i> estorepackaging@gmail.com</span>
        </div>
    </div>

</header>