<?php
    include 'inc/top.php';

    $checkout_no = $_GET['checkout_no'];
    $user_id = $m['id'];
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
        
    <div class="cart-d p-4">
        <form action="save_orders.php" method="POST">
            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
            <input type="hidden" name="checkout_no" value="<?php echo $checkout_no; ?>">
            <div class="row">
                <div class="col-md-6 mb-3 p-2">
                    <div class="card">
                        <div class="card-header">
                            <h3>Your Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="">First Name <span class="text-danger">*</span></label>
                                        <input type="text" name="fname" id="" value="<?php $qry = $conn->query("SELECT * FROM users WHERE username='$username'")->fetch_array();?>"class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="">Last Name <span class="text-danger">*</span></label>
                                        <input type="text" name="lname" id="" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="">Phone Number <span class="text-danger">*</span></label>
                                        <input type="text" name="phone" id="" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="">Email <span class="text-danger">*</span></label>
                                        <input type="text" name="email" id="" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-header">
                            <h3>Delivery Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="">Deliver to: First Name <span class="text-danger">*</span></label>
                                        <input type="text" name="d_fname" id="" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="">Deliver to: Last Name <span class="text-danger">*</span></label>
                                        <input type="text" name="d_lname" id="" placeholder="Enter Last Name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="">Deliver to: Phone <span class="text-danger">*</span></label>
                                        <input type="tel" name="d_phone" id="" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                    <label for="">Country <span class="text-danger">*</span></label>
                                        <input type="text" name="country" id="" class="form-control" value="Kenya" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                    <label for="">Street Address <span class="text-danger">*</span></label>
                                        <input type="text" name="s_address" id="" placeholder="Enter Email Address" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                    <label for="">Town / City <span class="text-danger">*</span></label>
                                        <input type="text" name="city" id="" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                    <label for="">State / County <span class="text-danger">*</span></label>
                                        <select name="county" id="" class="form-control">
                                            <option value="0">Nairobi</option>
                                            <option value="200">Thika</option>
                                            <option value="500">Mombasa</option>
                                            <option value="150">Kiambu</option>
                                            <option value="250">Nyeri</option>
                                            <option value="250">Nakuru</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 p-4">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3>Products</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Ref No</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th>Vat</th>
                                        <th>Sub Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $total = 0;
                                        $qry = $conn->query("SELECT * FROM checkout WHERE checkout_no='$checkout_no'");
                                        while ($row = $qry->fetch_assoc()) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $row['ref_no'] ?></td>
                                                    <td><?php echo $row['quantity'] ?></td>
                                                    <td>Ksh.<?php echo number_format($row['total'], 2) ?></td>
                                                    <td>Ksh.<?php echo number_format($row['vat'], 2) ?></td>
                                                    <td>Ksh.<?php echo number_format($row['subtotal'], 2) ?></td>
                                                </tr>
                                            <?php
                                            $total = $total + $row['subtotal'];
                                        }
                                    ?>
                                    <tr>
                                        <th colspan="4" style="text-align: right;">Total</th>
                                        <td><?php echo "Ksh." .number_format($total, 2); ?><input type="hidden" name="total" value="<?php echo $total; ?>"></td>
                                    </tr>
                                    <tr>
                                        <th colspan="4" style="text-align: right;">Delivery Fee</th>
                                        <td><span id="d_fee">0</span><input type="hidden" value="0" name="fee" readonly></td>
                                    </tr>
                                    <tr>
                                        <th colspan="4" style="text-align: right;">Grand Total</th>
                                        <td><span id="grnd"><?php echo $total; ?></span><input type="hidden" value="<?php echo $total; ?>" name="grand" readonly></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Place Order</button>
                </div>
                
            </div>
        </form>
        
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
            $('[name="county"]').on('change', function(){
                var val = $(this).val()
                var total = $('[name="total"]').val()
                var grand = parseInt(total) + parseInt(val)
                $('#d_fee').html(val)
                $('[name="fee"]').val(val)
                $('#grnd').html(grand)
                $('[name="grand"]').val(grand)
            })

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
                    var vat = total * 0.02
                    var grand = total + vat
                    $(this).find('.total').val(total)
                    $(this).find('.vat').val(vat)
                    $(this).find('.grand').val(grand)
                    grand_total += grand;
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