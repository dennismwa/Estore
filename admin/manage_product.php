<?php
    include 'connection.php';

    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $qry = $conn->query("SELECT * FROM products WHERE id=".$_GET['id'])->fetch_array();
        foreach ($qry as $k => $v) {
            $$k = $v;
        }
    }
?>

<div class="container-fluid">
    <div class="content">
        <div class="content-header d-flex align-items-center justify-content-between">
            <h4>Manage Product</h4>
            <a href="index.php?page=product" class="btn btn-primary"><i class="fas fa-list"></i> List</a>
        </div>
        <div class="content-body">
            <div class="content-data mt-5">
                <form action="" id="sub_product">
                    <input type="hidden" name="id" value="<?=isset($_GET['id']) ? $_GET['id'] : "" ?>">
                    <div class="row">
                        <div class="col-md-2 mb-3">
                            <div class="form-group d-flex flex-column">
                                <label for="">Image</label>
                                <div class="image-preview mb-2">
                                    <?php if (isset($image)): ?>
                                        <img src="product_img/<?=$image ?>" alt="">
                                    <?php else: ?>
                                    <i class="fas fa-image"></i>
                                    Upload
                                    <?php endif; ?>
                                </div>
                                <input type="file" class="form-control" name="img">
                            </div>
                        </div>
                        <div class="col-md-10 mb-3">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for=""><span class="text-danger">*</span> Name</label>
                                        <input type="text" class="form-control" name="name" value="<?=isset($name) ? $name : ""; ?>">
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for=""><span class="text-danger">*</span> Brand</label>
                                        <div class="select d-flex gap-2">
                                            <select name="brand" id="" class="form-control">
                                                <?php
                                                    $qry = $conn->query("SELECT * FROM brand");
                                                    while ($row = $qry->fetch_array()) {
                                                        ?>
                                                            <option value="<?=$row['id'] ?>" <?=isset($brand_id) && $brand_id == $row['id'] ? "selected" : "" ?>><?=$row['name'] ?></option>
                                                        <?php
                                                    }
                                                ?>
                                            </select>
                                            <button class="btn btn-primary add_brand" type="button"><i class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for=""><span class="text-danger">*</span> Unit</label>
                                        <div class="select d-flex gap-2">
                                            <select name="unit" id="" class="form-control">
                                                <option selected disabled>Select Unit</option>
                                                <?php
                                                    $qry = $conn->query("SELECT * FROM unit");
                                                    while ($row = $qry->fetch_array()) {
                                                        ?>
                                                            <option value="<?=$row['id'] ?>" <?=isset($unit_id) && $unit_id == $row['id'] ? "selected" : "" ?>><?=$row['name'] ?></option>
                                                        <?php
                                                    }
                                                ?>
                                            </select>
                                            <button class="btn btn-primary add_unit" type="button"><i class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for=""><span class="text-danger">*</span> Category</label>
                                        <div class="select d-flex gap-2">
                                            <select name="category" id="" class="form-control">
                                                <?php
                                                    $qry = $conn->query("SELECT * FROM category");
                                                    while ($row = $qry->fetch_array()) {
                                                        ?>
                                                            <option value="<?=$row['id'] ?>" <?=isset($category_id) && $category_id == $row['id'] ? "selected" : "" ?>><?=$row['name'] ?></option>
                                                        <?php
                                                    }
                                                ?>
                                            </select>
                                            <button class="btn btn-primary add_category" type="button"><i class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <!--<div class="col-md-8 mb-3">
                                    <div class="form-group">
                                        <label for=""><span class="text-danger">*</span> Barcode</label>
                                        <div class="select d-flex gap-2">
                                            <input type="text" name="barcode" id="" class="form-control w-50">
                                            <button class="btn btn-primary w-50" type="button"><i class="fas fa-barcode"></i> Generate Barcode</button>
                                        </div>
                                    </div>
                                </div>-->
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="">Opening Stock</label>
                                        <div class="input-group">
                                            <input type="number" name="qty" class="form-control" aria-label="Amount (to the nearest dollar)" value="<?=isset($quantity) ? $quantity : "0"; ?>">
                                            <span class="input-group-text" id="txt"><?= isset($unit_id) ? $conn->query("SELECT * FROM unit WHERE id='$unit_id'")->fetch_array()['short'] : "None" ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="">Size/Number Description</label>
                                        <input type="text" class="form-control" name="size" value="<?=isset($size) ? $size : ""; ?>">
                                    </div>
                                </div>
                            </div>
                            <h3>Price & Tax</h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for=""><span class="text-danger">*</span> Purchase Price</label>
                                        <div class="input-group">
                                            <span class="input-group-text">Ksh</span>
                                            <input type="number" name="purchase_price" style="border: 1.5px solid red;" class="form-control" aria-label="Amount (to the nearest dollar)" value="<?=isset($purchase_price) ? $purchase_price : "0"; ?>">
                                        </div>
                                        <span class="text-danger one" id="valid">Purchase Price must be greater than zero</span>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for=""><span class="text-danger">*</span> Sale Price</label>
                                        <div class="input-group">
                                            <span class="input-group-text">Ksh</span>
                                            <input type="number" name="sale_price" style="border: 1.5px solid red;" class="form-control" aria-label="Amount (to the nearest dollar)" value="<?=isset($sale_price) ? $sale_price : "0"; ?>">
                                        </div>
                                        <span class="text-danger two" id="valid">Sale Price must be greater than zero</span>
                                    </div>
                                </div>
                            </div>
                            <input type="submit" value="SAVE" class="btn btn-primary">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<script>
    $('#sub_product').submit(function(e){
        e.preventDefault()
        start_loader()

        $.ajax({
            url: 'ajax.php?action=save_product',
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
                    alert_pop("Product data saved successfully", "success")
                    setTimeout(() => {
                        location.href = 'index.php?page=product'
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

    if ($('[name="purchase_price"]').val() > 0) {
        $('.one').fadeOut('fast')
        $('[name="purchase_price"]').removeAttr("style")
    } else {
        $('.one').fadeIn('fast')
        $('[name="purchase_price"]').attr("style", "border:1.5px solid red")
    }

    if ($('[name="sale_price"]').val() > 0) {
        $('.two').fadeOut('fast')
        $('[name="sale_price"]').removeAttr("style")
    } else {
        $('.two').fadeIn('fast')
        $('[name="sale_price"]').attr("style", "border:1.5px solid red")
    }

    $('[name="purchase_price"]').on("change keyup", function(){
        if ($(this).val() > 0) {
            $('.one').fadeOut('fast')
            $(this).removeAttr("style")
        } else {
            $('.one').fadeIn('fast')
            $(this).attr("style", "border:1.5px solid red")
        }
    })

    $('[name="sale_price"]').on("change keyup", function(){
        if ($(this).val() > 0) {
            $('.two').fadeOut('fast')
            $(this).removeAttr("style")
        } else {
            $('.two').fadeIn('fast')
            $(this).attr("style", "border:1.5px solid red")
        }
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
                $('#txt').html(resp)
            }
        })
    })

    $('[name="qty"]').on("change keyup", function(){
        if ($(this).val() < 0) {
            $(this).val("0")
        }
    })
</script>