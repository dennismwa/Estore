<?php
    include 'inc/top.php';

    $user_id = $_GET['user_id'];

    if (isset($_POST['calculate'])) {
        echo "Calculate";
    }
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

    <style>
        tr td {
            font-size: 1.5rem;
        }

        .form-control {
            font-size: 1.5rem;
        }

        input {
            width: 70%;
        }
    </style>
</head>
<body>
    

    <?php include 'inc/header.php'; ?>

    <main>
        
    <div class="cart-d">
    <div class="row">
        <div class="col-md-12 mt-4 p-4">
            <?php
                $qry = $conn->query("SELECT cart.*, products.name, products.image, products.sale_price FROM cart INNER JOIN products ON products.id=cart.product_id WHERE cart.user_id='$user_id'");
                if ($qry->num_rows > 0) {
                    ?>
                        <form action="process.php?p=save_checkout" method="POST" id="sub_form" style="width: 100%;">
                            <table class="table table-bordered text-center" style="width: 100%;" id="myTable">
                                <colgroup>
                                <col width="5%">
                                <col width="10%">
                                <col width="20%">
                                <col width="10%">
                                <col width="10%">
                                <col width="15%">
                                <col width="10%">
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product Image</th>
                                        <th>Product Name</th>
                                        <th>Product Price</th>
                                        <th>Product Quantity</th>
                                        <th>Sub Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $s = 1;
                                        $total = 0;
                                        while ($row = $qry->fetch_array()) {
                                            $id = $row['id'];
                                            ?>
                                                <tr>
                                                    <td><?php echo $s; ?></td>
                                                    <td><img src="admin/product_img/<?php echo $row['image']; ?>" alt="" width="60"> <input type="hidden" name="user_id" value="<?php echo $user_id; ?>"></td>
                                                    <td><?php echo $row['name']; ?> <input type="hidden" name="id[]" class="id" value="<?php echo $id; ?>"></td>
                                                    <td><?php echo $row['sale_price']; ?><input type="hidden" value="<?php echo $row['sale_price']; ?>" name="price_<?= $id ?>" class="price"></td>
                                                    <td><input type="number" value="<?php echo $row['quantity']; ?>" name="qty_<?= $id ?>" class="qty"></td>
                                                    <td><input type="number" value="<?php echo $row['total']; ?>" name="total_<?= $id ?>" class="total" readonly></td>
                                                    <td>
                                                        <button class="btn btn-danger btn-sm btn-remove" type="button" data-id="<?php echo $row['id']; ?>">remove</button>
                                                    </td>
                                                </tr>
                                            <?php
                                            $s++;
                                            $total = $total + $row['total'];
                                        }
                                    ?>
                                </tbody>
                            </table>
                            <div class="well">
                                <div class="row">
                                    <div class="col-md-4" style="margin-left: 50%;margin-right: 50%;">
                                        <div class="card">
                                            <div class="card-body">
                                                <h2 style="color: #000034;"><strong>Grand Total: </strong> <input type="number" name="grnd" id="" value="<?php echo $total; ?>" readonly></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    <?php
                }
            ?>
        
            
        </div>
        <div class="col-md-12 mt-2 mb-3 text-center p-4">
            <?php
                $qry = $conn->query("SELECT * FROM cart WHERE user_id='$user_id'")->num_rows;
                if ($qry > 0) {
                    ?>
                        <button type="button" class="btn btn-success" name="checkout" onclick="$('#sub_form').submit()">Checkout</button>
                    <?php
                } else {
                    ?>
                        <div class="alert alert-warning mt-5">No Items In The Cart</div>
                    <?php
                }
            ?>
        </div>
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
    <script>
        $(document).ready(function(){

            $('#form1').submit(function(e){
                e.preventDefault();
            });

            $('.btn-remove').click(function(){
                var id = $(this).attr('data-id')
                $.ajax({
                    url: 'process.php?p=delete_cart',
                    method: 'POST',
                    data: {id:id},
                    error: err => {
                        alert("An error occurred")
                    },
                    success:function(resp){
                        if (resp == 1) {
                            alert("Product Removed")
                            setTimeout(() => {
                                location.reload()
                            }, 1500);
                        }
                    }
                })
            });

            $('.qty').on('change keyup', function(){
                if ($(this).val() <= 0) {
                    var val = 1;
                    $(this).val(val)
                }
                var grand_total = 0;
                $('#myTable > tbody > tr').each(function(){
                    var qty = $(this).find('.qty').val()
                    var price = $(this).find('.price').val()
                    var total = qty * price
                    $(this).find('.total').val(total)
                    grand_total += total;
                })
                $('[name="grnd"]').val(grand_total)
            })

            /*$('#sub_form').submit(function(e){
                e.preventDefault()

                $.ajax({
                    url: 'process.php?p=save_order',
                    method: 'POST',
                    type: 'POST',
                    data: new FormData($(this)[0]),
                    cashe: false,
                    contentType: false,
                    processData: false,
                    success: function(resp) {
                        if (resp == 1) {
                            alert("Order saved successfully")
                            location.href = 'delivery.php'
                        }
                    }
                })
            })*/
        })
    </script>
</body>
</html>