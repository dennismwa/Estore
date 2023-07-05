<?php
    include 'connection.php';

    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $qry = $conn->query("SELECT * FROM products WHERE id=".$_GET['id'])->fetch_array();
        foreach ($qry as $k => $v) {
            $$k = $v;
        }
    }
?>

<form action="" id="sub_form">
    <input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ""; ?>">
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="form-group">
                <label for="">Product Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo isset($name) ? $name : ""; ?>">
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="form-group">
                <label for="">Product Image</label>
                <input type="file" name="image" class="form-control">
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="form-group">
                <label for="">Product units</label>
                <input type="number" name="units" class="form-control" value="<?php echo isset($units) ? $units : ""; ?>">
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="form-group">
                <label for="">Product Weight</label>
                <input type="text" name="weight" class="form-control" value="<?php echo isset($weight) ? $weight : ""; ?>">
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="form-group">
                <label for="">Product Category</label>
                <select name="category" id="" class="form-control">
                    <?php
                        $qry = $conn->query("SELECT * FROM category");
                        while ($row = $qry->fetch_array()) {
                            ?>
                                <option value="<?php echo $row['id']; ?>" <?php echo isset($category_id) && $category_id == $row['id'] ? "selected" : ""; ?>><?php echo $row['name']; ?></option>
                            <?php
                        }
                    ?>
                </select>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="form-group">
                <label for="">Product Price</label>
                <input type="number" name="price" class="form-control" value="<?php echo isset($price) ? $price : ""; ?>">
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="form-group">
                <label for="">Supplier</label>
                <select name="supplier" id="" class="form-control">
                    <?php
                        $qry = $conn->query("SELECT * FROM supplier");
                        while ($row = $qry->fetch_array()) {
                            ?>
                                <option value="<?php echo $row['id']; ?>" <?php echo isset($supplier_id) && $supplier_id == $row['id'] ? "selected" : ""; ?>><?php echo $row['name']; ?></option>
                            <?php
                        }
                    ?>
                </select>
            </div>
        </div>
        <div class="col-md-12 mb-4">
            <div class="form-group">
                <label for="">Category Description</label>
                <textarea name="description" id="" cols="30" rows="4" class="form-control">
                    <?php echo isset($description) ? $description : ""; ?>
                </textarea>
            </div>
        </div>
    </div>
</form>

<script>
    $('#sub_form').submit(function(e){
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
                    alert_pop("Product data saved successfully", "success")
                    end_loader()
                    $('#uni_modal').modal('hide')
                    setTimeout(() => {
                        location.reload()
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
</script>