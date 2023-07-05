<?php
    include 'connection.php';

    $pro = $_GET['pro'];

    if ($pro == "add_brand") {
        ?>
            <form action="" id="sub_brand">
                <div class="form-group mb-2">
                    <label for="">Brand Name</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="form-group mb-2">
                    <label for="">Brand Description</label>
                    <textarea name="desc" id="" cols="30" rows="5" class="form-control"></textarea>
                </div>
            </form>
        <?php
    }

    if ($pro == "add_unit") {
        ?>
            <form action="" id="sub_unit">
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <div class="form-group">
                            <label for="">Unit Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="form-group">
                            <label for="">Unit Short</label>
                            <input type="text" name="short" class="form-control">
                        </div>
                    </div>
                </div>
                
            </form>
        <?php
    }

    if ($pro == "add_category") {
        ?>
            <form action="" id="sub_category">
                <div class="form-group mb-2">
                    <label for="">Category Name</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="form-group mb-2">
                    <label for="">Category Description</label>
                    <textarea name="desc" id="" cols="30" rows="5" class="form-control"></textarea>
                </div>
            </form>
        <?php
    }

    if ($pro == "add_tax") {
        ?>
            <form action="" id="sub_tax">
                <div class="form-group mb-2">
                    <label for="">Tax Name</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="form-group mb-2">
                    <label for="">Tax Percentage</label>
                    <input type="number" name="percent" class="form-control">
                </div>
            </form>
        <?php
    }

    if ($pro == "add_supplier") {
        ?>
            <form action="" id="sub_supplier">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="form-group">
                            <label for="">Supplier Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo isset($name) ? $name : ""; ?>">
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="form-group">
                            <label for="">Supplier Contact</label>
                            <input type="tel" name="phone" class="form-control" value="<?php echo isset($phone) ? $phone : ""; ?>">
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="form-group">
                            <label for="">Supplier Email</label>
                            <input type="email" name="email" class="form-control" value="<?php echo isset($email) ? $email : ""; ?>">
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="form-group">
                            <label for="">Supplier Address</label>
                            <input type="text" name="address" class="form-control" value="<?php echo isset($address) ? $address : ""; ?>">
                        </div>
                    </div>
                </div>
            </form>
        <?php
    }

    if ($pro == "show_unit") {
        $id = $_POST['id'];
        $short = $conn->query("SELECT * FROM unit WHERE id='$id'")->fetch_array()['short'];
        echo $short;
    }

?>

<script>
    $('#sub_brand').submit(function(e){
        e.preventDefault()
        start_loader()

        $.ajax({
            url: 'ajax.php?action=add_brand_product',
            method: 'POST',
            data: $(this).serialize(),
            success: function(data) {
                $('#uni_modal').modal('hide')
                $('[name="brand"]').html(data)
                end_loader()
            }
        })
    })

    $('#sub_unit').submit(function(e){
        e.preventDefault()
        start_loader()

        $.ajax({
            url: 'ajax.php?action=add_unit_product',
            method: 'POST',
            data: $(this).serialize(),
            success: function(data) {
                $('#uni_modal').modal('hide')
                $('[name="unit"]').html(data)
                end_loader()
            }
        })
    })

    $('#sub_tax').submit(function(e){
        e.preventDefault()
        start_loader()

        $.ajax({
            url: 'ajax.php?action=add_tax_product',
            method: 'POST',
            data: $(this).serialize(),
            success: function(data) {
                $('#uni_modal').modal('hide')
                $('[name="tax"]').html(data)
                end_loader()
            }
        })
    })

    $('#sub_supplier').submit(function(e){
        e.preventDefault()
        start_loader()

        $.ajax({
            url: 'ajax.php?action=add_supplier_purchase',
            method: 'POST',
            data: $(this).serialize(),
            success: function(data) {
                $('#uni_modal').modal('hide')
                $('[name="supplier"]').html(data)
                end_loader()
            }
        })
    })

    $('#sub_category').submit(function(e){
        e.preventDefault()
        start_loader()

        $.ajax({
            url: 'ajax.php?action=add_category_product',
            method: 'POST',
            data: $(this).serialize(),
            success: function(data) {
                $('#uni_modal').modal('hide')
                $('[name="category"]').html(data)
                end_loader()
            }
        })
    })

    $(document).ready(function(){})
</script>