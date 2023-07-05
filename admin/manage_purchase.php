<?php
    include 'connection.php';

    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $qry = $conn->query("SELECT * FROM products WHERE id=".$_GET['id'])->fetch_array();
        foreach ($qry as $k => $v) {
            $$k = $v;
        }
    }

    //unset($_SESSION['products']);
?>

<div class="container-fluid">
    <div class="content">
        <div class="content-header d-flex align-items-center justify-content-between">
            <h4>Manage Purchase</h4>
            <a href="index.php?page=purchase" class="btn btn-primary"><i class="fas fa-list"></i> List</a>
        </div>
        <div class="content-body">
            <div class="content-data mt-5">
                <form action="" id="sub_purchase">
                    <input type="hidden" name="id" value="<?=isset($_GET['id']) ? $_GET['id'] : "" ?>">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label for=""><span class="text-danger">*</span> Product</label>
                                <select name="product" id="" class="form-control">
                                    <option selected disabled>Select Product</option>
                                    <?php
                                        $qry = $conn->query("SELECT * FROM products");
                                        while ($row = $qry->fetch_array()) {
                                            ?>
                                                <option value="<?=$row['id'] ?>"><?=$row['name'] ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label for=""><span class="text-danger">*</span> Supplier</label>
                                <div class="select d-flex gap-2">
                                    <select name="supplier" id="" class="form-control">
                                        <?php
                                            $qry = $conn->query("SELECT * FROM supplier");
                                            while ($row = $qry->fetch_array()) {
                                                ?>
                                                    <option value="<?=$row['id'] ?>"><?=$row['name'] ?></option>
                                                <?php
                                            }
                                        ?>
                                    </select>
                                    <button class="btn btn-primary add_supplier" type="button"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label for=""><span class="text-danger">*</span> Purchase Date</label>
                                <input type="text" name="p_date" id="adate" class="form-control datetimepicker">
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <table class="table table-bordered" id="myTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Quantity</th>
                                        <th>Unit Price (KES)</th>
                                        <th>SubTotal (KES)</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if (!empty($_SESSION['products'])) {
                                            $s = 1;
                                            $total = 0;
                                            $tax_total = 0;
                                            foreach ($_SESSION['products'] as $key => $value) {
                                                ?>
                                                    <tr class="tr">
                                                        <td><?=$s ?></td>
                                                        <td><?=$value['name'] ?> <input type="hidden" name="p_id[]" value="<?=$value['id'] ?>"></td>
                                                        <td><input type="number" name="qty_<?=$value['id'] ?>" class="qty" value="1" style="border: 1px solid #ccc; padding: .5rem 1rem;"></td>
                                                        <td><input type="number" class="price" style="border: 1px solid #ccc; padding: .5rem 1rem;" name="price_<?=$value['id'] ?>" value="<?=$value['price'] ?>" readonly></td>
                                                        <td><input type="numer" class="total" style="border: 1px solid #ccc; padding: .5rem 1rem;" name="total_<?=$value['id'] ?>" value="<?=$value['price'] ?>" readonly></td>
                                                        <td><button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button></td>
                                                    </tr>
                                                <?php
                                                $s++;
                                                $total = $total + $value['price'];
                                            }
                                            ?>
                                                <tr>
                                                    <th colspan="4" style="text-align: right;">GrandTotal (KES)</th>
                                                    <td><input type="number" class="grand" style="border: 1px solid #ccc; padding: .5rem 1rem;" name="grnd" value="<?=$total ?>" readonly></td>
                                                    <td><a href="clear_products.php" class="btn btn-warning">Clear</a></td>
                                                </tr>
                                            <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-8 mb-3">
                            <div class="form-group mb-3">
                                <label for="">Terms And Conditions</label>
                                <textarea name="terms" id="" cols="30" rows="4" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group mb-3">
                                <label for=""><span class="text-danger">*</span> Select Order</label>
                                <select name="status" id="" class="form-control">
                                    <option disabled selected>Select Order Status</option>
                                    <option value="1">Received</option>
                                    <option value="2">Pending</option>
                                    <option value="3">Ordered</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Discout</label>
                                <div class="input-group">
                                    <span class="input-group-text">Ksh</span>
                                    <input type="number" name="discount" class="form-control" aria-label="Amount (to the nearest dollar)" value="<?=isset($purchase_price) ? $purchase_price : "0"; ?>">
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Shipping</label>
                                <div class="input-group">
                                    <span class="input-group-text">Ksh</span>
                                    <input type="number" name="shipping" class="form-control" aria-label="Amount (to the nearest dollar)" value="<?=isset($purchase_price) ? $purchase_price : "0"; ?>">
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for=""><span class="text-danger">*</span> TAX</label>
                                <div class="select d-flex gap-2">
                                    <select name="tax" id="" class="form-control">
                                        <?php
                                            $qry = $conn->query("SELECT * FROM tax");
                                            while ($row = $qry->fetch_array()) {
                                                ?>
                                                    <option value="<?=$row['id'] ?>"><?=$row['name']." (".$row['percent']."%)" ?></option>
                                                <?php
                                            }
                                        ?>
                                    </select>
                                    <button class="btn btn-primary add_tax" type="button"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Paid</label>
                                <div class="input-group">
                                    <span class="input-group-text">Ksh</span>
                                    <input type="number" name="paid" class="form-control" aria-label="Amount (to the nearest dollar)" value="0">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">SAVE</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<script>
    $('.datetimepicker').datetimepicker({
		format:"Y-m-d H:i "
	})

    $('[name="product"]').on("change", function(){
        $.ajax({
            url: 'ajax.php?action=load_product',
            method: 'POST',
            data: {p_id:$(this).val()},
            success: function(resp) {
                location.reload()
            }
        })
    })

    $('.add_tax').on('click', function(){
        uni_modal('Add Tax', 'process.php?pro=add_tax')
    })

    $('.clear').click(function(){
        $.ajax({
            url: 'ajax.php?action=clear_product',
            method: 'POST',
            data: {p_id:$(this).val()},
            success: function(resp) {
                if (resp == 1) {
                    alert("Product Cleared")
                }
            }
        })
    })

    $('.add_supplier').click(function(){
        uni_modal('Add Supplier', 'process.php?pro=add_supplier')
    })

    $('.qty').on("keyup change", function() {
        if ($(this).val() <= 0) {
            var val = 1
            $(this).val(val)
        }

        var grand_total = 0;
        $('#myTable > tbody > .tr').each(function(){
            var qty = $(this).find('.qty').val()
            var price = $(this).find('.price').val()
            var total = qty * price
            grand_total += total;
            $(this).find('.total').val(total)
        })
        $('[name="grnd"]').val(grand_total)
    })
    
    $('#sub_purchase').submit(function(e){
        e.preventDefault()
        start_loader()

        $.ajax({
            url: 'ajax.php?action=save_purchase',
            method: 'POST',
            type: 'POST',
            data: new FormData($(this)[0]),
            cashe: false,
            contentType: false,
            processData: false,
            error: err => {
                console.log(err)
                alert("An error occured")
                end_loader()
            },
            success: function(resp) {
                if (resp == 1) {
                    end_loader()
                    alert_pop("Purchase data saved successfully", "success")
                    setTimeout(() => {
                        location.href = 'index.php?page=purchase'
                    }, 1500);
                }

                if (resp == 2) {
                    alert_pop("Product already exists", "danger")
                    end_loader()
                }

                if (resp == 3) {
                    alert_pop("Please input the fields", "warning")
                    end_loader()
                }
            }
        })
    })

    $('[name="img"]').change(function(){
        const file = this.files[0];
        //console.log(file);
        if (file) {
            let reader = new FileReader(); // Object of file reader
            reader.onload = function(event) {
                //console.log(event.target.result);
                var img = document.createElement('IMG')
                img.src = event.target.result

                $('.image-preview').html(img)
            }
            reader.readAsDataURL(file);
        }
    })

    $('.add_brand').on('click', function(){
        uni_modal('Add Brand', 'process.php?pro=add_brand')
    })

    $('.add_unit').on('click', function(){
        uni_modal('Add Unit', 'process.php?pro=add_unit')
    })

    $('.add_category').on('click', function(){
        uni_modal('Add Category', 'process.php?pro=add_category')
    })

    $('[name="unit"]').on('change', function(){
        $.ajax({
            url: 'process.php?pro=show_unit',
            method: 'POST',
            data: {id:$(this).val()},
            success:function(resp) {
                $('.input-group-text').html(resp)
            }
        })
    })

    $('[name="qty"]').on("change keyup", function(){
        if ($(this).val() < 0) {
            $(this).val("0")
        }
    })
</script>