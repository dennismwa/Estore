<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estore | About</title>
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
			padding: 0;
			margin: 0;
		}
		.container-fluid{
			height: 70vh;
			overflow: hidden;
			background: aliceblue;
		}
		.row .card{
            width: 100%;
            height: 1ovh;
            display: grid;
            background: aliceblue;
            grid-template-columns: repeat(4, 1fr);
        }
        .card-item{
            height: 40vh;

            gap: 3rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 3rem 3rem ;
            margin: 2rem;
        }
        .card-item:nth-child(1){
            background: darkcyan;
        }
        .card-item:nth-child(2){
            background: #cdcdcd;
        }
        .card-item:nth-child(3){
            background: magenta;
        }
        .card-item:nth-child(4){
            background: yellowgreen;
        }
        .card-item h2{
            color: #000;
            font-size: 2rem;
            font-weight: bold;
            text-align: center;
        }
        .card-item span{
            font-size: 3rem;
            position: absolute;
            bottom: 40px;
            margin-left: 100px;
        }
        .card-item i{
            margin-right: -50px;
            font-size: 2rem;
        }
		
	</style>
<body>
    <?php include 'inc/header.php'; ?>
	<main>
    <div class="container-fluid">
		<div class="row">
			<div class="card">
                <div class="card-item">
                    <h2>Customers visit the website or the store</h2>
                    <i class="fas fa-arrow-right"></i>
                    <Span class="fas fa-globe"></Span>
                </div>
                <div class="card-item">
                    <h2>Customers visit the website or the store</h2>
                    <i class="fas fa-arrow-right"></i>
                    <Span class="fas fa-shopping-cart"></Span>
                </div>
                <div class="card-item">
                    <h2>Customers visit the website or the store</h2>
                    <i class="fas fa-arrow-right"></i>
                    <Span class="fas fa-paper-plane"></Span>
                </div>
                <div class="card-item">
                    <h2>Customers visit the website or the store</h2>
                    <Span class="fas fa-truck"></Span>
                </div>
            </div>
		</div> 
    </div>
	</main>
    <?php include 'footer.php'; ?>
</body>
</html>