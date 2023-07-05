<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estore | Contact</title>
        <link rel="stylesheet" href="assets/css/all.min.css">
        <link rel="stylesheet" href="assets/css/fontawesome.min.css">
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
        <link rel="stylesheet" href="assets/css/owl.theme.default.css">
        <link rel="stylesheet" href="assets/css/style.css">

        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.min.js"></script>
</head>
<style>
    *{
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }
    .row .one{
        height: 70vh;
        width: 100%;
        background: #fff;
        top: 0;
        display: relative;
        margin-top: 0;
    }
    .section1{
        background: #c1c1c1;
        width: 100%;
        height: 60vh;
        display: flex;
        top: 0;

    }
    .item1{
        width: 300px;
        height: 300px;

    }
    .item1 img{
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }
    .section2{
        width: 100;
        height: 60vh;
        display: flex;
        background: darkcyan;
        position: relative;

    }
    .item2{
        width: 300px;
        height: 300px;
        background: coral;
        position: absolute;
        margin-top: 0;
    }
    .item2 h2{
        text-align: center;
        font-size: 30px;
    }
    .item2 form{
        border: 1px solid #000;
        width: 300px;
        margin-top: 10px;
        height: 250px;
        background: none;
    }
    .child{
        width: 150px;
        display: block;
        padding: 15px 12px;
    }
    .child input[type=text], input[type=email]{
        width: 150px;
        border: none;
        margin-bottom: 150px;
        padding: 12px 18px;
        color: #000;
        background: transparent;
    }
    .child button{
        background: #000034;
        color: #fff;
        padding: 12px 15px;
        font-weight: bolder;
        font-size: 20px;
        position: absolute;
        border: none;
        border-radius: 22px;
    }
    .parent{
        width: 150px;
        display: block;
        padding: 15px 12px;
    }
    .parent h2{
        font-size: 18px;
        color: #fff;
        text-align: center;
    }
    .parent h3{
        font-size: 15px;
        color: #fff;
        text-align: center;
    }


</style>
<body>
    <?php include 'inc/header.php'; ?>
	<main>
       <div class="col-md-6">
        <div class="first">
            <input type="text" name="" placeholder="First Name">
            <input type="email" name="" placeholder="Email">
            <input type="text" name="" placeholder="Message">
        </div>
        <div class="second">
            <h2>Contact</h2>
            <h3>Production Manager</h3>
        </div>
       </div>
    </main>
    <?php include 'footer.php'; ?>
</body>
</html>