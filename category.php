<?php
    include 'inc/top.php';

    $qry = $conn->query("SELECT * FROM category WHERE id=".$_GET['cat'])->fetch_array();
    foreach ($qry as $k => $v){
        $$k = $v;
    }

    $id = $_GET['cat'];

    $current  = $_SERVER['REQUEST_URI'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estore</title>
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

    <main>

        <div class="cat-section">
            <?php
                $qry = $conn->query("SELECT * FROM category ORDER BY id DESC");
                while ($row = $qry->fetch_array()) {
                    ?>
                        <a href="category.php?cat=<?php echo $row['id']; ?>" class="<?php echo $current == "/category.php?cat=".$row['id'] ? "active" : ""; ?>"><!--<div class="img-c"><img src="assets/images/images (4).jpg"></div>--> <div><?php echo $row['name']; ?></div></a>
                    <?php
                }
            ?>
        </div>

        <div class="items-section">
            <h2 class="text-center mt-5 mb-5"><?php echo $name; ?></h2>
            <div class="row">
            <?php
                $qry = $conn->query("SELECT * FROM products WHERE category_id='$id' ORDER BY id DESC");
                while ($row = $qry->fetch_array()) {
                    ?>
                        <div class="col-md-2 mb-3">
                            <form id="form_s">
                            <div class="list-item">
                                    <a href="product_details.php?id=<?php echo $row['id']; ?>">
                                        <div class="list-image">
                                            <img src="admin/product_img/<?php echo $row['image']; ?>">
                                            <span><img src="admin/product_img/<?php echo $row['image']; ?>"></span>
                                        </div>
                                    </a>
                                    <div class="list-details">
                                        <h4><?php echo $row['name']; ?></h4>
                                        <p>Ksh. <?php echo number_format($row['sale_price'], 2); ?></p>
                                        <strong><?=$row['size'] ?></strong>
                                    </div>
                                    <hr>
                                    <?php if (isset($_SESSION['username'])): ?>
                                    <button type="button" class="btn btn-primary btn-cart" data-id="<?=$row['id'] ?>" data-user="<?=$m['id'] ?>" style="margin-left: 50px;">Add to Cart</button>
                                    <?php else: ?>
                                        <a href="login.php" class="btn btn-primary">Login</a>
                                    <?php endif; ?>
                                    <hr>
                                </div>
                                    
                            </form>
                        </div>
                    <?php
                }
            ?>
            </div>
        </div>
    </main>

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
    <?php include 'footer.php'; ?>
    <script>
    function openForm() {
        document.getElementById("myForm").style.display = "block";
      }
      
      function closeForm() {
        document.getElementById("myForm").style.display = "none";
      }
      </script>
      <script>
        
        function myFunction() {
          document.getElementById("myDropdown").classList.toggle("show");
        }
        window.onclick = function(e) {
          if (!e.target.matches('.dropbtn')) {
          var myDropdown = document.getElementById("myDropdown");
            if (myDropdown.classList.contains('show')) {
              myDropdown.classList.remove('show');
            }
          }
        }
        </script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
          $('.custom').owlCarousel({
            items: 1,
            autoplay: true,
            loop: true,
            dots: false
          });

          window.uni_modal = function($title="", $url="") {
            $.ajax({
                url: $url,
                error: err => {
                    console.log(err)
                    alert("An error occured")
                },
                success: function(data) {
                    $('#uni_modal .modal-title').html($title)
                    $('#uni_modal .modal-body').html(data)
                    $('#uni_modal').modal('show')
                }
            })
          }

          $('[name="qty"]').change(function(){
            if ($(this).val() <= 0) {
                var val = 1
                $(this).val(val)
            }
          })

          $('[name="qty"]').keyup(function(){
            if ($(this).val() <= 0) {
                var val = 1
                $(this).val(val)
            }
          })

          $('#form_s').submit(function(e){
            e.preventDefault();

            $.ajax({
                url: 'process.php?p=save_cart',
                method: 'POST',
                type: 'POST',
                data: new FormData($(this)[0]),
                cashe: false,
                contentType: false,
                processData: false,
                success: function(resp) {
                    if (resp == 1) {
                        alert('Cart Added Successfully')
                        location.reload()
                    }

                    if (resp == 2) {
                        alert('Cart Already Added')
                    }

                    if (resp == 3) {
                        alert('The quantity requested exceeds the stock')
                    }
                }
            })
          })
        });
    </script>
</body>
</html>