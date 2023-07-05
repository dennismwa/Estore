<!DOCTYPE html>
<html>
<head>
	<title>Portfolio</title>
	<link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="assets/css/jquery.dataTables.css">
    <link rel="stylesheet" href="assets/css/jquery.datetimepicker.min.css">
    <link rel="stylesheet" href="assets/css/styles2.css">

    <!--script links-->
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery.datetimepicker.full.min.js"></script>
    <script src="assets/js/jquery.dataTables.js"></script>
    <script src="assets/js/script.js"></script>
</head>
<body>
	<header class="header" id="header">
		<nav class="nav container">
			<a href="#" class="nav__logo">
				Dennis <span>mwangi</span>
			</a>
			<div class="nav__menu" id="nav-menu">
				<ul class="nav__list">
					<li class="nav__item"><a href="#home" class="nav__link">Home</a></li>
					<li class="nav__item"><a href="#about" class="nav__link">About</a></li>
					<li class="nav__item"><a href="#service" class="nav__link">Service</a></li>
					<li class="nav__item"><a href="#project" class="nav__link">Projects</a></li>
					<li class="nav__item"><a href="#contact" class="nav__link">Contact</a></li>
				</ul>
				<div class="nav__close" id="nav-close">
					<i class="fas fa-close"></i>
				</div>
			</div>
			<div class="nav__toggle" id="nav-toggle"><i class="fas fa-menu"></i></div>
		</nav>
	</header>

	<main class="main">
		<img src="border.png">

	</main>

	<footer class="footer">
		
	</footer>

</body>
<script type="text/javascript">
	const navMenu = document.getElementById('nav-menu'),
	navToggle = document.getElementById('nav-toggle'),
	navClose = document.getElementById('nav-close')

	if(navToggle){
		navToggle.addEventListener('click', () =>{
			navMenu.classList.add('show-menu')
		})
	}
	if(navClose){
		navClose.addEventListener('click', () =>{
			navMenu.classList.remove('show-menu')
		})
	}

	const navLink = document.querySelectorAll('.nav__link')

	const linkAction = () =>{
		const navMenu = document.getElementById('nav-menu')
		navMenu.classList.remove('show-menu')
	}
	
</script>
</html>